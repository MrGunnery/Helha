<?php 
$date = $_GET["date"];

$true = is_numeric($date);
	# code...
if ($true) {
	# code...
	if ((($date%4==0) && ($date%100 !=0))OR $date%400 ==0 ) {
	# code...
	echo "L'année ".$date." est bissextile ";
	}
	else{
	echo "l'année ".$date." n'est pas bissextile";
	}
}
else{
	echo "vous n'avez pas retrer une annee";
}


 ?>