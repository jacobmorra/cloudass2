<?php
/* 
Jacob Morra, 100395426

This file 
*/

require('vendor/autoload.php');
// this will simply read AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY from env vars
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>Come Find Me</h1> 
</div>
  
<div class="container">
  <div class="row">
    <form action="script.php" method="post">
		Address: <input type="text" name="address" id="address"><br>
		<input type="submit">
		</form>	
  </div>
</div>

</body>
</html>
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
