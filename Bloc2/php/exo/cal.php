<html>
<head>
<title>calendrier</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php 
function calendrier($choixmois,$choixannee,$nomfichier){?>
	 <style type="text/css">
		body {font-family:"Andale Mono", Arial, Verdana, sans-serif;font-size: 11px ;margin:0 0 0 0;padding:0 0 0 0;}
		a {color:#822;text-decoration:none ;}
		#table_calendrier{font-size:11px;text-align:center;border-left: solid 5px #666;border-top: solid 5px #666;border-right:solid 5px #ccc; border-bottom:solid 5px #ccc;background-color:#ddd;}
		#table_calendrier td{border: 1px solid #586;height:18px;}
		.textegras14{font-size: 14px ;font-weight:bold;color:#006633;}
		.numsem{background-color:#88a;height:20px}
		.fond1{background-color:#ee5;}
		.fond2{background-color:#fa5;}
		.fond3{background-color:#afa;}
		.choixjour1{background-color:#5bf;}
		.choixjour2{background-color:#fff;}
	</style><?php
	if($choixmois==Null) $choixmois=date('n', mktime(0,0,0,date('n')+1,0,0));
	if($choixannee==Null)$choixannee=date('Y', mktime(0,0,0,0,0, date('Y')+1));
	$nbrejourmois = date('t', mktime(0,0,0,$choixmois,1, $choixannee));
	$premierjour= date('w', mktime(0,0,0,$choixmois,1, $choixannee));
	$jourcourant=date('j', mktime(0,0,0,0,date('j'),0));
	$moiscourant= date('m', mktime(0,0,0,date('m')+1,0,0));
	$anneecourante= date('Y', mktime(0,0,0,0,0, date('Y')+1));
	$mois = Array ( "", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre" );
	$i=$choixmois;
	if ($premierjour==0) $premierjour=7;
	if ($i<1) $i=12;
	if ($i >12) $i=1;?>
	<table id="table_calendrier">
		<tr>
			<td colspan="8" class="fond1" >
				<a href="<?php echo $nomfichier ?>?choixannee=<?php echo $choixannee-1 ?>&choixmois=<?php echo $choixmois ?>"><<&nbsp;&nbsp; </a>
				<span class="textegras14"><?php echo $choixannee ;?></span>
				<a href="<?php echo $nomfichier ?>?choixannee=<?php echo $choixannee+1 ?>&choixmois=<?php echo $choixmois ?>">&nbsp;&nbsp;>> </a>
			</td>
		</tr>
		<tr>
			<td colspan="8" class="fond2" >
				<a href="<?php echo $nomfichier ?>?choixmois=<?php echo $i-1 ?>&choixannee=<?php echo $choixannee ?>"><<&nbsp;&nbsp; </a>
				<span class="textegras14"><?php echo $mois[$i] ;?></span>
				<a href="<?php echo $nomfichier ?>?choixmois=<?php echo  $i+1?>&choixannee=<?php echo $choixannee ?>">&nbsp;&nbsp;>> </a>
			</td>
		</tr>	   
		<tr class="fond3" ><td>N° S</td><td>Lu</td><td>Ma</td><td>Mer</td><td>Jeu</td><td>Ven</td><td>Sam</td><td>Dim</td></tr><?php 
		$varjour=1;
		$jour_increment=Null;
		for($s=0;$s<6;$s++){?>
			<tr><?php
				for($j=1;$j<8;$j++){
					if($varjour>=$premierjour){
						$jour_increment += 1 ;
						if($jour_increment<10)$jour_increment='0'.$jour_increment;
					}
					if($j<2 ){
						($jour_increment<=$nbrejourmois)?$numsemaine= date('W', mktime(0,0,0,$choixmois,$jour_increment, $choixannee)):$numsemaine='';//n° semaine?>
						 <td  class="numsem"><?php echo $numsemaine ?> </td><?php
					}
					if($jour_increment<=$nbrejourmois) {
						if(strlen($choixmois)==1) $choixmois='0'.$choixmois;
						$returndate=$jour_increment.'/'.$choixmois.'/'.$choixannee;
						($jour_increment==$jourcourant && $choixmois ==$moiscourant && $choixannee==$anneecourante )? $class=' class="choixjour1"': $class=' class="choixjour2"';?>
						<td <?php echo $class ?> ><a href="<?php echo $nomfichier ?>?returndate=<?php echo $returndate ?>&choixmois=<?php echo $i ?>&choixannee=<?php echo $choixannee ?>"><?php echo $jour_increment ?> </a></td><?php
					}else{
						$j=8;
					} 
					$varjour=$varjour+1;
				}?>
			</tr> <?php
		}?>
		</tr>
		<!-- <tr><td colspan="8">calendrier créé par M.LAVEAU</td></tr> -->
	</table><?php 
}?>
</head>
<body><?php 
	(isset($_GET['choixmois']))?$choixmois =$_GET['choixmois']:$choixmois=Null;
	(isset($_GET['choixannee']))?$choixannee =$_GET['choixannee']:$choixannee=Null;
	(isset($_GET['returndate']))?$returndate =$_GET['returndate']:$returndate=Null;
	calendrier($choixmois,$choixannee,$_SERVER['PHP_SELF'] );
	echo $returndate;?>
</body>
</html>