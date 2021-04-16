<?php
date_default_timezone_set('Asia/Sakhalin'); // Устанавливаю время на время БД, иначе начинает некорректно считать минуты
require_once('helpers.php'); // Подключаю ф-ии 
// Подключение к БД

$con = connection(); // Получаем подключение к БД

// Запрос на получение лотов, если запращивать просто id, то возникает ошибка (видимо потому что id есть во всех таблицах), поэтому запросил всё из лотов

$query_lots = "SELECT lots.*, category_name, rate_sum  
FROM lots 
INNER JOIN categories
ON category_id = categories.id
LEFT JOIN rates 
ON rates.id = (
    SELECT ra.id
    FROM rates ra
    WHERE ra.lot_id = lots.id
    ORDER BY ra.rate_sum DESC LIMIT 1
)
WHERE lots.winner_id IS NULL AND date_dead > NOW() ORDER BY date_create DESC;";

$lots_resourse = mysqli_query($con, $query_lots);

$lots = mysqli_fetch_all($lots_resourse, MYSQLI_ASSOC);

// Запрос на получение категорий

$query_categories = "SELECT * FROM `categories` ORDER BY id;";

$categories_resourse = mysqli_query($con, $query_categories);

$categories = mysqli_fetch_all($categories_resourse, MYSQLI_ASSOC);

$main_content = include_template(                //Передаю в шаблон
    'main.php',                                 
    [
        'lots' => $lots,
        'categories' => $categories,
    ]

);
$layout_content = include_template(             // Передаю в шаблон
    'layout.php',
    [
        'content' => $main_content, 'page_name' => 'Главная', 'user_name' => 'Сергей',
        'categories' => $categories,
    ]
);
print($layout_content);
