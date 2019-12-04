<?php
session_start();

require('inc/pdo.php');
require('inc/functions.php');
$title = 'Home page';
$query = $pdo->prepare($sql);
$query->execute();
$reves = $query->fetchAll();

include('inc/header.php'); ?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wonder</title>
    <meta name="description" content="">

    <link href="https://fonts.googleapis.com/css?family=Arvo:400,700" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<section class="movies">
    <div class="moviesview">
        <ul class="slides">
            <li><img src="???" alt=""></li>
        </ul>
    </div>
    <p class="lead">Ceci est un site pour les films</p>


    <div class="clear"></div>
</section>

<?php include('inc/footer.php'); ?>


