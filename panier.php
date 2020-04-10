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
<h1>Mon panier</h1>

<?php
        $_SESSION["user"]->creation_panier();

        if(isset($_GET['id']))
        {
            $id=$_GET["id"];
            $nom=$_GET["l"];
            $quantite=$_GET["q"];
            $prix_produit=$_GET["p"];

            $_SESSION["user"]->add_product_panier($id,$nom,$quantite,$prix_produit);
        }

$nb_produit=count($_SESSION['panier']['quantite']);

if($nb_produit <= 0){

    echo 'Votre panier est vide !';
    $_SESSION["user"]->delete_panier();
}
else{
    ?>

<form method="POST" action="">
    <table>
    <thead>
        <tr>
            <td>Nom du produit</td>
            <td>Quantité</td>
            <td>Prix unitaire</td>
            <td>Action</td> 
        </tr>
    </thead>
    </tbody>
        <?php 
        
            $i=0; 
            $nb_produit=count($_SESSION['panier']['quantite']);


                //tant que tu trouve des produits , ++
                for($i=0 ; $i < $nb_produit; $i++){
                    
                    ?>
                
                    <tr>
                        <td><?php echo $_SESSION['panier']['nom'][$i];?></td> 
                        <?php $pn_qt=$_SESSION['panier']['quantite'][$i];
                         $pn_id_pr=$_SESSION['panier']['id_produits'][$i];
                       ?>
                        <td><input name="qt" value="<?php echo $pn_qt;?>"/>
                        <input type="submit" name="qt_<?php echo $pn_id_pr?>"/></td>
                        <?php
                         $pn_qt=$_SESSION['panier']['quantite'][$i];
                         $pn_id_pr=$_SESSION['panier']['id_produits'][$i];
                       
                        if(isset($_POST["qt_"."$pn_id_pr"])){
                            $n_qt=$_POST["qt"];
                            $id_produit=$_SESSION['panier']['id_produits'];
                            $_SESSION["user"]->modify_quantity_product($id_produit,$quantite);
                        }
                        ?>
                        <td><?php echo $_SESSION['panier']['prix'][$i];?>€</td> 
                        <td></td>
                    </tr>


                    <?php
                }
        ?>
                    <tr>
                        <td colspan="3">Total : <?php echo calcul_montant_panier(); ?>€</td>
                    </tr>

                    
        </tbody>
    </table>
</form>

<!--Attention fonction delete_panier qui s'execute sans condition -> suppression automatique panier -->
<form method="POST" action="">
<input type="submit" name="delete_panier" value="Delete">
</form>
<?php
if(isset($_POST["delete_panier"])){
    $_SESSION["user"]->delete_panier();
}

?>



<button name="panier"><a href="paiement.php">Valider le panier</a></button>

            <?php } ?>   
</section>

</main>
<?php require 'include/footer.php'?>


</body>

</html>