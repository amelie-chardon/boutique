<?php

class user extends bdd{

    private $id = NULL;
    private $login = NULL;
    private $role = NULL;
    private $mail = NULL;
    private $nom = NULL;
    private $prix_produit = NULL;
    private $quantite = NULL;
    

//Fonctions inscription/connexion/déconnexion/désinscription/est connecté

    public function inscription($login,$mdp,$confmdp,$mail){
        if($login != NULL && $mdp != NULL && $confmdp != NULL && $mail != NULL){
            if($mdp == $confmdp){
                if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $mail)){
                    
                
                $this->connect();
                $requete = "SELECT login,mail FROM utilisateurs WHERE login = '$login' OR mail = '$mail'";
                $query = mysqli_query($this->connexion,$requete);
                $result = mysqli_fetch_all($query);

                if(empty($result)){
                    $mdp = password_hash($mdp, PASSWORD_BCRYPT, array('cost' => 5));
                    $requete = "INSERT INTO `utilisateurs`(`login`, `mdp`, `mail`, `role`) VALUES ('$login','$mdp','$mail','membre')";
                    $query = mysqli_query($this->connexion,$requete);
                    return "ok";
                }
                
                else{
                    return "log"; 
                }
            }
            else{ 
                return "mail";
            }
        }
            else{
                return "mdp";
            }
        }
        else{
            return "empty";
        }
    }

