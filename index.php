<?php
$is_auth = rand(0, 1);
$staff = [
    [
        'name' => '2014 Rossignol District Snowboard',
        'category' => 'Доски и лыжи',
        'price' => 10999,
        'image' => 'img/lot-1.jpg'
    ],
    [
        'name' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи',
        'price' => 159999,
        'image' => 'img/lot-2.jpg'
    ],
    [
        'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price' => 8000,
        'image' => 'img/lot-3.jpg'
    ],
    [
        'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки',
        'price' => 10999,
        'image' => 'img/lot-4.jpg'
    ],
    [
        'name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда',
        'price' => 7500,
        'image' => 'img/lot-5.jpg'
    ],
    [
        'name' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price' => 5400,
        'image' => 'img/lot-6.jpg'
    ],
];
$categories = [
    "Доски и лыжи",
    "Крепления",
    "Ботинки",
    "Одежда",
    "Инструменты",
    "Разное"
];
function lot_price($x)
{
    $x = ceil($x);
    if ($x >= 1000) {
        $x = number_format($x, 0, '.', ' ');
    }

    return $x . ' ' . '₽';
}
require_once('helpers.php');
$main_content = include_template(
    'main.php',
    [
        'staff' => $staff,
        'categories' => $categories
    ]
);
$layout_content = include_template(
    'layout.php',
    [
        'content' => $main_content, 'page_name' => 'Главная', 'user_name' => 'Сергей',
        'categories' => $categories,
        'is_auth' => $is_auth
    ]
);
print($layout_content);
