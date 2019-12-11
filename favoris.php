<?php
session_start();
require('inc/pdo.php');
require('inc/functions.php');


if (is_logged()) {

    $iduser = $_SESSION['login']['id'];

    // request pour aller chercher mes films à voir +++

    $sql = "SELECT mf.*,mu.id AS id,mf.id AS movieid, mf.title AS title,u.email AS emailuser, mu.note AS mun FROM movie_user AS mu
            LEFT JOIN movies_full AS mf
            ON mu.movie_id = mf.id
            LEFT JOIN users AS u
            ON mu.user_id = u.id
            WHERE mu.user_id = $iduser
            AND note IS NULL";
    $query = $pdo->prepare($sql);
    $query->execute();
    $movies = $query->fetchAll();

    if (!empty($_POST['submitted'])) {

        $idmovie = $_POST['hidden_movie'];
        $note = $_POST['note'];


        $sql = "SELECT * FROM movie_user WHERE user_id = :iduser AND movie_id = :idmovie";
        $query = $pdo->prepare($sql);
        $query->bindValue(':iduser', $iduser, PDO::PARAM_INT);
        $query->bindValue(':idmovie', $idmovie, PDO::PARAM_INT);
        $query->execute();
        $verifMovie = $query->fetchAll();

        if (!empty($verifMovie)) {
            $sql = "UPDATE movie_user SET note = :note, modified_at = NOW() WHERE user_id = :iduser AND movie_id = :idmovie ";
            $query = $pdo->prepare($sql);
            $query->bindValue(':iduser', $iduser, PDO::PARAM_INT);
            $query->bindValue(':note', $note, PDO::PARAM_STR);
            $query->bindValue(':idmovie', $idmovie, PDO::PARAM_INT);
            $query->execute();

        }
        header('Location: notes.php');
        }

    } else {
        die('403');
    }


include('inc/header.php');


foreach ($movies as $movie) {

    echo '<ul class="film-a-voir">';

    echo '<li><a href="details.php?slug=' . $movie['slug'] . '"><img src="posters/' . $movie['movieid'] . '.jpg" alt=""></a></li>';

    echo '<ul>';

    echo '<div><a href="delate-fav.php?id=' . $iduser . '&film=' . $movie['movieid'] . '">Retirer de mes favoris</a></div>';

    ?>

    <form action="favoris.php" method="post">

        <select name="note">
            <option value="">-- Saisissez votre note --</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <input type="hidden" name="hidden_movie" value="<?= $movie['movieid'] ?>">
        <input type="submit" name="submitted" value="Envoyer">

    </form>

    <span class="error"><?php if (!empty($errors['select'])) {echo $errors['select'];} ?></span>

    </div>



<?php }

echo '<div class="clear"></div>';

include('inc/footer.php');