<head>
    <style>
        p,body {
                text-align: center;
            }
    </style>
</head>

<div class="titre"> <b>Ajout d'article</b></div>
<br/>
	<form method="post">
		<table align="center">
                    <tr>
                        <td>Nom:</td>
                        <td><input type="text" name="nom"  required value=""/></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td><textarea type="text" name="description" class="form-control" required value=""></textarea></td>
                    </tr>
                    <tr>
                        <td>Prix:</td>
                        <td><input type='number' name='prix' class='form-control' required value="" /></td>
                    </tr>
                    <tr>
                        <td>Quantité:</td>
                        <td><input type='number' name='qte' class='form-control' required value="" /></td>
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
            <input type="submit" class="btn btn-primary" name="aj" value="Sauvegarder">
	</form>