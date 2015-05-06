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
	</style>
	
     <script type = "text/javascript" src = "javascript.js"> </script>

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
        <li><a class="active" href="locations.php">Locations</a></li>
        <li><a href="events.php">Events</a></li>
        <li><a href="posts.php">Posts</a></li>
        <li><a href="findprices.php">Prices</a></li>
        <li><a href="logout.php">Log Out</a></li>
      </ul>
    </div>
</header>

<script src="https://maps.googleapis.com/maps/api/js"></script>

<div align="center">

	<br><legend>Search BMW Locations</legend>
		<form method="post" onsubmit="return validatelocation();">
			<input type='text' name='address' id='address'><br><span id='locationerror'></span><br>
			<input class = 'mybutton' type='submit' name='submitloc'>
			<br><br>
		</form>

		<?php
		if ( isset ($_POST['submitloc'] ) ) {
		?> 
		<div id="map-canvas"></div>
		<?php
		include 'map.php';
	}?>

</div>

</body>