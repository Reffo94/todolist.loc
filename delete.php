<?php

include __DIR__ . '/app/settings.php';

$id = [$_GET['id']];


$sql = "DELETE FROM tasks WHERE `tasks`.`id` = ?";
$query = $pdo->prepare($sql);
$query->execute($id);

header('location: index.php');
