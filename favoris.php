<?php
session_start();
require('inc/pdo.php');
require('inc/functions.php');


if (is_logged()) {
    $iduser = $_SESSION['login']['id'];

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
    debug($movies);

    // request pour aller chercher mes film à voir +++




} else {

  // redirection
  die('403');
}


// header

// foreach
// +++++++++++++++++++++++++++++++++++++++
  // html afficher les films  +++++
  // +++++++++++++++++++++++++++++++++++++++
// end foreach
// footer
