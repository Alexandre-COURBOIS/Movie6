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

<form method="POST" action="checkbox.php">

    <input type="checkbox" name="Drama" value="1"> Drama<br>
    <input type="checkbox" name="Fantasy" value="2"> Fantasy<br>
    <input type="checkbox" name="Romance" value="3"> Romance<br>
    <input type="checkbox" name="Action" value="4"> Action<br>
    <input type="checkbox" name="Thriller" value="5"> Thriller<br>
    <input type="checkbox" name="Comedy" value="6"> Comedy<br>
    <input type="checkbox" name="Adventure" value="7"> Adventure<br>
    <input type="checkbox" name="Animation" value="8"> Animation<br>
    <input type="checkbox" name="Family" value="9"> Family<br>
    <input type="checkbox" name="Sci-fi" value="10"> Sci-Fi<br>
    <input type="checkbox" name="Crime" value="11"> Crime<br>
    <input type="checkbox" name="Horror" value="12"> Horror<br>
    <input type="submit" value="Submit">

<?php foreach ($movies as $movie) {

    echo '<ul class="film">';

    echo '<li><a href="details.php?id='.$movie['id'].'"><img src="posters/'.$movie['id'].'.jpg" alt=""></a></li>';

    echo '<ul>';

    echo '<a href="">A visionner</a>';

} ?>

<div class="clear"></div>


<p class="filmplus"><a href="index.php">+ de films !</a></p>


</div>


<div class="clear"></div>


<?php include('inc/footer.php'); ?>

