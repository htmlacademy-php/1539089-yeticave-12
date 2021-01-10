<?php
require_once ('helpers.php');
$main_content = include_template(htmlspecialchars('main.php'), $data = []);
$layout_content = include_template('layout.php', ['content' => $main_content, 'page_name' => 'Главная', 'user_name' => 'Сергей', 
    'categories' => [
        "Доски и лыжи",
        "Крепления",
        "Ботинки",
        "Одежда",
        "Инструменты",
        "Разное"
        ]
    ]
);
print ($layout_content);
?>
