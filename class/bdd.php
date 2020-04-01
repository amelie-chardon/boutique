<?php

class bdd{

    protected $connexion = "";
    private $query="";
    private $result=[];
    private $pouik="";


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
    public function pouik($pouik)
    { 
        {
            $this->query=$pouik;
            $execute=mysqli_query($this->connexion, $pouik);

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

} 

?>