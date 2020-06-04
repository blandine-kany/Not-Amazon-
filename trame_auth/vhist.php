<?php
require("auth/EtreAuthentifie.php");
require("db_config.php");
include("header.php");
if($idm->getRole()=='acheteur'){
include("navBarBuyer1.php");
}else{
    include("navBarSeller.php");
}

$id=$idm->getUid();

echo '<text style="color:black;">';
if(!isset($id)){
    echo"Erreur";
}else{
    try{
    $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $SQL="SELECT p.nom, p.description, a.qte, p.prix, a.date, a.statut, b.login, c.nom as c, p.ctid FROM commande a  LEFT JOIN  produits p ON p.pid=a.pid LEFT JOIN users b ON b.uid=a.uid LEFT JOIN categories c ON c.ctid=p.ctid WHERE p.uid=:uid "; 
    $res= $db->prepare($SQL);
    $res->bindParam(':uid',$id);
    $res->execute();
    $db=null;
    
    if($res->rowCount()>0){
        echo "<br>";
        echo"<table class='table table-striped table-bordered table-hover'>";
        echo"<th>Nom</th>
            <th>Description</th>
            <th>Acheteur</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Catégorie</th>
            <th>Date</th>
            <th>Status</th>";
        foreach ($res as $row) {
            echo "<tr><td>$row[nom]</td>
			<td>$row[description]</td>
                        <td>$row[login]</td>
                        <td>$row[qte]</td>
                        <td>".$row['prix']*$row['qte'] ."€</td>
                        <td><a href='categorie.php?c=$row[ctid]'>$row[c]</td>
                        <td>$row[date]</td>
                        <td>$row[statut]</td>
                        </tr>";
        }
        echo"</table>";
    }else{
        echo"</br> </br>";
        echo"<h5>Historique de commandes vide</h5>";
        echo"</br> </br>";
    }
}catch(PDOException $e){
    exit("Erreur de connexion" .$e->getMessage());
}
}
include ('footer.php');