<?php

    require("auth/EtreAuthentifie.php");
    $title = 'Ajout des produits';
    include("header.php");
    if($idm->getRole()=='acheteur'){
        include("navBarBuyer1.php");
    }else{
        include("navBarSeller.php");
    }
    
    $id=$idm->getUid();
    echo '<text style="color:black;">';
    
    if (empty($_POST['aj'])) {
        include('aj_form.php');
        exit();
    }
   
        if($_POST['aj']=='Sauvegarder'){
            try {
                $description= htmlspecialchars($_POST['description']);
                $nom= htmlspecialchars($_POST['nom']);
                
                $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql="INSERT INTO produits SET nom=?, description=?, qte=?, prix=?, ctid=?, uid=?";
                $stm=$db->prepare($sql);
                $stm->execute(array($nom,$description, $_POST['qte'], $_POST['prix'], $_POST['ctid'], $id));

                if(!$stm){
                    echo"<br><h5>Erreur d'ajout</h5><br>";
                }else{
                    echo"<br><h5>L'ajout a été effectué</h5><br><br>";
                }
                $db=null;
            }
            catch(PDOException $e)
            {
                    exit("Erreur de connexion" .$e->getMessage());
            }
        }else if (($_POST["aj"]=='Annuler')){
            echo"</br> <h5>Operation annulée </h5>";
            echo"</br>";
            echo"</br>"; 
        }
//    }
include('footer.php');            
    ?> 
