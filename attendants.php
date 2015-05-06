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
if ( isset ( $_POST['attendants'] ) ) {
    $event_id = $_POST['ID'];

    $dbc = @mysqli_connect("localhost", "mccleajo", "pV2YzEEU", mccleajo) OR die("message".mysqli_connect_error());
    $query = "SELECT * FROM Events WHERE event_id ='$event_id'";

    $result = mysqli_query( $dbc, $query);
    #$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    //echo "Query is $query";

    echo "<br><table>";
    echo "<tr><th>Event:</th>";

    // Cycle through the array
    while ( @extract(mysqli_fetch_array($result, MYSQLI_ASSOC)) ) {

        // Output a row
        echo "<tr>";
        echo "<td bgcolor='#E0E0E0'><b>$date</b><br>
        Name: $name<br>
        Address: $address<br>
        Time: $time<br>

        <form method='post' action = 'joinevent.php'>
        <input class = 'mybutton' type='submit' name='joinevent' value= 'Join Event'>
        <input type = 'hidden' value='$event_id' name='ID'>
        </form>

        <br></td>";
        echo "</tr>";
    }

    echo "</table>";

}



echo "<br><b>Current Attendants:<br></b>";



$query = "SELECT user_id FROM user_events WHERE event_id= '$event_id'";
$result = mysqli_query( $dbc, $query);

//echo "Query: $query <br />"; // for debug

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {;

    if (isset($row['user_id'])){
        $user_id = $row['user_id'];
        //echo "<br>$user_id";
        displaynames($user_id);
    } else {
    echo "<br>There are no attendants for this event yet!"; 
    }
}

function displaynames($user_id){
        $dbc = @mysqli_connect("localhost", "mccleajo", "pV2YzEEU", mccleajo) OR die("message".mysqli_connect_error());
        $query = "SELECT firstname, lastname FROM users WHERE user_id= '$user_id'";
        $result = mysqli_query( $dbc, $query);

        //echo "Query: $query <br />"; // for debug
       

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {;
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            echo "$firstname $lastname<br>";
    } 
      
}

  



//echo "user_id: $user_id<br>";






?>