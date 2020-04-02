<header>
    <div id="menu">
        <?php require 'include/nav.php'?>
    </div>
        
    <div id="banner">
        <img id="logo-top" src="img/logo.png">
        <h1>Amélie & Sarah</h1>
    </div>
    <div id="search">

    </div>
    <div id="menu2">
        <?php require 'include/nav2.php'?>
       
        <form method="GET" action="resultat_recherche.php">
            <input type="text" name="search" placeholder="Search">
            <input type="submit" value="Chercher">
        </form>
    </div>
</header>