<?php


function creation_panier(){
    if(!isset($_SESSION['panier'])){
        
        $_SESSION['panier']=array();
        $_SESSION['panier']['id_produits']=array();
        $_SESSION['panier']['id_achats']=array();
        $_SESSION['panier']['quantite']=array();
        $_SESSION['panier']['prix']=array();

    }
    return true;
}

function add_product_panier($id_produit,$id_achats,$quantite,$prix_produit){
    if(creation_panier()){
        
        $position_produit=array_search($id_produit,$_SESSION['panier']['id_produits']);

        if($position_produit!== false){
            $_SESSION['panier']['id_produits'][$position_produit]+= $quantite;
        }
        else {

            array_push($_SESSION['panier']['id_produits'],$id_produit);
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
        $tmp['id_achats']=array();
        $tmp['quantite']=array();
        $tmp['prix']=array();

        for($i; $i<count($_SESSION['panier']['id_produits']); $i++){
            
            if($_SESSION['panier']['id_produits'][$i] !== $id_produit){
            
            array_push($_SESSION['panier']['id_produits'],$_SESSION['panier']['id_produits'][$i]);
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

    for($i; $i<count($_SESSION['panier']['id_produits']); $i++){
        $total+= $_SESSION['panier']['quantite'][$i]*$_SESSION['panier']['prix'];

    }

    return $total;
}

function delete_panier(){
    if(isset($_SESSION['panier'])){

        unset($_SESSION['panier']);
    }
}

?>