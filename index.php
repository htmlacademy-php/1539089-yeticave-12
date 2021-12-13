<?php

date_default_timezone_set('Asia/Sakhalin'); // Устанавливаю время на время БД, иначе начинает некорректно считать минуты
require_once 'helpers.php';

$con = connection(); // Получаем подключение к БД

// Запрос на получение лотов,

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

$header_categories = include_template(  //Подключаем шаблон категорий с картинками
    'main_header_categories_list.php'
);



$main_content = include_template(
    'main.php',
    [
        'lots' => $lots, 'header_categories' => $header_categories
    ]
);
$layout_content = include_template(
    'layout.php',
    [
        'header' => $header,
        'content' => $main_content,
        'footer' => $footer,
        'page_name' => 'Главная',
        'user_name' => 'Сергей'
    ]
);
print($layout_content);
