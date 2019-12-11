<?php
session_start();
require('inc/pdo.php');
require('inc/functions.php');

if (is_logged()) {

    $iduser = $_SESSION['login']['id'];

    $sql = "SELECT mf.*,mu.id AS id,mf.id AS movieid, mf.title AS title,u.email AS emailuser, mu.note AS note FROM movie_user AS mu
            LEFT JOIN movies_full AS mf
            ON mu.movie_id = mf.id
            LEFT JOIN users AS u
            ON mu.user_id = u.id
            WHERE mu.user_id = $iduser
            AND NOT note IS NULL";
    $query  = $pdo->prepare($sql);
    $query->execute();
    $movies = $query->fetchAll();

} else {
    die('403');
}

include('inc/header.php');

foreach ($movies as $movie) {

echo '<ul class="film-a-voir">';

echo '<li><a href="details.php?slug=' . $movie['slug'] . '"><img src="posters/' . $movie['movieid'] . '.jpg" alt=""></a></li>';

echo '<ul>';

echo '<p>Vous avez noté ce film '.$movie['note'].'/5.</p>';?>

<!--    <div class="etoiles">
        <?php /*if ($movie['note'] == 1) { */?>
            <input type="checkbox" id="st1" value="1"/>
            <label for="st1"></label>
    <?php /*} elseif ($movie['note'] == 2) {*/?>
        <input type="checkbox" id="st2" value="2"/>
        <label for="st2"></label>
    <?php /*} elseif ($movie['note'] == 3) {*/?>
        <input type="checkbox" id="st3" value="3"/>
        <label for="st3"></label>
    <?php /*} elseif ($movie['note'] == 4) {*/?>
        <input type="checkbox" id="st4" value="4"/>
        <label for="st4"></label>
    <?php /*} elseif ($movie['note'] == 5) {*/?>
        <input type="checkbox" id="st5" value="5"/>
        <label for="st5"></label>
    <?php /*} */?>
    </div>
-->
<?php } ?>

<div class="clear"></div>

<?php include('inc/footer.php');
