<!DOCTYPE html>
<html>
<head>
	<title>ex5.4</title>
	<meta charset="utf-8">
</head>
<body>
<table border="1" width="800" align="center" style="font-size: 20px" >
		<caption style="font-size: 40px; font-style: italic;">Table de multiplication</caption>
		<?php
			$NbrCol 	= 10; // nombre de colonnes
			$NbrLigne 	= 10; // nombre de lignes
			// $i=0;
			// $j-0;
			 $k=1;
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
			<?php	
				// for ($j=1; $j<=$NbrCol; $j++){ 
				$j=1;
				do{
				 	# code...	 
			?>
			<td style="background:#FFFF66; ">
			<?php 
				echo $j; 
			?>
			</td>
			<?php
				$j+=1;	
				}while ( $j<= $NbrCol); 
			?>
			</th>
		</thead>
		<tbody>
			<?php
				// lignes suivantes
				// for ($i=1; $i<=$NbrLigne; $i++) {
				$i=1;
				do{
				 	# code... 
			?>
			<tr>
			<?php	
				// for ($j=1; $j<=$NbrCol; $j++) {
				
				do{
					# code...
				
					// 1ere colonne (colonne 0)
					if ($k==1) { 
			?>		
			<td style="background:#FFFF66; height:50px;">
			<?php
			 	echo $i; 
			?>
			</td>
			<?php
				}
				// colonnes suivantes
				if ($i==$k) {
			?>		
			<td style="background:#FFCC66;">
			<?php			
			} 	
			else {
			?>		
			<td>
			<?php			
				}
				// -------------------------
				// DONNEES A AFFICHER dans la cellule
				echo $i*$k;
				// -------------------------
			?>		
			</td>
			<?php
				$k+=1;	
				}while ( $k<= $NbrCol); 
			?>
			</tr>
			<?php	
				$k=1;
				$i+=1;
				}while ( $i<= $NbrLigne);
			?>
		</tbody>
	</table>

</body>
</html>