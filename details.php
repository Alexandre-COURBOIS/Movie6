<?php
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
        <p>Year : <?php echo $movies['year']; ?></p>
        <p>Genre : <?php echo $movies['genres']; ?></p>
        <p>Resumé : <?php echo $movies['plot']; ?></p>
    </div>

<?php include('inc/footer.php'); ?>