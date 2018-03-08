<?php
require_once 'class_calendar.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Exemple de calendrier avec mois incrémentable</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<?php
if(isset($_GET['month']))
	$month = $_GET['month'];
else
	$month = date('n');

if(isset($_GET['year']))
	$year = $_GET['year'];
else
	$year = date('Y');

$calendar = new calendar($month, $year);
$calendar->add_vacation('13/06->17/06');
$calendar->add_vacation('03/06');
$calendar->add_holiday('02/06');
$calendar->add_eday('24/06', 'http://kik.s.free.fr/test/test.php');

echo '<div id="calendar">' . 
	'<a href="test.php?month=' . (($month-1==0) ? 12 : $month-1) . '&year=' . (($month-1==0) ? ($year-1) : $year) . '">&lt;&lt;&nbsp;</a>' . 
	$calendar->get_month() . ' ' . $year .  
	'<a href="test.php?month=' . (($month+1==13) ? 1 : $month+1) . '&year=' . (($month+1==13) ? ($year+1) : $year) . '">&nbsp;&gt;&gt;</a><br />';
	$calendar->show_calendar();
echo'</div>';
?>
</body>
</html>