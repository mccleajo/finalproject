<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>BMW Land</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Fullscreen Background Image Slideshow with CSS3 - A Css-only fullscreen background image slideshow" />
        <meta name="keywords" content="css3, css-only, fullscreen, background, slideshow, images, content" />
        <link rel="shortcut icon" href="../favicon.ico"> 
     	<link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style1.css" />
		<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
    </head>

<body id="page">
        <ul class="cb-slideshow">
            <li><span>Image 01</span><div></div></li>
            <li><span>Image 02</span><div></div></li>
            <li><span>Image 03</span></div></li>
            <li><span>Image 04</span><div></div></li>
        </ul>


<?php 

if ( !isset ( $_COOKIE['login'] ) ) {
	?> <h3> User not logged in! </h3> 
	<a href="login.php">
		<input class ='mybutton' type="button" value="Return to Login" />
	</a> <?php
	die();
}

?>

<div class="container">
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
</div>


<script src="https://maps.googleapis.com/maps/api/js"></script>

<?php

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

