<?php
$servername = "localhost"; //хост
$database = "Business_school"; //имя базы данных
$user = "root"; //имя пользователя
$password = ""; //пароль
//создаем соединение
$db = mysqli_connect($servername, $user, $password, $database);
//проверяем соединение, если подключение не выполнено, сообщение об ошибке и прекращение работы скрипта
if (!$db) {
    die("Connection falied: " . mysqli_connect_error());

}
?>