<?php 
require_once 'connection.php'; 

echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>My Website</title>
    <link rel=\"stylesheet\" href=\"style.css\">
</head>
<body>
    <header>
    <a href=\"index.php\"><h2 class=\"logo\">GGames</h2></a>
        <nav class=\"navigation\">";

    $categoryFilter = isset($_GET['category']) ? $_GET['category'] : 'all';
    $sql = "SELECT DISTINCT category FROM games";
    $stmt = $pdo->query($sql);

    $stmt->execute();
    $resultCategories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($resultCategories as $rowCat) {
        $category = $rowCat['category'];
        $active = isset($_GET['category']) && $_GET['category'] == $category ? "style='pointer-events: none; color: #7b7b7b;'" : "";
        echo "<a href='index.php?category=$category' $active>$category</a>";
    }
    echo "</nav></header>";
?>
