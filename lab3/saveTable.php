<?php

require_once 'connection.php';
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['query']) && $_POST['query'] == 'delete') {
    echo "Игра успешно удалена. id: $id";
}
if(isset($_POST['query']) && $_POST['query'] == 'add') {
    echo "Игра успешно добавлена";
}
if(isset($_POST['query']) && $_POST['query'] == 'edit') {
    echo "Игра успешно изменена";
}
echo "<a href=\"http://localhost/lab3/showTableGames.php\">на главную</a>";

?>