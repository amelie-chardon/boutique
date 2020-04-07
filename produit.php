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
        <title>Page produit</title> 
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
</head>



<body>
<?php require 'include/header.php'?>

<main>

<section class="panneau-jaune">
<?php 
                        if ($_GET['id_produits']){

                         
                            $id= $_GET['id_produits'];
                            $connect = mysqli_connect('localhost', 'root', '','boutique');
                            $select="SELECT *
                                     FROM produits
                                     WHERE id=$id";
                            $query= mysqli_query($connect,$select);
                            $data= mysqli_fetch_assoc($query);
                            

                            ?> 
                    <section class="bloc">

                        <article class="fiche_produit">
                        <h1><?php echo $data['nom']?></h1>
                            <img id="produit_img" src="<?php echo $data['image']?>" />
                            <h2><?php echo $data['description']?></h2>
                            <p>Stock disponible : <?php echo $data['stock']?> </p>
                            <h2><?php echo $data['prix']?>€</h2>
                            
                            
                        <?php
                            if($data['stock']!=0){
                                ?>
                               <button> <a href="panier.php?action-ajout&amp;id=<?php echo $data['id'];?>&amp;l=<?php echo $data['nom'];?>&amp;q=<?php echo $data['stock'];?>&amp;p=<?php echo $data['prix'];?>"> Ajouter au panier (+1)</a></button>
                            <?php
                            }
                            else{
                                ?>
                                <p>En cours de réapro</p>
                            <?php
                            }
                            ?>
                       
                        </article>
                    </section>

                    <section class="bloc_text">

                        <article class="zone_avis">
                            <div class="avis">
                            <h2>Les derniers avis</h2>
                            <?php 
                                   $id= $_GET['id_produits'];
                                   $connect = mysqli_connect('localhost', 'root', '','boutique');
                                   $select="SELECT commentaire , note FROM `avis` where id_produits = $id";
                                   $query= mysqli_query($connect,$select);
                                   $data= mysqli_fetch_all($query);
                                   foreach($data as list($commentaire,$note))
                                   {
                                               ?>
                                               <article>
                                                   
                                                       <div class="avis&note">
                                                           
                                                           <p><?php echo $note; ?></p></br>
                                                           <p><?php echo $commentaire; ?></p>
                                                           
                                                       </div>
                                               </article>
                                               <?php
                   
                                   }
                                   
                                 ?>
                            <?php 
                            

                        }
                        else
                        {
                            echo 'produit pas trouver';
                        }
                            ?>
                           
                            <h2>Vous souhaitez laisser un avis</h2>
                            <?php
                            $id = $_GET['id_produits']
                            ?>
                            <button><a href="laisser-avis?id_produits=<?php echo $id; ?>">Poster un commentaire</a></button>
                            </div>
                               
                            <div class="zone_creation_avis">

                            </div>

                        </article>
                    </section>

                        <aside class="produit_similaire">


                        </aside>

                          


</section>


</main>
<?php require 'include/footer.php'?>


</body>

</html>




