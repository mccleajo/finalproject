<!DOCTYPE html>

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>Welcome to BMWLand</title>
     <link rel="stylesheet" type="text/css" href="projectstyle.css">

     <style>
	 select, option {font-size: 150%;}
	 </style>

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
        <li><a href="events.php">Events</a></li>
        <li><a href="posts.php">Posts</a></li>
        <li><a class="active" href="findprices.php">Prices</a></li>
        <li><a href="logout.php">Log Out</a></li>
      </ul>
    </div>
</header>

<?php

if ( isset ( $_POST['submit'] ) ) {

	$name = $_POST['bmw'];
	findpricing( $name);

}

findpricingform();
sortbmws();

?>

</body>
</html>

<?php

function findpricingform( ){

?>

<div align = "center"><Br>
	<form method="post">
<?php
	$filename = 'bmws.txt';
	$bmws = sortbmws();
	?><select name="bmw"><?php
	foreach ($bmws as $id => $name){
		?> <option value='<?php echo "$id"; ?>'><?php echo "$name"; ?></option><?php
	}
	?>
	</select>
	<br><br>
	<input class = 'mybutton' type='submit' value='Choose a BMW' name='submit'>
	</form>
</div>

<?php
}

function sortbmws(){

	$filename = 'bmws.txt';
	$bmws = file($filename);
	$ids = array();
	
	foreach ($bmws as $bmw){
		$info = explode(",", $bmw);
		$name = substr(urlencode($info[0]), 3);
		$id = $info[1];
		$ids[$name] = $id;
	}
	asort($ids);
	return $ids;
}

function findpricing($id){
	$bmws = sortbmws();
	if (False != file_get_contents('https://api.edmunds.com/v1/api/tmv/tmvservice/calculatenewtmv?styleid='.'200'.$id.'&zip=02467&fmt=json&api_key=cbzsd8kr9usnmssk2aqqy2t9')){
		$info = file_get_contents('https://api.edmunds.com/v1/api/tmv/tmvservice/calculatenewtmv?styleid='.'200'.$id.'&zip=10803&fmt=json&api_key=cbzsd8kr9usnmssk2aqqy2t9');
		$json = json_decode($info, true);
	}
	$name = $bmws[$id];
	echo "<br>The MSRP price of a $name is: \$" . $json['tmv']['nationalBasePrice']['baseMSRP'];
}
