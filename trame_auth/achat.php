<?php

    require("auth/EtreAuthentifie.php");
    $title = 'Ajouter dans le panier';
    include("header.php");
    if($idm->getRole()=='acheteur'){
        include("navBarBuyer1.php");
    }else{
        include("navBarSeller.php");
    }
    
    $id=$idm->getUid();
    $p=$_GET['p'];
    echo '<text style="color:black;">';
    
    try {
    $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sq="SELECT nom FROM produits WHERE pid=:pid";
    $res=$db->prepare($sq);
    $res->bindParam(':pid', $p);
    $res->execute();
    $db=null;
    $r=$res->fetch(PDO::FETCH_ASSOC);
    $nom=$r['nom'];
    }
catch(PDOException $e){
    exit("Erreur de connexion " .$e->getMessage());
}
    
    if (empty($_POST['achat'])) {
        include('achat_form.php');
        exit();
    }
    
        if($_POST['achat']=='Commandez'){
            
            if(empty($_POST['qte'])){
                echo'Il faut introduire une quantité';
                include 'achat_form.php';
                exit();
            }
            $q= htmlspecialchars($_POST['qte']);
            try {
                $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql="INSERT INTO commande SET pid=?,qte=?, uid=?, date=?, statut=?";
                $stm=$db->prepare($sql);
                $stm->execute(array($p, $q, $id, date("Y-m-d H:i:s"),'en_cours'));

                if(!$stm){
                    echo"<br><h5>Erreur de commande</h5><br>";
                }else{
                    echo"<br><h5>Commande effectuée</h5><br><br>";
                }
                $db=null;
            }
            catch(PDOException $e)
            {
                    exit("Erreur de connexion " .$e->getMessage());
            }
        }else if (($_POST["achat"]=='Annuler')){
            echo"</br> <h5>Commande annulée </h5>";
            echo"</br>";
            echo"</br>"; 
        }
//    }
include('footer.php');            
    ?> 
