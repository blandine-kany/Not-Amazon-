<?php

require("auth/EtreAuthentifie.php");

$title = 'Accueil';
include("header.php");
if($idm->getRole()=='acheteur'){
    include("navBarBuyer1.php");
}else{
    include("navBarSeller.php");
}

$id=$idm->getUid();
echo '<text style="color:black;">';

try{
    $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $SQL="SELECT p.nom, p.pid, p.description, a.qte, p.prix, a.date, a.statut, b.login, b.uid, c.nom as c, p.ctid, a.cmdid FROM commande a  LEFT JOIN  produits p ON p.pid=a.pid LEFT JOIN users b ON b.uid=a.uid LEFT JOIN categories c ON c.ctid=p.ctid WHERE p.uid=:uid AND a.statut='en_cours' "; 
    $res= $db->prepare($SQL);
    $res->bindParam(':uid',$id);
    $res->execute();
    $db=null;
    if($res->rowCount()>0){
        echo "<br>";
        echo"<table class='table table-striped table-bordered table-hover'>";
        echo"<th>Produit</th>
            <th>Description</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Catégorie</th>
            <th>Acheteur</th>
            <th colspan='2'>Action</th>";
        foreach ($res as $row) {
            echo "<tr><td>$row[nom]</td>
                    <td>$row[description]</td>			
                    <td>$row[qte]</td>
                    <td>".$row['prix']*$row['qte']."€</td>"
                    . "<td><a href='categorie.php?c=$row[ctid]'>$row[c]</td>"
                    . "<td>$row[login]</td>" 
                    . "<td><a class='btn btn-primary' href='accep.php?co=$row[cmdid]&a=$row[uid]&p=$row[pid]'>Accepter</a></td>"
                    . "<td><a class='btn btn-danger' href='ref.php?co=$row[cmdid]&a=$row[uid]&p=$row[pid]'>Refuser</a></td>";
        }
        echo"</table>";
    
    }else{
        echo"</br>";
        echo"<h5>Pas de commandes</h5><br><br>";
    }

}
catch(PDOException $e){
    exit("Erreur de connexion" .$e->getMessage());
}

include("footer.php");

?>
<br>

