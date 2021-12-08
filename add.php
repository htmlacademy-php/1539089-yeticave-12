<?php
require_once('helpers.php');
$con = connection();
$categories_list = include_template('categories_list.php');
$categories_dropdown = get_categories();
$categories_id_list = array_column($categories_dropdown, 'id');
//if ($is_auth === 1){ //!!!Раскомментить для выполнения пункта ТЗ "Страница доступна только аутентифицированным пользователям."!!!
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$filename = 'uploads/' . uniqid() . '.img';  //называем файл изображения, сразу с папкой в которой будет лежать
		$required = ['lot_name', 'category_id', 'description', 'start_price', 'rate_step', 'date_dead', 'image'];
		$errors = [];
		$rules = [
			'lot_name' => function($value){
				return !isset($value);
			},
			'category_id' => function ($value) use ($categories_id_list) {  
				return !validateCategory($value, $categories_id_list);      //если валидация вернула true, то меняет на false, чтобы не записалось в ошибки          
			},
			'description' => function($value){
				return !isset($value);
			},
			'start_price' => function ($value){
				return !validatePrice($value);                              //если валидация вернула false, то меняет на true, чтобы ушло в ошибки
			},
			'rate_step' => function	($value){
				return !validatePrice($value);
			},
			'date_dead' => function ($value){
				return !validateDate ($value);
			}		
		];
		$lot = 
		filter_input_array(INPUT_POST, 											// не до конца понял, как работает
			[ 
				'lot_name' => FILTER_DEFAULT,
				'category_id' => FILTER_DEFAULT,
				'description' => FILTER_DEFAULT,  
				'start_price' => FILTER_DEFAULT, 
				'rate_step' => FILTER_DEFAULT,
				'date_dead' => FILTER_DEFAULT], 
				true);  
		foreach ($lot as $key => $value) {
			if (isset($rules[$key])) {
				$rule = $rules[$key];
				$errors[$key] = $rule($value);                               //присваиваем ключу в массиве ошибок ключ правила
			}

			if (in_array($key, $required) && empty($value)) {               // Проверяем на заполненность
				$errors[$key] = "Поле $key надо заполнить";
			}
		}
		$errors = array_filter($errors);                                   //Оставляем только нужные значения(удаляем все пустые)
		if (!empty($_FILES['image']['name'])) {  
			              
		$path = $_FILES['image']['name'];
		$filename = uniqid().$path;
		$tmp_name = $_FILES['image']['tmp_name'];
		$mime = mime_content_type($tmp_name);
			if ($mime == 'image/png' || $mime == 'image/jpeg'){
				move_uploaded_file($tmp_name, 'uploads/'.$filename);
				$lot['image'] = 'uploads/'.$filename;	
			}else{
				$errors['image'] = 'Выберите изображение в формате PNG или JPEG';
			}
			}else{
			$errors['image'] = 'Вы не загрузили файл';
			}
		if (count($errors)) {
			$add_lot_content = include_template(							//Передаем в шаблон с ошибками
				'add-lot.php',
				[
					'header' => $header,
					'user_name' => 'Сергей',
					'categories_list' => $categories_list,
					'categories_dropdown' => $categories_dropdown,
					'errors' => $errors,
					'lot_name' => $lot['lot_name'],
					'category_value' => $lot['category_id'],
					'description_value' => $lot['description'],
					'path' => $path,
					'start_price' => $lot['start_price'],
					'rate_step' => $lot['rate_step'],
					'date_dead' => $lot['date_dead'],
					'footer' => $footer
				]
			);
		}
		else {
			$sql = "INSERT INTO lots (date_create, lot_name, category_id, description, start_price, rate_step, date_dead, author_id, image)
						VALUES (NOW(), ?, ?, ?, ?, ?, ?, 1, ?)";
			$stmt = db_get_prepare_stmt($con, $sql, $lot);  //выполняем подготовленное выражение
			$res = mysqli_stmt_execute($stmt);
			if ($res) {
				$lot_id = mysqli_insert_id($con);

			header('Location: lot.php?id='.$lot_id);  // перенаправляем на созданный лот
			}
		}
	}
	else {
		$add_lot_content = include_template(					//При первом открытии страницы
			'add-lot.php',												
			[
				'header' => $header,
				'user_name' => 'Сергей',
				'categories_list' => $categories_list,
				'categories_dropdown' => $categories_dropdown,
				'footer' => $footer
			]
		);
	}
//}
print $add_lot_content;
