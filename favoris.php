<?php
require('inc/pdo.php');
require('inc/functions.php');
session_start();

if (is_logged()) {

    $idusers = $_SESSION['login']['id'];

    $sql = "SELECT * FROM movie_user AS mu
      LEFT JOIN movies_full AS mf ON mf.id = mu.movie_id
      WHERE mu.user_id = $idusers";
    $query  = $pdo->prepare($sql);
    $query->execute();
    $user_movie = $query->fetchAll();

}