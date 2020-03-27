<?php

class bdd{

    protected $connexion = "";
    private $query="";
    private $result=[];


public function connect()
    {
        $connect = mysqli_connect('localhost', 'root', '','boutique');
        //var_dump($connect);
        if($connect == false)
        {
            return false;
        }
        $this->connexion = $connect;
    }


    public function close(){
        mysqli_close($this->connexion);
    }


    public function execute($query)
    { 
        {
            $this->query=$query;
            $execute=mysqli_query($this->connexion, $query);

            // Si le résultat est un booléen 
            if(is_bool($execute))
            {
                $this->result=$execute;
            }
            // Si le résultat est un tableau
            else
            {
                $this->result=mysqli_fetch_all($execute);
            }

            return $this->result;
        }
    }

    public function info_produits($id_produits){
    $this->connect();
    $result=$this->execute("SELECT nom, image FROM produits WHERE id=$id_produits");
    $nom=$result[0][0];
    $image=$result[0][1];

    return ["nom"=>$nom,"image"=>$image];
}

}

?>