<?php
/**
 * Проверяет переданную дату на соответствие формату 'ГГГГ-ММ-ДД'
 *
 * Примеры использования:
 * is_date_valid('2019-01-01'); // true
 * is_date_valid('2016-02-29'); // true
 * is_date_valid('2019-04-31'); // false
 * is_date_valid('10.10.2010'); // false
 * is_date_valid('10/10/2010'); // false
 *
 * @param string $date Дата в виде строки
 *
 * @return bool true при совпадении с форматом 'ГГГГ-ММ-ДД', иначе false
 */
function is_date_valid(string $date) : bool {
    $format_to_check = 'Y-m-d';
    $dateTimeObj = date_create_from_format($format_to_check, $date);

    return $dateTimeObj !== false && array_sum(date_get_last_errors()) === 0;
}

/**
 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
 *
 * @param $link mysqli Ресурс соединения
 * @param $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_stmt Подготовленное выражение
 */
function db_get_prepare_stmt($link, $sql, $data = []) {
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        $errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($link);
        die($errorMsg);
    }

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = 's';

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);

        if (mysqli_errno($link) > 0) {
            $errorMsg = 'Не удалось связать подготовленное выражение с параметрами: ' . mysqli_error($link);
            die($errorMsg);
        }
    }

    return $stmt;
}

/**
 * Возвращает корректную форму множественного числа
 * Ограничения: только для целых чисел
 *
 * Пример использования:
 * $remaining_minutes = 5;
 * echo "Я поставил таймер на {$remaining_minutes} " .
 *     get_noun_plural_form(
 *         $remaining_minutes,
 *         'минута',
 *         'минуты',
 *         'минут'
 *     );
 * Результат: "Я поставил таймер на 5 минут"
 *
 * @param int $number Число, по которому вычисляем форму множественного числа
 * @param string $one Форма единственного числа: яблоко, час, минута
 * @param string $two Форма множественного числа для 2, 3, 4: яблока, часа, минуты
 * @param string $many Форма множественного числа для остальных чисел
 *
 * @return string Рассчитанная форма множественнго числа
 */
function get_noun_plural_form (int $number, string $one, string $two, string $many): string
{
    $number = (int) $number;
    $mod10 = $number % 10;
    $mod100 = $number % 100;

    switch (true) {
        case ($mod100 >= 11 && $mod100 <= 20):
            return $many;

        case ($mod10 > 5):
            return $many;

        case ($mod10 === 1):
            return $one;

        case ($mod10 >= 2 && $mod10 <= 4):
            return $two;

        default:
            return $many;
    }
}

/**
 * Подключает шаблон, передает туда данные и возвращает итоговый HTML контент
 * @param string $name Путь к файлу шаблона относительно папки templates
 * @param array $data Ассоциативный массив с данными для шаблона
 * @return string Итоговый HTML
 */
function include_template($name, array $data = []) {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}


/**
 * Принимает дату , выводит оставшееся время до неё в массиве [HH, MM]
 * $lot_time - принимаемое значение даты, разницу с которым надо найти
 * $hours,$minutes -Часы и минуты.
 * $hours_str, $minutes_str - дополняет '0', если получившееся число меньше 10 
 */


function time_to_dead ($lot_time) {
    $lot_time = strtotime($lot_time);
    $time_now = time();

    $hours = floor(($lot_time-$time_now)/3600);
    $minutes = ceil((((($lot_time-$time_now)/3600)-$hours)*60));

    if ($minutes === 60.0){            /* Если исользовать строгое сравнение '===' то не работает */
        $hours_str = str_pad($hours + 1, 2, "0", STR_PAD_LEFT);
        $minutes_str = '00';
        return [$hours_str, $minutes_str];
    }

    else{
    $hours_str = str_pad($hours, 2, "0", STR_PAD_LEFT);
    $minutes_str = str_pad($minutes, 2, "0", STR_PAD_LEFT);
    return [$hours_str, $minutes_str];
    }
    
}



// Подключение к БД

$con = mysqli_connect("127.0.0.1", "root", "root", "yety");

mysqli_set_charset($con, "utf8");

// Запрос на получение лотов

$query_lots = "SELECT lot_name, start_price, image, date_dead, category_name, rate_sum
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

$lots_array = mysqli_fetch_all($lots_resourse, MYSQLI_ASSOC);

// Запрос на получение категорий

$query_categories = "SELECT * FROM `categories` ORDER BY id;";

$categories_resourse = mysqli_query($con, $query_categories);

$categories_array = mysqli_fetch_all($categories_resourse, MYSQLI_ASSOC);