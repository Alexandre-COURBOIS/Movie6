<?php
session_start();

require('inc/pdo.php');
require('inc/functions.php');



if (is_logged() && (!empty($_GET)) && $_GET['id'] == $_SESSION['login']['id'] ) {

    $id = $_GET['id'];
    $movie = $_GET['film'];

    $sql = "DELETE FROM movie_user
            WHERE user_id = :id
            AND movie_id = :movie";
    $query  = $pdo->prepare($sql);
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->bindValue(':movie',$movie,PDO::PARAM_INT);
    $query->execute();

    header('Location: favoris.php');

} else {

    die('403');

}
