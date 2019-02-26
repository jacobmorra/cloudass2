<?php

require "vendor/autoload.php";

use Google\Cloud\Vision\VisionClient;

use Google\Cloud\Core\ServiceBuilder;

$gcloud = new ServiceBuilder([
    'keyFilePath' => 'cloudviskey.json',
    'projectId' => 'myProject'
]);

$storage = $gcloud->storage();

$bucket = $storage->bucket('myBucket');

echo "good";

/*
$vision = new VisionClient(['keyFile' => json_decode(file_get_contents("cloudviskey.json"),true)]);

$familyPhotoResource = fopen('fampic.jpg', 'r');

$image = $vision->image($familyPhotoResource, ['FACE_DETECTION', 'WEB_DETECTION']);

$result = $vision->annotate($image);

var_dump($result);

echo "hahahaha4";

*/
/*
if($result){
	echo "YEAH BITCH";
}
*/


?>
