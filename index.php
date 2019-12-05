<?php
session_start();

require('inc/pdo.php');
require('inc/functions.php');
$title = 'Home page';
$sql   = "SELECT * FROM movies_full ORDER BY rand() LIMIT 30";
$query = $pdo->prepare($sql);
$query->execute();
$movies = $query->fetchAll();

$sql = "SELECT * FROM movies_full WHERE 1 = 1";
if(!empty($_POST['genres'])){

    $sql .= ' AND ( genres LIKE "%' . $_POST['genres'][0] . '%" ';
    for($i = 1;$i<count($_POST['genres']);$i++) {
        $sql .= ' OR genres LIKE "%' . $_POST['genres'][$i] . '%"';

    }
    $sql .= ')';
}

include('inc/header.php'); ?>

<div class="wrap">

<form method="POST" action="checkbox.php">

    <input type="checkbox" name="genres[]" value="1"> Drama<br>

    <input type="checkbox" name="genres[]" value="2"> Fantasy<br>

    <input type="checkbox" name="genres[]" value="3"> Romance<br>

    <input type="checkbox" name="genres[]"  value="4"> Action<br>

    <input type="checkbox" name="genres[]" value="5"> Thriller<br>

    <input type="checkbox" name="genres[]"  value="6"> Comedy<br>

    <input type="checkbox" name="genres[]" value="7"> Adventure<br>

    <input type="checkbox" name="genres[]" value="8"> Animation<br>

    <input type="checkbox" name="genres[]" value="9"> Family<br>

    <input type="checkbox" name="genres[]" value="10"> Sci-Fi<br>

    <input type="checkbox" name="genres[]" value="11"> Crime<br>

    <input type="checkbox" name="genres[]" value="12"> Horror<br>


    <input type="submit" value="Submit">

<?php foreach ($movies as $movie) {

    echo '<ul class="film">';

    echo '<li><a href="details.php?slug='.$movie['slug'].'"><img src="posters/'.$movie['id'].'.jpg" alt=""></a></li>';

    echo '<ul>';

} ?>

<div class="clear"></div>


<p class="filmplus"><a href="index.php">+ de films !</a></p>


</div>


<div class="clear"></div>


<?php include('inc/footer.php'); ?>

