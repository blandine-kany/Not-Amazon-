<head>
    <style>
        p,body {
                text-align: center;
            }
    </style>
</head>
<?php
echo '<text style="color:black;">';
?>
<br>

<div class="titre"><b>Commande de: <?php echo $nom ?> </b></div> <br>
<br>
    <form method="post">
        <table align="center">
                   
                    <tr>
                        <td>Quantité:</td>
                        <td><input type='number' name='qte' class='form-control'/></td>
                    </tr>
                    
		</table>
            <br>
        <input class="btn btn-primary" type="submit" name="achat" value="Commandez">
        <input class="btn" type="submit" name="achat" value="Annuler">
    </form>
