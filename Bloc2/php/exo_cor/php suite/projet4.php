
 <!DOCTYPE html>
 <html>
 	<head>
 		<title>Projet 4</title>
 		<meta charset="utf-8">
 		<style>
 			.bleu
 			{
 				background-color: blue;
 			}
 			.rouge
 			{
 				background-color: red;
 			}
 			table,td
 			{
 				border-style: solid;
 				border-collapse: collapse;
 			}
 		
 		</style>
 	</head>
 	<body>
 		<h1>Les températures du mois de septembre 2017</h1>
 		<p>Voici le calendrier avec leur température:</p>
 		<table>
 		<?php 
			$temp = array(20,20,20,20,24,19,18,17,16,17,17,18,17,17,14,15,16,16,16,17,17,19,17,20,19,20,21,21,24,17);
			$moyenne = 0;
			$grande = $temp[0];
			$petite = $temp[0];
			$cptfr = 0;
			$cptch = 0;

			for ($i=0; $i < 30; $i++) //Trouver min et max
			{ 
				if($grande < $temp[$i])
				{
					$grande = $temp[$i];
				}
				elseif($petite > $temp[$i])
				{
						$petite = $temp[$i];

				}
				$moyenne += $temp[$i];
			}
			for ($i=0; $i < 30; $i++) //trouver date min et max
			{ 
				if($grande == $temp[$i])
				{
					$ich[$cptch] = $i;
					$cptch++;
				}
				elseif($petite == $temp[$i])
				{
						$ifr[$cptfr] = $i;
						$cptfr++;

				}
			}
			for ($i=0; $i < 30; $i++) //affiche les jours 1>30
			{ 
					echo "<td>".($i+1)."</td>";
			}
			echo "<tr></tr>";
			for ($i=0; $i < 30; $i++) //temperatures
			{ 
				if($temp[$i] == $petite)
					echo "<td class='bleu'>".$temp[$i]."</td>";
				elseif($temp[$i] == $grande)
					echo "<td class='rouge'>".$temp[$i]."</td>";
				else
					echo "<td>".$temp[$i]."</td>";
			}
			echo "</table>";
			
			
			$moyenne /= 30;
			echo "La température la plus froide $petite °C était le ".($ifr[0] +1);
			if(count($ifr)>1)
			{
				for ($i=1; $i < count($ifr); $i++) { 
				echo " et le ".($ifr[$i]+1);
				}
			}
			echo '<br>';
			echo "La température la plus chaude $grande °C était le ".($ich[0]+1);
			if(count($ich)>1)
			{
				for ($i=1; $i < count($ich); $i++) { 
				echo " et le ".($ich[$i]+1);
			}

			}
			echo '<br>';
			echo "la moyenne est de $moyenne";

		 ?>
 	</body>
 </html>