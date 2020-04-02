<?php

ini_set('display_errors', 'On');
ini_set('track_errors', 'On');

$dbHost = '127.0.0.1';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'guestbook';

// https://www.php.net/manual/ru/mysqli.examples-basic.php
$DB = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($DB->connect_errno) {
    echo "Ошибка подключения в базе данных!";
    exit;
}

$DB->query('SET NAMES UTF8');
