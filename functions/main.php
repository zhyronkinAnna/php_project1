<?php
require_once __DIR__ . '/helper.php';
require_once __DIR__ . '/validation.php';

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