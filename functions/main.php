<?php
require_once __DIR__ . '/helper.php';
require_once __DIR__ . '/Message.php';
require_once __DIR__ . '/OldInputs.php';
$config = require_once('config.php');

session_start();

$action = $_POST['action'] ?? null;
if (!empty($action)) {
    $action();
}

function sendEmail(){
    $email = $_POST['email'] ?? null;    // ''
    $message = $_POST['message'] ?? null; // 'dfgf gdfgdfg'

    if(empty($email) || empty($message)){
        Message::set('All fields required', 'danger');
        OldInputs::set($_POST);   // ['email'=>'', 'message'=>'dfgf gdfgdfg']
    }
    else{
        // mail()
        Message::set('Thank!');
    }
    redirect('/contacts');
}


function uploadImage() : void { 
    global $config;
    extract($_FILES['file']); 
    if($error === 4){
        Message::set('File is required', 'danger');
        redirect('/uploads');
    }

    if ($error !== 0) {
        Message::set('File is not uploaded', 'danger');
        redirect('/uploads');
    }

    
    if(!in_array($type, $config['allowImageTypes']) ){
        Message::set('File is not image', 'danger');
        redirect('/uploads');
    }

    $fName =  uniqid() . '_' . $name;

    move_uploaded_file($tmp_name, "uploaded/$fName");

    Message::set('File is uploaded');
    redirect('/uploads');
}