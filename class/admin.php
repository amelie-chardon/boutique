<?php


class admin extends user
{
    private $nom = NULL;
    private $descrition = NULL;
    private $prix= NULL;
    private $stock = NULL;
    private $cat = NULL;
    private $sous_cat = NULL;
    

   /* public function tableau_utilisateurs()
    {
        $i = 0;
        $this->connect();
        $request = "SELECT id,login,dateinscrit,role FROM utilisateurs";
        $query = mysqli_query($this->connexion,$request);
        $fetch = mysqli_fetch_all($query);
        ?>
            <table>
                <tbody>
                        <tr>
                        <th>ID</th>    
                        <th>Login</th>
                        <th>Date Inscription</th>
                        <th>Role</th>
                        </tr>
        <?php
       foreach($fetch as list($id,$login,$dateinscrit,$role))
       {
        
            ?>
             
          
                       <td><?php echo  $id; ?></td>
                       <td><?php echo  $login; ?></td> 
                       <td><?php echo  $dateinscrit; ?></td>
                       <td><?php echo  $role;  ?></td>
                       <td><a href="fiche_membre.php?id=<?php echo $id ?>">Profil</</td>
                       
                       
       
                       <tr>
                       <td></td> 
                       <td></td> 
                       <td></td> 
                       <td></td> 
                       <td></td> 
                       </tr> 
          
           
       <?php
       }
       $i++
       ?>
           
           </tbody> 
            </table>
        <?php
    }

    public function all_topic()
    {
        

        $i = 0;
        $this->connect();
        $request = "SELECT * FROM topic RIGHT JOIN utilisateurs ON topic.id_utilisateurs = utilisateurs.id WHERE id ";
        $query = mysqli_query($this->connexion,$request);
        $fetch = mysqli_fetch_all($query);

        //var_dump($fetch);
        ?>
            <table>
                <tbody>
                        <tr>
                        <th>ID</th>    
                        <th>Login</th>  
                        <th>Date</th>
                        <th>Titre</th>
                        <th>Role</th>
                        </tr>
        <?php
       foreach($fetch as list($id,$login,$role,$date,$titre))
       {
        
            ?>
                       <td><?php echo  $id; ?></td>
                       <td><?php echo  $login; ?></td>
                       <td><?php echo  $date; ?></td> 
                       <td><?php echo  $titre; ?></td>
                       <td><?php echo  $role;  ?></td>
                    
                       <tr>
                       <td></td> 
                       <td></td> 
                       <td></td> 
                       <td></td> 
                       <td></td> 
                       </tr> 
          
           
       <?php
       }
       $i++
       ?>
           
           </tbody> 
            </table>
        <?php
    
    }


    public function gestion_grade(){
        $this->connect();
       $this->connect();
        $request = "SELECT * FROM produits";
        $query = mysqli_query($this->connexion,$request);
        $fetch = mysqli_fetch_all($query);



    }*/

    public function ajout_produit($nom,$description,$stock,$prix)
        {
            if($nom != NULL && $description  != NULL && $stock != NULL && $prix != NULL)
            
        

        if(empty($result))
        {
            $this->connect();
            $requete = "INSERT INTO produits (`id`, `nom`, `description`, `prix`, `stock`) VALUES (NULL, $nom, '$description', '$prix', '$stock')";
            $query = mysqli_query($this->connexion,$requete);
            return "ok";
        }
        else{
            return "empty";
        }
    }

    public function recup_info_produit(){

        $i=0;
        $id=$_GET['id'];
        $this->connect();
        $request ="SELECT *
                   FROM produits
                   WHERE id= $id";
        $query = mysqli_query($this->connexion,$request);
        $fetch = mysqli_fetch_all($query);

?>
<table>
                <tbody>
                    <tr>

                        <th>Img</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Note</th>
                        <th>Catégorie</th>
                        <th>Sous Catégorie(s)</th>
                    </tr>
        <?php
       foreach($fetch as $data)
       {
        
            ?>
                    <tr>
                       <td><img src="<?php echo $data[5] ?>"> </td>
                       <td><?php echo $data[1] ?></td> 
                       <td><?php echo $data[2] ?></td>
                       <td><?php echo $data[3] ?></td>
                       <td><?php echo $data[4] ?></td>
                       <td><?php echo $data[6] ?></td>
                       <td><?php echo $data[7] ?></td>
                       <td><?php echo $data[8] ?></td>
           
       <?php
       }
       $i++
       ?>
           
           </tbody> 
            </table>
            
        <?php
    }
         

    
        
}


?>
