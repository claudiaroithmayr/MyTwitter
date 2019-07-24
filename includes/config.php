<?php
ob_start();
session_start();

//database credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','mytwitter');

$db = new PDO('mysql:host=localhost;dbname='. DBNAME, DBUSER, DBPASS);
