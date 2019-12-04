<?php
// FONCTIONS
function clean($value)
{
    $valueclean = trim(strip_tags($value));
    return $valueclean;
}
//
function emailValidation($mail, $err, $key)
{
    if(!empty($mail)){
        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $err[$key] = 'Email non valide.';
        }
    } else {
        $err[$key] = 'Veuillez renseigner ce champ.';
    }
    return $err;
}
//
function textValid($value, $err, $key, $min, $max,$empty = true)
{
    if(!empty($value)) {
        if (mb_strlen($value) < $min) {
            $err[$key] = 'Veuillez renseigner un message de plus de '.$min.' caractères.';
        } elseif (mb_strlen($value) > $max) {
            $err[$key] = 'Veuillez renseigner un message de moins de '.$max.' caractères.';
        }
    } else {
        if($empty) {
            $err[$key] = 'Veuillez renseigner ce champ.';
        }
    }
    return $err;
}
//
function debug($value)
{
    echo '<pre>';
    print_r($value);
    echo '<pre>';
}
//
function generateToken()
{
    $token = '';
    $chaine = "aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZé-_èçàè&°+$%*/!&1234567890";
    for ($i=0; $i < 255 ; $i++) {
        $token .= $chaine[rand(0,mb_strlen($chaine))];

    }
    return $token;
}
//
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function is_logged()
{
    $roles = array('abonne','admin');

    if(!empty($_SESSION['login'])) {
        if(!empty($_SESSION['login']['id']) && is_numeric($_SESSION['login']['id'])) {
            if(!empty($_SESSION['login']['pseudo'])) {
                if(!empty($_SESSION['login']['role'])) {
                    if(in_array($_SESSION['login']['role'],$roles)){
                        if(!empty($_SESSION['login']['ip'])) {
                            if($_SESSION['login']['ip'] == $_SERVER['REMOTE_ADDR']) {
                                return true;
                            }
                        }
                    }
                }
            }
        }
    }

    return false;
}