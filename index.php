<?php
session_start();
require('vendor/autoload.php');
require('inc/pdo.php');
require('inc/functions.php');

$title = 'Home page';
$sql   = "SELECT * FROM movies_full ORDER BY rand() LIMIT 30";
$query = $pdo->prepare($sql);
$query->execute();
$movies = $query->fetchAll();

if (!empty($_POST['submitted'])) {


    $sql = "SELECT * FROM movies_full WHERE 1 = 1";

    if (!empty($_POST['genres'])) {

        $sql .= ' AND ( genres LIKE "%' . $_POST['genres'][0] . '%" ';
        for ($i = 1; $i < count($_POST['genres']); $i++) {
            $sql .= ' OR genres LIKE "%' . $_POST['genres'][$i] . '%"';

        }

        $sql .= ')';
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    $movies = $query->fetchAll();
}

/*use JasonGrimes\Paginator;

$page = 1;

if(!empty($_GET['page'])) {

    $page = $_GET['page'];

    $totalItems = 1000;
    $itemsPerPage = 20;
    $currentPage = $page;
    $urlPattern = 'index.php?page=(:num)';

    $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

}*/



include('inc/header.php'); ?>

<div class="wrap">

<form method="post" action="">

    <input type="checkbox" name="genres[]" value="Drama"> Drama

    <input type="checkbox" name="genres[]" value="Fantasy"> Fantasy

    <input type="checkbox" name="genres[]" value="Romance"> Romance

    <input type="checkbox" name="genres[]"  value="Action"> Action

    <input type="checkbox" name="genres[]" value="Thriller"> Thriller

    <input type="checkbox" name="genres[]"  value="Comedy"> Comedy

    <input type="checkbox" name="genres[]" value="Adventure"> Adventure

    <input type="checkbox" name="genres[]" value="Animation"> Animation

    <input type="checkbox" name="genres[]" value="Family"> Family

    <input type="checkbox" name="genres[]" value="Sci-Fi"> Sci-Fi

    <input type="checkbox" name="genres[]" value="Crime"> Crime

    <input type="checkbox" name="genres[]" value="Horror"> Horror


    <input type="submit" name="submitted" value="Confirmer">

</form>

<?php

foreach ($movies as $movie) {

    $image = 'posters/'.$movie['id'].'.jpg';

if(file_exists($image)) {

    echo '<ul class="film">';

    echo '<li><a href="details.php?slug='.$movie['slug'].'"><img src="posters/'.$movie['id'].'.jpg" alt=""></a></li>';

    echo '<ul>';


} else {

        echo '<ul class="film">';

        echo '<li><a href="details.php?slug='.$movie['slug'].'"><img width="220px" height="312px" src="assets/img/visuel-non-dispo.jpg" alt=""></a></li>';

        echo '<ul>';

    }
}

/*echo $paginator;*/
    ?>

<div class="clear"></div>


<p class="filmplus"><a href="index.php">+ de films !</a></p>


</div>


<div class="clear"></div>


<?php include('inc/footer.php'); ?>

