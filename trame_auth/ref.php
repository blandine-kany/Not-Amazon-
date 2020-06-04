<?php

    require("auth/EtreAuthentifie.php");
    include("header.php");
    if($idm->getRole()=='acheteur'){
        include("navBarBuyer1.php");
    }else{
        include("navBarSeller.php");
    }
    
    $co=$_GET['co'];
    echo '<text style="color:black;">'; 

        if (empty($_POST['re'])) {
            include('ref_form.php');
            exit();
        }
    
        if($_POST['re']=='Oui'){
            try{

                $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $SQL="UPDATE commande SET statut=?, date=?  WHERE cmdid=$co ";
                $stm= $db->prepare($SQL);
                $res=$stm->execute(array('refusee',date("Y-m-d H:i:s")));

                if($res){
                    echo"</br>";
                    echo"<h5>Operation effectuée</h5><br>";
                    echo"<h5>L'acheteur est notifié </h5>";
                }else{
                    echo"<h5>Erreur d'operation</h5>";
                }
                $db=null;

            }
            catch(PDOException $e)
            {
                exit("Erreur de connexion" .$e->getMessage());
            }
            
            
        }else if (($_POST["re"]=='Non')){

            echo"</br> <h5>Operation annulée </h5>";
            echo"</br>";
            echo"</br>";

        }
include('footer.php');            
 ?> 