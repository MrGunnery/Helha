<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
	</head>
	<body>
		<form action="#" method="post">

			<input type="number" name="cote" value='<?php 
			if(isset($_POST["cote"]))
			{
				echo $_POST["cote"];
			}
			 ?>'>
			
			<input type="submit" value="Voir l'appréciation">
		</form>
		<?php 
		if(isset($_POST["cote"])){
			$note = $_POST["cote"];
			if($note <10 && $note >=0)
			{
				echo "I";
			}
			elseif($note >=10 && $note <=12)
			{
				echo "S";
			}
			elseif($note >= 13 && $note <=15)
			{
				echo "B";
			}

			elseif($note >= 16 && $note <= 18)
			{
				echo "TB";
			}
			elseif($note >= 19 && $note <=20)
			{
				echo "Excellent";
			}
			else {
				echo "Note incorrecte !";
			}
		}


		 ?>

	</body>
</html>