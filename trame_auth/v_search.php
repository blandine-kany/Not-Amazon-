<?php

require("auth/EtreAuthentifie.php");

$title = 'Recherche';
include("header.php");
if($idm->getRole()=='acheteur'){
    include("navBarBuyer1.php");
}else{
    include("navBarSeller.php");
}


echo '<text style="color:black;">';
if(isset($_POST['search'])){
    $id=$idm->getUid();
    $search= htmlspecialchars(strip_tags($_POST['search']));

    try{
        $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="(SELECT a.pid, a.nom, a.prix, a.description, a.qte, b.login as v, c.nom as c, b.uid, c.ctid FROM produits a LEFT JOIN users b ON a.uid=b.uid LEFT JOIN categories c ON a.ctid=c.ctid WHERE a.nom LIKE '$search' AND b.uid=$id)";
        $res= $db->prepare($sql);
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
                <th colspan='2'>Action</th>";
            foreach ($res as $row) {
                echo "<tr><td>$row[nom]</td>
                        <td>$row[description]</td>			
                        <td>$row[qte]</td>
                        <td>$row[prix]€</td>"
                        . "<td><a href='categorie.php?c=$row[ctid]'>$row[c]</td>"
                        ."<td><a class='btn btn-danger' href='supp.php?p=$row[pid]'>Supprimer</a></td>
                        <td><a class='btn btn-info' href='modif.php?p=$row[pid]'>Modifier</a></td>
                        </tr>";
            }
            echo"</table>";
        }else{
            try {
                $db=new PDO ("mysql:host=$hostname; dbname=$dbname; charset=UTF8", $username, $password);    
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sq="SELECT nom, ctid FROM categories WHERE nom LIKE '$search'";
                $res=$db->prepare($sq);
                $res->execute();
                $db=null;

                if($res->rowCount()>0){
                    echo "<br>";
                    echo"<table class='table table-striped table-bordered table-hover'>";
                    echo"<th>Catégorie</th>
                        <th>Action</th>";
                    foreach ($res as $row) {
                        echo "<tr><td>$row[nom]</td>
                             <td><a class='btn btn-primary' href='categorie.php?c=$row[ctid]'>Aller à la catégorie</td>";	
                    }
                    echo '</table>';
                }else{
                    echo '<br><br><h5>Pas de résultats</h5>';
                    echo '<h6> Il faut taper le mot exact pour avoir un résultat</h6><br>';
                }
            }
            catch(PDOException $e){
                exit("Erreur de connexion" .$e->getMessage());
            }
        }
    }catch(PDOException $e){
        exit("Erreur de connexion" .$e->getMessage());
    }
}

include 'footer.php';
?>

    