<?php
    require_once('helpers.php');
    date_default_timezone_set('Asia/Sakhalin');
    $con = connection();

    $sign_up_content = include_template(
        'sign-up.php',
            [
                'header' => $header,
                'categories_list' => $categories_list,
                'footer' => $footer,
            ]);

    if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
        print_r ($sign_up_content);
        exit();
    }
        $required = ['email', 'password', 'name', 'message'];
        $errors =[];
        $rules = 
        [
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
            'name' => FILTER_DEFAULT,
            'password' => FILTER_DEFAULT,
            'message' => FILTER_DEFAULT
        ],
            true
        );
	
        $user_email = $user['email'];
        $sql_email = "SELECT id FROM users WHERE email = '$user_email'";
        $emailQuery = mysqli_query($con, $sql_email);
        
        
        foreach ($user as $key => $value) {
            if (isset($rules[$key])) {
                $rule = $rules[$key];
                $errors[$key] = $rule($value);
            }
            if (in_array($key, $required) && empty($value)) {               // Проверяем на заполненность
				$errors[$key] = "Поле $key надо заполнить";
			}
            if (mysqli_num_rows($emailQuery) > 0) {
                $errors['email'] = 'Пользователь с этим email уже зарегистрирован';
        };
    }
        $errors = array_filter($errors);  

        if (count($errors) < 1) {

        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT); // хэшируем пароль
        $newUserSql = "INSERT INTO users (registration_date, email, user_name, user_password, user_contact)
				       VALUES (NOW(), ?, ?, ?, ?)";
			$statementNewUser = db_get_prepare_stmt($con, $newUserSql, $user);  //выполняем подготовленное выражение
			
            $executeNewUSer = mysqli_stmt_execute($statementNewUser);
			if ($executeNewUSer) {
                header('Location: pages/login.html');
            exit();
            } else {
                $errors['execute_error'] = mysqli_error($con);
                $sign_up_content = include_template(
                    'sign-up.php',
                        [
                            'header' => $header,
                            'categories_list' => $categories_list,
                            'footer' => $footer,
                            'errors' => $errors,
                            'email' => $user['email'],
                            'user_name' => $user['name'],
                            'message' => $user['message']
                        ]
                );
                print_r($sign_up_content);
                exit();
            }
        }

        $sign_up_content = include_template(
            'sign-up.php',
                [
                    'header' => $header,
                    'categories_list' => $categories_list,
                    'footer' => $footer,
                    'errors' => $errors,
					'email' => $user['email'],
					'user_name' => $user['name'],
					'message' => $user['message']
                   ]
        );
        print_r ($sign_up_content);
        exit();
