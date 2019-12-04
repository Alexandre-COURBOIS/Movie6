<?php
session_start();

require('inc/pdo.php');
require('inc/functions.php');
$title = 'Home page';
$sql   = "SELECT * FROM movies_full ORDER BY rand() LIMIT 30";
$query = $pdo->prepare($sql);
$query->execute();
$movies = $query->fetchAll();

include('inc/header.php'); ?>

<?php foreach ($movies as $movie) { ?>
    <div class="movies">
        <img src="posters/<?php echo $movie['id']; ?>.jpg" alt="">
    </div>

<?php } ?>

<?php include('inc/footer.php'); ?>
