<?php

session_start();

$pageTitle = 'Добавить запись | Гостевая книга с использованием базы данных MySQL';

$errors = [
    'form' => '',
    'username' => '',
    'message' => ''
];

if (!empty($_SESSION['formErrors'])) {
    $formErrors = $_SESSION['formErrors'];

    $errors['form'] = <<<s
<tr>
    <td colspan="2" style="color: red; font-size: 10pt">Ошибки на форме</td>
</tr>
s;

    if (!empty($formErrors['username'])) {
        $errors['username'] = "<br><span style='color: red'>{$formErrors['username']}</span>";
    }

    if (!empty($formErrors['message'])) {
        $errors['message'] = "<br><span style='color: red'>{$formErrors['message']}</span>";
    }

    // Удаляем ошибки в сессии
    unset($_SESSION['formErrors']);
}

echo <<<s
<!DOCTYPE html>
<html>
<head>
    <title>$pageTitle</title>
    <meta http-equiv="Content-Language" content="ru">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<h1>Добавить запись</h1>

<form action="/addMessage.php" method="POST">
    <table cellpadding="25">
        {$errors['form']}
        <tr>
            <td valign="top">Имя *</td>
            <td><input type="text" name="username" size="52">{$errors['username']}</td>
        </tr>
        <tr>
            <td valign="top">Сообщение *</td>
            <td><textarea name="message" cols="40" rows="10"></textarea>{$errors['message']}</td>
        </tr>
        <tr>
            <td colspan="2" style="font-size: 8pt">Поля, обозначенные символом * (звёздочка), обязательны для заполнения</td>
        </tr>
        <tr>
        <td></td>
        <td><input type="submit" value="Добавить"></td>
        </tr>
    </table>
</form>

[<a href="/">вернуться на главную</a>]

</body>
</html>
s;