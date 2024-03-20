<?php
echo "<!DOCTYPE html>
<html>
<head>
    <title>Edit Table</title>
    <link rel=\"stylesheet\" href=\"style.css\">
</head>
<body>";

require_once 'connection.php';
$connObj = new mysqli($host, $user, $password, $database);
if ($connObj->connect_error) {
    echo "Ошибка соединения с базой данных: " . $connObj->connect_error;
}

echo "<h1>Удалить этот товар?</h1>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm'])) {
        if ($_POST['confirm'] == 'delete') {
            $game_id = $_GET['id'];

            $sql = "DELETE FROM games WHERE idGame = 3";

            if ($connObj->query($sql) === TRUE) {
                echo "Товар успешно удален. Информация: " . $connObj->info;
            } else {
                echo "Ошибка при удалении товара: " . $connObj->error;
            }
        } elseif ($_POST['confirm'] == 'cancel') {
            header("Location: showTableGames.php");
            exit();
        }
    }
}

echo "<form method=\"post\" action=\"editTable.php\">
    <input type=\"hidden\" name=\"id\" value=\"" . $_Get['id'] . "\">
    <button type=\"submit\" name=\"confirm\" value=\"delete\">Да</button>
</form>
<form method=\"post\" action=\"editTable.php\">
    <button type=\"submit\" name=\"confirm\" value=\"cancel\">Нет</button>
</form>
<br>";

echo "<form method=\"post\" action=\"saveTable.php\">
    <label for=\"name\">Название:</label>
    <input type=\"text\" id=\"name\" name=\"name\"><br><br>
    
    <label for=\"description\">Описание:</label>
    <input type=\"text\" id=\"description\" name=\"description\"><br><br>

    <label for=\"category\">Категория:</label>
    <input type=\"text\" id=\"category\" name=\"category\"><br><br>

    <label for=\"price\">Цена:</label>
    <input type=\"text\" id=\"price\" name=\"price\"><br><br>
    
    <button type=\"submit\" name=\"confirm\" value=\"save\">Сохранить</button>
</form>";

echo "</body></html>";
?>