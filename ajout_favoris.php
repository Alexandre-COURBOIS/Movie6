<?php
session_start();

include('inc/pdo.php');
include('inc/functions.php');

if(!empty($_GET['id']) && is_numeric($_GET['id']) && is_logged()) {

    $idusers = $_SESSION['login']['id'];

    $sql = "SELECT id
        FROM movie_user AS mu
        JOIN users ON users.id = user_id.id
        JOIN movies_full AS mf ON mf.id = movie_id.id
        WHERE users.id = $idusers";

    $query = $pdo->prepare($sql);
    $query->execute();
    $userid = $query->fetchAll();

    $sql ="SELECT *
    FROM movie_user
    WHERE 1 = 1";
    $query = $pdo->prepare($sql);
    $query->execute();

    $favoris = $query->fetchAll();

}