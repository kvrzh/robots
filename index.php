<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Главная</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
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
include 'rules.php';
if (isset($_POST['go']) && isset($_POST['url'])) {
    $robot = new robots($_POST['url']);
    $result = $robot->getResult();
    $name = $robot->getUrl();
}
?>
<h1><?= $name ?></h1>
<table>
    <tr>
        <td>Название</td>
        <td>ОК/Ошибка</td>
        <td>Состояние</td>
        <td>Рекомендации</td>
    </tr>
    <tr>
        <td>Проверка наличия файла robots.txt</td>
        <td><?php if ($result['isExists'] === true) echo '<span class="success">Ок</span>'; else echo '<span class="error">Ошибка</span>' ?></td>
        <td><?php if ($result['isExists'] === true) echo '<span class="success">' . $rules['isExists']['true']['Состояние'] . '</span>'; else echo '<span class="error">' . $rules['isExists']['false']['Состояние'] . '</span>' ?></td>
        <td><?php if ($result['isExists'] === true) echo '<span class="success">' . $rules['isExists']['true']['Рекомендации'] . '</span>'; else echo '<span class="error">' . $rules['isExists']['false']['Рекомендации'] . '</span>' ?></td>
    </tr>
    <tr>
        <td>Проверка указания директивы Host</td>
        <td><?php if ($result['isHost'] === true) echo '<span class="success">Ок</span>'; else echo '<span class="error">Ошибка</span>' ?></td>
        <td><?php if ($result['isHost'] === true) echo '<span class="success">' . $rules['isHost']['true']['Состояние'] . '</span>'; else echo '<span class="error">' . $rules['isHost']['false']['Состояние'] . '</span>' ?></td>
        <td><?php if ($result['isHost'] === true) echo '<span class="success">' . $rules['isHost']['true']['Рекомендации'] . '</span>'; else echo '<span class="error">' . $rules['isHost']['false']['Рекомендации'] . '</span>' ?></td>
    </tr>
    <tr>
        <td>Проверка количества директив Host, прописанных в файле</td>
        <td><?php if ($result['countHost'] == 1) echo '<span class="success">Ок</span>'; else echo '<span class="error">Ошибка</span>' ?></td>
        <td><?php if ($result['countHost'] == 1) echo '<span class="success">' . $rules['countHost']['true']['Состояние'] . '</span>'; else echo '<span class="error">' . $rules['countHost']['false']['Состояние'] . '</span>' ?></td>
        <td><?php if ($result['countHost'] == 1) echo '<span class="success">' . $rules['countHost']['true']['Рекомендации'] . '</span>'; else echo '<span class="error">' . $rules['countHost']['false']['Рекомендации'] . '</span>' ?></td>
    </tr>
    <tr>
        <td>Проверка размера файла robots.txt</td>
        <td><?php if ($result['size'] <= 256000) echo '<span class="success">Ок</span>'; else echo '<span class="error">Ошибка</span>' ?></td>
        <td><?php if ($result['size'] <= 256000) echo '<span class="success">' . $rules['size']['true']['Состояние'] . '</span>'; else echo '<span class="error">' . $rules['size']['false']['Состояние'] . '</span>' ?></td>
        <td><?php if ($result['size'] <= 256000) echo '<span class="success">' . $rules['size']['true']['Рекомендации'] . '</span>'; else echo '<span class="error">' . $rules['size']['false']['Рекомендации'] . '</span>' ?></td>
    </tr>
    <tr>
        <td>Проверка указания директивы Sitemap</td>
        <td><?php if ($result['isSitemap'] === true) echo '<span class="success">Ок</span>'; else echo '<span class="error">Ошибка</span>' ?></td>
        <td><?php if ($result['isSitemap'] === true) echo '<span class="success">' . $rules['isSitemap']['true']['Состояние'] . '</span>'; else echo '<span class="error">' . $rules['isSitemap']['false']['Состояние'] . '</span>' ?></td>
        <td><?php if ($result['isSitemap'] === true) echo '<span class="success">' . $rules['isSitemap']['true']['Рекомендации'] . '</span>'; else echo '<span class="error">' . $rules['isSitemap']['false']['Рекомендации'] . '</span>' ?></td>
    </tr>
    <tr>
        <td>Проверка кода ответа сервера для файла robots.txt</td>
        <td><?php if ($result['code'] == 200) echo '<span class="success">Ок</span>'; else echo '<span class="error">Ошибка</span>' ?></td>
        <td><?php if ($result['code'] == 200) echo '<span class="success">' . $rules['code']['true']['Состояние'] . '</span>'; else echo '<span class="error">' . $rules['code']['false']['Состояние'] . '</span>' ?></td>
        <td><?php if ($result['code'] == 200) echo '<span class="success">' . $rules['code']['true']['Рекомендации'] . '</span>'; else echo '<span class="error">' . $rules['code']['false']['Рекомендации'] . '</span>' ?></td>
    </tr>

</table>
</body>
