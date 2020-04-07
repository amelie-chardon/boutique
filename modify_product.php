<?php 
require 'class/bdd.php';
require 'class/user.php';
require 'class/admin.php';


session_start();



if(!isset($_SESSION['bdd']))
{
    $_SESSION['bdd'] = new bdd();
}

if(!isset($_SESSION['user'])){
    $_SESSION['user'] = new user();
}

if(!isset($_SESSION['admin'])){
    $_SESSION['admin'] = new admin();
}

if(!isset($_SESSION['perm'])){
    header('Location:index.php');
}


?>

<html>

<head>
        <title>Modération</title> 
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
</head>

    <body>
    <?php require 'include/header.php'?>

        <main>

                    <section class="panneau">
                    <h1>Administration</h1>

                      <div class="gestion_produit"> 
                        <article>
                        <h2>Modération de Produit</h2>
                        <?php 
                        if ($_GET['id']){
                         
                            $id= $_GET['id'];
                            $connect = mysqli_connect('localhost', 'root', '','boutique');
                            $select="SELECT *
                                     FROM produits
                                     WHERE id=$id";
                            $query= mysqli_query($connect,$select);
                            $data= mysqli_fetch_assoc($query);

                         ?>   
                       
    
                <form action="" method="POST">

                        
                        <label>Nom : </label>
                        <input type="text" name="nom" value="<?php echo  $data['nom']; ?>"/><br>
                        <label>Description :</label>
                        <input type="text" name="description" value="<?php echo  $data['description']; ?>"/><br>
                        <label>Stock : </label>
                        <input type="text" name="stock" value="<?php echo  $data['stock']; ?>"/><br>
                        <label>Prix : </label>
                        <input type="text" name="prix" value="<?php echo  $data['prix']; ?>"/><br>
                
                        <input type="submit" name="mod_prod"/>
                </form> 
            </article>
                        <?php
                        }
                        else{
                            echo "Produit non trouvé";
                        }?>


            <?php if(isset($_POST['mod_prod']))
            {
        

            $id=$_GET['id'];
            $connexion = mysqli_connect('Localhost', 'root', '', 'boutique');
            $update_produit ="UPDATE `produits` 
                        SET `nom` = '".$_POST['nom']."', `description` = '".$_POST['description']."', `prix` = '".$_POST['prix']."',
                        `stock` = '".$_POST['stock']."'
                        WHERE produits.id= $id";

            $query= mysqli_query($connexion,$update_produit);

            header ("location:modify_product?id=". $_GET["id"]);
            }
?>


<!--Partie mod cat & sous cat-->
                    <article class="">
                        <form method="POST" action="">

                        <?php 
        
                        $_SESSION["user"]->pop_list_cat(); 

                         ?>
                            <input name="mod_cat" type="submit"/>
                        
                    </article>
                    <?php if(isset($_POST['mod_cat']))
            {
        

            $id=$_GET['id'];
            $cat=$_POST["cat"];
            //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $connexion = mysqli_connect('Localhost', 'root', '', 'boutique');
            $update_cat ="UPDATE `categories_produits` SET `id_categories` = $cat WHERE  `categories_produits`.`id_produits` = $id";
            $query= mysqli_query($connexion,$update_cat);
            var_dump($update_cat);
            var_dump($query);
            
            echo "yes!";
            
            }
            
?>


<!--Partie mod cat & sous cat-->
<article class="">
                        <form method="POST" action="">

                        <?php 
        
                        $_SESSION["user"]->pop_list_sous_cat(); 
                        
                         ?>
                            <input name="mod_sous_cat" type="submit"/>
                        
                    </article>
                    
                    <?php if(isset($_POST['mod_sous_cat']))
            {
        

            $id=$_GET['id'];
            $cat=$_POST["sous_categorie"];
            //mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $connexion = mysqli_connect('Localhost', 'root', '', 'boutique');
            $update_cat ="UPDATE `sous_categories_produits` SET `id_sous_categories` = $cat WHERE  `sous_categories_produits`.`id_produits` = $id";
            $query= mysqli_query($connexion,$update_cat);
            var_dump($update_cat);
            var_dump($query);
            
            echo "yes!";
            
            }
            
            
?>
                   
        </form>                     
                       
                    


                        <article>
                        <h2>Upload photo du produit</h2>
                        <img class="produit_img_table" src="<?php echo $data['image']; ?>" />
                        <form action="" method="POST" enctype="multipart/form-data">
                        <input type="file" name="avatar"/>
                        
                        <input type="submit" name="valider">
                        
                        
                        <?php
    
            if(isset($_POST['valider'])){
                if(isset($_FILES['avatar'])) {
                    $tailleMax = 3145728;
                    $extensionsValides = array('jpg');
                    if($_FILES['avatar']['size'] <= $tailleMax)
                     {
                       $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
                       if(in_array($extensionUpload, $extensionsValides)) {
                        $id = $_GET['id'];
                          $chemin = "img/produit/".$id.".".$extensionUpload;
                          echo $chemin;
                          $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                          if($resultat) {
                             
                             $connexion = mysqli_connect('Localhost', 'root', '', 'boutique');
                             $update_pp ="UPDATE produits SET image = '$chemin' WHERE id = '$id'";
                             $query= mysqli_query($connexion,$update_pp);
                             
                             echo "Image produit bien mis à jour !";

                          } else {
                             echo "Erreur durant l'importation de votre photo de profil";
                          }
                       } else {
                          echo "Votre photo de profil doit être au format jpg";
                       }
                    } else {
                       echo "Votre photo de profil ne doit pas dépasser 3Mo";
                    }
                }
                 
                }
                ?>
</form> 
                        </article>
                       

                    </section>


        </main>
        <?php require 'include/footer.php'?>


    </body>

</html>
