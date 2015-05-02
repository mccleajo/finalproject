<!DOCTYPE html>

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>Welcome to BMWLand</title>
     <link rel="stylesheet" type="text/css" href="projectstyle.css">
     <style>
     	#map-canvas {
        width: 500px;
        height: 400px;
        }

        body { background: url(755102-bmw-wallpaper.jpg) no-repeat center center fixed; background-size: center; background-repeat: no-repeat; font-family: helvetica;}
     </style>
</head>
<body>

<script src="https://maps.googleapis.com/maps/api/js"></script>

<?php

include 'bmwpics.php';


// $results = finddealerships("310 Corlies Avenue, Pelham, NY 10803");	
// $dealerships = $results[0];
// foreach ( $dealerships as $dealership ) {
// 	echo $dealership;
	?><!--  <br>  --><?php
// }


if ( !isset ( $_COOKIE['login'] ) ) {
	?> <h3> User not logged in! </h3> 
	<a href="login.php">
		<input class ='mybutton' type="button" value="Return to Login" />
	</a> <?php
	die();
}


if ( isset ( $_POST['locations'] ) ) {
		locationform();
	}
	if ( isset ($_POST['submitloc'] ) ) {
		?> <div id="map-canvas"></div><?php
		include 'map.php';
		locationform();
	}


if ( isset ( $_POST['history'] ) ) {
		bmwpics();
	}


	if ( isset ( $_POST['events'] ) ) {
		eventsform();
	}
	

displayform();

?>

</body>
</html>

<?php

function displayform(){

?>


		<form method="post">
			<input class = 'mybutton' type='submit' name='locations' value='Find BMW Locations'><br>
			<input class = 'mybutton' type='submit' name='history' value='BMW Models'><br><br>
			<input class = 'mybutton' type='submit' name='posts' value='Posts'>
		</form>

		<a href="events.php">
		<input class = 'mybutton' type='submit' name='events' value='Events'><br>
		</a>

		<form method="post" action="dboperation.php">
			<input class = 'mybutton' type='submit' name='op' value='Log Out'><br>
		</form>
	


		
<?php

}

function locationform(){

?>


	<legend>Search BMW Locations</legend><br>
		<form method="post">
			<input type='text' name='address' id='address'><br>
			<input class = 'mybutton' type='submit' name='submitloc'><br><br><br><br><br>
		</form>


<?php

}

/*function eventsform(){

date_default_timezone_set('UTC');

$monthNames = Array("January", "February", "March", "April", "May", "June", "July", 
"August", "September", "October", "November", "December");

if (!isset($_REQUEST["month"])) $_REQUEST["month"] = date("n");
if (!isset($_REQUEST["year"])) $_REQUEST["year"] = date("Y");

$cMonth = $_REQUEST["month"];
$cYear = $_REQUEST["year"];
 
$prev_year = $cYear;
$next_year = $cYear;
$prev_month = $cMonth-1;
$next_month = $cMonth+1;
 
if ($prev_month == 0 ) {
    $prev_month = 12;
    $prev_year = $cYear - 1;
}
if ($next_month == 13 ) {
    $next_month = 1;
    $next_year = $cYear + 1;
}
?>

<table width="200">
<tr align="center">
<td bgcolor="#999999" style="color:#FFFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="50%" align="left">  <a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $prev_month . "&year=" . $prev_year; ?>" style="color:#FFFFFF">Previous</a></td>
<td width="50%" align="right"><a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $next_month . "&year=" . $next_year; ?>" style="color:#FFFFFF">Next</a>  </td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center">
<table width="100%" border="0" cellpadding="2" cellspacing="2">
<tr align="center">
<td colspan="7" bgcolor="#999999" style="color:#FFFFFF"><strong><?php echo $monthNames[$cMonth-1].' '.$cYear; ?></strong></td>
</tr>
<tr>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>S</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>M</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>T</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>W</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>T</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>F</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>S</strong></td>
</tr>

<?php
$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
$maxday = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
for ($i=0; $i<($maxday+$startday); $i++) {
    if(($i % 7) == 0 ) echo "<tr>";
    if($i < $startday) echo "<td></td>";
    else echo "<td align='center' valign='middle' height='20px'>". ($i - $startday + 1) . "</td>";
    if(($i % 7) == 6 ) echo "</tr>";
}
}
?>

</table>
</td>
</tr>
</table>

*/

