<?php 
require_once 'header.php'; 

echo "<main><div class=\"wrapper\">";

    $filterCategory = isset($_GET['category']) ? $_GET['category'] : null;
    $condition = isset($filterCategory) ? "WHERE category = '$categoryFilter' " : " ";
    $sql = "SELECT idGame, name, description FROM games $condition ORDER BY `name`";
    $stmt = $pdo->query($sql);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($products) > 0) {
        foreach ($products as $product) {
            // Вывод названия товара в заголовке и описания товара в параграфе
            echo "<h3>" . $product['name'] . "</h3>";
            echo "<p>" . $product['description'] . "</p>";
            echo "<a href='info.php?game_id=" . $product['idGame'] . "'>Подробнее</a>";
            echo "<br><br>";
        }
    } else {
        echo "Нет товаров.";
    }

echo "</div></main>";

include 'footer.php'; ?>