<!DOCTYPE html>

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>Welcome to BMWLand</title>
     <link rel="stylesheet" type="text/css" href="projectstyle.css">

</head>
<body>

<?php

if ( !isset ( $_COOKIE['login'] ) ) {
	?> <h3> User not logged in! </h3> 
	<a href="login.php">
		<input class ='mybutton' type="button" value="Return to Login" />
	</a> <?php
	die();
}

?>

<header>
    <div class="nav">
      <ul>
        <li><a href="homepage.php">Home</a></li>
        <li><a href="locations.php">Locations</a></li>
        <li><a class="active" href="events.php">Events</a></li>
        <li><a href="posts.php">Posts</a></li>
        <li><a href="findprices.php">Prices</a></li>
        <li><a href="logout.php">Log Out</a></li>
      </ul>
    </div>
</header>

<?php

// date_default_timezone_set('UTC');

// $monthNames = Array("January", "February", "March", "April", "May", "June", "July",
// "August", "September", "October", "November", "December");

// if (!isset($_REQUEST["month"])) $_REQUEST["month"] = date("n");
// if (!isset($_REQUEST["year"])) $_REQUEST["year"] = date("Y");

// $cMonth = $_REQUEST["month"];
// $cYear = $_REQUEST["year"];

// $prev_year = $cYear;
// $next_year = $cYear;
// $prev_month = $cMonth-1;
// $next_month = $cMonth+1;

// if ($prev_month == 0 ) {
//     $prev_month = 12;
//     $prev_year = $cYear - 1;
// }
// if ($next_month == 13 ) {
//     $next_month = 1;
//     $next_year = $cYear + 1;
// }
?>

<!-- <br>
	<table width="200">
		<tr align="center">
			<td bgcolor="#0099cc" style="color:#FFFFFF">
				<table width="100%" border="1" cellspacing="2" cellpadding="2">
					<tr>
						<td width="50%" align="left">  <a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $prev_month . "&year=" . $prev_year; ?>" style="color:#FFFFFF">Previous</a></td>
						<td width="50%" align="right"><a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $next_month . "&year=" . $next_year; ?>" style="color:#FFFFFF">Next</a>  </td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center">
				<table width="100%" border="12" cellpadding="12" cellspacing="12">
					<tr align="center">
						<td colspan="7" bgcolor="#0099cc" style="color:#FFFFFF"><strong><?php echo $monthNames[$cMonth-1].' '.$cYear; ?></strong></td>
					</tr>
					<tr>
						<td align="center" bgcolor="#0099cc" style="color:#FFFFFF"><strong>S</strong></td>
						<td align="center" bgcolor="#0099cc" style="color:#FFFFFF"><strong>M</strong></td>
						<td align="center" bgcolor="#0099cc" style="color:#FFFFFF"><strong>T</strong></td>
						<td align="center" bgcolor="#0099cc" style="color:#FFFFFF"><strong>W</strong></td>
						<td align="center" bgcolor="#0099cc" style="color:#FFFFFF"><strong>T</strong></td>
						<td align="center" bgcolor="#0099cc" style="color:#FFFFFF"><strong>F</strong></td>
						<td align="center" bgcolor="#0099cc" style="color:#FFFFFF"><strong>S</strong></td>
					</tr> -->

<?php
// $timestamp = mktime(0,0,0,$cMonth,1,$cYear);
// $maxday = date("t",$timestamp);
// $thismonth = getdate ($timestamp);
// $startday = $thismonth['wday'];
// for ($i=0; $i<($maxday+$startday); $i++) {
//     if(($i % 7) == 0 ) echo "<tr>";
//     if($i < $startday) echo "<td></td>";
//     else echo "<td align='center' bgcolor='#E0E0E0' valign='middle' height='20px'>". ($i - $startday + 1) . "</td>";
//     if(($i % 7) == 6 ) echo "</tr>";
// }

?>

<!-- </table>
</td>
</tr>
</table> -->

<div align ="center">
<br>
<form method="post" action ="myevents.php">
    <input class="mybutton" name="myevents" id="myevents" value= "My Events" type="submit"/>
</form><br>

<form method="post">
  <input type = "text" name ="Searchbar" id = "Searchbar" value = "<?php if(isset($_POST['Searchbar'])) {echo $_POST['Searchbar'];}?>"/>
  <input class="mybutton" name="Search" id="Search" value= "Search All Events" type="submit"/>
</form>

</div>

<?php
if(isset($_POST['Searchbar'])) {
$Searchbar = $_POST['Searchbar'];

$dbc = @mysqli_connect("localhost", "mccleajo", "pV2YzEEU", mccleajo) OR die("message".mysqli_connect_error());
$query = "SELECT event_id, name, date, time, address FROM Events WHERE

name LIKE '%$Searchbar%'
ORDER BY date ASC";

$result = mysqli_query( $dbc, $query);
#$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

//echo "Query is $query";

echo "<table>";
echo "<tr><th>Events</th>";

    // Cycle through the array
    while ( @extract(mysqli_fetch_array($result, MYSQLI_ASSOC)) ) {

        // Output a row
        echo "<tr>";
        echo "<td bgcolor='#E0E0E0'><b>$date</b><br><br>
        <b>Name:</b> $name<br>
        <b>Address:</b> $address<br>
        <b>Time:</b> $time<br><br>

        <form method='post' action = 'joinevent.php'>
        <input class = 'mybutton' type='submit' name='joinevent' value= 'Join Event'>
        <input type = 'hidden' value='$event_id' name='ID'>
        </form><br>

        <form method='post' action = 'attendants.php'>
        <input class = 'mybutton' type='submit' name='attendants' value= 'Attendants'>
        <input type = 'hidden' value='$event_id' name='ID'>
        </form>

        <br></td>";
        echo "</tr>";
    }

    echo "</table>";
}
?>
    




<?php
if(!isset($_POST['Searchbar'])) {

$dbc = @mysqli_connect("localhost", "mccleajo", "pV2YzEEU", mccleajo) OR die("message".mysqli_connect_error());
$query = "SELECT event_id, name, date, time, address FROM Events ORDER BY date ASC";

$result = mysqli_query( $dbc, $query);
#$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

//echo "Query is $query";

echo "<table>";
echo "<tr><th>Events</th>";

    // Cycle through the array
    while ( @extract(mysqli_fetch_array($result, MYSQLI_ASSOC)) ) {

        // Output a row
        echo "<tr>";
        echo "<td bgcolor='#E0E0E0'><b>$date</b><br><br>
        <b>Name:</b> $name<br>
        <b>Address:</b> $address<br>
        <b>Time:</b> $time<br><br>

        <form method='post' action = 'joinevent.php'>
        <input class = 'mybutton' type='submit' name='joinevent' value= 'Join Event'>
        <input type = 'hidden' value='$event_id' name='ID'>
        </form><br>

        <form method='post' action = 'attendants.php'>
        <input class = 'mybutton' type='submit' name='attendants' value= 'Attendants'>
        <input type = 'hidden' value='$event_id' name='ID'>
        </form>
  

        <br></td>";
        echo "</tr>";
    }

    echo "</table>";
}
?>



