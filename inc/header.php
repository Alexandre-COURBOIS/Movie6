<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <titleMovies
    </title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap"
          rel="stylesheet">
</head>

<body>

<div class="bg-header">
    <div class="wrap">
    <?php if(empty($_SESSION)) { ?>
        <header>
            <a href="" class="logo"><img src="assets/img/logowr.png" alt=""></a>
            <nav class="nav navbar">
                <ul>
                    <li><a href="index.php">accueil</a></li>
                    <li><a href="">what's on</a></li>
                    <li><a href="">news</a></li>
                    <li><a href="">contact</a></li>
                </ul>
            </nav>
            <div class="log">
                <a class="connexion" href="connexion.php">Connexion</a>
                <a class="inscription" href="inscription.php">Inscription</a>
                <a href=""><img src="assets/img/loupe.svg" alt=""></a>
            </div>
            <?php } else { ?>
            <a href="" class="logo"><img src="assets/img/logowr.png" alt=""></a>
            <nav class="nav navbar">
                <ul>
                    <li><a href="index.php">accueil</a></li>
                    <li><a href="">what's on</a></li>
                    <li><a href="">news</a></li>
                    <li><a href="">contact</a></li>
                </ul>
            </nav>
            <div class="log">
                <a class ="voir" href="notes.php">Mes notes</a>
                <a class ="voir" href="favoris.php">A voir</a>
                <a class="connexion" href="deconnexion.php">Deconnexion</a>
            </div>
            <?php } ?>
        </header>
        <div class="clear"></div>
    </div>
</div>

</body>


</html>