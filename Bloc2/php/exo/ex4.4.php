<!DOCTYPE html>
<html>
<head>
	<title>Ex 4.4</title>
	<meta charset="utf-8">
</head>
<body align="center" style="margin-top: 40vh; background-color:#FF00FF; margin-right: 200px; margin-left: 200px; ">
	<div  style=" border-width: 10px; border-style: dotted;border-radius: 100px; border-right-color: green; border-left-color: red; ">
	<h1 style="color: blue">Ex 4.4</h1>
	<form action="ex4.4.php" method="post">
		<!-- <label for="nbr1">Introduire le premier nombre</label> -->
		<input type="number" name="nbr1" value="<?php if (isset($_POST['nbr1'])){echo $_POST['nbr1'];} ?>">
		<!-- <label for="signe">Quel est le signe</label> -->
		<!-- <input type="text" name="signe"> -->
		<!-- <label for="nbr2">Introduire le dexieme nombre</label> -->
		<select name="signe">
			<?php 
				echo '<option value="+"';
				if(isset($_POST["signe"]))
					{
						if ($_POST["signe"] == "+")
						{
							echo "selected";
						}
					}
				echo '>+</option>';
			 ?>
			 <?php 
				echo '<option value="-"';
				if(isset($_POST["signe"]))
					{
						if ($_POST["signe"] == "-")
						{
							echo "selected";
						}
					}
				echo '>-</option>';
			 ?>
			 <?php 
				echo '<option value="*"';
				if(isset($_POST["signe"]))
					{
						if ($_POST["signe"] == "*")
						{
							echo "selected";
						}
					}
				echo '>*</option>';
			 ?>
			 <?php 
				echo '<option value="/"';
				if(isset($_POST["signe"]))
					{
						if ($_POST["signe"] == "/")
						{
							echo "selected";
						}
					}
				echo '>/</option>';
			 ?>
			<!-- <option value="+">+</option>
			<option value="-">-</option>
			<option value="*">*</option>
			<option value="/">/</option> -->
		</select>
		<input type="number" name="nbr2" value="<?php if (isset($_POST['nbr2'])){echo $_POST['nbr2'];} ?>">
		<input type="submit" value="=">
		<?php 
			if (isset($_POST['nbr1'])and isset($_POST['signe'])and isset($_POST['nbr2']) ) {
				# code...
				$nbr1 = $_POST['nbr1'];
				$nbr2 = $_POST['nbr2'];
				$signe = $_POST['signe'];

				switch ($signe) {
					case '+':
						# code...
					    echo $nbr1+$nbr2;
						break;
					case '-':
						# code...
						echo $nbr1-$nbr2;
						break;
					case '*':
						# code...
						echo $nbr1*$nbr2;
						break;
					case '/':
						# code...
						if ($nbr2 == 0) {
							# code...
							echo "Impossible de diviser par 0";
						}
						else{
							echo $nbr1/$nbr2;
						}
						break;
					default:
						echo "Vous n'avez pas fait un choix correct";
						break;
				}
			}
		 ?>
	</form>
	</div>
</body>
</html>