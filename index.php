<?php
//Configuration for our PHP Server
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

//Make Constants using define.
define('client_id', '3f99e2faa923415b458ab0c4c4b991e');
define('client_secret', '70d20d0e81714447a98791fb1d69bef8');
define('redirectURI', 'http://localhost/Andrew/index.php');
define('ImageDirectory', 'pics/');
?>


<!-- CLIENT INFO
CLIENT ID 3f99e2faa923415b458ab0c4c4b991e
CLIENT SECRET 70d20d0e81714447a98791fb1d69bef8
WEBSITE URL http://localhost/Andrew/index.php
REDIRECT URI http://localhost/Andrew/index.php -->