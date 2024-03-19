<?php
include 'header.php';
echo "<main><div class=\"wrapper\">";
if (isset($_GET['game_id']) && !empty($_GET['game_id'])) {
    $game_id = $_GET['game_id'];

    $stmt = $pdo->prepare("SELECT * FROM games WHERE idGame = :game_id");
    $stmt->bindParam(':game_id', $game_id);
    $stmt->execute();

    $game = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($game) {
        echo "<div class='content'>";
        if (!empty($game['logo'])) {
            echo "<img class='logo' src='logos/" . $game['logo'] . "' alt='Game Logo'>";
        }
        echo "<div class='game-info'>";
        echo "<h2>" . $game['name'] . "</h2><br>";
        echo "<p>" . $game['description'] . "</p><br>";
        echo "<h4 style='font-weight: lighter; font-size: 20px;'>Price: $" . number_format($game['price'], 2) . "</h4>";
        
        echo "<form method='post'>";
        echo "<input type='hidden' name='game_id' value='$game_id'>";

        $stmtCheckCart = $pdo->prepare("SELECT COUNT(*) as count FROM cart WHERE idGame = :game_id");
        $stmtCheckCart->bindParam(':game_id', $game_id);
        $stmtCheckCart->execute();
        $result = $stmtCheckCart->fetch(PDO::FETCH_ASSOC);

        $is_in_cart = $result['count'] > 0;

        if ($is_in_cart) {
            echo "<button type='button' disabled>Товар в корзине</button>";
        } else {
            $stmtCart = $pdo->prepare("INSERT INTO cart (idGame) VALUES (:game_id)");
            $stmtCart->bindParam(':game_id', $game_id);
            $stmtCart->execute();
            echo "<button type='submit' name='add_to_cart'>Добавить в корзину</button>";
        }
        echo "</form>";

        echo "</div>";
        echo "</div>";

        $stmtPhotos = $pdo->prepare("SELECT photo FROM photos WHERE idGame = :game_id");
        $stmtPhotos->bindParam(':game_id', $game_id);
        $stmtPhotos->execute();

        $photos = $stmtPhotos->fetchAll(PDO::FETCH_ASSOC);

        if ($photos) {
            echo "<h4>Game Images:</h4>";
            echo "<div class='grid'>";
            foreach ($photos as $photo) {
                echo "<img class='photo' src='photos/" . $photo['photo'] . "' alt='Game Image'>";
            }
            echo "</div>";
        }
    } else {
        echo "Game not found.";
    }
} else {
    echo "game_id parameter is not specified.";
}
echo "</div></main>";
include 'footer.php';
?>