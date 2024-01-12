<?php
require_once __DIR__ . '/helper.php';

session_start();

$action = $_POST['action'] ?? null;
if (!empty($action)) {
    $action();
}

function sendEmail(){
    $email = $_POST['email'] ?? null;
    $message = $_POST['message'] ?? null;

    if(empty($email) || empty($message)){
        $_SESSION['message'] = 'Error';
    }
    else{
        // mail()
        $_SESSION['message'] = 'Thank!';
    }
    redirect('/contacts');

}