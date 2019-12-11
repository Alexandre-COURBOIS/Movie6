<?php
session_start();
require('inc/pdo.php');
require('inc/functions.php');


if (is_logged()) {

    $iduser = $_SESSION['login']['id'];

    // request pour aller chercher mes film à voir +++

    $sql = "SELECT mf.*,mu.id AS id,mf.id AS movieid, mf.title AS title,u.email AS emailuser, mu.note AS mun FROM movie_user AS mu
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

$select = array(
    'Note'  => "1",
    'Note1' => "2",
    'Note2' => "3",
    'Note3' => "4",
    'Note4' => "5",
);


include('inc/header.php');


foreach ($movies as $movie) {

    echo '<ul class="film-a-voir">';

    echo '<li><a href="details.php?slug=' . $movie['slug'] . '"><img src="posters/' . $movie['movieid'] . '.jpg" alt=""></a></li>';

    echo '<ul>';

    echo '<div><a href="delate-fav.php?id=' . $iduser . '&film=' . $movie['movieid'] . '">Retirer de mes favoris</a></div>';?>

    <div class="formulaire select">
        <label class="label-contact" for="select">Note /5 :</label>
        <select id="select" name="select">
            <option value="">-- Sélectionnez --</option>
            <?php foreach ($select as $key => $value) { ?>
            <option value="<?php echo $key; ?>"<?php if (!empty($_POST['select'])) {if($_POST['select'] == $key ) {echo ' selected="selected" ';}} ?>>
                <?php echo $value; ?></option><?php   }  ?>
        </select>
        <input type="submit" name="submitted" value="Envoyer">
        <span class="error"><?php if (!empty($errors['select'])) {echo $errors['select'];} ?></span>
    </div>



<?php }

    echo '<div class="clear"></div>';

include('inc/footer.php');