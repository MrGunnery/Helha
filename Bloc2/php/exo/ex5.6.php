
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Table de multiplication</title>
</head>
<body>

<table border="1" width="800" align="center" style="font-size: 20px">
	<caption style="font-size: 40px; font-style: italic;">Table de multiplication</caption>
	
<?php
$NbrCol 	= 10; // nombre de colonnes
$NbrLigne 	= 10; // nombre de lignes
// --------------------------------------------------------
// on affiche en plus sur les 1ere ligne et 1ere colonne 
// les valeurs a multiplier (dans des cases en couleur)
// le tableau final fera donc 10 x 10
// --------------------------------------------------------
	// 1ere ligne (ligne 0) 
?>
<thead>
	<th style="height: 50px">
		<!-- <td style="background:#CCCCCC;">i X j</td> -->
<?php	for ($j=1; $j<=$NbrCol; $j++) { ?>
		<td style="background:#FFFF66;"><?php echo $j; ?></td>
<?php	} ?>
	</th>
</thead>

<tbody>
<?php
	// lignes suivantes
	for ($i=1; $i<=$NbrLigne; $i++) { 
?>
	<tr>
<?php		for ($j=1; $j<=$NbrCol; $j++) {
			// 1ere colonne (colonne 0)
			if ($j==1) { 
?>		<td style="background:#FFFF66;height:50px;"><?php echo $i; ?></td>
<?php			}
			// colonnes suivantes
			if ($i==$j) {
?>		<td style="background:#FFCC66;">
<?php			} else {
?>		<td>
<?php			}
		// -------------------------
		// DONNEES A AFFICHER dans la cellule
		echo $i*$j;
		// -------------------------
?>		</td>
<?php	} 
?>
	</tr>
<?php	$j=1;
}
?>
</tbody>
</table>

</body>
</html>