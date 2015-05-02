<?php

function finddealerships($address){

	$geocodeURL = "https://maps.googleapis.com/maps/api/place/nearbysearch/xml?";
   	$location = getCoordinates($address);
   	$latitude = $location['latitude'];
   	$longitude = $location['longitude'];
   	
   	$locationurl = "location=" . urlencode($latitude) . "," . urlencode($longitude);
   	$radiusurl = "radius=50000";
   	$typesurl = "types=car_dealer";
   	$nameurl = "name=BMW";
   	
   	$key = "key=AIzaSyDAn2VpCvXzaNCYtQs_dNM6_p9_rYYCxtc";
   	$geocoderequest = "$geocodeURL$locationurl" . "&" . $radiusurl . "&" . $typesurl . "&" . $nameurl . "&" . $key ;
	$xml= new SimpleXMLElement( file_get_contents( $geocoderequest ) );
   		
   	if($xml->status != 'OK') {
   		return array("$geocoderequest");
   	}
 	
   	$results = $xml->result;
   	$dealerships = array();
   	$dealershiplats = array();
   	$dealershiplngs = array();
   	
   	foreach ( $results as $result ) {
   	
		$dealerships[] = $result->name;
		$dealershiplats[] = $result->geometry->location->lat;
		$dealershiplngs[] = $result->geometry->location->lng;
	
   	}
   	
   	return array($dealerships, $dealershiplats, $dealershiplngs);


}

function getCoordinates($address){

	$geocodeURL = "https://maps.googleapis.com/maps/api/geocode/xml?";
   	$address = "address=" . urlencode($address);
   	$key = "AIzaSyDnOvPDSoBunOcRtOKMN41lNbO09R51k2U";
   	$geocoderequest = "$geocodeURL$address" . "&" . $key;
	$xml= new SimpleXMLElement( file_get_contents( $geocoderequest ) );
   		
   		if($xml->status != 'OK') {
   			return;
   		}

   	$latitude = $xml->result->geometry->location->lat;
   	$longitude = $xml->result->geometry->location->lng;
   	
   	$location = array("latitude" => $latitude, "longitude" => $longitude);
   	
   	return $location;


}

?>