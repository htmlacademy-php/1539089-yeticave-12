<?php
$staff = [
    [
        'name' => '2014 Rossignol District Snowboard',
        'category' => 'Доски и лыжи',
        'price' => 10999,
        'image' => 'img/lot-1.jpg',
        'time' => '2021-01-26'
    ],
    [
        'name' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи',
        'price' => 159999,
        'image' => 'img/lot-2.jpg',
        'time' => '2021-01-20'
    ],
    [
        'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price' => 8000,
        'image' => 'img/lot-3.jpg',
        'time' => '2021-01-21'
    ],
    [
        'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки',
        'price' => 10999,
        'image' => 'img/lot-4.jpg',
        'time' => '2021-01-22'
    ],
    [
        'name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда',
        'price' => 7500,
        'image' => 'img/lot-5.jpg',
        'time' => '2021-01-23'
    ],
    [
        'name' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price' => 5400,
        'image' => 'img/lot-6.jpg',
        'time' => '2021-01-24'
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
    ]
);
print($layout_content);
