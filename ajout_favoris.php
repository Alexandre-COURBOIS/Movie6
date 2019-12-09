<?php
session_start();

include('inc/pdo.php');
include('inc/functions.php');

if(!empty($_GET['id']) && is_numeric($_GET['id']) && is_logged()) {

    $user_id = $_SESSION['login']['id'];
    $movie_id = $_GET['id'];

    $sql = "INSERT INTO movie_user VALUES (null,:user_id,:movie_id,null,NOW(),null)";
    $query = $pdo->prepare($sql);
    $query->bindValue(':user_id',  $user_id,PDO::PARAM_STR);
    $query->bindValue(':movie_id',   $movie_id,PDO::PARAM_STR);
    $query->execute();
    $success = true;

    header('Location: favoris.php');

} else {
    die('404');
}