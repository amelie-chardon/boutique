<?php 

$_SESSION["bdd"]->connect();
$categories=$_SESSION["bdd"]->execute("SELECT nom FROM categories");

?>

<nav>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li class="deroulant"><a href="#">Nos produits</a>
            <ul class="sous">
        <?php foreach ($categories as $nom_cat)
        {
            ?><li><a href="resultat_recherche.php?search=<?php echo $nom_cat[0]; ?>"><?php echo $nom_cat[0]; ?></a></li><?php
        }
        ?>
            </ul>
        </li>
        <li><a href="presentation.php">Notre entreprise</a></li>
        <li><a href="contact.php">Contact</a></li> 
     </ul>
</nav>

