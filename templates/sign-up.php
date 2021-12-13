<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link href="../css/normalize.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>

    <div class="page-wrapper">

        <?php echo $header; ?>

        <main>
            <nav class="nav">
                <ul class="nav__list container">
                    <?php echo $categories_list; ?>
                </ul>
            </nav>
            <form class="form container
                <?php echo isset($errors) ? 'form--invalid' : '' ?>" action="signUpScenario.php" method="post" autocomplete="off" enctype="application/x-www-form-urlencoded">
                <h2>Регистрация нового аккаунта</h2>
                <div class="form__item
                    <?php echo isset($errors['email']) ? 'form__item--invalid' : '' ?>">
                    <label for="email">E-mail <sup>*</sup></label>
                    <input id="email" type="text" name="email" placeholder="Введите e-mail" value=<?php echo htmlspecialchars($email ?? ''); ?>>
                    <span class="form__error">
                        <?php echo isset($errors['email']) && is_string($errors['email']) ? $errors['email'] : 'Введите Email' ?>
                    </span>
                </div>
                <div class="form__item
                <?php echo isset($errors['password']) ? 'form__item--invalid' : '' ?>">
                    <label for="password">Пароль <sup>*</sup></label>
                    <input id="password" type="password" name="password" placeholder="Введите пароль">
                    <span class="form__error">Введите пароль</span>
                </div>
                <div class="form__item
                <?php echo isset($errors['name']) ? 'form__item--invalid' : '' ?>">
                    <label for="name">Имя <sup>*</sup></label>
                    <input id="name" type="text" name="name" placeholder="Введите имя" value=<?php echo htmlspecialchars($user_name ?? ''); ?>>
                    <span class="form__error">Введите имя</span>
                </div>
                <div class="form__item
                <?php echo isset($errors['message']) ? 'form__item--invalid' : '' ?>">
                    <label for="message">Контактные данные <sup>*</sup></label>
                    <textarea id="message" name="message" placeholder="Напишите как с вами связаться"><?php echo htmlspecialchars($message ?? ''); ?></textarea>
                    <span class="form__error">Напишите как с вами связаться</span>
                </div>
                <span class="form__error form__error--bottom"><?php echo isset($errors['execute_error']) ? 'Произошла ошибка с вашим запросом, код ошибки: ' . $errors['execute_error'] : 'Пожалуйста, исправьте ошибки в форме.' ?></span>
                <button type="submit" class="button">Зарегистрироваться</button>
                <a class="text-link" href="pages/login.html">Уже есть аккаунт</a>
            </form>
        </main>
    </div>

    <?php echo $footer; ?>

</body>

</html>
