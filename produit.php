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
   
<?php 
                        if ($_GET['id']==true){
//condition à add, si le stock est suffisant
                         
                            $id= $_GET['id'];
                            $connect = mysqli_connect('localhost', 'root', '','boutique');
                            $select="SELECT *
                                     FROM produits
                                     WHERE id=$id";
                            $query= mysqli_query($connect,$select);
                            $data= mysqli_fetch_assoc($query);
                            

                            ?> 
                        <article class="fiche_produit">
                            
                            <h1><?php echo $data['nom']?></h1>
                            <img id="produit_img" src="img/produit/<?php echo $data['id']?>.jpg" />
                            <h2><?php echo $data['description']?></h2>
                            <p>Stock disponible : <?php echo $data['stock']?> </p>
                            <h2><?php echo $data['prix']?>€</h2>
                       
                        </article>

                        <article class="zone_avis">
                            <div class="avis">

                            </div>
                            <?php
                        }
                        //test
                        else{
                            echo "niet";
                        }
                         ?>   
                            <div class="zone_creation_avis">

                            </div>

                        </article>

                        <aside class="produit_similaire">


                        </aside>

                          


</section>


</main>
<?php require 'include/footer.php'?>


</body>

</html>




