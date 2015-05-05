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
        <li><a  class="active" href="homepage.php">Home</a></li>
        <li><a href="locations.php">Locations</a></li>
        <li><a href="events.php">Events</a></li>
        <li><a href="posts.php">Posts</a></li>
        <li><a href="findprices.php">Prices</a></li>
        <li><a href="login.php">Log Out</a></li>
      </ul>
    </div>
</header>


<script src="https://maps.googleapis.com/maps/api/js"></script>

<?php

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

//displayform();

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

