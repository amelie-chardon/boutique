<?php

/*
class panier extends user{

    
    private $prix=0;
    */

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
        if(creation_panier()){
            if($id_produit==false){

            $position_produit=array_search($id_produit,$_SESSION['panier']['id_produits']);
            if($position_produit!== false){
                //$position_produit-1 car produits.id commence à 1 mais l'indice des array commence à 0
                $_SESSION['panier']['id_produits'][$position_produit-1]+= $quantite;
            }
        }
            else {
                $_SESSION["bdd"]->connect();
                //$requete=$_SESSION["bdd"]->execute("SELECT nom FROM produits WHERE id=$id_produit");
                //$nom=$requete[0][0];

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
        if(creation_panier()){
            //si la quantité d'un article dans le panier est sup à 0 
            if($quantite>0){
                //recherche la position du produit dans le panier
                $position_produit=array_search($_SESSION['panier']['id_produits'],$id_produit);
                //si il le trouve la position
                if($position_produit!==false){
                    //
                    $i=0;
                    $_SESSION['panier']['id_produits'][$position_produit]=$quantite;
                }
            }
            //quantité d'article inferieur à 0 d'un article
            else{
            delete_product_panier($id_produit);
            }
        }
        else{
            echo 'erreur';
        }

    }

    function delete_product_panier($id_produit){ 
        if(creation_panier()){
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
        $i=0;
        $nb_produit=$_SESSION["user"]->compter_produit();
        for($i=0; $i<$nb_produit; $i++){
            $total+= intval($_SESSION['panier']['quantite'][$i])*intval($_SESSION['panier']['prix'][$i]);
        }
        return $total;
    }

    function delete_panier(){
        if(isset($_SESSION['panier'])){

            unset($_SESSION['panier']);
        }
    }

/* } */

?>