<!DOCTYPE html>
<html>

<head>
    <title>Product List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    require_once 'connection.php';
    $connObj = new mysqli($host, $user, $password, $database);

    if ($connObj->connect_error) {
        echo "Connection failed: " . $connObj->connect_error;
    }
    
    $N = 3; 
    
    $filterCategory = isset($_GET['category']) ? $_GET['category'] : null;
   
    $filter = $filterCategory ? "WHERE category = '$filterCategory'" : "";
    
    $sqlCount = "SELECT COUNT(*) as total FROM games $filter";
    $resultCount = $connObj->query($sqlCount);
    $totalCount = $resultCount->fetch_assoc()['total'];
    
    $totalPages = ceil($totalCount / $N);
    
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; 
    $start = ($currentPage - 1) * $N; 

    $sqlCategories = "SELECT DISTINCT category FROM games";
    $resultCategories = $connObj->query($sqlCategories);

    echo "<div>";
    while($rowCat = $resultCategories->fetch_assoc()) {
        $category = $rowCat['category'];
        $active = isset($_GET['category']) && $_GET['category'] == $category ? "style='pointer-events: none; color: gray;'" : "";
        echo "<a href='showListGames.php?category=$category' $active>$category</a> ";
    }
    $active = !isset($_GET['category']) ? "style='pointer-events: none; color: gray;'" : "";
    echo "<a href='showListGames.php' $active>очитить фильтры</a> ";

    $filterCategory = isset($_GET['category']) ? $_GET['category'] : null;
    $filter = $filterCategory ? "WHERE category = '$filterCategory'" : "";
    $sql = "SELECT * FROM games $filter ORDER BY name LIMIT $start, $N";
    $result = $connObj->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<h2>" . $row["name"] . "</h2>";
            echo "<p>" . $row["description"] . "</p>";
            echo "<p>" . number_format($row["price"], 2) . "</p>"; 
            echo "<br>";
        }
    } else {
        echo "0 results";
    }

    echo "<div>";
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a href='showListGames.php?page=$i";
        if ($filterCategory) {
            echo "&category=$filterCategory";
        }
        echo "'>$i</a> ";
    }
    echo "</div>";

    $connObj->close();
    ?>
</body>
</html>
