<?php

include "assets/back/inc/pdo.php";

$id = $_GET['id'];

$sql = "SELECT * FROM `users` WHERE id = :id";
$query = $pdo->prepare($sql);
$query->bindValue(':id', $id, PDO::PARAM_INT);
$query->execute();
$user = $query->fetch();

$error = array();

if(isset($_POST['submited'])){
  $pseudo    = trim(strip_tags($_POST['pseudo']));
  $email     = trim(strip_tags($_POST['email']));

  $error['pseudo']    = $formVerif->errorText($pseudo, 'pseudo');
  $error['email']     = $formVerif->errorEmail($email, 'email', 10, 100);

  if (!empty($error)) {

  $sql =" UPDATE `users` SET email = :email, pseudo = :pseudo, created_at = NOW() WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email',$email, PDO::PARAM_STR);
    $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
    $query->bindValue(':id',$id, PDO::PARAM_INT);
    $query->execute();
  }
}

include "admin_header.php"; ?>

<form class="form-wrap" action="user_edition.php" method="post">
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

<input type="submit" name="submitted" value="Modifier utilisateur">
</form>

<?php include "admin_footer.php"; ?>
