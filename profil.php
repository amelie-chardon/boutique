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
if($_SESSION['user']->isConnected() != true){
    header('Location:index.php');
}?>
<html>

<head>
        <title>Profil</title> 
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
</head>

<body>
<?php require 'include/header.php'?>

<main>


<section class="panneau">
<h1> Mon compte </h1>

    <section class="bloc">
        <h2>Mes Informations</h2>
            <?php
          $_SESSION["user"]->mes_info();
          ?>
    </section>
   
    <section class="bloc">
        <h2>Modifier mes informations</h2>
    
                <form action="profil.php" method="POST">
                    <label>Identifiant : </label>
                    <input type="text" name="login" value="<?php echo $_SESSION['user']->getlogin(); ?>"><br>
                    <label>Mail :</label>
                    <input type="mail" name="mail" value="<?php echo $_SESSION['user']->getmail() ?>"><br>
                    <label>Mot de passe : </label>
                    <input type="password" name="password" minlength="5" /><br>
                    <label>Confirmation du mot de passe :</label>
                    <input type="password" name="passwordconf" required><br>
                    <input type="submit" name="send">
                    </form>

    <?php // modif login/mail/mdp 
    if(isset($_POST["send"])){
        if(!empty($_POST["passwordconf"])){
            if(!empty($_POST["login"])){
                $_SESSION['user']->profil($_POST["passwordconf"],$_POST["login"],NULL,NULL,NULL);
            }
            if(!empty($_POST["mail"])){
                $_SESSION['user']->profil($_POST["passwordconf"],NULL,$_POST["mail"],NULL);
            }
            if(!empty($_POST["password"])){
                $_SESSION['user']->profil($_POST["passwordconf"],NULL,NULL,$_POST["password"]);
            }
        }
        else{
            ?>
            <p>Veuillez rentrer votre ancien mot de passe pour valider vos changements</p>
        <?php
    }
}

?>
    </section>
     


    <section class="bloc">
        <h2>Mes achats</h2>

        <article>
<?php $_SESSION["user"]->mes_achats();?>

        </article>
    </section>


    <section class="bloc">
        <h2>Me désinscrire</h2> 
        <form class="formulaire" method="post">
            <button type="submit" name="desinscription">Se désinscrire</button>
        </form>

        <?php 
        if(isset($_POST["desinscription"]))
        {
            $_SESSION["user"]->desinscription('id');
        }
        ?>
    </section>

</section>


</main>

<?php require 'include/footer.php'?>

</body>

</html>
