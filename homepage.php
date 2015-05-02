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

//include 'bmwpics.php';


// $results = finddealerships("310 Corlies Avenue, Pelham, NY 10803");	
// $dealerships = $results[0];
// foreach ( $dealerships as $dealership ) {
// 	echo $dealership;
	?><!--  <br>  --><?php
// }


?> <div id="map-canvas"></div><?php
include 'map.php';


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
		locationform();
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
			<input class = 'mybutton' type='submit' name='posts' value='Posts'>
		</form>


		<a href="bmwpics.php">
		<input class = 'mybutton' type='submit' name='BMW Models' value='BMW Models'><br>
		</a>

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
			<input class = 'mybutton' type='submit' name='submitloc' onsubmit='initialize()'><br><br><br><br><br>
		</form>


<?php

}

