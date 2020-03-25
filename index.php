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
</section>
<section class="panneau-rose">
    <h2>La sélection du mois</h2>
</section>
<section class="panneau-jaune">
    <h2>Les coups de coeur de nos clients</h2>
</section>





</main>
<?php require 'include/footer.php'?>


</body>

</html>