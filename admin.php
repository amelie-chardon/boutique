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
        <title>Admin</title> 
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
</head>

    <body>
        <main>

            <?php require 'include/header.php'?>

            
                <h1>Administration</h1>

                    <section class="panneau">
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
                   
                   
                   
                    
                    <label>Catégorie(s) : </label>
                    <select name="categorie" required>
                <option value="Mariage" name="Mariage">Mariage</option>
                <option value="Anniv" name="Anniv">Anniversaire</option>
                <option value="Autre" name="Autre">Autre</option>
                    </select></br>
                    <label>Sous-Catégorie(s) : </label>
                    <select name="sous_categorie" required>
                <option value="Chocolat" name="ch">Chocolat</option>
                <option value="Fruit" name="fr">Fruit</option>
                <option value="Les_deux" name="les_2">Les deux</option>
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
                    $requete = "INSERT INTO `produits` (`nom`, `description`, `prix`, `stock`, `categorie`, `sous_cat`) VALUES 
                    ('$nom', '$description', '$prix', '$stock','$categorie','$sous_categorie')";
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

                        <h2>Produit en Vente</h2>
            <?php
             

        $i = 0;
        $connect = mysqli_connect("localhost", "root", "", "boutique");
        $select = "SELECT * from produits";
        $query = mysqli_query($connect,$select);
        $result = mysqli_fetch_all($query);
        
        
        
        ?>
        <table>
                <tbody>
                    <tr>
                        <th>Img</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Stock</th>
                       
                        <th>Catégorie</th>
                        <th>Sous Catégorie(s)</th>
                    </tr>
        <?php
       foreach($result as $data)
       {
        
            ?>
                    <tr>
                       <td><?php echo $data[5] ?></td>
                       <td><?php echo $data[1] ?></td> 
                       <td><?php echo $data[2] ?></td>
                       <td><?php echo $data[3] ?></td>
                       <td><?php echo $data[4] ?></td>
                       <td><?php echo $data[6] ?></td>
                       <td><?php echo $data[7] ?></td>
                       
                       <td><button><a href="modify_product?id=<?php echo $data[0]; ?>">Modifier</a></button></td>
                       <td><button><a href="confirm_delete?id=<?php echo $data[0]; ?>">Delete</a></button></td>
                    </tr>
       <?php
       }
       $i++
       
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


                      <h2>Catégorie(s) Disponible </h2>

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

                <?php require 'include/footer.php'?>

        </main>


    </body>

</html>

