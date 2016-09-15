<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Главная</title>

</head>
<body>
<form method="post" action="">
    <label for="url" style="display:block">Вводите адресс начиная с http:// или https:// , если этого нет, по умолчанию
        будет добавлено http:// в начале </label>
    <input type="text" placeholder="Введите url" name="url">
    <input type="submit" name="go">
</form>

<?php
include 'robots.php';
if (isset($_POST['go']) && isset($_POST['url'])) {
    $robot = new robots($_POST['url']);
    print_r($robot->getResult());
    print_r($robot->getUrl());
}
?>
</body>
