<?php

include "assets/back/inc/pdo.php";
include "assets/front/inc/Form.php";
include "assets/front/inc/FormVerif.php";
include "assets/front/inc/functions.php";

$id = $_GET['id'];

$sql = "SELECT * FROM `users` WHERE id = :id";
$query = $pdo->prepare($sql);
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->execute();
$user = $query->fetch();

$form = new Form;
$formVerif = new FormVerif;

$error = array();

if(isset($_POST['submited'])){
  $nom       = trim(strip_tags($_POST['nom']));
  $prenom    = trim(strip_tags($_POST['prenom']));
  $email     = trim(strip_tags($_POST['email']));
  $password  = trim(strip_tags($_POST['password']));

  $error['nom']       = $formVerif->errorText($nom, 'nom', 5, 20);
  $error['prenom']    = $formVerif->errorText($prenom, 'prenom', 5, 20);
  $error['email']     = $formVerif->errorEmail($email, 'email', 10, 100);
  $error['password']  = $formVerif->errorText($password, 'Mot de passe', 5, 255);

  if (!empty($error)) {

  $password = password_hash($password, PASSWORD_DEFAULT);

  $sql =" UPDATE `users` SET email = :email, password= :password, nom = :nom, prenom = :prenom, created_at = NOW() WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email',$email, PDO::PARAM_STR);
    $query->bindValue(':password',$password, PDO::PARAM_STR);
    $query->bindValue(':nom',$nom, PDO::PARAM_STR);
    $query->bindValue(':prenom',$prenom, PDO::PARAM_STR);
    $query->bindValue(':id',$id, PDO::PARAM_INT);
    $query->execute();
  }
}

include "admin_header.php"; ?>

<form class="form-wrap" action="inscription.php" method="post">
<h1>Edition utilisateur</h1>
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

<input type="submit" name="submitted" value="Modifier utilisateur">
</form>

<?php include "admin_footer.php"; ?>
