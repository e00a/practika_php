<?php

require_once 'connection.php';
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
    $id = $_POST['id'];
    $sql = "DELETE FROM games WHERE idGame = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Игра успешно удален. id: $id";
    } else {
        echo "Ошибка при удалении игры: " . $conn->error;
    }
} else {
    echo "Неверный запрос для удаления игры.";
}
echo "<a href=\"http://localhost/lab3/showTableGames.php\">на главную</a>";

$conn->close();
?>