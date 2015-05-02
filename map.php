<?php

include 'geocoding.php';

$address = $_POST['address'];
$location = getCoordinates($address);

$results = finddealerships($address);

$dealerships = $results[0];
$amount = count($dealerships);
$latitudes = $results[1];
$longitudes = $results[2];

$i = 0;
foreach ( $dealerships as $dealership ) {
	$dealershipid = urlencode($dealership);
	$value = "dealer" . "$i";
	echo "<input type='hidden' value='$dealershipid' id='$value'>\n";
	$i = $i + 1;
}

$j = 0;
foreach ( $latitudes as $latitude ) {
	$latitudeid = urlencode($latitude);
	$value = "latitude" . "$j";
	echo "<input type='hidden' value='$latitudeid' id='$value'>\n";
	$j = $j + 1;
}

$k = 0;
foreach ( $longitudes as $longitude ) {
	$longitudeid = urlencode($longitude);
	$value = "longitude" . "$k";
	echo "<input type='hidden' value='$longitudeid' id='$value'>\n";
	$k = $k + 1;
}

?>
<input type='hidden' value="<?php echo $location['latitude'];  ?>" id='latitude' >
<input type='hidden' value="<?php echo $location['longitude']; ?>" id='longitude' >
<input type='hidden' value="<?php echo $amount; ?>" id='amount' >
<script>

function initialize() {
	var mapCanvas = document.getElementById('map-canvas');
	var latitude=document.getElementById("latitude").value;
	var longitude=document.getElementById("longitude").value;	
	var mapOptions = {
  		center: new google.maps.LatLng(latitude, longitude),
  		zoom: 10,
  		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var map = new google.maps.Map(mapCanvas, mapOptions);
	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(latitude, longitude),
		map: map,
		title: 'Hello World!'
		});
	var amount=document.getElementById("amount").value;
	for (i = 0; i < amount; i++){
		var dealer = document.getElementById("dealer" + i).value;
		var markerlat = document.getElementById("latitude" + i).value;
		var markerlng = document.getElementById("longitude" + i).value;
		var marker = new google.maps.Marker( {
			position: new google.maps.LatLng(markerlat, markerlng),
			map: map,
			title: "test"
		} ) ;
	}
}
google.maps.event.addDomListener(window, 'load', initialize);

</script>

<?php




