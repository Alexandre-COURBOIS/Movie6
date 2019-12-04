<?php
session_start();
include('inc/pdo.php');
include('inc/functions.php');







include('inc/header.php'); ?>

    <h1>Home</h1>

<?php foreach ($movies as $movie) { ?>
    <div class="movies">
        <h2><?php echo $movie['title']; ?></h2>
        <img src="posters/<?php echo $movie['id']; ?>.jpg" alt="">
    </div>

<?php } ?>



<?php include('inc/footer.php');
