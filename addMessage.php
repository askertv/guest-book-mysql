<?php

session_start();

require_once 'connect.php';

$username = !empty($_POST['username']) ? trim($_POST['username']) : '';
$message = !empty($_POST['message']) ? trim($_POST['message']) : '';

$errors = [];

if (!$username) {
    $errors['username'] = 'Не заполнено поле "Имя"';
}

if (!$message) {
    $errors['message'] = 'Не заполнено поле "Сообщение"';
}

if (count($errors)) {
    $_SESSION['formErrors'] = $errors;
    header("location: /addMessageForm.php");
    exit;
}

$sql = "
    INSERT INTO
        posts
        (
            username,
            message,
            date_added
        )
        VALUES
        (
            '$username',
            '$message',
            NOW()
        )
    ";

$DB->query($sql);

$newId = $DB->insert_id;

header("location: /?$newId");
