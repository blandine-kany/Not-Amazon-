<?php

require("auth/EtreAuthentifie.php");

$title = 'Accueil';
include("header.php");
if($idm->getRole()=='acheteur'){
    include("navBarBuyer1.php");
}else{
    include("navBarSeller.php");
}

echo '<text style="color:black;">';
echo "<b>Bonjour </b> " . $idm->getIdentity()."<b><br/> Votre uid est:</b>". $idm->getUid() ."<b><br/> 
Votre role est: </b>".$idm->getRole();
?>

<?php 

echo '<text style="color:black;">';
echo '<h3>Liste de Produits</h3>';

if($idm->getRole()=='acheteur'){
try{
    $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $SQL="SELECT a.pid,a.nom as p,a.description,a.qte,a.prix, b.login as v, c.nom as c, b.uid, c.ctid FROM produits a LEFT JOIN users b ON a.uid=b.uid LEFT JOIN categories c ON a.ctid=c.ctid WHERE a.qte>0 ORDER BY a.pid";
    $res= $db->prepare($SQL);
    $res->execute();
    $db=null;
    if($res->rowCount()>0){
        echo "<br>";
        echo"<table class='table table-striped table-bordered table-hover'>";
        echo"<th>Produit</th>
            <th>Description</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Vendeur</th>
            <th>Catégorie</th>
            <th>Action</th>";
        foreach ($res as $row) {
            echo "<tr><td>$row[p]</td>
                    <td>$row[description]</td>			
                    <td>$row[qte]</td>
                    <td>$row[prix]€</td>"
                    . "<td><a href='vendeur.php?v=$row[uid]'>$row[v]</td>"
                    . "<td><a href='categorie.php?c=$row[ctid]'>$row[c]</td>"
                    . "<td><a class='btn btn-primary' href='achat.php?p=$row[pid]'>Commandez l'article</a></td></tr>";
        }
        echo"</table>";
    
    }

}
catch(PDOException $e){
    exit("Erreur de connexion" .$e->getMessage());
}
} else {
$id=$idm->getUid();
try{
    $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $SQL="SELECT p.nom, p.description,p.qte,p.pid, p.prix,c.nom as c, c.ctid  FROM produits p LEFT JOIN categories c ON p.ctid=c.ctid WHERE uid=:uid ORDER BY p.ctid";
    $res= $db->prepare($SQL);
    $res->bindParam(':uid',$id);
    $res->execute();
    $db=null;
    if($res->rowCount()>0){
        echo "<br>";
        echo"<table class='table table-striped table-bordered table-hover'>";
        echo"<th>Catégorie</th>
            <th>Produit</th>
            <th>Description</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th colspan='2'>Action</th>";
        foreach ($res as $row) {
            echo "<tr><td><a href='categorie.php?c=$row[ctid]'>$row[c]</td>"
            . "<td>$row[nom]</td>
                    <td>$row[description]</td>			
                    <td>$row[qte]</td>
                    <td>$row[prix]€</td>
                    <td><a class='btn btn-danger' href='supp.php?p=$row[pid]'>Supprimer</a></td>
                    <td><a class='btn btn-info' href='modif.php?p=$row[pid]'>Modifier</a></td>
                    </tr>";
        }
        echo"</table>";
    }else{
        echo"</br> </br>";
        echo"<h5>Pas des produits à vendre</h5>";
        echo"</br> </br>";
    }
    echo"<a class='btn btn-inverse btn-block' href='ajout.php?'>Ajout des produits</a>";
}catch(PDOException $e){
    exit("Erreur de connexion" .$e->getMessage());
}
}

?>
<br>
<br>
<br>

<?php

include("footer.php");

?>
<br>

