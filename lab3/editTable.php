<?php
echo "<!DOCTYPE html>
<html>
<head>
    <title>Edit game</title>
    <link rel=\"stylesheet\" href=\"style.css\">
</head>
<body>";
if(isset($_GET['delete']) && $_GET['delete'] == 'true'){
    if (isset($_GET['id']) && $_GET['id'] != ''){  
        echo "<h1>удалить игру?</h1>
        <form method=\"get\" action=\"saveTable.php\">
        <input type='hidden' name='id' value='" . $_GET["id"] ."'> 
        <button type='submit' name='delete' value='true'>Да</button>
        </form>
        <form method='get' action='showTableGames.php'>
        <button type='submit' name='confirm' value='no'>Нет</button>
        </form>
        <br>";
    } else {
        echo "<h1>игра не передана</h1>";
    }
}

if(isset($_GET['ins']) && $_GET['ins'] == 'true'){
    echo "<form method='post' action='saveTable.php'>
        
    <label for='name'>Название:</label>
    <input type='text' id='name' name='name'><br><br>

    <label for='description'>Описание:</label>
    <input type='text' id='description' name='description'><br><br>

    <label for='category'>Категория:</label>
    <input type='text' id='category' name='category'><br><br>

    <label for='price'>Цена:</label>
    <input type='text' id='price' name='price' ><br><br>

    <button type='submit' name='add' value='true'>Сохранить</button>
    </form>
    </body>
    </html>";
}
?>