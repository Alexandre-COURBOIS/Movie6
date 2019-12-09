<?php
session_start();
require('inc/pdo.php');
require('inc/functions.php');


if (is_logged()) {

    $iduser = $_SESSION['login']['id'];

    // request pour aller chercher mes film à voir +++

    $sql = "SELECT mf.*,mu.id AS id,mf.id AS movieid, mf.title AS title,u.email AS emailuser FROM movie_user AS mu
            LEFT JOIN movies_full AS mf
            ON mu.movie_id = mf.id
            LEFT JOIN users AS u
            ON mu.user_id = u.id
            WHERE mu.user_id = $iduser
            AND note IS NULL";
    $query  = $pdo->prepare($sql);
    $query->execute();
    $movies = $query->fetchAll();

} else {
    die('403');
}


include('inc/header.php');


foreach ($movies as $movie) {

    echo '<ul class="film-a-voir">';

    echo '<li><a href="details.php?slug='.$movie['slug'].'"><img src="posters/'.$movie['movieid'].'.jpg" alt=""></a></li>';

    echo '<ul>';

}


include('inc/footer.php');
// +++++++++++++++++++++++++++++++++++++++
  // html afficher les films  +++++
  // +++++++++++++++++++++++++++++++++++++++
// end foreach
// footer
