<?php
require("auth/EtreAuthentifie.php");


include("header.php");
include("navBarBuyer1.php");
$v=$_GET['v'];
echo '<text style="color:black;">';

try {
    $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sq="SELECT login FROM users WHERE uid=:uid";
    $res=$db->prepare($sq);
    $res->bindParam(':uid', $v);
    $res->execute();
    $db=null;
    $r=$res->fetch(PDO::FETCH_ASSOC);
    $nom=$r['login'];
    }
catch(PDOException $e){
    exit("Erreur de connexion" .$e->getMessage());
}
echo"<h3>Produits de ". $nom ."</h3>";

try{
    $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $SQL="SELECT p.nom, p.description,p.qte,p.pid, p.prix,c.nom as c, c.ctid  FROM produits p LEFT JOIN categories c ON p.ctid=c.ctid WHERE uid=:uid AND qte>0 ORDER BY p.ctid";
    $res= $db->prepare($SQL);
    $res->bindParam(':uid',$v);
    $res->execute();
    $db=null;
    if($res->rowCount()>0){
        echo "<br>";
        echo"<table class='table table-striped table-bordered table-hover'>";
        echo"<th>Catégorie</th>
            <th>Nom</th>
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
                    <td><a class='btn btn-primary' href='achat.php?p=$row[pid]'>Commandez l'article</a></td>
                    </tr>";
        }
        echo"</table>";
    }else{
        echo"</br> </br>";
        echo"<h5>Pas des produits à vendre</h5>";
        echo"</br> </br>";
    }
}catch(PDOException $e){
    exit("Erreur de connexion" .$e->getMessage());
}

include("footer.php");

?>
<br>

