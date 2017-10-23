<?php
/**
 * подключение к БД
 */

// соединяемся с БД
$link = mysqli_connect('127.0.0.1', 'root', '123', 'myshop');
if (!$link){
    echo 'Ошибка доступа к MySql';
    exit();
}
// установка кодировки
mysqli_set_charset($link, 'utf8');
