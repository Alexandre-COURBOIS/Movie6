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
    <label for="Drama">Drama</label>

    <input type="checkbox" name="genres[]" value="2"> Fantasy<br>
    <label for="Fantasy">Fantasy</label>

    <input type="checkbox" name="genres[]" value="3"> Romance<br>
    <label for="Romance">Romance</label>

    <input type="checkbox" name="genres[]"  value="4"> Action<br>
    <label for="Action">Action</label>

    <input type="checkbox" name="genres[]" value="5"> Thriller<br>
    <label for="Thriller">Thriller</label>

    <input type="checkbox" name="genres[]"  value="6"> Comedy<br>
    <label for="Comedy">Comedy</label>

    <input type="checkbox" name="genres[]" value="7"> Adventure<br>
    <label for="Adventure">Adventure</label>

    <input type="checkbox" name="genres[]" value="8"> Animation<br>
    <label for="Animation">Animation</label>

    <input type="checkbox" name="genres[]" value="9"> Family<br>
    <label for="Family">Family</label>

    <input type="checkbox" name="genres[]" value="10"> Sci-Fi<br>
    <label for="Sci-fi">Sci-fi</label>

    <input type="checkbox" name="genres[]" value="11"> Crime<br>
    <label for="<Crime>">Crime</label>

    <input type="checkbox" name="genres[]" value="12"> Horror<br>
    <label for="Horror">Horror</label>

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

