<?php

function generateAuthToken($length = 25)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getUserIdByAuthToken($authToken) {
    include __DIR__ . '/../settings.php';
    $params = [$authToken];
    $sql = "SELECT `id` FROM `users` WHERE `authtoken` = ?;";
    $query = $pdo->prepare($sql);
    $query->execute($params);
    $user = $query->fetch(PDO::FETCH_OBJ);
    return $user->id;
}

function getUserEmailByAuthToken($authToken) {
    include __DIR__ . '/../settings.php';
    $params = [$authToken];
    $sql = "SELECT `email` FROM `users` WHERE `authtoken` = ?;";
    $query = $pdo->prepare($sql);
    $query->execute($params);
    $user = $query->fetch(PDO::FETCH_OBJ);
    return $user->email;
}

function isAuthorized() {
    if (isset($_COOKIE['authtoken'])) {
        return true;
    } else {
        return false;
    }
}