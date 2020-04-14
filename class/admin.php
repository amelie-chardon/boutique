<?php


class admin extends user
{
    private $nom = NULL;
    private $descrition = NULL;
    private $prix= NULL;
    private $stock = NULL;
    private $cat = NULL;
    private $sous_cat = NULL;
    


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
