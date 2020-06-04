<head>
    <style>
        p,body {
                text-align: center;
            }
    </style>
</head>

<div class="titre"> <b>Modifications</b></div>
<br/>
<?php if($idm->getRole()=='vendeur'){ ?>
	<form method="post">
		<table align="center">
                    <tr>
                        <td>Nom:</td>
                        <td><input type="text" name="nom" class="form-control" required value="<?php echo htmlspecialchars($nom, ENT_QUOTES);?>"/></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td><textarea type="text" name="description" class="form-control" required value=""><?php echo htmlspecialchars($description,ENT_QUOTES);?></textarea></td>
                    </tr>
                    <tr>
                        <td>Prix:</td>
                        <td><input type='number' name='prix' required value="<?php echo htmlspecialchars($prix,ENT_QUOTES);  ?>" class='form-control' /></td>
                    </tr>
                    <tr>
                        <td>Quantité:</td>
                        <td><input type='number' name='qte' required value="<?php echo htmlspecialchars($qte,ENT_QUOTES);  ?>" class='form-control'/></td>
                    </tr>
                    <tr>
                        <td>Catégorie:</td>
                        <td><select name='ctid'>
                            <option value='1'>Alimentaire</option>
                            <option value='2'>Vétements</option>
                            <option value='3'>Jouets</option>
                          
                            </select></td>
                    </tr>
       
		</table>
            <br>
            <input type="submit" class="btn btn-primary" name="mod" value="Sauvegarder">
            <input class="btn" type="submit" name="mod" value="Annuler">
	</form>
<?php }else{ ?>
<form method="post">
		<table align="center">
                    <tr>
                        <td>Quantité:</td>
                        <td><input type='number' name='qte' required value="<?php echo htmlspecialchars($qte,ENT_QUOTES);  ?>" class='form-control'/></td>
                    </tr>
       
		</table>
            <br>
            <input type="submit" class="btn btn-primary" name="mod" value="Sauvegarder">
            <input class="btn" type="submit" name="mod" value="Annuler">
	</form>
<?php } ?>
