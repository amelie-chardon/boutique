<?php


class admin extends user{

    public function tableau_utilisateurs()
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
       


    }


}
?>