<html>

<?php
require 'class/bdd.php';
require 'class/user.php';
//require 'class/panier.php';

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
}
else{
    ?>

<form method="GET" action="">
    <table>
    <thead>
        <tr>
            <th>Nom du produit</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th>Total</th>
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
                        <td><?php echo $_SESSION['panier']['prix'][$i];?>€</td> 
                        <?php $pn_qt=$_SESSION['panier']['quantite'][$i];
                         $pn_id_pr=$_SESSION['panier']['id_produits'][$i];
                       ?>
                        <td><input id="chiffre" type="number" min="1" max="<?php echo $_SESSION["bdd"]->stock($pn_id_pr); ?>"step="1" name="qt" value="<?php echo $pn_qt;?>"/>
                        <input type="submit" name="qt_<?php echo $pn_id_pr?>"/></td>
                        <?php
                         $pn_qt=$_SESSION['panier']['quantite'][$i];
                         $pn_id_pr=$_SESSION['panier']['id_produits'][$i];
                       
                        if(isset($_GET["qt_"."$pn_id_pr"])){
                            $n_qt=intval($_GET["qt"]);

                            $id_produit=$_SESSION['panier']['id_produits'];
                            $_SESSION["user"]->modify_quantity_product($pn_id_pr,$n_qt);
                        }
                        ?>
                        <td><?php echo intval($_SESSION['panier']['prix'][$i])*intval($_SESSION['panier']['quantite'][$i]);?>€</td>
                    </tr>


                    <?php
                }
        ?>
                    <tr>
                        <td class="prix_tot" colspan="4">Total panier : <?php echo $_SESSION["user"]->calcul_montant_panier(); ?>€</td>
                    </tr>

                    
        </tbody>
    </table>
</form>

<form method="POST" action="">
<input type="submit" name="delete_panier" value="Supprimer le panier">
</form>
<?php
if(isset($_POST["delete_panier"])){
    $_SESSION["user"]->delete_panier();
    header("location:panier.php");
}

?>



<button name="panier"><a href="paiement.php">Valider le panier</a></button>

            <?php } ?>   
</section>

</main>
<?php require 'include/footer.php'?>


</body>

</html>