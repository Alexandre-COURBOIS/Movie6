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

    <h1>Home</h1>
<?php foreach ($movies as $movie) { ?>
    <div class="movies">
        <h2><?php echo $movie['title']; ?></h2>
    </div>
<?php } ?>

<?php include('inc/footer.php'); ?>
