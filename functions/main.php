<?php
require_once __DIR__ . '/helper.php';
require_once __DIR__ . '/validation.php';
require_once __DIR__ . '/Message.php';
require_once __DIR__ . '/OldInputs.php';
$config = require_once('config.php');


session_start();

$action = $_POST['action'] ?? null;
if (!empty($action)) {
    $action();
}

function sendEmail()
{
    $email = $_POST['email'] ?? null;    // ''
    $message = $_POST['message'] ?? null; // 'dfgf gdfgdfg'

    if (empty($email) || empty($message)) {
        Message::set('All fields required', 'danger');
        OldInputs::set($_POST);   // ['email'=>'', 'message'=>'dfgf gdfgdfg']
    } else {
        // mail()
        Message::set('Thank!');
    }
    redirect('/contacts');
}


function login(){
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    if(empty($email) || empty($password)){
        $_SESSION['err_message'] = 'Please fill out all fields';
        redirect('/login');
        return;
    }
    if (!isValidEmail($email)) {
        $_SESSION['email_err_message'] = 'Please enter a valid email address';
        redirect('/login');
        return;
    }
   
    $_SESSION['message'] = 'Thanks!';
    redirect('/login');
}

function registration(){
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $password2 = $_POST['confirm-password'] ?? null;

    if(empty($email) || empty($password) || empty($password2)){
        $_SESSION['err_message'] = 'Please fill out all fields';
        redirect('/registration');
        return;
    }
    if (!isValidEmail($email)) {
        $_SESSION['email_err_message'] = 'Please enter a valid email address';
        redirect('/registration');
        return;
    }
    if(!isValidPassword($password)){
        $_SESSION['password_err_message'] = 'Password has to be at least 6 symbols';
        redirect('/registration');
        return;
    }
    if(!isPasswordMatch($password, $password2)){
        $_SESSION['password_err_message'] = 'Password is not match';
        redirect('/registration');
        return;
    }

    $_SESSION['message'] = 'Thanks!';
    redirect('/registration');
}


function uploadImage(): void
{
    global $config;
    extract($_FILES['file']);
    if ($error === 4) {
        Message::set('File is required', 'danger');
        redirect('/uploads');
    }

    if ($error !== 0) {
        Message::set('File is not uploaded', 'danger');
        redirect('/uploads');
    }

    if (!in_array($type, $config['allowImageTypes'])) {
        Message::set('File is not image', 'danger');
        redirect('/uploads');
    }

    $fName =  uniqid() . '_' . $name;

    move_uploaded_file($tmp_name, "uploaded/$fName");

    resizeImage("uploaded/$fName", 150, true); // true - жесткая обрезка.  150*150
    resizeImage("uploaded/$fName", 300, false); // пропорциональное изменение размеров 300 - ширина  

    Message::set('File is uploaded');
    redirect('/uploads');
}

function resizeImage(string $path, int $size, bool $crop = false): void
{
    extract(pathinfo($path)); // dirname, extension, basename

    $extension = strtolower($extension) === 'jpg' ? "jpeg" : strtolower($extension);

    $functionCreate = "imagecreatefrom" . $extension;
    $src_image = $functionCreate($path);

    list($src_width, $src_height) = getimagesize($path);

    if ($crop) {
        // обрезать
        $dst_image = imagecreatetruecolor($size, $size);

        if ($src_width > $src_height) {
            $src_y = 0;
            $src_x = ($src_width - $src_height) / 2;
            $width = $height = $src_height;
        } else {
            $src_y = ($src_height - $src_width) / 2;
            $src_x = 0;
            $width = $height = $src_width;
        }
        imagecopyresampled($dst_image, $src_image, 0, 0, $src_x, $src_y, $size, $size, $width, $height);
    } else {
        // пропорциональное изменение
        $dst_width = $size;
        $dst_height = $size * $src_height / $src_width;
        $dst_image = imagecreatetruecolor($dst_width, $dst_height);
        imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
    }

    $dir = $crop ? 'small' : 'medium';   /////

    if(!file_exists("$dirname/$dir"))
        mkdir("$dirname/$dir");


    $functionSave = "image" . $extension;
    if($extension === 'jpeg')
        $functionSave($dst_image, "$dirname/$dir/$basename", 100);
    else
        $functionSave($dst_image, "$dirname/$dir/$basename");

}

function uploadImageTo(): void{
    $sName = $_POST['sliders-dst'] ?? null;
    echo $sName;
    if(empty($sName)){
        Message::set('Select a slider for uploading');
        redirect('/manage-sliders');
    }

    global $config; 
    extract($_FILES['file']);
    if ($error === 4) {
        Message::set('File is required', 'danger');
        redirect('/manage-sliders');
    }

    if ($error !== 0) {
        Message::set('File is not uploaded', 'danger');
        redirect('/manage-sliders');
    }

    if (!in_array($type, $config['allowImageTypes'])) {
        Message::set('File is not image', 'danger');
        redirect('/manage-sliders');
    }

    $fName =  uniqid() . '_' . $name;

    move_uploaded_file($tmp_name, "uploaded/$sName/$fName");
    resizeImage("uploaded/$sName/$fName", 150, false);
    Message::set('File is uploaded');
    redirect('/manage-sliders');
}

function createSlider() : void {
   $sName = $_POST['sliderName'] ?? null;
   if(empty($sName)){
     Message::set('Enter new slider name');
     redirect('/manage-sliders');
   }

   $allSliders = glob('uploaded/*');

   if(in_array("uploaded/$sName", $allSliders)){ 
      Message::set('Slider with name "'.$sName .'" already exists');
      redirect('/manage-sliders');
   }

   mkdir("uploaded/$sName");
   Message::set("Slider $sName created!");
}

function deleteSlider(): void {
    $slider = $_POST['slider'] ?? '';
    if(empty($slider)){
        Message::set('Select a slider');
        redirect('/manage-sliders');
    }

    removeDir("uploaded/$slider");
}

function removeDir($path){
    if(is_file($path)){
        unlink($path);
        Message::set('File removed successfully');
        return;
    }
    elseif(is_dir($path)){
        $files = glob("$path/*");
        foreach($files as $file){
            removeDir($file);
        }

        rmdir($path);
        Message::set('Directory removed successfully');
        return;
    }
}

function renderSlider($slider) : void {
    $files = glob("$slider/medium/*");
    if (empty($files)) {
        return;
    }

    $sName = basename($slider);
    $bigPhotoes = glob("$slider/*");

    foreach ($files as $key=>$value) {
        if(!is_dir($value)){
            echo '<a href="' . $bigPhotoes[$key] . '" data-fancybox="' . $sName . '">
            <img src="' . $value . '" alt="Image">
        </a>';
        }
    }
}