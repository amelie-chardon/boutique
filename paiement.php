<html>

<?php
require 'class/bdd.php';
require 'class/user.php';
require 'class/panier.php';

session_start();


if(!isset($_SESSION['bdd']))
{
    $_SESSION['bdd'] = new bdd();
}
if(!isset($_SESSION['user'])){
    $_SESSION['user'] = new user();
}


?>

<head>
        <title>Paiement</title> 
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
</head>



<body>
<?php require 'include/header.php'?>

<main>

<section class="panneau-jaune">
    <h1>Paiement du panier</h1>
    <article class="paiement">
    <h2>Montant de la transaction : <?php echo calcul_montant_panier(); ?> €</h2>
    <p>Numéro de carte bancaire :</p>
    <p>Date d'expiration :</p>
    <p>Cryptogramme visuel :</p>
    <button>Valider</button>
    </article>

</section>

</main>
<?php require 'include/footer.php'?>


</body>

</html>