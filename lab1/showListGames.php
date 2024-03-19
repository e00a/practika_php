<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
</head>
<body>
    <?php
    require_once 'connection.php';
    $connObj = new mysqli($host, $user, $password, $database);

    if ($connObj->connect_error) {
        echo "Connection failed: " . $connObj->connect_error;
    }
    
    $N = 3; 
    
    $sqlCount = "SELECT COUNT(*) as total FROM games";
    $resultCount = $connObj->query($sqlCount);
    $totalCount = $resultCount->fetch_assoc()['total'];
    
    $totalPages = ceil($totalCount / $N); 
    
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; 
    $start = ($currentPage - 1) * $N; 
    
    $sql = "SELECT * FROM games ORDER BY name LIMIT $start, $N";
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
        echo "<a href='showListGames.php?page=$i'>$i</a> ";
    }
    echo "</div>";

    $connObj->close();
    ?>
</body>
</html>

