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


?>

<head>
        <title>Accueil</title> 
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
</head>



<body>
<?php require 'include/header.php'?>

<main>

<section class="panneau-jaune">

    <h2>Les nouveautés</h2>
    <section class="section_wrap">
    <?php 
        //Selection des 3 produits les plus récemments ajoutés
        $_SESSION['bdd']->select_produits("SELECT id,nom, image,prix FROM produits ORDER BY id DESC LIMIT 3");
    ?>
    </section>
</section>


<section class="panneau-rose">
    <h2>Les meilleures ventes</h2>
    <section class="section_wrap">
    <?php 
        //Selection des 3 produits avec les meilleures ventes
        $_SESSION['bdd']->select_produits("SELECT produits.id,nom,image,prix, SUM(quantite) AS quantite_totale FROM panier INNER JOIN produits on panier.id_produits=produits.id GROUP BY id_produits ORDER BY quantite_totale DESC LIMIT 3");
    ?>
    </section>
</section>


<section class="panneau-jaune">
    <h2>Les coups de coeur de nos clients</h2>
    <section class="section_wrap">
    <?php 
        //Selection des 3 produits avec les meilleures notes
        $_SESSION['bdd']->select_produits("SELECT id, nom, image,prix FROM produits ORDER BY note DESC LIMIT 3");
    ?>
    </section>
</section>





</main>
<?php require 'include/footer.php'?>


</body>

</html>