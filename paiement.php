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

    <?php if (!isset($_POST["valider"]))
    {
    ?>
        <h2>Montant de la transaction : <?php echo calcul_montant_panier(); ?> €</h2>
        <p>Numéro de carte bancaire : XXXXXXXXXXXXXXXXXXX</p>
        <p>Date d'expiration : XX/XX</p>
        <p>Cryptogramme visuel : XXX</p>
        <form method="post">
            <input type="submit" name="valider">
        </form>
    <?php

    }
    else
    {
    $_SESSION["user"]->connect();
    $id_achats = $_SESSION["user"]->execute("SELECT MAX(`id_achats`) FROM panier");
    $id_achats=intval($id_achats[0][0])+1;
    $prix_tot=0;

    //Pour chaque produit du panier
    for($i=0;$i<count($_SESSION["panier"]["id_produits"]);$i++)
    {
        $id_produits=$_SESSION['panier']['id_produits'][$i];
        $quantite=intval($_SESSION['panier']['quantite'][$i]);
        $prix=intval($_SESSION['panier']['prix'][$i]);
        //On ajoute à la table panier
        $panier=$_SESSION["user"]->execute("INSERT INTO panier (id_produits,id_achats,quantite) VALUES (\"$id_produits\",\"$id_achats\",\"$quantite\")");
        
        //Calcul du prix total de la commande
        $prix_tot+=$quantite*$prix;
    }
    $id_utilisateur=$_SESSION["user"]->getid();
    //On ajoute la commande dans la table "achats"
    $achat=$_SESSION["user"]->execute("INSERT INTO achats(id_utilisateurs, prix, date_achat) VALUES ($id_utilisateur,$prix_tot,NOW())");
    
    //Suppression du panier en cours
    $_SESSION["user"]->delete_panier();

    ?>
    <p>Votre commande a été validée. </p>
    <button><a href="voir-commande.php?id_achats=<?php echo $id_achats ;?>">Voir ma commande</a></button>
    <?php
    }
    ?>
    </article>

</section>

</main>
<?php require 'include/footer.php'?>


</body>

</html>