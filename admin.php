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
        <title>Administration</title> 
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
            <h2>Ajout de produit</h2>
                <form action="admin.php" method="POST">
                    <label>Nom : </label>
                    <input type="text" name="nom"/><br>
                    <label>Description :</label>
                    <input type="text" name="description"/><br>
                    <label>Stock : </label>
                    <input type="text" name="stock" required/><br>
                    <label>Prix : </label>
                    <input type="text" name="prix" required/><br>
        <?php 
        $_SESSION["bdd"]->connect();
        $i=0;
        $result=$_SESSION["bdd"]->execute("SELECT id , nom
                                           FROM categories
                                           ");
                                           
                                           
                                           
        ?>

                    <label>Catégorie(s) : </label>
                    <select name="categorie" required>
                       
                       <?php
                       foreach($result as list($id,$nom)) {
                        ?>

                        <option value="<?php echo $nom ?>"><?php echo $nom ?></option>

                        <?php
                        
                       }
                       $i++
                       
                       ?>

                    </select></br>


                    <?php 
        $_SESSION["bdd"]->connect();
        $i=0;
        $result=$_SESSION["bdd"]->execute("SELECT id , nom
                                           FROM sous_categories
                                           ");
                                           
                                           
        ?>

                    <label>Sous-Catégorie(s) : </label>
                    <select name="sous_categorie" required>
                       
                    <?php
                       foreach($result as list($id,$nom)) {
                        ?>

                        <option value="<?php echo $nom ?>"><?php echo $nom ?></option>

                        <?php
                        
                       }
                       $i++
                       
                       ?>


                        
                    </select></br>
                    
                    
                    <input type="submit" name="send_add_produit"/>
                    

                       <?php if(isset($_POST['send_add_produit'])){
        
        $nom= $_POST['nom'];
        $description=$_POST['description'];
        $stock=$_POST['stock'];
        $prix=$_POST['prix'];
        $categorie=$_POST['categorie'];
        $sous_categorie=$_POST['sous_categorie'];


    if($nom != NULL && $description  != NULL && $stock != NULL &&
     $prix != NULL && $categorie != NULL && $sous_categorie != NULL)
    {
         
                    $connect = mysqli_connect("localhost", "root", "", "boutique");
                    $requete = "INSERT INTO `produits` (`nom`, `description`, `prix`, `stock`, `categorie`, `sous_cat`)
                                VALUES ('$nom', '$description', '$prix', '$stock','$categorie','$sous_categorie')" AND
                                //"INSERT INTO `categories_produits` (`id_produits`)
                               // VALUES ('$categorie')";

                            //Amélie au secours le sql va me tuer :D 


                               
                    $query = mysqli_query($connect,$requete);
                    
                   echo "Article bien ajouté !";
                   header('Location:index.php');
                    }
             
     else
     {
        
        echo "empty";
     }
         
        }
        
       
?>
                </form>
            </article>

            <article>

                <h2>Produits en vente</h2>
                <?php
                    $_SESSION["bdd"]->connect();
                    $result=$_SESSION["bdd"]->execute("SELECT Produits.id, produits.nom, produits.description, produits.image, produits.stock, produits.prix FROM produits ORDER BY produits.id ASC");
                ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                <th>Catégorie(s)</th>
                                <th>Sous Catégorie(s)</th>
                            </tr>
                        </thead>
                        <tbody>
        <?php

                foreach($result as list($id,$nom,$description,$image,$stock,$prix))
                {
                    $categories=$_SESSION["bdd"]->execute("SELECT Produits.id, categories.nom FROM produits RIGHT JOIN categories_produits ON produits.id=categories_produits.id_produits RIGHT JOIN categories ON categories_produits.id_categories=categories.id WHERE produits.id=$id");
                    $sous_categories=$_SESSION["bdd"]->execute("SELECT Produits.id, sous_categories.nom FROM produits RIGHT JOIN sous_categories_produits ON produits.id=sous_categories_produits.id_produits RIGHT JOIN sous_categories ON sous_categories_produits.id_sous_categories=sous_categories.id WHERE produits.id=$id");

                        ?>
                            <tr>
                                <td><img class="produit_img" src="<?php echo $image; ?>"/></td>
                                <td><?php echo $nom; ?></td> 
                                <td><?php echo $description; ?></td>
                                <td><?php echo $prix; ?></td>
                                <td><?php echo $stock; ?></td>
                                <td><?php foreach ($categories as $categorie){ echo $categorie[1];?></br><?php } ?></td>
                                <td><?php foreach ($sous_categories as $sous_categorie){ echo $sous_categorie[1];?></br><?php } ?></td>
                                
                                <td><button><a href="modify_product?id=<?php echo $id; ?>">Modifier</a></button></td>
                                <td><button><a href="confirm_delete?id=<?php echo $id; ?>">Delete</a></button></td>
                            </tr>
                         <?php
                }       
       ?>
                        </tbody> 
                    </table>
    
            </article>
        </div>


        <div class="gestion_cat">
            <article>

                <h2>Création de categories</h2>

                    <form action="admin.php" method="POST">
                    <label>Nom : </label>
                    <input type="text" name="nom"/><br>

                    <input type="submit" name="send_add_cat"/>

                        <?php if(isset($_POST['send_add_cat'])){
                            $nom= $_POST['nom'];
        
                            if($nom != NULL)
                            {
                
                            $connect = mysqli_connect("localhost", "root", "", "boutique");
                            $requete = "INSERT INTO `categories` (`nom`) VALUES 
                            ('$nom')";
                            $query = mysqli_query($connect,$requete);
                            
                        echo "Catégorie bien ajoutée !";
                        //s'ajoute en deux fois , si ajout header location, bug , car deja use plus haut...//
                            }
             
                            else
                            {
                                
                                echo "empty";
                            }
                                
                                }
                        ?>

                    </form>
            </article>


                      <h2>Catégorie(s) disponible(s) </h2>

                      <?php
             
             


             $i = 0;
             $connect = mysqli_connect("localhost", "root", "", "boutique");
             $select = "SELECT * from categories";
             $query = mysqli_query($connect,$select);
             $result = mysqli_fetch_all($query);
             
             
             ?>
             <table>
                     <tbody>
                         <tr>
                             <th>Nom</th>
                            <!-- <th>Articles dependants</th> -->
                         </tr>
             <?php
            foreach($result as $data)
            {
             
                 ?>
                         <tr>
                            <td><?php echo $data[1] ?></td> 
                            <td><button><a href="modify_cat?id=<?php echo $data[0]; ?>">Modifier</a></button></td>
                            <td><button><a href="confirm_delete_cat?id=<?php echo $data[0]; ?>">Delete</a></button></td>
                         </tr>
            <?php
            }
            $i++
            
            ?>
                     </tbody> 
                 </table>
         
                             </article>
                           </div>


                 <!--   <div class="gestion_sous_cat">
                        <article>

                        <h2>Création de sous-categories</h2>

                        <form action="admin.php" method="POST">
                        <label>Nom : </label>
                        <input type="text" name="nom"/><br>
                  
                        <input type="submit" name="add_sous_cat"/>
                        <?php /*if(isset($_POST['add_sous_cat'])){
        
        $nom= $_POST['nom'];
        
    if($nom != NULL)
    {
         
                    $connect = mysqli_connect("localhost", "root", "", "boutique");
                    $requete = "INSERT INTO `sous_categories` (`nom`) 
                                VALUES ('$nom')"; 
                                
                    $query = mysqli_query($connect,$requete);
                    var_dump($query);
                    
                   echo "Sous-Catégorie bien ajoutée !";
                   //s'ajoute en deux fois , si ajout header location, bug , car deja use plus haut...//
                    }
             
     else
     {
        
        echo "empty";
     }
         
        }
  */      
       
?>
                 </form>

                        </article>
                    
 -->  
                    </section>


        </main>

        <?php require 'include/footer.php'?>

    </body>

</html>

