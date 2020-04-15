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
        <title>Présentation de l'entreprise</title> 
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
</head>



<body>
<?php require 'include/header.php'?>

<main>

<section class="panneau-jaune">

    <h1>Notre entreprise</h1>
        <p>L'entreprise "Amélie & Sarah" spécialisée dans la vente en ligne de pâtisseries, est née récemment de la volonté de deux jeunes entrepreuneses.</p>
    <section class="section_wrap">
        <section class="bloc_texte">
            <h2>2019 : rencontre des deux entrepreuneuses</h2>
            <p>C'est au sein de l'école La Plateforme_ que ces deux femmes se sont rencontrées.
            Amélie et Sarah ont toutes deux 27 ans et ont en commun la passion pour la cuisine et le web.</p>
        </section>
        <section class="bloc_texte">
            <h2>2020 : création de l'entreprise</h2>
            <p>Après avoir collaboré sur de nombreux projets, c'est au début de l'année 2020 qu'elles décident de s'associer pour un projet de plus grande envergure : ouvrir un site web pour la vente en ligne de pâtisseries.</p>
        </section>
    </section>
</section>
    
</main>
<?php require 'include/footer.php'?>


</body>

</html>