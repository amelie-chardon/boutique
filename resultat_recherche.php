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
    <h2>Le résultat de ta recherche</h2>

    <?php 
            if(isset($_GET['search'])){
                $q=$_GET['search'];
                $_SESSION["bdd"]->connect();
                $result=$_SESSION["bdd"]->execute("SELECT
                produits.id,
                produits.nom,
                produits.description,
                produits.image
            FROM
                produits
            RIGHT JOIN categories_produits ON produits.id = categories_produits.id_produits
            RIGHT JOIN categories ON categories_produits.id_categories = categories.id
            RIGHT JOIN sous_categories_produits ON produits.id = sous_categories_produits.id_produits
            RIGHT JOIN sous_categories ON sous_categories_produits.id_sous_categories = sous_categories.id
            WHERE
                CONCAT(
                    produits.description,
                    produits.description,
                    categories.nom,
                    sous_categories.nom
                ) LIKE '%$q%'
            ORDER BY
                produits.id
            DESC");
            /*
                    $connect = mysqli_connect('localhost','root','','boutique');
                    $q=$_GET['search'];
                    $sql = "SELECT
                    produits.description,
                    produits.description,
                    categories.nom,
                    sous_categories.nom
                FROM
                    produits
                RIGHT JOIN categories_produits ON produits.id = categories_produits.id_produits
                RIGHT JOIN categories ON categories_produits.id_categories = categories.id
                RIGHT JOIN sous_categories_produits ON produits.id = sous_categories_produits.id_produits
                RIGHT JOIN sous_categories ON sous_categories_produits.id_sous_categories = sous_categories.id
                WHERE
                    CONCAT(
                        produits.description,
                        produits.description,
                        categories.nom,
                        sous_categories.nom
                    ) LIKE '%$q%'
                ORDER BY
                    produits.id
                DESC";

                    $req = mysqli_query($connect,$sql) or die( mysqli_connect_error());
                     var_dump($req);
                */
                foreach($result as list($id,$nom,$description,$image))
                {
                            ?>
                            <article>
                                <img id="produit_img" src="<?php echo $image; ?>" />
                                    <div>
                                        <h2><?php echo $nom; ?></h2>
                                        <p><?php echo $description; ?></p>
                                        <button><a href="produit?id_produits=<?php echo $id; ?>">Page produit</a></button>
                                    </div>
                            </article>
                            <?php

                }
                    
            }
            else{
                    echo "vide ou pas trouvé";
            }
            ?>

</section>


</main>
<?php require 'include/footer.php'?>


</body>

</html>




