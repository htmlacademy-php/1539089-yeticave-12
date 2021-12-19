<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Вход</title>
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
                <?php echo isset($errors) ? 'form--invalid' : '' ?>" action="loginScript.php" method="post" autocomplete="off" enctype="application/x-www-form-urlencoded">
                <h2>Вход</h2>
                <div class="form__item
                    <?php echo isset($errors['email']) ? 'form__item--invalid' : '' ?>">
                    <label for="email">E-mail <sup>*</sup></label>
                    <input id="email" type="text" name="email" placeholder="Введите e-mail" value=<?php echo htmlspecialchars($email ?? ''); ?>>
                    <span class="form__error"><?php if (isset($errors['email']) && is_string($errors['email'])) {
                        echo $errors['email'];
                                              } else {
                                                  echo 'Введите Email';
                                              }?></span>
                </div>
                <div class="form__item form__item--last
                    <?php echo isset($errors['password']) ? 'form__item--invalid' : '' ?>">
                    <label for="password">Пароль <sup>*</sup></label>
                    <input id="password" type="password" name="password" placeholder="Введите пароль">
                    <span class="form__error"><?php echo isset($errors['password']) ? $errors['password'] : '' ?></span>
                </div>
                <button type="submit" class="button">Войти</button>
            </form>
        </main>

    </div>

    <?php echo $footer; ?>

</body>

</html>
