<!DOCTYPE html>
<html>
	<head>
		<title>Calculatrice</title>
		<meta charset="utf-8">
	</head>
	<body>
		<form action="#" method="post">
			<?php 
				echo '<input type="number" name="terme1"';
				if(isset($_POST["terme1"]))
				{
					echo 'value="'. $_POST["terme1"].'"';
				}
				echo ">";
			 ?>
			<select name="operateur">
				<?php 
				echo '<option value="+"';
				if (isset($_POST["operateur"])) 
				{
					if($_POST["operateur"] == "+"){
						echo 'selected';
					}
				}
				echo '>+</option>';

				echo '<option value="-"';
				if (isset($_POST["operateur"])) 
				{
					if($_POST["operateur"] == "-"){
						echo 'selected';
					}
				}
				echo '>-</option>';

				echo '<option value="*"';
				if (isset($_POST["operateur"])) 
				{
					if($_POST["operateur"] == "*"){
						echo 'selected';
					}
				}
				echo '>*</option>';

				echo '<option value="/"';
				if (isset($_POST["operateur"])) 
				{
					if($_POST["operateur"] == "/"){
						echo 'selected';
					}
				}
				echo '>/</option>';
				 ?>
			</select>
			<?php 
				echo '<input type="number" name="terme2"';
				if(isset($_POST["terme2"]))
				{
					echo 'value="'. $_POST["terme2"].'"';
				}
				echo ">";
			 ?>
			
			<input type="submit" value="=">
			<?php 
			if (isset($_POST["operateur"]) && isset($_POST["terme1"]) && isset($_POST["terme2"])) 
			{
				$terme1 = $_POST["terme1"];
				$terme2 = $_POST["terme2"];
				$operateur = $_POST["operateur"];

				switch ($operateur) {
					case '+':
						echo $terme1 + $terme2;
						break;
					case '-':
						echo $terme1 - $terme2;
						break;
					case '*':
						echo $terme1 * $terme2;
						break;
					case '/':
						if ($terme2 == 0) 
						{
							echo "Division par 0 impossible";
						}
						else {
							echo $terme1 / $terme2;
						}
						
						break;
					
					default:
						# code...
						break;
				}
			}

			 ?>
		</form>
	</body>
</html>