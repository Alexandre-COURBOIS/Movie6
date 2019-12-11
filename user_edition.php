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

include "admin_header.php";

$form->init("", "post", "form-edition-user");
$form->inputText("nom", "Nom: ", "Entrez un nom.", $user['nom']);
if(!empty($error['nom'])){$formVerif->printError($error['nom']);};
$form->inputText("prenom", "Prenom: ", "Entrez un prenom.", $user['prenom']);
if(!empty($error['prenom'])){$formVerif->printError($error['prenom']);};
$form->inputText("email", "Email: ", "michel.michel@hotmail.fr", $user['email']);
if(!empty($error['email'])){$formVerif->printError($error['email']);};
$form->inputPassword("password", "Mot de passe: ", "");
if(!empty($error['password'])){$formVerif->printError($error['password']);};
$form->inputSubmit("submited", "Modifier");
$form->end();

include "admin_footer.php";
