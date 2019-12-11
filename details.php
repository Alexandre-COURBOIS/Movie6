<?php
session_start();
require('inc/pdo.php');
require('inc/functions.php');

if (!empty($_GET['slug'])) {

    $slug = $_GET['slug'];

    $sql = "SELECT * FROM movies_full WHERE slug LIKE '" . $slug . "%'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $movies = $query->fetch();

    if (!empty($movies)) {

        $userid = $_SESSION['login']['id'];
        $movieid = $movies['id'];

        $sql = "SELECT * FROM movie_user WHERE user_id = :userid AND movie_id = :movieid";
        $query = $pdo->prepare($sql);
        $query->bindValue(':userid',$userid,PDO::PARAM_INT);
        $query->bindValue(':movieid',$movieid,PDO::PARAM_INT);
        $query->execute();
        $verifUser = $query->fetch();

        $verifMovie = $verifUser['movie_id'];

    } else {
        die('404 Not Found');
    }

} else {
    die('403 Not Found');
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

        <?php if (is_logged()) {
            if (empty($verifMovie)) {
                echo '<a href="ajout_favoris.php?id=' . $movies['id'] . '">Ajouter à ma liste de favoris</a>';
            }
        } ?>



    </div>

<?php include('inc/footer.php'); ?>
