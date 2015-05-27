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

//Function that is going to connect to Instagram
function connectToInstagram($url){
	$ch = curl_init();

	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => 2,
	));
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}
//Function to get userID cause userName doesn't allow us to get pictures!
function getUserID($userName){
	$url = 'https://api.instagram.com/v1/users/search?q=\"ayoooodrew\"&client_id='.clientID;
	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true);

	return $results['data']['0']['id']; //echoing out userID.
}
//Function to print out image onto screen
function printImages($userID){
	$url = 'https://api.instagram.com/v1/users/' . $userID . '/media/recent?client_id='.clientID . '&count=5';
	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true);
	require_once(__DIR__ . "/view/header.php");

	//Parse through thet information one by one
	foreach ($results['data'] as $items){
	 	$image_url = $items['images']['low_resolution']['url']; //go through all of the results and give back the url of those pictures because we want to save it in the php server.
	 	echo '<img class="ig-pic" src=" '. $image_url .' "/><br/>';
	 	//calling a function to save that $image_url
	 	savePictures($image_url);
	 }
	 require_once(__DIR__ . "../view/footer.php");
}
//Function to save image to server
function savePictures($image_url){
	//echo $image_url .'<br>'; 
	echo '<head>
			<link rel="stylesheet" href="css/main.css" 
			</head>';

			echo '<body id="body-class">';

	$filename = basename($image_url);//the filename is what we are storing. basename is the PHP built in method that we are using to store $image_url
	//echo $filename . '<br>';

	$destination = ImageDirectory . $filename; //maiking sure that the image doesnt exist in the storage.
	file_put_contents($destination, file_get_contents($image_url)); //goes and grabs an imagefile and stores it into our server.
}


if (isset($_GET['code'])) {
	$code = $_GET['code'];
	$url = 'https://api.instagram.com/oauth/access_token';
	$access_token_settings =  array('client_id' => clientID,
								   'client_secret' => clientSecret,
								   'grant_type' => 'authorization_code',
								   'redirect_uri' => redirectURI,
								   'code' => $code);

								  
//Curl is a library that lets you make HTTP requests($_GET[] or $_POST[]) in PHP.
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$result = curl_exec($curl);
curl_close($curl);

$results = json_decode($result, true);
$userName = $results['user']['username'];

$userID = getUserID($userName);

printImages($userID);
}
else {
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Guillermo</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="author" href="humans.txt">
	</head>
	<body>
	<!-- Creating a login for people to go and give approval for our web app to access their Instagram Account
	After getting approval we are now going to have the information so that we can play with it
	-->
	<title></title>
		<div class="login">
			<a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI; ?>&response_type=code">LOGIN</a>
			<script type="js.main.js"></script>
		</div>
	</body>
</html>
<?php
}
?>