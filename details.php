<?php
session_start();
require('inc/pdo.php');

if(!empty($_GET['id']) && is_numeric($_GET['id'])){

$id = $_GET['id'];

$sql="SELECT * FROM movies_full WHERE id = $id";
$query  = $pdo->prepare($sql);
$query->execute();
$movies = $query->fetch();

if(!empty($movies)) {

} else {
die('404 Not Found');
}
}

include('inc/header.php');?>

    <div class="films">
        <h1><?php echo $movies['title']; ?></h1>
        <img src="posters/<?php echo $movies['id']; ?>.jpg" alt="">
        <p>Year : <?php echo $movies['year']; ?></p>
        <p>Genre : <?php echo $movies['genres']; ?></p>
        <p>Resumé : <?php echo $movies['plot']; ?></p>
        <p>Realisateur : <?php echo $movies['directors']; ?></p>
        <p>Acteurs : <?php echo $movies['cast']?> </p>
        <p>Ecrivain : <?php echo $movies['writers']?> </p>
        <p>Durée : <?php echo $movies['runtime']?> minutes. </p>
        <p>Limitation d'âge : <?php echo $movies['mpaa']?> </p>
        <p>Limitation d'âge : <?php echo $movies['mpaa']?> </p>
        <p>Note : <?php echo $movies['rating']?> /100</p>
        <p>Popularité : <?php echo $movies['popularity']?> </p>

    </div>

<?php include('inc/footer.php'); ?>