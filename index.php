<?php

require_once 'connect.php';

$pageTitle = 'Гостевая книга с использованием базы данных MySQL';

echo <<<s
<!DOCTYPE html>
<html>
<head>
    <title>$pageTitle</title>
    <meta http-equiv="Content-Language" content="ru">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<h1>$pageTitle</h1>
s;

try {
    $sql = 'SELECT * FROM posts ORDER BY date_added DESC';

    $result = $DB->query($sql);

    $bookRecords = '';
    
    if (!$result) {
        echo "<pre>MySQL error:<br>";
        echo "Code: {$DB->errno}<br>";
        echo "Error:<br>";
        print_r($DB->error);
        echo "</pre>";
    } else {
        while ($row = $result->fetch_assoc()) {
            $bookRecords .= <<<s
<tr>
    <td>{$row['id']}</td>
    <td>{$row['username']}</td>
    <td>{$row['message']}</td>
    <td>{$row['date_added']}</td>
</tr>
s;
        }
    }
    
    echo <<<s
[<a href="/addMessageForm.php">добавить запись</a>] &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; [<a href="/info.php">phpinfo</a>]
<br><br>
<table border="1" style="border-collapse: collapse;" cellpadding="25">
    <tr>
        <td>№</td>
        <td>Пользователь</td>
        <td>Сообщение</td>
        <td>Добавлен</td>
    </tr>
    $bookRecords
</table>
s;

} catch (Exception $e) {
    echo "<pre>Exception:<br>";
    var_dump($e);
    echo "</pre>";
}

echo <<<s
</body>
</html>
s;
