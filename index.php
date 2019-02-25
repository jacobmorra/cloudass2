<?php

session_start();

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


?>
