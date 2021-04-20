<?php //Шаблон для категорий в main сверху
date_default_timezone_set('Asia/Sakhalin'); // Устанавливаю время на время БД, иначе начинает некорректно считать минуты
require_once('helpers.php');

$con = connection(); // Получаем подключение к БД

$query_categories = "SELECT * FROM `categories` ORDER BY id;";

$categories_resourse = mysqli_query($con, $query_categories);

$categories = mysqli_fetch_all($categories_resourse, MYSQLI_ASSOC);

foreach ($categories as $key => $val) : ?>
        <li class="promo__item promo__item--<?= htmlspecialchars($val['symbol_code']); ?>">
                <a class="promo__link" href="pages/all-lots.html"><?= htmlspecialchars($val['category_name']); ?></a>
        </li>
<?php endforeach; ?>