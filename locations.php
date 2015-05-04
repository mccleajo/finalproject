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

<body>

<header>
    <div class="nav">
      <ul>
        <li class="home"><a href="homepage.php">Home</a></li>
        <li class="locations"><a class="active" href="locations.php">Locations</a></li>
        <li class="events"><a href="events.php">Events</a></li>
        <li class="posts"><a href="posts.php">Posts</a></li>
        <li class="bmwmodels"><a href="bmwpics.php">Models</a></li>
        <li class="logout"><a href="login.php">Log Out</a></li>
      </ul>
    </div>
</header>

<script src="https://maps.googleapis.com/maps/api/js"></script>

<div align="center">

	<br><legend>Search BMW Locations</legend>
		<form method="post">
			<input type='text' name='address' id='address'><br>
			<input class = 'mybutton' type='submit' name='submitloc' onsubmit='initialize()'><br><br>
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