<?php

require_once 'helpers.php';
date_default_timezone_set('Asia/Sakhalin');
$con = connection();

$loginContent = include_template(
    'login.php',
    [
        'header' => $header,
        'categories_list' => $categories_list,
        'footer' => $footer,
    ]
);
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    print_r($loginContent);
    exit();
}
$required = ['email', 'password'];
$errors = [];
$rules =
    [
        'email' => function ($value) {
            return !validateEmail($value);
        },
        'password' => function ($value) {
            return !isset($value);
        },
    ];
$loginUser = filter_input_array(
    INPUT_POST,
    [
        'email' => FILTER_DEFAULT,
        'password' => FILTER_DEFAULT
    ],
    true
);

foreach ($loginUser as $key => $value) {
    if (isset($rules[$key])) {
        $rule = $rules[$key];
        $errors[$key] = $rule($value);
    }
    if (in_array($key, $required) && empty($value)) {               // Проверяем на заполненность
        $errors[$key] = "Поле $key надо заполнить";
    }
}
$errors = array_filter($errors);

if (count($errors)) {
    $loginContent = include_template(
        'login.php',
        [
            'header' => $header,
            'categories_list' => $categories_list,
            'footer' => $footer,
            'errors' => $errors,
            'email' => $loginUser['email']
        ]
    );
    print_r($loginContent);
    exit();
}
$userEmail = mysqli_real_escape_string($con, $loginUser['email']);

$queryUser = "SELECT *
        FROM users
        WHERE email = '$userEmail'";
$userResourse = mysqli_query($con, $queryUser);

if ($userResourse) {
    $userInfo =  $userResourse ? mysqli_fetch_array($userResourse, MYSQLI_ASSOC) : null;
    if (password_verify($_POST['password'], $userInfo['user_password'])) {
        session_start();
        $_SESSION = $userInfo;
        header('Location: index.php');
        exit();
    }
    $errors['password'] = 'Неверный пароль';
} else {
    $errors['email'] = 'Такой пользователь не найден';
}

$loginContent = include_template(
    'login.php',
    [
        'header' => $header,
        'categories_list' => $categories_list,
        'footer' => $footer,
        'errors' => $errors,
        'email' => $loginUser['email']
    ]
);
print_r($loginContent);
exit();
