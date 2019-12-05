<?php
session_start();

require('inc/pdo.php');
require('inc/functions.php');

$title = 'Connexion';

$errors =  array();
$success = false;

if(!empty($_POST['submitted'])) {

    $login    = trim(strip_tags($_POST['login']));
    $password = trim(strip_tags($_POST['password']));

    if(empty($login) || empty($password)) {
        $errors['login'] = 'Veuillez renseigner ces champs';
    } else {
        $sql = "SELECT * FROM users WHERE pseudo = :login OR email = :login";
        $query = $pdo->prepare($sql);
        $query->bindValue(':login',$login,PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();
        if(!empty($user)) {
            if(password_verify($password,$user['password'])) {
                $_SESSION['login'] = array(
                    'id'      => $user['id'],
                    'pseudo'  => $user['pseudo'],
                    'role'    => $user['role'],
                    'ip'      => $_SERVER['REMOTE_ADDR']
                );

                header('Location: index.php');
            } else {
                $errors['login'] = 'Pseudo or email inconnu ou mot de passe oublié';
            }
        } else {
            $errors['login'] = 'Pseudo or email inconnu';
        }
    }
}

include('inc/header.php'); ?>



    <form action="connexion.php" method="post" class="form-wrap">
        <h1>Connexion</h1>
        <label for="login">Pseudo or email *</label>
        <input type="text" name="login" id="login" value="<?php if(!empty($_POST['login'])) { echo $_POST['login']; } ?>">
        <p class="error"><?php if(!empty($errors['login'])) { echo $errors['login']; } ?></p>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" value="">

        <input type="submit" name="submitted" value="connexion">

    </form>

    <div class="mp">
        <a href="forget-mdp.php">Mot de passe oublié</a>
    </div>


<?php include('inc/footer.php');
