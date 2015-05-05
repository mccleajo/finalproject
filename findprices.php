<!DOCTYPE html>

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>Welcome to BMWLand</title>

</head>
<body>

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
	<br>
	Zip Code:<input type='text' name='zip'><br>
	<input type='submit' value='Choose a BMW' name='submit'>
	</form>
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
	if (False != file_get_contents('https://api.edmunds.com/v1/api/tmv/tmvservice/calculatenewtmv?styleid='.$id.'&zip=02467&fmt=json&api_key=cbzsd8kr9usnmssk2aqqy2t9')){
		$info = file_get_contents('https://api.edmunds.com/v1/api/tmv/tmvservice/calculatenewtmv?styleid='.$id.'&zip=10803&fmt=json&api_key=cbzsd8kr9usnmssk2aqqy2t9');
		$json = json_decode($info, true);
	}
	$name = $bmws[$id];
	echo "The MSRP price of $name is: " . $json['tmv']['nationalBasePrice']['baseMSRP'];



}
