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
        <p><span>Year : </span><?php echo $movies['year']; ?></p>
        <p><span>Genre : </span><?php echo $movies['genres']; ?></p>
        <p><span>Resumé : </span><?php echo $movies['plot']; ?></p>
    </div>

<?php include('inc/footer.php'); ?>