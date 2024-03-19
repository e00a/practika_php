<!DOCTYPE html>
<html>
<head>
    <title>Product Table</title>
</head>
<body>
<?php
require_once 'connection.php';
$connObj = new mysqli($host, $user, $password, $database);

if ($connObj->connect_error) {
    echo "Ошибка соединения с базой данных: " . $connObj->connect_error;
}

$sql = "SELECT * FROM games";
if (isset($_GET['price']) && $_GET['price'] != '') {
    $price = $_GET['price'];
    $sql .= " WHERE price = $price";
}
$sortBy = isset($_GET['sortBy']) ? $_GET['sortBy'] : 'name'; 
$sql .= " ORDER BY $sortBy";


$result = $connObj->query($sql);
    ?>

    <form method="get" action="showTableGames.php">
    <input type="radio" name="sortBy" value="name" id="sortByName" <?php echo ($sortBy === 'name') ? 'checked' : ''; ?>> <label for="sortByName">Сортировать по названию</label>
    <input type="radio" name="sortBy" value="price" id="sortByPrice" <?php echo ($sortBy === 'price') ? 'checked' : ''; ?>> <label for="sortByPrice">Сортировать по цене</label>
    <button type="submit">Сортировать</button>
    </form>

    <br>

    <form method="GET" action="showTableGames.php">
        <label for="price">Введите цену:</label>
        <input type="text" name="price" id="price" value="<?php echo isset($_GET['price']) ? $_GET['price'] : ''; ?>">
        <button type="submit">Фильтровать</button>
    </form>
    
<?php


if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th><a href=\"showTableGames.php?sortBy=name\">Name</a></th>
    <th><a href=\"showTableGames.php?sortBy=description\">Description</a></th>
    <th><a href=\"showTableGames.php?sortBy=price\">Price</a></th>
    </tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . number_format($row["price"], 2) . "</td>"; // Денежный формат с знаком рубля
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "0 results";
}

$connObj->close();
?>
</body>
</html>