<?php

class user extends bdd{

    private $id = NULL;
    private $login = NULL;
    private $role = NULL;
    private $mail = NULL;


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
                $mdp = password_hash($mdp, PASSWORD_BCRYPT, array('cost' => 12));
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
                        <th>Panier</th>
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
                        <td><form class="formulaire" method="get" action="" id="comment"><button type="submit" id="submit" name="achats" value="<?php echo $id; ?>">Laisser un avis</button></form></td>
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
        $fetch=$this->execute("SELECT produits.id,produits.nom, panier.quantite,produits.prix, produits.image, achats.prix FROM panier RIGHT JOIN produits ON panier.id_produits=produits.id RIGHT JOIN achats ON achats.id_panier=panier.id_achats WHERE id_achats=$id_achats");

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
       foreach($fetch as list($id_produit,$nom,$quantite,$prix_u,$image,$prix_total))
       {
            ?>
                    <tr>
                        <td><?php echo $nom; ?></td>
                        <td><?php echo $prix_u; ?>€</td>
                        <td><?php echo $quantite ?></td>
                        <td><?php echo $prix_u*$quantite; ?>€</td>
                        <td><form class="formulaire" method="get" action="" id="comment"><button type="submit" id="submit" name="id_produit" value="<?php echo $id_produit ; ?>">Laisser un avis</button></form></td>
                    </tr>
            <?php
       }
            ?>
                </tbody> 
            </table>
    <?php
    }


//Fonctions GET

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