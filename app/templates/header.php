<?php
include __DIR__ . '/../settings.php';
include __DIR__ . '/../sourse/functions.php';

$authLink = '';
$userEmail = '';
$emailLink = '';

if (!empty($_COOKIE['authtoken'])) {
    $userEmail = getUserEmailByAuthToken($_COOKIE['authtoken']);
}

if (isAuthorized()) {
    $authLink = '<li><a href="logout.php" title="Выйти из аккаунта">Выход</a></li>';
    $emailLink = "<h2>Привет $userEmail </h2>";
} else {
    $authLink = '<li><a href="login.php">Вход</a></li>
    <li><a href="registration.php">Регистрация</a></li>';
    $emailLink = '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todolist</title>
    <link rel="stylesheet" href="/app/styles/main.css">
</head>

<body>
    <header>
        <h2>
            <a href="index.php">Мои записи</a>
        </h2>
        <ol>
            <li><?= $emailLink ?></li>
        </ol>
        <ol>
            <?= $authLink ?>
        </ol>
    </header>

    <main>