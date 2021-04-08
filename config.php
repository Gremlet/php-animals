<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$dbname = 'zoo';
$user = 'zooAdmin';
$password = 'zoo';

$dbh = new PDO('mysql:host=localhost;dbname=zoo', $user, $password);
