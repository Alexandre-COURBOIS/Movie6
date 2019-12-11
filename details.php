<?php
session_start();
require('inc/pdo.php');
require('inc/functions.php');

if(!empty($_GET['slug'])) {

    $slug = $_GET['slug'];

    $sql="SELECT * FROM movies_full WHERE slug LIKE '".$slug."%'";
    $query  = $pdo->prepare($sql);
    $query->execute();
    $movies = $query->fetch();

    if (!empty($movies)) {

    } else {
        die('404 Not Found');
    }

} else {
    die('404 Not Found');
}

include('inc/header.php');?>

    <div class="films">
        <h1><?php echo $movies['title']; ?></h1>

        <p><span>Year : </span><?php echo $movies['year']; ?></p>
        <p><span>Genre : </span><?php echo $movies['genres']; ?></p>
        <p><span>Resumé : </span><?php echo $movies['plot']; ?></p>

        <img id="postdetail" src="posters/<?php echo $movies['id']; ?>.jpg" alt="">

        <p><span>Realisateur : </span><?php echo $movies['directors']; ?></p>
        <p><span>Acteurs : </span><?php echo $movies['cast']?> </p>
        <p><span>Ecrivain : </span><?php echo $movies['writers']?> </p>
        <p><span>Durée : </span><?php echo $movies['runtime']?> minutes. </p>
        <p><span>Limitation d'âge : </span><?php echo $movies['mpaa']?> </p>
        <p><span>Note : </span><?php echo $movies['rating']?> /100</p>
        <p><span>Popularité : </span><?php echo $movies['popularity']?> </p>

        <?php if(is_logged()) {

            echo '<a href="ajout_favoris.php?id='.$movies['id'].'">Ajouter à ma liste de favoris</a>';

        } ?>



    </div>

<?php include('inc/footer.php'); ?>
