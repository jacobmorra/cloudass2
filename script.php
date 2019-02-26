<?php

require('vendor/autoload.php');

/* 
Jacob Morra, 100395426

This file is my script page for my application. Given the input address from index.php, the user has to find me using my location via Google Maps API and a Photo. I will receive a text of the user's location using the Twilio API.

*/


#PART 1 - CONNECT TO DATABASE - TESTED AND WORKS

#initialize new connection
$conn = new mysqli("us-cdbr-iron-east-03.cleardb.net", "b50feca8c93502", "e1c23b30", "heroku_9bc6fe309529a63");

#set address from index.php
$address = $_POST["address"];

#insert address into database
$sql = "INSERT INTO addresses(addresses) VALUES('$address')";


if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

/*
#PART 2 - TEXT MESSAGES - TESTED AND WORKS
require_once "vendor/autoload.php"; 
use Twilio\Rest\Client;

#authentication details
$account_sid = "AC5b4c9c99886a25e1761cfa33a8c05a6f";
$auth_token = "a484e3051393f77b58391ac3eac0c39f";
$twilio_phone_number = "+13658000322";

$client = new Client($account_sid, $auth_token);

#send a SMS message to phone
$client->messages->create(
    '2894040725',
    array(
        "from" => '+13658000322',
        "body" => $address
    )
);
*/
?>


<!DOCTYPE html>
<!-- PART 3 - GOOGLE MAPS API IMPLEMENTATION - TESTED AND WORKS -->
<html lang="en">
	<head>
		<title>Come Find Me</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<style>
			  /* Always set the map height explicitly to define the size of the div
			   * element that contains the map. */
			  #map {
				height: 600px;
			  }
			  /* Optional: Makes the sample page fill the window. */
			  html, body {
				height: 100%;
				margin: 0;
				padding: 0;
			  }
			  #floating-panel {
				position: absolute;
				top: 250px;
				left: 25%;
				z-index: 5;
				background-color: #fff;
				padding: 5px;
				border: 1px solid #999;
				text-align: center;
				font-family: 'Roboto','sans-serif';
				line-height: 30px;
				padding-left: 10px;
			  }

		</style>
	</head>
	<body>
		<div class="jumbotron text-center">
		  <h1>Come Find Me</h1> 
		</div>
		<div class="container">
			<div class="row">
				<div id="floating-panel">
				<b>Start: </b>
				<select id="start">
					<option value=""></option>
					<option value=<?php echo $_POST['address'] ?>><?php echo $_POST['address'] ?>
					</option>
				</select>
				<b>End: </b>
					<select id="end">
					<option value="2000 Simcoe Street North, ON">2000 Simcoe Street North, ON</option>
					</select>
			</div>
			Directions to me: <br>
			<div id="map"></div>
				<script>
				  function initMap() {
					var directionsService = new google.maps.DirectionsService;
					var directionsDisplay = new google.maps.DirectionsRenderer;
					var map = new google.maps.Map(document.getElementById('map'), {
					  zoom: 7,
					  center: {lat: 41.85, lng: -87.65}
					});
					directionsDisplay.setMap(map);

					var onChangeHandler = function() {
					  calculateAndDisplayRoute(directionsService, directionsDisplay);
					};
					document.getElementById('start').addEventListener('change', onChangeHandler);
					document.getElementById('end').addEventListener('change', onChangeHandler);
				  }

				  function calculateAndDisplayRoute(directionsService, directionsDisplay) {
					directionsService.route({
					  origin: document.getElementById('start').value,
					  destination: '2000 Simcoe Street North, ON',
					  travelMode: 'DRIVING'
					}, function(response, status) {
					  if (status === 'OK') {
						directionsDisplay.setDirections(response);
					  } else {
						window.alert('Directions request failed due to ' + status);
					  }
					});
				  }
				</script>
				<script async defer 
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCTyb4-Pduzn2umNzIUER9joB5EZdHoEs&callback=initMap">
				</script>

			</div>
		</div>
		<div class="container">
		<br>
		<br>		
		</div>

		<div class="container">			
			Photo of me: <br>
			<img src="fampic.jpg" height="600 px">
		</div>

		<div class="container">
		<br>
		<br>		
		</div>

		<div class="container">
		
<?php
require 'vendor/autoload.php';

use Google\Cloud\Vision\VisionClient;

// Authenticating with keyfile data.
$vision = new VisionClient([
    'keyFile' => json_decode(file_get_contents('key.json'), true)
]);

// Authenticating with a keyfile path.
$vision = new VisionClient([
    'keyFilePath' => 'key.json'
]);

// Providing the Google Cloud project ID.
$vision = new VisionClient([
    'projectId' => 'cloudass2-1551081154281'
]);

$images = [];

$picRes = fopen(__DIR__ . 'fampic.jpg', 'r');

$images[] = $vision->image($picRes, [
    'FACE_DETECTION'
]);

echo "test";
$result = $vision->annotateBatch($images);
		
?>		
		</div>
	</body>
</html>
