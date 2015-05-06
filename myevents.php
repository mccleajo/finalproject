<!DOCTYPE html>

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>Welcome to BMWLand</title>
     <link rel="stylesheet" type="text/css" href="projectstyle.css">

</head>
<body>


<header>
    <div class="nav">
      <ul>
        <li><a href="homepage.php">Home</a></li>
        <li><a href="locations.php">Locations</a></li>
        <li><a class="active" href="events.php">Events</a></li>
        <li><a href="posts.php">Posts</a></li>
        <li><a href="findprices.php">Prices</a></li>
        <li><a href="login.php">Log Out</a></li>
      </ul>
    </div>
</header>

<br><table><th>My Events:</th></table>

<?php

if ( isset ( $_POST['myevents'] ) ) {
	$email = $_COOKIE['login']; }
	//echo "Email: $email<br>";

$dbc = @mysqli_connect("localhost", "mccleajo", "pV2YzEEU", mccleajo) OR die("message".mysqli_connect_error());
$query = "SELECT user_id FROM users WHERE email= '$email'";

$result = mysqli_query( $dbc, $query);

//echo "Query: $query <br />"; // for debug

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {;
$user_id = $row['user_id'];
//echo "user_id: $user_id<br>";
}






$dbc = @mysqli_connect("localhost", "mccleajo", "pV2YzEEU", mccleajo) OR die("message".mysqli_connect_error());
$query = "SELECT event_id FROM user_events WHERE user_id ='$user_id'";

$result = mysqli_query( $dbc, $query);
#$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {;
$event_id = $row['event_id'];
//echo "event_id: $event_id<br>";
displayeventname($event_id);}




function displayeventname($event_id){
$dbc = @mysqli_connect("localhost", "mccleajo", "pV2YzEEU", mccleajo) OR die("message".mysqli_connect_error());
$query = "SELECT DISTINCT event_id, name, date, time, address FROM Events WHERE event_id ='$event_id'";

$result = mysqli_query( $dbc, $query);
#$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

echo "<table>";
echo "<tr>";

    // Cycle through the array
    while ( @extract(mysqli_fetch_array($result, MYSQLI_ASSOC)) ) {

        // Output a row
        echo "<tr>";
        echo "<td bgcolor='#E0E0E0'><b>$date</b><br>
        Name: $name<br>
        Address: $address<br>
        Time: $time<br>

        <form method='post' action = 'leaveevent.php'>
        <input class = 'mybutton' type='submit' name='leaveevent' value= 'Leave Event'>
        <input type = 'hidden' value='$event_id' name='ID'>
        </form>

        <br></td>";
        echo "</tr>";
    }

    echo "</table>";
}
	?>


