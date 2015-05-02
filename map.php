<?php

include 'geocoding.php';

$address = $_POST['address'];
$location = getCoordinates($address);

$results = finddealerships($address);

$dealerships = $results[0];
$latitudes = $results[1];
$longitudes = $results[2];
$i = 0;


?> <!-- <div class='dealerships'> --> <?php
// foreach ( $dealerships as $dealership ) {
// 	$dealershipid = urlencode($dealership);
// 	$latitudeid = urlencode($dealership . "latitude");
// 	$longitudeid = urlencode($dealership . "longitude");
// 	echo "<input type='hidden' value='$dealershipid' id='$dealershipid'>";
// 	echo "<input type='hidden' value='$latitudes[$i]' id='$latitudeid'>";
// 	echo "<input type='hidden' value='$longitudes[$i]' id='$longitudeid'>";
// }
?> <!-- </div>  --><?php


foreach ( $dealerships as $dealership ) {
?> <div class='dealers'> <?php
	$dealershipid = urlencode($dealership);
	echo "<input type='hidden' value='$dealershipid' id='$dealershipid'>";
?> </div> <?php
}


?> <div class='latitudes'> <?php
foreach ( $latitudes as $latitude ) {
	$latitudeid = urlencode($latitude);

	echo "<input type='hidden' value='$latitudeid' id='$latitudeid'>";
?> </div> <?php
}


?> <div class='longitudes'> <?php
foreach ( $longitudes as $longitude ) {
	$longitudeid = urlencode($longitude);
	echo "<input type='hidden' value='$longitudeid' id='$longitudeid'>";
	$i += 1;
?> </div> <?php
}

?>

<input type='hidden' value="<?php echo $location['latitude'];  ?>" id='latitude' >
<input type='hidden' value="<?php echo $location['longitude']; ?>" id='longitude' >

<script>

function initialize() {
	var mapCanvas = document.getElementById('map-canvas');
	var latitude=document.getElementById("latitude").value;
	var longitude=document.getElementById("longitude").value;	
	var mapOptions = {
  		center: new google.maps.LatLng(latitude, longitude),
  		zoom: 12,
  		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var map = new google.maps.Map(mapCanvas, mapOptions)
	var dealerships=document.getElementsByClassName("dealers");
	var latitudes=document.getElementsByClassName("latitudes");
	var longitudes=document.getElementsByClassName("longitudes");	
	
// 	var marker = new google.maps.Marker({
// 		position: new google.maps.LatLng(latitude, longitude),
// 		map: map,
// 		title: 'Hello World!'
// 		});

	for (i = 0; i < dealerships.length; i++){
		var dealership = dealerships[i];
		var markerlat = latitudes[i];
		var markerlng = longitudes[i];
		var latlng = new google.maps.LatLng(markerlat, markerlng);
		var marker = new google.maps.Marker( {
			position: latlng,
			map: map,
			title: "test"
		} ) ;
	}
}
google.maps.event.addDomListener(window, 'load', initialize);

</script>

<?php


