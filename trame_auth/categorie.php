<?php
require("auth/EtreAuthentifie.php");

$title = 'Accueil';
include("header.php");
if($idm->getRole()=='acheteur'){
    include("navBarBuyer1.php");
}else{
    include("navBarSeller.php");
}


$c=$_GET['c'];
echo '<text style="color:black;">';
if($idm->getRole()=='acheteur'){
    try {
        $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sq="SELECT nom FROM categories WHERE ctid=:ctid";
        $res=$db->prepare($sq);
        $res->bindParam(':ctid', $c);
        $res->execute();
        $db=null;
        $r=$res->fetch(PDO::FETCH_ASSOC);
        $nom=$r['nom'];
        }
    catch(PDOException $e){
        exit("Erreur de connexion" .$e->getMessage());
    }
    echo"<h3>Catégorie: ". $nom ."</h3>";

    try{
        $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $SQL="SELECT p.nom, p.description,p.qte,p.pid, p.prix,c.login as v, c.uid  FROM produits p LEFT JOIN users c ON p.uid=c.uid WHERE ctid=:ctid AND qte>0";
        $res= $db->prepare($SQL);
        $res->bindParam(':ctid',$c);
        $res->execute();
        $db=null;
        if($res->rowCount()>0){
            echo "<br>";
            echo"<table class='table table-striped table-bordered table-hover'>";
            echo"<th>Vendeur</th>
                <th>Produit</th>
                <th>Description</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th colspan='2'>Action</th>";
            foreach ($res as $row) {
                echo "<tr><td><a href='vendeur.php?v=$row[uid]'>$row[v]</td>"
                . "<td>$row[nom]</td>
                        <td>$row[description]</td>			
                        <td>$row[qte]</td>
                        <td>$row[prix]€</td>
                        <td><a class='btn btn-primary' href='achat.php?p=$row[pid]'>Commandez l'article</a></td>
                        </tr>";
            }
            echo"</table>";
        }else{
            echo"</br> </br>";
            echo"<h5>Pas des produits ".$nom ."</h5>";
            echo"</br> </br>";
        }
    }catch(PDOException $e){
        exit("Erreur de connexion" .$e->getMessage());
    }
}else{
    $id=$idm->getUid();
    try {
        $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sq="SELECT nom FROM categories WHERE ctid=:ctid";
        $res=$db->prepare($sq);
        $res->bindParam(':ctid', $c);
        $res->execute();
        $db=null;
        $r=$res->fetch(PDO::FETCH_ASSOC);
        $nom=$r['nom'];
        }
    catch(PDOException $e){
        exit("Erreur de connexion" .$e->getMessage());
    }
    echo"<h3>Produits de ". $nom ."</h3>";

    try{
        $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $SQL="SELECT p.nom, p.description,p.qte,p.pid, p.prix,c.nom as v, c.uid  FROM produits p LEFT JOIN users c ON p.uid=c.uid WHERE ctid=:ctid AND p.uid=:uid";
        $res= $db->prepare($SQL);
        $res->bindParam(':ctid',$c);
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
                <th colspan='2'>Action</th>";
            foreach ($res as $row) {
                echo "<tr>"
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
            echo"<h5>Vous vendez pas des produits de catégorie: ".$nom ."</h5>";
            echo"</br> </br>";
        }
    }catch(PDOException $e){
        exit("Erreur de connexion" .$e->getMessage());
    }
}

include("footer.php");

?>
<br>

