<?php
require('vendor/autoload.php');
#PART 1 - CONN TO DB - TESTED AND WORKS

$conn = new mysqli("us-cdbr-iron-east-03.cleardb.net", "b50feca8c93502", "e1c23b30", "heroku_9bc6fe309529a63");

$address = $_POST["address"];

$sql = "INSERT INTO addresses(addresses) VALUES('$address')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<html>
    <head><meta charset="UTF-8"></head>
	<body>	
	<h1>Come Find Me</h1>
	<!--PART 3 - USE GOOGLE MAPS API TO GET LOCATION-->
	<div id="googleMap" style="width:100%;height:400px;"></div>

	<script>
	function myMap() {
	var mapProp= {
	  center:new google.maps.LatLng(51.508742,-0.120850),
	  zoom:5,
	};
	var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
	}
	</script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCTyb4-Pduzn2umNzIUER9joB5EZdHoEs&callback=myMap"></script>
	</body>
</html>
