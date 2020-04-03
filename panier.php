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

<form method="post" action="">
    <table>
        <tr>
            <td>Mon panier actuel</td>
        </tr>
        <tr>
            <td>Nom du produit</td>
            <td>Prix unitaire</td>
            <td>Quantité</td>
            <td>Action</td>
        </tr>
        <?php 
             
             
            $i=0; 
            $nb_produit=count($_SESSION['panier']['quantite']);
            var_dump($nb_produit);
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
                      <td><?php echo $_SESSION['panier']['prix'][$i];?></td> 

                    </tr>

                    <tr>
                        <td>Total : <?php echo calcul_montant_panier() ?></td>
                    </tr>
                    <?php
                }

            }
        ?>
    </table>
</form>
   

</section>

</main>
<?php require 'include/footer.php'?>


</body>

</html>