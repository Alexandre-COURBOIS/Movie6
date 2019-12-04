<?php
session_start();

require('inc/pdo.php');
require('inc/functions.php');

$title = 'Inscription';
$errors = array();
$success = false;


if(!empty($_POST['submitted'])) {

    $pseudo    = trim(strip_tags($_POST['pseudo']));
    $email     = trim(strip_tags($_POST['email']));
    $password1 = trim(strip_tags($_POST['password1']));
    $password2 = trim(strip_tags($_POST['password2']));

    if(empty($pseudo)) {
        $errors['pseudo'] = 'Veuillez renseigner ce champ';
    } elseif (mb_strlen($pseudo) > 120) {
        $errors['pseudo'] = 'Max 120 caractères';
    } elseif (mb_strlen($pseudo) < 2) {
        $errors['pseudo'] = 'Min 2 caractères';
    } else {
        $sql = "SELECT id FROM users WHERE pseudo = :pseudo";
        $query = $pdo->prepare($sql);
        $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
        $query->execute();
        $verifpseudo = $query->fetch();
        if(!empty($verifpseudo)) {
            $errors['pseudo'] = 'Ce pseudo existe déjà !';
        }
    }

    if(empty($email) || filter_var($email,FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = 'Veuillez renseigner un email valide';
    } else {
        $sql = "SELECT id FROM users WHERE email = :mail";
        $query = $pdo->prepare($sql);
        $query->bindValue(':mail',$email,PDO::PARAM_STR);
        $query->execute();
        $verifemail = $query->fetch();
        if(!empty($verifemail)) {
            $errors['email'] = 'Cet email existe déjà !';
        }
    }

    if(!empty($password1)) {
        if($password1 != $password2) {
            $errors['password'] = 'Les deux mot de passe doivent être identiques';
        } elseif(mb_strlen($password1) <= 5) {
            $errors['password'] = 'Min 6 caractères';
        }
    } else {
        $errors['password'] = 'Veuillez renseigner un mot de passe';
    }

    if(count($errors) == 0) {

        $hashPassword = password_hash($password1,PASSWORD_BCRYPT);
        $token = generateRandomString(120);

        $sql = "INSERT INTO users VALUES (null,:pseudo,:email,:password,:token,'abonne',NOW())";
        $query = $pdo->prepare($sql);
        $query->bindValue(':pseudo',  $pseudo,PDO::PARAM_STR);
        $query->bindValue(':email',   $email,PDO::PARAM_STR);
        $query->bindValue(':password',$hashPassword,PDO::PARAM_STR);
        $query->bindValue(':token',   $token,PDO::PARAM_STR);
        $query->execute();
        $success = true;

    }
}


include('inc/header.php'); ?>

    <h1>Inscription</h1>

    <form action="inscription.php" method="post">
        <label for="pseudo">Pseudo *</label>
        <input type="text" name="pseudo" id="pseudo" value="<?php if(!empty($_POST['pseudo'])) { echo $_POST['pseudo']; } ?>">
        <p class="error"><?php if(!empty($errors['pseudo'])) { echo $errors['pseudo']; } ?></p>

        <label for="email">Email *</label>
        <input type="email" name="email" id="email" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } ?>">
        <p class="error"><?php if(!empty($errors['email'])) { echo $errors['email']; } ?></p>

        <label for="password1">Mot de passe *</label>
        <input type="password" name="password1" id="password1" value="">
        <p class="error"><?php if(!empty($errors['password'])) { echo $errors['password']; } ?></p>

        <label for="password2">Confirmez votre mot de passe *</label>
        <input type="password" name="password2" id="password2" value="">

        <input type="submit" name="submitted" value="Inscrivez-vous">
    </form>


<?php include('inc/footer.php');
