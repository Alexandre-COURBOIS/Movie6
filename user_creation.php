<?php

include "assets/back/inc/pdo.php";
include "assets/front/inc/Form.php";
include "assets/front/inc/FormVerif.php";
include "assets/front/inc/functions.php";

$form = new Form;
$formVerif = new FormVerif;

$error = array();

if(isset($_POST['submited'])){
  $nom       = trim(strip_tags($_POST['nom']));
  $prenom    = trim(strip_tags($_POST['prenom']));
  $email     = trim(strip_tags($_POST['email']));
  $email2    = trim(strip_tags($_POST['email2']));
  $password  = trim(strip_tags($_POST['password']));
  $password2 = trim(strip_tags($_POST['password2']));

  $error['nom']       = $formVerif->errorText($nom, 'nom', 5, 20);
  $error['prenom']    = $formVerif->errorText($prenom, 'prenom', 5, 20);
  $error['email']     = $formVerif->errorEmail($email, 'email', 10, 100);
  $error['email2']    = $formVerif->errorRepeat($email, $email2, "Les E-mail ne correspondent pas.");
  $error['password']  = $formVerif->errorText($password, 'Mot de passe', 5, 255);
  $error['password2'] = $formVerif->errorRepeat($password, $password2, 'Les mots de passe ne correspondent pas.');

  if (!empty($error)) {

  $token = generateToken();
  $password = password_hash($password, PASSWORD_DEFAULT);

  $sql =" INSERT INTO `users`(`email`, `password`, `token`, `nom`, `prenom`, `created_at`)
          VALUES (:email, :password, :token, :nom, :prenom, NOW())";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email',$email, PDO::PARAM_STR);
    $query->bindValue(':password',$password, PDO::PARAM_STR);
    $query->bindValue(':token',$token, PDO::PARAM_STR);
    $query->bindValue(':nom',$nom, PDO::PARAM_STR);
    $query->bindValue(':prenom',$prenom, PDO::PARAM_STR);
    $query->execute();
  }
}

include "admin_header.php"; ?>

<form class="form-wrap" action="inscription.php" method="post">
<h1>Création utilisateur</h1>
<label for="pseudo">Pseudo *</label>
<input type="text" name="pseudo" id="pseudo" value="<?php if(!empty($_POST['pseudo'])) { echo $_POST['pseudo']; } ?>">
<p class="error"><?php if(!empty($errors['pseudo'])) { echo $errors['pseudo']; } ?></p>

<label for="email">Email *</label>
<input type="email" name="email" id="email" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } ?>">
<p class="error"><?php if(!empty($errors['email'])) { echo $errors['email']; } ?></p>

<label for="email2">Confirmation Email *</label>
<input type="email" name="email2" id="email2" value="<?php if(!empty($_POST['email2'])) { echo $_POST['email2']; } ?>">
<p class="error"><?php if(!empty($errors['email'])) { echo $errors['email']; } ?></p>

<label for="password1">Mot de passe *</label>
<input type="password" name="password1" id="password1" value="">
<p class="error"><?php if(!empty($errors['password'])) { echo $errors['password']; } ?></p>

<label for="password2">Confirmez le mot de passe *</label>
<input type="password" name="password2" id="password2" value="">
<p class="error"><?php if(!empty($errors['password'])) { echo $errors['password']; } ?></p>

<input type="submit" name="submitted" value="Création utilisateur">
</form>

<?php include "admin_footer.php"; ?>
