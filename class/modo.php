<?php
class modo extends admin{

    public function delete_topic(){
        
    $this->connect();
    $request = "DELETE * FROM topic WHERE id_topic= id ";
    $query = mysqli_query($this->connexion,$request);
    $fetch = mysqli_fetch_all($query);
    }
}
?>