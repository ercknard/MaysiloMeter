

<?php

$host = "us-cdbr-east-04.cleardb.com";
$db = "heroku_5142987c57081a";
$username = "b64914f07d5e65";
$password = "f742c533";

try {
	$dsn = "mysql:host=$host;dbname=$db;charset=UTF8;";
	$pdo = new PDO($dsn, $username, $password, [
		PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC
	]);

} catch (PDOException $e) {
	echo $e->getMessage();
}
