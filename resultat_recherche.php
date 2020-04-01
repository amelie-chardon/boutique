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
        <title>Resultat</title> 
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
</head>



<body>
<?php require 'include/header.php'?>

<main>

<section class="panneau-jaune">
    <h2>Le resultat de ta recherche pour </h2>

    <?php 
            if(isset($_GET['search'])){
        
                    $connect = mysqli_connect('localhost','root','','boutique');
                    $q=$_GET['search'];
                    $sql = "SELECT *
                            FROM produits 
                            WHERE CONCAT(nom,description,categorie,sous_cat)
                            LIKE '%$q%'
                            ORDER BY id DESC";
                    $req = mysqli_query($connect,$sql) or die( mysqli_connect_error());
                     
                    while($fetch=mysqli_fetch_assoc($req)){
                            ?>
                            <article>
                                <img id="produit_img" src="img/produit/<?php echo $fetch['id']?>.jpg" />
                                    <div>
                                        <h2><?php echo $fetch['nom']?></h2>
                                        <p><?php echo $fetch['description']?></p>
                                        <button><a href="produit?id=<?php echo $fetch['id']; ?>">Page produit</a></button>
                                    </div>
                            </article>
                            <?php

                    }
                    
            }
            else{
                    echo "vide ou pas trouver";
            }
            ?>

</section>


</main>
<?php require 'include/footer.php'?>


</body>

</html>




