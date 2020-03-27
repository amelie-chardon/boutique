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
        <title>Ma commande </title> 
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
</head>

<body>
<?php require 'include/header.php'?>

<main>


<section class="panneau">
<h1> Ma commande n°<?php echo $_GET["id_achats"]?></h1>

<?php $_SESSION["user"]->mon_panier_achats();?>

<a href="profil.php"><button type="submit">Retour</button></a>

</section>


</main>

<?php require 'include/footer.php'?>

</body>

</html>
