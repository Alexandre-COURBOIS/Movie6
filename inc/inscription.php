<?php
include('assets/front/inc/functions.php');

$errors  = array();
$success = false;

if (!empty($_POST['submitted'])) {

    $nom      = clean($_POST['nom']);
    $prenom   = clean($_POST['prenom']);
    $mail     = clean($_POST['mail']);
    $select   = clean($_POST['select']);
    $textArea = clean($_POST['textArea']);

    $errors = textValid($nom,$errors,'nom',5,20);
    $errors = textValid($prenom, $errors,'prenom',5,20);
    $errors = textValid($textArea,$errors,'textArea',10,4000);
    $errors = emailValidation($mail,$errors,'mail');

    if(empty($select)){
        $errors['select'] = 'Veuillez selectionner un motif.';
    }

    if(count($errors) == 0) {
        $success = true;
    }

}

$select = array(
    'probleme'  => "Vous n'arrivez pas à vous connecter",
    'probleme1' => "Vous n'arrivez pas à mettre à jour vos vaccins",
    'probleme2' => "Vos vaccins ne s'affichent pas",
    'probleme3' => "Question pratique",
    'probleme4' => "Autres problèmes",
);

?>
<?php if($success) {?>
    <p class="success">OK</p>
    <div class="retour-index"><a href="index.html">Accueil</a></div>
<?php } else {?>

    <?php include('header.php');
    ?>
    <div class="wrap">


        <form class="formulaire-contact" action="" method="post">

            <div id="form-encre" class="formulaire nom">
                <label  class="label-contact" for="nom">Nom :</label>
                <input class="input-contact" type="text" id="nom" name="nom" value="<?php if (!empty($_POST['nom'])) {echo $_POST['nom'];} ?>">
                <span class="error"><?php if(!empty($errors['nom'])) {echo $errors['nom'];} ?>
            </div>

            <div class="formulaire prenom">
                <label class="label-contact" for="prenom">Prenom :</label>
                <input class="input-contact" type="text" id="prenom" name="prenom" value="<?php if (!empty($_POST['prenom'])) {echo $_POST['prenom'];} ?>">
                <span class="error"><?php if(!empty($errors['prenom'])) {echo $errors['prenom'];} ?>
            </div>

            <div class="formulaire mail">
                <label class="label-contact" for="mail">E-mail :</label>
                <input class="input-contact" type="mail" id="mail" name="mail" value="<?php if (!empty($_POST['mail'])) {echo $_POST['mail'];} ?>">
                <span class="error"><?php if(!empty($errors['mail'])) {echo $errors['mail'];} ?>
            </div>

            <div class="formulaire select">
                <label class="label-contact" for="select">Motif :</label>
                <select id="select" name="select">
                    <option value="">-- Sélectionnez --</option>
                    <?php foreach ($select as $key => $value) { ?>
                    <option value="<?php echo $key; ?>"<?php if (!empty($_POST['select'])) {if($_POST['select'] == $key ) {echo ' selected="selected" ';}} ?>>
                        <?php echo $value; ?></option><?php   }  ?>
                </select>
                <span class="error"><?php if (!empty($errors['select'])) {echo $errors['select'];} ?></span>
            </div>

            <div class="formulaire textArea">
                <label class="label-contact" for="textArea">Message :</label>
                <textarea rows="8" id="textArea" class="textArea" name="textArea"><?php if (!empty($_POST['textArea'])) {echo $_POST['textArea'];} ?></textarea>
                <span class="error"><?php if (!empty($errors['textArea'])) {echo $errors['textArea'];} ?></span>
            </div>

            <div class ="formulaire-submit submit1">
                <input type="submit" name="submitted" value="Envoyer">
            </div>

        </form>


    </div>
<?php }
include('footer.php');
?>