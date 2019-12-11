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

include "admin_header.php";

$form->init("", "post", "form-creation-user");
$form->inputText("nom", "Nom: ", "Entrez votre nom.");
if(!empty($error['nom'])){$formVerif->printError($error['nom']);};
$form->inputText("prenom", "Prenom: ", "Entrez votre prenom.");
if(!empty($error['prenom'])){$formVerif->printError($error['prenom']);};
$form->inputText("email", "Email: ", "michel.michel@hotmail.fr");
if(!empty($error['email'])){$formVerif->printError($error['email']);};
$form->inputText("email2", "Repetez le Email: ", "");
if(!empty($error['email2'])){$formVerif->printError($error['email2']);};
$form->inputPassword("password", "Mot de passe: ", "");
if(!empty($error['password'])){$formVerif->printError($error['password']);};
$form->inputPassword("password2", "Repetez le Mot de passe: ", "");
if(!empty($error['password2'])){$formVerif->printError($error['password2']);};
$form->inputSubmit("submited");
$form->end();

include "admin_footer.php";
