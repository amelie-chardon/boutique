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
                
                        
                        <?php 
                        if ($_GET['id']==true){
                         
                            $id= $_GET['id'];
                            $connect = mysqli_connect('localhost', 'root', '','boutique');
                            $select="SELECT *
                                     FROM categories
                                     WHERE id=$id";
                            $query= mysqli_query($connect,$select);
                            $data= mysqli_fetch_assoc($query);

                         ?>   
                       
    
                       <article>

                       <h2>Modération de categories</h2>

                    <form action="" method="POST">
                    <label>Nom : </label>
                    <input type="text" name="nom"/><br>

                    <input type="submit" name="send"/>
                    </form>

                    
                    <?php
                        }
                        else{
                            header('Location:admin.php');
                        }?>
                        
                       <?php if(isset($_POST['send'])){
        
        
        
        $nom= $_POST['nom'];
        
        $id=$_GET['id'];
        $connexion = mysqli_connect('Localhost', 'root', '', 'boutique');
        $update ="UPDATE `categories` 
                  SET `nom` = '".$_POST['nom']."' 
                  WHERE categories.id = $id";

        $query= mysqli_query($connexion,$update);

        header ("location:modify_cat?id=". $_GET["id"]);
        
}
                      
?>

                    </form>

</article>

                    </section>

                <?php require 'include/footer.php'?>

        </main>


    </body>

</html>

