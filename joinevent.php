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

<?php

if ( isset ( $_POST['joinevent'] ) ) {
	$event_id = $_POST['ID'];
	$email = $_COOKIE['login']; }
	echo "Event_id: $event_id<br>";
	echo "Email: $email<br>";

$dbc = @mysqli_connect("localhost", "mccleajo", "pV2YzEEU", mccleajo) OR die("message".mysqli_connect_error());
$query = "SELECT * FROM users WHERE email= '$email'";

$result = mysqli_query( $dbc, $query);

echo "Query: $query <br />"; // for debug

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {;
$user_id = $row['user_id'];
echo "user_id: $user_id<br>";}

$query = "INSERT INTO user_events(user_id, event_id) VALUES ($user_id, $event_id)";
echo "Query: $query <br />"; // for debug

$result = mysqli_query ($dbc, $query);
if (!$result) {
die('Invalid query: $query ' . mysqli_error($dbc));
}



	?>
