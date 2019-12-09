<?php
session_start();
require('inc/pdo.php');
require('inc/functions.php');


if (is_logged()) {
    $iduser = $_SESSION['login']['id'];



    // $sql = "SELECT * FROM movie_user AS mu
    //   LEFT JOIN movies_full AS mf ON mf.id = mu.movie_id
    //   WHERE mu.user_id = $idusers";
    // $query  = $pdo->prepare($sql);
    // $query->execute();
    // $user_movie = $query->fetchAll();

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

