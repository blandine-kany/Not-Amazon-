<?php

$p=$_GET['p'];
$co=$_GET['co'];
try{

    $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $SQL="SELECT qte FROM commande WHERE cmdid=$co AND statut='acceptee' AND pid=$p";
    $res= $db->prepare($SQL);
    $res->execute();
   
    $row=$res->fetch(PDO::FETCH_ASSOC);
    $qt=$row['qte'];
    
    if($res){
        echo"</br>";
    }else{
        echo"<h5>Erreur d'operation</h5>";
    }
    $db=null;

}
catch(PDOException $e)
{
    exit("Erreur de connexion" .$e->getMessage());
}

try{

    $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $SQL="SELECT qte FROM produits WHERE pid=$p";
    $res= $db->prepare($SQL);
    $res->execute();
    
    $row=$res->fetch(PDO::FETCH_ASSOC);
    $q=$row['qte'];

    if($res){
        echo"</br>";
    }else{
        echo"<h5>22: Erreur d'operation</h5>";
    }
    $db=null;

}
catch(PDOException $e)
{
    exit("Erreur de connexion" .$e->getMessage());
}

$qte=$q-$qt;

if($qte<0){
    echo"<h5>La quantité demandée n'est pas possible</h5>";
    try{

        $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $SQL="UPDATE commande SET statut=?, date=?  WHERE cmdid=$co ";
        $stm= $db->prepare($SQL);
        $res=$stm->execute(array('refusee',date("Y-m-d H:i:s")));

        if($res){
            echo"</br>";
        }else{
            echo"<h5>Erreur d'operation</h5>";
        }
        $db=null;

    }
    catch(PDOException $e)
    {
        exit("Erreur de connexion" .$e->getMessage());
    }
    exit();
}else{

try{

    $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $SQL="UPDATE produits SET qte=? WHERE pid=$p";
    $stm= $db->prepare($SQL);
    $res=$stm->execute(array($qte));

    if($res){
        echo"</br>";
        echo"<h5>Produit mis à jour</h5><br><br>";
    }else{
        echo"<h5>Erreur de modification</h5>";
    }
    $db=null;

}
catch(PDOException $e)
{
    exit("Erreur de connexion" .$e->getMessage());
}
}
?>