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



<div class="wrap">
<?php foreach ($movies as $movie) {

    echo '<ul class="film">';

    echo '<li><a href="details.php?id='.$movie['id'].'"><img src="posters/'.$movie['id'].'.jpg" alt=""></a></li>';

    echo '<ul>';

} ?>
</div>
<div class="clear"></div>


<?php include('inc/footer.php'); ?>
