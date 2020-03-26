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
                    <input type="text" name="text" required/><br>
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

