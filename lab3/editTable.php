<!DOCTYPE html>
<html>
<head>
    <title>Подтверждение удаления товара</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Вы уверены, что хотите удалить этот товар?</h1>

<form method="post" action="saveTable.php">
    <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
    <button type="submit" name="confirm" value="yes">Да</button>
</form>

<form method="post" action="showTableGames.php">
    <button type="submit" name="confirm" value="no">Нет</button>
</form>

<br>

<form method="post" action="saveTable.php">
    
        <label for="name">Название:</label>
        <input type="text" id="name" name="name"><br><br>
        
        <label for="description">Описание:</label>
        <input type="text" id="description" name="description"><br><br>

        <label for="category">Категория:</label>
        <input type="text" id="category" name="category"><br><br>

        <label for="price">Цена:</label>
        <input type="text" id="price" name="price"><br><br>
        
        <button type="submit" name="confirm" value="save">Сохранить</button>
    </form>
</body>
</html>