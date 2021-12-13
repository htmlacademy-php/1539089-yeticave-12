<?php // Шаблон категорий без картинок
date_default_timezone_set('Asia/Sakhalin'); // Устанавливаю время на время БД, иначе начинает некорректно считать минуты
require_once 'helpers.php'; // Подключаю ф-ии
// Подключение к БД


$categories = get_categories();

foreach ($categories as $key => $val) : ?>
    <li class="nav__item">
        <a class="promo__link" href="pages/all-lots.html"><?php echo htmlspecialchars($val['category_name']); ?></a>
    </li>
<?php endforeach; ?>
