<?php
$host = 'localhost'; // адрес сервера
$database = 'market'; // имя базы данных
$user = 'root'; // имя пользователя
$password = 'root'; // пароль

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>