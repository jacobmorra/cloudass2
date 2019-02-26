<?php
require('vendor/autoload.php');
// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
$s3 = Aws\S3\S3Client::factory();
$bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
?>





<html>
    <head><meta charset="UTF-8"></head>
    <body>
        <h1>Come Find Me</h1>
		<form action="script.php" method="post">
		Address: <input type="text" name="address"><br>
		<input type="submit">
		</form>		
		<a href="https://floating-beyond-79601.herokuapp.com/list.php">Files List</a>




<?php

#PART 1 - CONN TO DB - TESTED AND WORKS

$conn = new mysqli("us-cdbr-iron-east-03.cleardb.net", "b50feca8c93502", "e1c23b30", "heroku_9bc6fe309529a63");

$email = "frostdrive";

$sql = "INSERT INTO emails(emails) VALUES('$email')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


#PART 2 - TEXT MESSAGES - TESTED AND WORKS
require_once "vendor/autoload.php"; 
use Twilio\Rest\Client;

$account_sid = "AC42a738d7e606d6e74a1142967ec4df1a";
$auth_token = "a22ee4895ae1981f65d87a3f029bf7c9";
$twilio_phone_number = "2892744712";

$client = new Client($account_sid, $auth_token);

$client->messages->create(
    '2894040725',
    array(
        "from" => '2892744712',
        "body" => "Whaddup from PHP!"
    )
);

#PART 3 - USE GOOGLE MAPS API TO GET LOCATION
?>

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

<!-- PART 4 - USE GOOGLE VISION TO CLASSIFY PICS-->
<?php
/*
# includes the autoloader for libraries installed with composer
#require __DIR__ . '/vendor/autoload.php';

# imports the Google Cloud client library

use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\VisionClient;

#echo "hahaha";
# instantiates a client
#$imageAnnotator = new vision.ImageAnnotatorClient();

$vision = new VisionClient(['keyFile' => json_decode(file_get_contents("cloudviskey.json"),true)]);

echo "hahaha1";

$familyPhotoResource = fopen('https://www.photonottingham.co.uk/wp-content/uploads/2018/07/photonottingham-family-contemporary-square.jpg', 'r') or die('FUCK KEVIN');

echo "hahahah2";

$image = $vision->image($familyPhotoResource, ['FACE_DETECTION']);

echo "hahahaha3";
$result = $vision->annotate($image);

echo "hahahaha4";
if($result){
	echo "YEAH BITCH";
}
*/
/*
# the name of the image file to annotate
$fileName = 'test/data/wakeupcat.jpg';

# prepare the image to be annotated
$image = file_get_contents($fileName);

# performs label detection on the image file
$response = $imageAnnotator->labelDetection($image);
$labels = $response->getLabelAnnotations();

if ($labels) {
    echo("Labels:" . PHP_EOL);
    foreach ($labels as $label) {
        echo($label->getDescription() . PHP_EOL);
    }
} else {
    echo('No label found' . PHP_EOL);
}
*/
?>



<?php
echo "YOYOYO";

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    // FIXME: add more validation, e.g. using ext/fileinfo
    try {
        // FIXME: do not use 'name' for upload (that's the original filename from the user's computer)
        $upload = $s3->upload($bucket, $_FILES['userfile']['name'], fopen($_FILES['userfile']['tmp_name'], 'rb'), 'public-read');
?>
        <p>Upload <a href="<?=htmlspecialchars($upload->get('ObjectURL'))?>">successful</a> :)</p>
<?php } catch(Exception $e) { ?>
        <p>Upload error :(</p>
<?php } } ?>
        <h2>Upload a file</h2>
        <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
            <input name="userfile" type="file"><input type="submit" value="Upload">
        </form>
    </body>
</html>
