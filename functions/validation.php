<?php

function isValidEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isValidPassword($password){
    return strlen($password) > 6;
}

function isPasswordMatch($password, $password2){
    return $password === $password2;
}