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
function is_date_valid(string $date): bool
{
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
function db_get_prepare_stmt($link, $sql, $data = [])
{
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
			} else if (is_string($value)) {
				$type = 's';
			} else if (is_double($value)) {
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
function get_noun_plural_form(int $number, string $one, string $two, string $many): string
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
function include_template($name, array $data = [])
{
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


function time_to_dead($lot_time)
{
	$lot_time = strtotime($lot_time);
	$time_now = time();

	$hours = floor(($lot_time - $time_now) / 3600);
	$minutes = ceil((((($lot_time - $time_now) / 3600) - $hours) * 60));

	if ($minutes === 60.0) {            // Если исользовать строгое сравнение '===' то не работает
		$hours_str = str_pad($hours + 1, 2, "0", STR_PAD_LEFT);
		$minutes_str = '00';
		return [$hours_str, $minutes_str];
	} else {
		$hours_str = str_pad($hours, 2, "0", STR_PAD_LEFT);
		$minutes_str = str_pad($minutes, 2, "0", STR_PAD_LEFT);
		return [$hours_str, $minutes_str];
	}
}

function connection()
{  //Функция на подключение к БД

	$con = mysqli_connect("127.0.0.1", "root", "root", "yety");
	mysqli_set_charset($con, "utf8"); // не уверен, применяется ли кодировка везде, куда я передаю(да, тк.к ресурс соединения устанавливается в $con)
	if ($con == false) {
		print("Ошибка подключения: " . mysqli_connect_error());
	}
	/* else {                                 
        print ("Соединение установлено");
    }   */
	return $con;
}

function error404()			// вывод 404, вызывается return error404();
{           
	$categories_list = include_template(  //Получаем категории из шаблона
		'categories_list.php'
	);
	$error_404 = include_template(
		'404.php',
		[
			'categories_list' => $categories_list
		]
	);
	http_response_code(404);
	print($error_404);
}

function get_categories()   // Получаем категории для навигации
{        
	$con = connection();

	$query_categories = "SELECT * FROM `categories` ORDER BY id;";

	$categories_resourse = mysqli_query($con, $query_categories);

	$categories_array = mysqli_fetch_all($categories_resourse, MYSQLI_ASSOC);
	return $categories_array;
}
/*
Валидация категорий, если $id нет в массиве $allowed_list вернет ошибку
*/
function validateCategory($id, $allowed_list)
{
	if (!in_array($id, $allowed_list)) {
		return 'Указана несуществующая категория';
	}
	return null;
}
/*
Валидация цифровых значений цены
возвращает null, когда $val число и при этом все символы в $val являются числовыми
*/
function validatePrice($val){
	if (is_numeric($val) && ctype_digit($val)){
		return null;
	}
	return "Введите целое число больше нуля";
}
/*
Валидация даты
возвращает null, когда $val проходит проверку is_date_valid и при этом больше текущей даты
*/
function validateDate($val){
	$date_now = date("Y-m-d");
	if (is_date_valid($val) == 1 && $val > $date_now){
		return null;
	}
	return 'Введите дату в формате ГГГГ-ММ-ДД';
}
/**Возвращает введенное пользователем значение
 * $name - имя атрибута, значение которого необходимо вернуть
 * ?? - оператор объединения с null, возвращает $_POST['$name'] если он был задан и не равен null
 * в противном случае возвращает ''
 */
function getPOSTval($name)
{
	return $_POST[$name] ?? '';
}

$is_auth = rand(0,1);  //Определил здесь, для выполнения пункта ТЗ "Страница доступна только аутентифицированным пользователям."
