<?php

# includes the autoloader for libraries installed with composer
require __DIR__ . '/vendor/autoload.php';

# imports the Google Cloud client library
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

# instantiates a client
$imageAnnotator = new ImageAnnotatorClient(['keyFile' => json_decode(file_get_contents("cloudviskey.json"),true)]);

# the name of the image file to annotate
$fileName = 'test/data/wakeupcat.jpg';

echo "yo";

# prepare the image to be annotated
$image = file_get_contents($fileName);

# performs label detection on the image file
$response = $imageAnnotator->labelDetection($image);

/*session_start();

require "vendor/autoload.php";

use Google\Cloud\Vision\VisionClient;

$vision = new VisionClient(['keyFile' => json_decode(file_get_contents("cloudviskey.json"),true)]);

$familyPhotoResource = fopen('https://www.photonottingham.co.uk/wp-content/uploads/2018/07/photonottingham-family-contemporary-square.jpg', 'r') or die('FUCK KEVIN');

$image = $vision->image($familyPhotoResource, ['FACE_DETECTION', 'WEB_DETECTION']);

$result = $vision->annotate($image);

echo "hahahaha4";

/*
if($result){
	echo "YEAH BITCH";
}
*/
*/

?>
