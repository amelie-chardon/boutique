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
                <option value="mariage" name="mariage">Mariage</option>
                <option value="anniv" name="anniv">Anniversaire</option>
                <option value="autre" name="autre">Autre</option>
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
                    var_dump($requete);
                    
                   echo "Article bien ajouté !";
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

                        <h2>Modération de produit</h2>
    
                <form action="admin.php" method="POST">
                    <label>Nom : </label>
                    <input type="text" name="nom"/><br>
                    <label>Description :</label>
                    <input type="text" name="description"/><br>
                    <label>Stock : </label>
                    <input type="password" name="password" required/><br>
                    <label>Catégorie(s):</label>
                    <select name="select_cat" required>
                <optgroup label="Mariage" value="mariage">
                    <option value="choco" name="choco">Chocolat</option>
                    <option value="fruit" name="fruit">Fruit</option>
                    <option value="les_deux" name="les_deux">Les deux</option><br>
                </optgroup>
                <optgroup label="Anniversaire" value="anniv">
                    <option value="choco" name="choco">Chocolat</option>
                    <option value="fruit" name="fruit">Fruit</option>
                    <option value="les_deux" name="les_deux">Les deux</option><br>
                </optgroup>
                <optgroup label="Autre" value="autre">
                    <option value="choco" name="choco">Chocolat</option>
                    <option value="fruit" name="fruit">Fruit</option>
                    <option value="les_deux" name="les_deux">Les deux</option><br>
                </optgroup>
                    <input type="submit" name="send"/>
                    </form>

                        </article>
                    </div>


                    <div class="gestion_cat">
                        <article>

                        <h2>Création de categories</h2>

                        <form action="admin.php" method="POST">
                        <label>Nom : </label>
                        <input type="text" name="nom"/><br>
                  
                        <input type="submit" name="send"/>
                        </form>

                        </article>


                        <article>

                        <h2>Modération de categories</h2>

                        <form action="admin.php" method="POST">
                        <label>Nom : </label>
                        <input type="text" name="nom"/><br>
                  
                        <input type="submit" name="send"/>
                        </form>

                        </article>
                    </div>

                    <div class="gestion_sous_cat">
                        <article>

                        <h2>Création de sous-categories</h2>

                        <form action="admin.php" method="POST">
                        <label>Nom : </label>
                        <input type="text" name="nom"/><br>
                  
                        <input type="submit" name="send"/>
                        </form>

                        </article>


                        <article>

                        <h2>Modération de sous-categories</h2>

                        <form action="admin.php" method="POST">
                        <label>Nom : </label>
                        <input type="text" name="nom"/><br>


                        <input type="submit" name="send"/>
                        </form>

                        </article>
                    </div>

                    

                    </section>

                <?php require 'include/footer.php'?>

        </main>


    </body>

</html>

