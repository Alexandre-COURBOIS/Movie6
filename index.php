<?php
session_start();

require('inc/pdo.php');
require('inc/functions.php');
/*$title = 'Home page';
$query = $pdo->prepare($sql);
$query->execute();
$reves = $query->fetchAll();*/

include('inc/header.php'); ?>

<!DOCTYPE html>

<section class="movies">
    <div class="movies2">
        <ul class="movies3">
            <li><img src="???" alt=""></li>
        </ul>
    </div>
    <p class="lead">Ceci est un site pour les films</p>

    <div class="clear"></div>
</section>

<?php include('inc/footer.php'); ?>
