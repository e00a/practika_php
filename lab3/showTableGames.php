<?php
echo "<!DOCTYPE html>
<html>
<head>
    <title>Product Table</title>
    <link rel=\"stylesheet\" href=\"style.css\">
</head>
<body>";

require_once 'connection.php';
$connObj = new mysqli($host, $user, $password, $database);
if ($connObj->connect_error) {
    echo "Ошибка соединения с базой данных: " . $connObj->connect_error;
}
//filters
$sql = "SELECT * FROM games WHERE 1=1";
if (isset($_GET['price']) && $_GET['price'] != '') {
    $price = $_GET['price'];
    $sql .= " AND price = $price";
}
if (isset($_GET['name']) && $_GET['name'] != '') {
    $name = $_GET['name'];
    $sql .= " AND name LIKE '%$name%'";
}
if (isset($_GET['description']) && $_GET['description'] != '') {
    $description = $_GET['description'];
    $sql .= " AND description LIKE '%$description%'";
}
//sorting
$sortBy = isset($_GET['sortBy']) ? $_GET['sortBy'] : 'name'; 
$sql .= " ORDER BY $sortBy";
if (isset($_GET['filter']) && $_GET['filter'] === 'no') {
    $sql = "SELECT * FROM games ORDER BY $sortBy";
}
$result = $connObj->query($sql);

echo "<form method=\"get\" action=\"showTableGames.php\" id=\"gameForm\">
    <input type=\"radio\" name=\"sortBy\" value=\"name\" id=\"sortByName\" " . (($sortBy === 'name') ? 'checked' : '') . "> <label for=\"sortByName\">Сортировать по названию</label>
    <input type=\"radio\" name=\"sortBy\" value=\"price\" id=\"sortByPrice\" " . (($sortBy === 'price') ? 'checked' : '') . "> <label for=\"sortByPrice\">Сортировать по цене</label>
    <button type=\"submit\">Сортировать</button>
    <br>
    <label for=\"name\">Введите название:</label>
    <input type=\"text\" name=\"name\" id=\"name\" value=\"" . (isset($_GET['name']) ? $_GET['name'] : '') . "\">
    <br>
    <label for=\"description\">Введите описание:</label>
    <input type=\"text\" name=\"description\" id=\"description\" value=\"" . (isset($_GET['description']) ? $_GET['description'] : '') . "\">
    <br>
    <label for=\"price\">Введите цену:</label>
    <input type=\"text\" name=\"price\" id=\"price\" value=\"" . (isset($_GET['price']) ? $_GET['price'] : '') . "\">
    <br>
    <button type=\"submit\" name=\"filter\" value=\"yes\">Фильтровать</button>
    
    <button type=\"submit\" name=\"filter\" value=\"no\"><a class=\"btn\" href=\"http://localhost/lab3/showTableGames.php?sortBy=$sortBy&name=&description=&price=\">Очистить</a></button>
</form>";

echo "<form method='post' action='editTable.php'>
<button name='ins' type='submit'>Добавить</button>
</form>";

//table
if ($result->num_rows > 0) {
    echo "<table class=\"table\">";
    echo "<tr><th><a href=\"showTableGames.php?sortBy=name\">Name</a></th>
    <th><a href=\"showTableGames.php?sortBy=description\">Description</a></th>
    <th><a href=\"showTableGames.php?sortBy=price\">Price</a></th>
    <th>Actions</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . number_format($row["price"], 2) . "</td>";
        echo "<td><form method='get' action='editTable.php'>
        <input type='hidden' name='id' value='" . $row["idGame"] . "'>
        <button type='submit' >Удалить</button>
        </form></td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "0 results";
}
$connObj->close();

echo "</body>
</html>";
?>
































 <!-- <button type=\"submit\" name=\"filter\" value=\"no\">Очистить</button> -->