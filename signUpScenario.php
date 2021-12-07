<?php
    require_once('helpers.php');
    date_default_timezone_set('Asia/Sakhalin');
    $con = connection();

    $lotpage_categories = include_template (
        'categories_list.php'
    );

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $required = ['email', 'password', 'name', 'message'];
        $errors =[];
        $rules = [
            'email' => function($value){
                return !validateEmail($value);
            },
            'password' => function($value){
                return !isset($value);
            },
            'name' => function($value){
                return !isset($value);
            },
            'message' => function($value){
                return !isset($value);
            },
        ];
        $user = filter_input_array(INPUT_POST,
        [
            'email' => FILTER_DEFAULT,
            'password' => FILTER_DEFAULT,
            'name' => FILTER_DEFAULT,
            'message' => FILTER_DEFAULT],
            true
        );
	
        $user_email = $user['email'];
        $sql_email = "SELECT id FROM users WHERE email = '$user_email'";
        $res = mysqli_query($con, $sql_email);
        
        
        foreach ($user as $key => $value) {
            if (isset($rules[$key])) {
                $rule = $rules[$key];
                $errors[$key] = $rule($value);
            }

            if (in_array($key, $required) && empty($value)) {               // Проверяем на заполненность
				$errors[$key] = "Поле $key надо заполнить";
			}
            if (mysqli_num_rows($res) > 0) {
                $errors['email'] = 'Пользователь с этим email уже зарегистрирован';
        };
    }
        $errors = array_filter($errors);  

        if (count($errors)) {
            $lotpage_content = include_template(
                'sign-up.php',
                    [
                        'header' => $header,
                        'lot_info' => $lot_info, 
                        'categories_list' => $categories_list,
                        'footer' => $footer,
                        'errors' => $errors,
						'email' => $user['email'],
						'user_name' => $user['name'],
						'message' => $user['message']
                    ]
            );
        }
        else {

        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT); // хэшируем пароль
        $sql = "INSERT INTO users (registration_date, email, user_name, user_password, user_contact)
						VALUES (NOW(), ?, ?, ?, ?)";
			$stmt = db_get_prepare_stmt($con, $sql, $user);  //выполняем подготовленное выражение
			$res = mysqli_stmt_execute($stmt);
			if ($res) {
				$user_id = mysqli_insert_id($con);
            
            
            header('Location: pages/login.html');

            }
    
        }
    } else {
    $lotpage_content = include_template(
        'sign-up.php',
            [
                'header' => $header,
                'lot_info' => $lot_info, 
                'categories_list' => $categories_list,
                'footer' => $footer,
            ]
    );
    
    }
print ($lotpage_content);
?>
