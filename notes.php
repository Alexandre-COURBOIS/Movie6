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

}

include('inc/header.php');

foreach ($movies as $movie) {

echo '<ul class="film-a-voir">';

echo '<li><a href="details.php?slug=' . $movie['slug'] . '"><img src="posters/' . $movie['movieid'] . '.jpg" alt=""></a></li>';

echo '<ul>';

echo '<p>Vous avez noté ce film '.$movie['note'].'/5.</p>';
}
?>

<?php include('inc/footer.php');
