<?php //Шаблон для категорий в main сверху
date_default_timezone_set('Asia/Sakhalin'); // Устанавливаю время на время БД, иначе начинает некорректно считать минуты
require_once('helpers.php');


$categories = get_categories();

foreach ($categories as $key => $val) : ?>
        <li class="promo__item promo__item--<?= htmlspecialchars($val['symbol_code']); ?>">
            <a class="promo__link" href="pages/all-lots.html"><?= htmlspecialchars($val['category_name']); ?></a>
        </li>
<?php endforeach; ?>