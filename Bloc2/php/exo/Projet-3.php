<!DOCTYPE html>
<html>
<head>
	<title>Projet-3</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Le Calendrier</h1>
	<table style="border-style: initial;">
		<tr>
			<td style="border: 1px solid black;">
				<h4>Voici le calandrier avec le nombre de jour par mois</h4>
				<table style="border-style: initial;" align="center">
					<thead style="border-style: initial;">
						<td style="border: 1px solid black;">Mois de l'année</td>
						<td style="border: 1px solid black;">Jours par mois</td>
					</thead>
					<tbody>
						<?php 
							$mois = array('janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre');
							$tab_jour = array(31,28,30,31,30,31,30,31,30,31,30,31,30,31,30,31,30);
							for ($i=0; $i < 12; $i++) { ?>
							<tr>
								<td style="border: 1px solid black;"> <?php echo($mois[$i]) ?></td>
								<td style="border: 1px solid black;"> <?php echo($tab_jour[$i]) ?></td>
							</tr> <?php } ?>
					</tbody>
				</table>
			</td>
			<td style="border: 1px solid black;">
				<h4>Recherche du nombre de jours par moi: </h4>
				<form action="Projet-3.php" method="post">
					<select name="choix">
						<option value="janvier">janvier</option>
						<option value="fevrier">fevrier</option>
						<option value="mars">mars</option>
						<option value="avril">avril</option>
						<option value="mai">mai</option>
						<option value="juin">juin</option>
						<option value="juillet">juillet</option>
						<option value="aout">aout</option>
						<option value="septembre">septembre</option>
						<option value="octobre">octobre</option>
						<option value="novembre">novembre</option>
						<option value="decembre">decembre</option>
						
					</select>
					<input type="submit">
					<br>
					<?php 
						if (isset($_POST['choix'])) {
							# code...
							$choix = $_POST['choix'];
							if ($choix == 'janvier' or $choix == 'avril' or $choix == 'juin' or $choix == 'aout' or $choix == 'octobre' or $choix == 'decembre') {
								# code...
								echo("il y a 31 jours dans le mois");
							}
							elseif ($choix == 'mars' or $choix == 'mai' or $choix == 'juillet' or $choix == 'septembre' or $choix == 'novembre') {
								# code...
								echo("il y a 30 jours dans le mois");
							}
							else{
								echo("il y a 28 jours dans le mois");
							}
						}
					 ?>

				</form>
			</td>
		</tr>


	</table>
</body>
</html>