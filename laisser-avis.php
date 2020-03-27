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
        <title>Laisser un avis</title> 
        <link rel="stylesheet" href="style.css">
        
        <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
</head>

<body>
<?php require 'include/header.php'?>

<main>


<section class="panneau">
<h1> Laisser un avis </h1>

<?php 
//Affichage des infos du produit
$id_produits=$_GET["id_produits"]; 
$info_produits=$_SESSION["bdd"]->info_produits($id_produits);
?>
<h2>Produit : <?php echo $info_produits["nom"] ;?></h2>
<img src="<?php echo $info_produits["image"] ;?>"/>
<?php
//Formulaire de commentaire
?>
<form class="formulaire" method="POST">
            <label for="commentaire" name="commentaire">Votre commentaire :</label>
            <input type="textarea" name="commentaire" required>
            <label for="note" name="note">Votre note :</label>
            <div class="note_echelle">
                <label for="note01">1</label>
                <input type="radio" name="note" id="note01" value="1" required />
                <label for="note02">2</label>
                <input type="radio" name="note" id="note02" value="2" required />
                <label for="note03">3</label>
                <input type="radio" name="note" id="note03" value="3" required />
                <label for="note03">4</label>
                <input type="radio" name="note" id="note04" value="4" required />
                <label for="note03">5</label>
                <input type="radio" name="note" id="note05" value="5" required />
            </div>
            <button type="submit" name="send">Valider</button>
        </form>
    
<?php 

if(isset($_POST["send"])){
    if($_SESSION["user"]->avis_produits($_POST["commentaire"],$_POST["note"])=="ok")
    {
        ?>
            <p>Votre avis a bien été envoyé.</p>
        <?php
    }
    elseif($_SESSION["user"]->avis_produits($_POST["commentaire"],$_POST["note"])=="empty")
    {
        ?>
            <p>Veuillez remplir tous les champs avant envoi.</p>
        <?php
    }
    else
    {
        ?>
            <p>Un problème est survenu lors de l'envoi. Veuillez recommencer.</p>
        <?php
    }
}
?>
<a href="profil.php"><button type="submit">Retour</button></a>

</section>


</main>

<?php require 'include/footer.php'?>

</body>

</html>
