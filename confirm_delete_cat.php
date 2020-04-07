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
                
                        <h2>Suppression de produit</h2>
                        

                    <form method="post" action="">
                    <label>Etes vous sûre de vouloir supprimer ce produit de votre BDD ?</label>
                    <input type="submit" name ="suppr_cat" value="Delete"/>
                    
<?php 
                    if(isset($_POST['suppr_cat']))
                        {
                            
                            $connexion = mysqli_connect('Localhost', 'root', '', 'boutique');
                            $id = $_GET['id'];
                            $delete="DELETE FROM categories WHERE categories.id = $id";
                            $query=mysqli_query($connexion,$delete);
                            header('Location:admin.php');
                 
                        }
        
                        ?>
                        </form>
                </article>
                       

                    </section>

                <?php require 'include/footer.php'?>

        </main>


    </body>

</html>

