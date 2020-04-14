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
        <title>Contact</title> 
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
</head>



<body>
<?php require 'include/header.php'?>

<main>

<section class="panneau-jaune">

    <h1>Contactez-nous</h1>
    <section class="section_wrap">
        <section class="bloc">
            <img class="photo_profil" src="img/amelie.jpg"/>
            <h2>Amélie CHARDON</h2>
            <a href="https://www.linkedin.com/in/amelie-chardon/" target="_blank"><img class="logo" src="img/linkedin.png"></a>
        </section>

        <section class="bloc">
            <img class="photo_profil" src="img/sarah.png"/>
            <h2>Sarah CHAOUATI</h2>
            <a href="https://www.linkedin.com/in/sarah-chaouati-412281197/" target="_blank"><img class="logo" src="img/linkedin.png"></a>
        </section>
    </section>

</section>
</main>
<?php require 'include/footer.php'?>


</body>

</html>