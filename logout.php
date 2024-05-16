<?php 
include __DIR__ . '/app/settings.php';
include __DIR__ . '/app/sourse/functions.php';


$oldToken = $_COOKIE['authtoken'];
setcookie('authtoken', '', -1);

$authtoken = generateAuthToken();
$params = [$authtoken, $oldToken];
$sql = "UPDATE `users` SET `authtoken` = ? WHERE `authtoken` = ?;";
$query = $pdo->prepare($sql);
$query->execute($params);

header('location: index.php');