<!DOCTYPE html>
<html>
<head>
	<title>ex3</title>
	<meta charset="utf-8">
</head>
<body align="center" style="font-size: 20px; background-color:#C8D4FD ">
		<?php 
		$septembre =array(24, 20, 20, 20, 20, 19, 14, 17, 16, 17, 17, 17, 17, 17, 14, 16, 16, 16, 14, 17, 17, 19, 17, 20, 19, 20, 21, 21, 20, 17);
		?>

		<h1>Les temperatures du mois de Septembre 2017</h1>
		<p ">Voici le calendrier avec les temperatures:</p>
		<table style="border-style: groove; border-radius: 5px" align="center">
			<tr style="border-style: initial;">
				<?php 
					for ($i=1; $i <= 30 ; $i++) { ?>
				 <td style="border: 1px solid black; background-color:#868384;"> <?php echo($i) ?></td>
				 <?php } ?>
			</tr> 
			<tr>
				<?php 
					foreach ($septembre as $value) { 
						if ($value == minimum($septembre)) { ?>
						<td style="border: 1px solid black; background-color:#003AE1"> <?php echo($value); } ?></td>
						<?php if ($value == maximum($septembre)) { ?>
						<td style="border: 1px solid black; background-color:#E1000D"> <?php echo($value); } ?></td>
						<?php if ($value != maximum($septembre) and $value != minimum($septembre)) { ?>
				 		<td style="border: 1px solid black; background-color:#C2C0C0"> <?php echo($value); }; ?></td>
				 	<?php } ?>
			</tr> 
		</table>
		<p>
			<?php echo("Il a fait le plus froid le: ".trouve($septembre, minimum($septembre))." avec une têmperature de ". minimum($septembre)). "°C" ?>
		</p>
		<p>
			<?php echo("Il a fait le plus chaud le: ".trouve($septembre, maximum($septembre))." avec une têmperature de ". maximum($septembre)). "°C" ?>
		</p>
		<p>
			<?php echo("la temperatures moyenne est de: ".moyenne($septembre)."°C") ?>
		</p>
</body>
</html>

<?php 
	function minimum($tab){
		# code...
		
		$nbr_moins = 100;
		foreach ($tab as $value) {
			# code...
			if ($value < $nbr_moins) {
				# code...
				$nbr_moins = $value;
			}
		}
		return $nbr_moins;
	}

	function maximum($tab){
		# code...
		$nbr = -100;
		foreach ($tab as $value) {
			# code...
			if ($value > $nbr) {
				# code...
				$nbr = $value;
			}
		}
		return $nbr;
	}
	function trouve($tab, $temp){
		# code...
		$i=0;
		$cpt=0;
		foreach ($tab as $value) {
			# code...
			$i++;
			if ($value == $temp) {
				# code...
				$n_fois[$cpt++]= $i;
			}
		}
		$chaine = pluisieur($n_fois);
		return $chaine;
	}
	function pluisieur($tab){
		$ligne = "";
		for ($i=0; $i <count($tab) ; $i++) { 
			# code...
			if ($i != 0 && $i != count($tab)) {
				# code...
				if ($i == (count($tab)-1)) {
					# code...
					$ligne = $ligne." et le ";
				}
				else{
					$ligne = $ligne.", le ";
				}	
			}
			$ligne = $ligne."$tab[$i]";
		}
		return $ligne;
	}
	function moyenne($tab){
		# code...
		return(array_sum($tab)/count($tab));
	}
 ?>