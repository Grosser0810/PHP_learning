<?php

$connection = mysqli_connect(
    'localhost',
    'root',
    '',
    'function'
);

if(!$connection) {
    echo "Подключение к БД не успешно";
}


?>