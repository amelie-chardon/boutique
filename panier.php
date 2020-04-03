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
        <title>Mon panier</title> 
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
</head>



<body>
<?php require 'include/header.php'?>

<main>

<section class="panneau-jaune">
<h1>Mon panier actuel</h1>

<form method="post" action="">
    <table>
        <tr>
            <td>Nom du produit</td>
            <td>Quantité</td>
            <td>Prix unitaire</td>
            <td>Action</td> 
        </tr>
        <?php 
        
        $_SESSION["user"]->creation_panier();

        if(isset($_GET['id']))
        {
            $id=$_GET["id"];
            $nom=$_GET["l"];
            $quantite=$_GET["q"];
            $prix_produit=$_GET["p"];

            $_SESSION["user"]->add_product_panier($nom,$quantite,$prix_produit);
        }
            $i=0; 
            $nb_produit=count($_SESSION['panier']['quantite']);

            if($nb_produit <= 0){

                echo 'Panier vide!';
            }
            else{
                //tant que tu trouve des produits , ++
                for($i=0 ; $i < $nb_produit; $i++){

                    ?>
                    <tr>
                        <td><?php echo $_SESSION['panier']['nom'][$i];?></td> 
                        <td><input name="qt" value="<?php echo $_SESSION['panier']['quantite'][$i];?>"/></td> 
                        <td><?php echo $_SESSION['panier']['prix'][$i];?>€</td> 
                        <td></td>
                    </tr>


                    <?php
                }

            }
        ?>
                    <tr>
                        <td colspan="3">Total : <?php echo calcul_montant_panier(); ?>€</td>
                    </tr>
    </table>
</form>
   

</section>

</main>
<?php require 'include/footer.php'?>


</body>

</html>