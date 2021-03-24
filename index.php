<?php
date_default_timezone_set('Asia/Sakhalin'); // Устанавливаю время на время БД, иначе начинает некорректно считать минуты
require_once('helpers.php'); // Подключаю ф-ии и запросы к БД из этого файла
// Можно как вариант к БД отсюда подключаться, и вот вопрос у меня как лучше это делать?
$main_content = include_template(                //Передаю в шаблон
    'main.php',                                 
    [
        'lots_array' => $lots_array,
        'categories_array' => $categories_array,
    ]

);
$layout_content = include_template(             // Передаю в шаблон
    'layout.php',
    [
        'content' => $main_content, 'page_name' => 'Главная', 'user_name' => 'Сергей',
        'categories_array' => $categories_array,
    ]
);
print($layout_content);
