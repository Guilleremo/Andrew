<?php
//Configuration for our PHP Server
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

//Make Constants using define.
define('clientID', '3f99e2faa9234151b458ab0c4c4b991e');
define('clientSecret', '70d20d0e81714447a98791fb1d69bef8');
define('redirectURI', 'http://localhost/Andrew/index.php');
define('ImageDirectory', 'pics/');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Untitled</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="author" href="humans.txt">
	</head>
	<body>
	<!-- Creating a login for people to go and give approval for our web app to access their Instagram Account
	After getting approval we are now going to have the information so that we can play with it
	-->
	<title></title>
		<a href="	https://api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI; ?>&response_type=code">LOGIN</a>
		<script type="js.main.js"></script>
	</body>
</html>