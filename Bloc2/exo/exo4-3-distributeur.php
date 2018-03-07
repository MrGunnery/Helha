<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<style>
			img {
				height: 200px;
			}
		</style>
	</head>
	<body>
		<form action="#" method="post">
			<select name="boisson">
				<?php 
					echo '<option value="0"';

					if(isset($_POST["boisson"]))
					{
						if ($_POST["boisson"] == "0")
						{
							echo "selected";
						}
					}
					echo '>Eau</option>';

					echo '<option value="1"';

					if(isset($_POST["boisson"]))
					{
						if ($_POST["boisson"] == "1")
						{
							echo "selected";
						}
					}
					echo '>Coca</option>';
				 ?>
			
			</select>
			<input type="submit" value="Servir">
		</form>


<?php 
$stockEau = 2;
$stockCoca = 1;

if (isset($_POST["boisson"])) 
{
	$boisson = $_POST["boisson"];
	switch ($boisson) {
		case '0':
			if ($stockEau > 0)
			{
				echo "Voici l'eau";
				echo '<img src="eau.jpg" alt="image eau">';
				$stockEau--;
			}
			else
			{
				echo "Il n'y a plus d'eau";
			}
			break;
		case '1':
			if ($stockCoca > 0)
			{
				echo "Voici le coca";
				echo '<img src="coca.jpeg" alt="image coca">';
				$stockCoca--;
			}
			else
			{
				echo "Il n'y a plus de coca";
			}
			break;
		default:
			# code...
			break;
	}
}


 ?>
	</body>
</html>