public function connexion($login,$mdp){
        $this->connect();
        $requete = "SELECT * FROM utilisateurs WHERE login = '$login'";
        $query = mysqli_query($this->connexion,$requete);
        $result = mysqli_fetch_assoc($query);
        if(!empty($result)){
            if($login == $result["login"]){
                if(password_verify($mdp,$result["mdp"])){
                    $this->id = $result["id"];
                    $this->login = $result["login"];
                    $this->role = $result["role"];
                    $this->mail = $result["mail"];
                    return [$this->id,$this->login,$this->role,$this->mail];
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }



    public function disconnect(){
        $this->id = NULL;
        $this->login = NULL;
        $this->mail = NULL;
        $this->role = NULL;
    }

    public function isConnected(){
        if ($this->id != null) {
            return true;
        } else {
            return false;
        }
    }

//Fonctions profil

public function profil($confmdp,$login = "",$mail= "",$mdp = ""){
    $this->connect();
    $request = "SELECT mdp FROM utilisateurs WHERE id = $this->id";
    $query = mysqli_query($this->connexion,$request);
    $fetchmdp = mysqli_fetch_assoc($query);
        if(password_verify($confmdp,$fetchmdp["mdp"])){
            if($login != NULL){
                $result=$this->execute("SELECT login FROM utilisateurs WHERE login = \"$login\"");
                if(empty($result)){
                    $this->login = $login;
                }
                else{
                    return false;
                }
            }
            if($mail != NULL){
                $result=$this->execute("SELECT mail FROM utilisateurs WHERE mail =\"$mail\"");
                if(empty($result)){
                    $this->mail = $mail;
                }
                else{
                    return false;
                }
            }
            if($mdp != NULL)
            {
                $mdp = password_hash($mdp, PASSWORD_BCRYPT, array('cost' => 5));
                $request = "UPDATE utilisateurs SET mdp = \"$mdp\" WHERE id = $this->id";
                $query = mysqli_query($this->connexion,$request);
            }
            $request = "UPDATE utilisateurs SET login = \"$this->login\", mail =\"$this->mail\" WHERE id =$this->id";
            $query = mysqli_query($this->connexion,$request);
        }
        
        else{
            return false;
        }
    }


    public function mes_info()
    {   
        $this->connect();
        $fetch=$this->execute("SELECT login,mail FROM utilisateurs WHERE id = $this->id");

        ?>
            <table>
                <tbody>
                    <tr>
                        <th>Login</th>
                        <th>Mail</th>
                    </tr>
        <?php
       foreach($fetch as list($login,$mail))
       {
        
            ?>
                    <tr>
                       <td><?php echo $login; ?></td> 
                       <td><?php echo $mail; ?></td>
                    </tr>
       <?php
       }
       ?>
                </tbody> 
            </table>
        <?php
    }

    public function desinscription()
    {
        $this->connect();
        $id = $_SESSION["user"]->getid();
        $desinscription="DELETE FROM utilisateurs WHERE id = $id";
        $query_desinsc=mysqli_query($this->connexion,$desinscription);
                session_unset();
                session_destroy();
                header ('location:index.php');
    }


    public function mes_achats(){

        $this->connect();
        $fetch=$this->execute("SELECT achats.id, DATE_FORMAT(achats.date_achat, \"%d/%m/%Y\"), achats.prix FROM achats RIGHT JOIN utilisateurs ON achats.id_utilisateurs = utilisateurs.id WHERE utilisateurs.id = $this->id");
        //S'il n'y a pas d'achat
        if ($fetch[0][0]==null)
        {
            echo "Aucun achat pour le moment.";
        }
        else
        {
        ?>
            <table class="actions">
                <tbody>
                    <tr>
                        <th>Date d'achat</th>
                        <th>Montant</th>
                        <th></th>
                    </tr>
        <?php
       foreach($fetch as list($id,$date_achat,$prix))
       {
        
            ?>
                    <tr>
                        <td><?php echo $date_achat; ?></td>
                        <td><?php echo $prix; ?>€</td>
                        <td><form class="formulaire" method="get" action="voir-commande.php" id="panier"><button type="submit" id="submit" name="id_achats" value="<?php echo $id; ?>">Voir ma commande</button></form></td>
                    </tr>
       <?php
       }
       ?>
                </tbody> 
            </table>
        <?php
        }
    }

    public function mon_panier_achats(){
        $id_achats=$_GET["id_achats"];

        $this->connect();
        $fetch=$this->execute("SELECT achats.id_utilisateurs, produits.id,produits.nom, panier.quantite,produits.prix, produits.image, achats.prix FROM panier RIGHT JOIN produits ON panier.id_produits=produits.id RIGHT JOIN achats ON achats.id=panier.id_achats WHERE id_achats=$id_achats");
        //On vérifie que la commande correspond à l'utilisateur connecté
        $id_utilisateur=$this->getid();
        if($fetch[0][0]!==$id_utilisateur)
        {
            header("location:index.php");
        }
        else
        {
        ?>
            <table class="actions">
                <tbody>
                    <tr>
                        <th>Nom</th>
                        <th>Prix à l'unité</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
        <?php
       foreach($fetch as list($id_utilisateur,$id_produit,$nom,$quantite,$prix_u,$image,$prix_total))
       {
            ?>
                    <tr>
                        <td class="bloc_table"><?php echo $nom; ?><img class="produit_img_table" src="<?php echo $image; ?>"></td>
                        <td><?php echo $prix_u; ?>€</td>
                        <td><?php echo $quantite ?></td>
                        <td><?php echo $prix_u*$quantite; ?>€</td>
                        <td><form class="formulaire" method="get" action="laisser-avis.php" id="comment"><button type="submit" id="submit" name="id_produits" value="<?php echo $id_produit ; ?>">Laisser un avis</button></form></td>
                    </tr>
            <?php
       }
            ?>
                    <tr>
                        <td class="prix_tot" colspan="3">Montant total :</td>
                        <td class="prix_tot"><?php echo $prix_u*$quantite; ?>€</td>
                        <td></td>
                    </tr>
                </tbody> 
            </table>
        <?php
        }
}

    public function avis_produits($commentaire,$note){
        $id_produits=$_GET["id_produits"];
        $id_utilisateurs=$this->id;
        if($commentaire!=NULL && $note!=NULL)
        {
            $this->connect();
            $requete=$this->execute("INSERT INTO avis (id_produits, id_utilisateurs, note, commentaire) VALUES (\"$id_produits\",\"$id_utilisateurs\",\"$note\",\"$commentaire\")");
            $requete2=$this->execute("UPDATE produits AS target 
            INNER JOIN (select avis.id_produits,ROUND(AVG(avis.note),1) AS Notemoy FROM avis GROUP BY avis.id_produits) as source
            ON target.id = source.id_produits
            SET target.note = source.Notemoy WHERE target.id=$id_produits");
            if($requete==true)
            {
                return "ok";
            }
            else
            {
                return false;
            }
        }
        else 
        {
            return "empty";
        }
    }


    public function recup_image_produit(){

        
        $this->connect();
        $request ="SELECT image
                   FROM produits
                   WHERE id= '" . $_GET['id'] . "'";
        $query = mysqli_query($this->connexion,$request);
        $result = mysqli_fetch_assoc($query);

         if($result == true)
         {
            ?>
            <img src="img/profil/<?php echo $_GET['id']?>.jpg" />
            <?php
         }
    }


//PANIER FUNCTION

function creation_panier(){
    if(!isset($_SESSION['panier'])){
        
        $_SESSION['panier']=array();
        $_SESSION['panier']['id_produits']=array();
        $_SESSION['panier']['nom']=array();
        $_SESSION['panier']['quantite']=array();
        $_SESSION['panier']['prix']=array();
    }
    return true;
}

function add_product_panier($id_produit,$nom,$quantite,$prix_produit){
    if($this->creation_panier()){
                $position_produit=array_search($id_produit,$_SESSION['panier']['id_produits']);
        if($position_produit!== false){
            //$position_produit-1 car produits.id commence à 1 mais l'indice des array commence à 0
            $_SESSION['panier']['quantite'][$position_produit]= $quantite;
        }
    
        else {
            $_SESSION["bdd"]->connect();

            array_push($_SESSION['panier']['id_produits'],$id_produit);
            array_push($_SESSION['panier']['nom'],$nom);
            array_push($_SESSION['panier']['quantite'],$quantite);
            array_push($_SESSION['panier']['prix'],$prix_produit);
        }
    }
    //si pas de panier mais add product , erreur
    else {

        echo 'erreur panier non existant';
    }
}

function modify_quantity_product($id_produit,$quantite){
    if($this->creation_panier()==true){
        //Si la valeur est un entier
        if(is_int($quantite))
        {
            //Si la quantite choisie est disponible (en stock)
            $stock=$this->stock($id_produit);
            if($quantite <= $stock)
            {
                //si la quantité d'un article dans le panier est sup à 0 
                if($quantite>0)
                {
                    //recherche la position du produit dans le panier
                    $position_produit=array_search($id_produit,$_SESSION['panier']['id_produits']);
                    //si il le trouve la position
                    if($position_produit!==false){
                        $_SESSION['panier']['quantite'][$position_produit]=strval(intval($quantite));
                        header('location:panier.php');
                    }
                }
                //quantité d'article inferieur à 0 d'un article
                else
                {
                    $this->delete_product_panier($id_produit);
                   header('location:panier.php');
                }
            }
            else 
            {
                echo "stock indisponible";
            }
        }
        else{
            echo 'erreur';
        }
    }

}

function delete_product_panier($id_produit){ 
    if($this->creation_panier()){
        //création de tableau temporaire
        $i=0;
        $tmp =array();
        $tmp['id_produits']=array();
        $tmp['nom']=array();
        $tmp['quantite']=array();
        $tmp['prix']=array();

        for($i; $i<count($_SESSION['panier']['id_produits']); $i++){
            
            if($_SESSION['panier']['id_produits'][$i] !== $id_produit){
            
            array_push($_SESSION['panier']['id_produits'],$_SESSION['panier']['id_produits'][$i]);
            array_push($_SESSION['panier']['nom'],$_SESSION['panier']['nom'][$i]);
            array_push($_SESSION['panier']['quantite'],$_SESSION['panier']['quantite'][$i]);
            array_push($_SESSION['panier']['prix'],$_SESSION['panier']['prix'][$i]);
            }

        }
        //regrouper les info du produit
        $_SESSION['panier']=$tmp;
        //se debarasser de l'info
        unset($tmp);
    }

    else{
        echo 'error';
    }
}

function compter_produit(){
    if(isset($_SESSION['panier'])){
        return count($_SESSION['panier']['id_produits']);
    }
    else{
        return 0;
    }
}

function calcul_montant_panier(){

    $total = 0;
    $nb_produit=$_SESSION["user"]->compter_produit();
    for($i=0; $i<$nb_produit; $i++){
        $total+= intval($_SESSION['panier']['quantite'][$i])*intval($_SESSION['panier']['prix'][$i]);
    }
    return $total;
}


function delete_panier(){
    if(isset($_SESSION['panier'])){
        unset($_SESSION['panier']);
        //header('location:index.php');
        
    }
}

function pop_list_cat(){
    $_SESSION["bdd"]->connect();
        $i=0;
        $result=$_SESSION["bdd"]->execute("SELECT id , nom
                                           FROM categories
                                           ");
                                           
                                           
                                           
        ?>

                    <label>Catégorie(s) : </label>
                    <select name="cat">
                       
                       <?php
                       foreach($result as list($id,$nom)) {
                        ?>

                        <option value="<?php echo $id ?>"><?php echo $nom ?></option>

                        <?php
                        
                       }
                       $i++
                       
                       ?>

                    </select></br>
   
                    <?php
}

function pop_list_sous_cat(){
    $_SESSION["bdd"]->connect();
    $i=0;
    $result=$_SESSION["bdd"]->execute("SELECT id , nom
                                       FROM sous_categories
                                       ");
                                       
                                       
    ?>

                <label>Sous-Catégorie(s) : </label>
                <select name="sous_categorie">
                   
                <?php
                   foreach($result as list($id,$nom)) {
                    ?>

                    <option value="<?php echo $id ?>"><?php echo $nom ?></option>

                    <?php
                    
                   }
                   $i++
                   
                   ?>


                    
                </select></br>
                <?php
}

function quantite(){
    $_SESSION["bdd"]->connect();
    $i=0;
    $result=$_SESSION["bdd"]->execute("SELECT stock
                                       FROM produits
                                       ");
                                       
                                       
    ?>

                <label>Sous-Catégorie(s) : </label>
                <select name="sous_categorie">
                   
                <?php
                   while($i<$result) {
                    ?>

                    <option value="<?php echo $i++ ?>"><?php echo $i++ ?></option>

                    <?php
                    
                   }
                   
                   
                   ?>


                    
                </select></br>
                <?php
}




//Fonctions GET
    public function getidproduit(){
        return $this->id;
    }

    public function getnomproduit(){
        return $this->nom;
    }

    public function getprix(){
        return $this->prix;
    }

    public function getstock(){
        return $this->quantite;
    }





    public function getid(){
        return $this->id;
    }

    public function getlogin(){
        return $this->login;
    }

    public function getmail(){
        return $this->mail;
    }

    public function getrole(){
        return $this->role;
    }
    

}
?>