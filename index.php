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
<hr>
		<form action="script.php" method="post">
		Address: <input type="text" name="address" id="address"><br>
		<input type="submit">
		</form>	
<hr>
		<form action="script2.php" method="post">
		Picture of Me: <input type="text" name="picture" id="picture"><br>
		<input type="submit">
		</form>	
    </body>
</html>
