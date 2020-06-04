<?php

    require("auth/EtreAuthentifie.php");
    $title = 'Modification des produits';
    include("header.php");
    if($idm->getRole()=='acheteur'){
        include("navBarBuyer1.php");
    }else{
        include("navBarSeller.php");
    }
    
    $id=$idm->getUid();
    $p=$_GET['p'];
    echo '<text style="color:black;">';
    
     if($idm->getRole()=='vendeur'){
        try {
            $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sq="SELECT nom, description,prix, qte FROM produits WHERE pid=:pid";
            $res=$db->prepare($sq);
            $res->bindParam(':pid', $p);
            $res->execute();

            $r=$res->fetch(PDO::FETCH_ASSOC);
            $nom=$r['nom'];
            $description=$r['description'];
            $prix=$r['prix'];
            $qte=$r['qte'];

            $db=null;

        }
        catch(PDOException $e){
            exit("Erreur de connexion" .$e->getMessage());
        }       

        if (empty($_POST['mod'])) {
            include('mod_form.php');
            exit();
        }
    
        if($_POST['mod']=='Sauvegarder'){
            $description= htmlspecialchars($_POST['description']);
            $nom= htmlspecialchars($_POST['nom']);
            try{
                $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $SQL="UPDATE produits SET nom=?, description=?, qte=?, prix=?, ctid=? WHERE pid=$p";
                $stm= $db->prepare($SQL);
                $res=$stm->execute(array($nom,$description, $_POST['qte'], $_POST['prix'], $_POST['ctid']));

                if($res){
                    echo"</br>";
                    echo"<h5>La modification a été effectuée</h5><br><br>";
                }else{
                    echo"<h5>Erreur de modification</h5>";
                }
                $db=null;

            }
            catch(PDOException $e)
            {
                exit("Erreur de connexion" .$e->getMessage());
            }
        }else if (($_POST["mod"]=='Annuler')){

            echo"</br> <h5>Operation annulée </h5>";
            echo"</br>";
            echo"</br>";

        }
    } else {
        $id=$idm->getUid();
        try{
            $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $SQL="SELECT * FROM panier WHERE userid=:userid";
            $res= $db->prepare($SQL);
            $res->bindParam(':userid',$id);
            $res->execute();

            $row=$res->fetch(PDO::FETCH_ASSOC);
            $qte=$row['qte'];    
        }
        catch(PDOException $e){
        exit("Erreur de connexion" .$e->getMessage());
        }
        
        if (empty($_POST['mod'])) {
            include('mod_form.php');
            exit();
        }
        
        if($_POST['mod']=='Sauvegarder'){
            try{

                $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $SQL="UPDATE panier SET qte=? WHERE prodid=$p";
                $stm= $db->prepare($SQL);
                $res=$stm->execute(array($_POST['qte']));

                if($res){
                    echo"</br>";
                    echo"<h5>La modification a été effectuée</h5><br><br>";
                }else{
                    echo"<h5>Erreur de modification</h5>";
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
                $SQL="UPDATE commande SET qte=?, date=?  WHERE pid=$p AND uid=$id ";
                $stm= $db->prepare($SQL);
                $res=$stm->execute(array($_POST['qte'],date("Y-m-d H:i:s")));

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
        }else if (($_POST["mod"]=='Annuler')){

            echo"</br> <h5>Operation annulée </h5>";
            echo"</br>";
            echo"</br>";
            
        }
}
include('footer.php');            
 ?> 