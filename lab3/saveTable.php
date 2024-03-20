<?php

require_once 'connection.php';
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['delete']) && $_GET['delete'] == 'true') {
    $id = $_GET['id'];
    $sql = "DELETE FROM games WHERE idGame = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Игра успешно удалена. id: $id";
    } else {
        echo "Ошибка при удалении игры: " . $conn->error;
    }
} else if (isset($_POST['add']) && $_POST['add'] == 'true') {  
    if(isset($_POST['name']) && !empty($_POST['name']) 
        && isset($_POST['description']) && !empty($_POST['description']) 
        && isset($_POST['category']) && !empty($_POST['category'])){

        $name = $_POST['name'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $price = isset($_POST['price']) ? floatval($_POST['price']) : -1;
        
        if ($price >= 0) {        
            $sql = "INSERT INTO games (`name`, `description`, category, price) VALUES ('$name', '$description', '$category', $price)";
            
            if ($conn->query($sql) === TRUE) {
                echo "Данные успешно добавлены в таблицу games " . $conn->info;
            } else {
                echo "Ошибка при добавлении данных в таблицу games: " . $conn->error;
            }
        } else {
            echo "цена не валидна.";
        }
    } else {
        echo "данных нет";
    }
} else {
    echo "Неверный запрос для удаления игры.";
}

echo "<br><a href=\"http://localhost/lab3/showTableGames.php\">на главную</a>";

$conn->close();
?>