<?php 

    require("auth/EtreAuthentifie.php");
    $title = 'Suppression des produits';
    include("header.php");
    if($idm->getRole()=='acheteur'){
        include("navBarBuyer1.php");
    }else{
        include("navBarSeller.php");
    }
    $id=$idm->getUid();
    $p=$_GET['p'];
    echo '<text style="color:black;">';
    if (empty($_POST['supp'])) {
        include('supp_form.php');
        exit();
    }


if($idm->getRole()=='vendeur'){
    if($_POST["supp"]=='Supprimer'){

        try {
            $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $SQL="DELETE FROM produits WHERE pid=$p";
            $res= $db->prepare($SQL);
            $res->execute(array($p));
            $db=null;

            echo"</br> <h5>Supression effectuée </h5> </br>";
        }  
        catch(PDOException $e){
                exit("Erreur de connexion" .$e->getMessage());
        }
    }else if (($_POST["supp"]=='Annuler')){

        echo"</br> <h5>Operation annulée </h5>";
        echo"</br>";
        echo"</br>";
      
    }
}else{
    $id=$idm->getUid();
    if($_POST["supp"]=='Supprimer'){
        try{
            $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $SQL="DELETE FROM panier WHERE userid=:userid and prodid=:prodid";
            $res= $db->prepare($SQL);
            $res->bindParam(':userid',$id);
            $res->bindParam(':prodid',$p);
            $res->execute();   
            $db=null;
            echo"</br> <h5>Supression effectuée </h5> </br>";
        }
        catch(PDOException $e){
        exit("Erreur de connexion" .$e->getMessage());
        }
        
        try{
            $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $SQL="DELETE FROM commande WHERE pid=$p AND uid=$id";
            $res= $db->prepare($SQL);
            $res->execute();
                if($res){
                    echo"</br>";
                    
                }else{
                    echo"<h5>Erreur de modification</h5>";
                }
                $db=null;
//                echo"<a class='btn' href='comm.php?'>Revenir à votre panier</a>";
            }
            catch(PDOException $e)
            {
                exit("Erreur de connexion" .$e->getMessage());
            }
            
    }else if (($_POST["supp"]=='Annuler')){

        echo"</br> <h5>Operation annulée </h5>";
        echo"</br>";
        echo"</br>";
    }
    
    
}

    include('footer.php');
                ?> 