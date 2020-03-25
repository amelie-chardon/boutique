<html>

<?php
require 'class/bdd.php';
require 'class/user.php';

session_start();

if(!isset($_SESSION['bdd']))
{
    $_SESSION['bdd'] = new bdd();
}
if(!isset($_SESSION['user'])){
    $_SESSION['user'] = new user();
}
if($_SESSION['user']->isConnected() != false){
    header('Location:index.php');
}

?>


<head>
        <title>Inscription</title> 
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
</head>

<body>
<?php require 'include/header.php'?>

<main>
    <section class="panneau">
    <h1>Inscription</h1>

        <section class="bloc"> 
        <form class="formulaire" action="inscription.php" method="post">
        
            <label>Identifiant :</label>
            <input type="text" name="login" required><br>
            <label>Mail :</label>
            <input type="mail" name="mail" required><br>
            <label>Mot de passe :</label>
            <input type="password" name="password" minlength="12" required><br>
            <label>Confirmation du mot de passe :</label>
            <input type="password" name="passwordconf" minlength="12" required><br>
            <input type="submit" name="send">
        </form>

    </section>

<?php

if(isset($_POST['send'])){
    if($_SESSION["user"]->inscription($_POST['login'],$_POST["password"],$_POST['passwordconf'],$_POST['mail']) == "ok"){
        ?>
        <p>Le compte a été créé.</p>
        <?php
    }
    elseif($_SESSION["user"]->inscription($_POST['login'],$_POST["password"],$_POST['passwordconf'],$_POST['mail']) == "log"){
        ?>
            <p>L'identifiant ou l'email est déjà pris.</p>
        <?php
    }
    elseif($_SESSION["user"]->inscription($_POST['login'],$_POST["password"],$_POST['passwordconf'],$_POST['mail']) == "empty"){
        ?>
            <p>Veuillez remplir tous les champs.</p>
        <?php
    }
    elseif($_SESSION["user"]->inscription($_POST['login'],$_POST["password"],$_POST['passwordconf'],$_POST['mail']) == "mdp"){
        ?>
            <p>Les mots de passes ne sont pas identiques.</p>
        <?php
    }
}

?>
</section>


</main>
<?php require 'include/footer.php'?>


</body>

</html>