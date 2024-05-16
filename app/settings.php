<?php


$db = ['host' => 'localhost', 'dbname' => 'todolist', 'user' => 'root', 'password' => ''];

try {
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'], $db['user'], $db['password']);
} catch (PDOException $e) {
    echo 'Ошибка соединения с базой данных ' . $e->getMessage();
    die;
}
