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

		<?= $header; ?>

		<main>
			<nav class="nav">
				<ul class="nav__list container">
					<?php print $categories_list; ?>
				</ul>
			</nav>
			<form class="form container
    			<?php if (isset($errors)) : ?>form--invalid<?php endif; ?>" action="signUpScenario.php" method="post" autocomplete="off" enctype="application/x-www-form-urlencoded">
				<h2>Регистрация нового аккаунта</h2>
				<div class="form__item
    				<?php if (isset($errors['email'])) : ?>form__item--invalid<?php endif ?>">
					<label for="email">E-mail <sup>*</sup></label>
					<input id="email" type="text" name="email" placeholder="Введите e-mail" value=<? print $email ?>>
					<span class="form__error">
						<?php if (is_string($errors['email'])) { //Если в массиве булево 1 или 0 то возвражает определенную строку, если ошибка задана в сценарии, то возвращает её
							print_r($errors['email']);
							} else {
							print 'Введите Email';
							}?>
					</span>
				</div>
				<div class="form__item
	  				<?php if (isset($errors['password'])) : ?>form__item--invalid<?php endif ?>">
					<label for="password">Пароль <sup>*</sup></label>
					<input id="password" type="password" name="password" placeholder="Введите пароль">
					<span class="form__error">Введите пароль</span>
				</div>
				<div class="form__item
	  				<?php if (isset($errors['name'])) : ?>form__item--invalid<?php endif ?>">
					<label for="name">Имя <sup>*</sup></label>
					<input id="name" type="text" name="name" placeholder="Введите имя" value=<? print $user_name ?>>
					<span class="form__error">Введите имя</span>
				</div>
				<div class="form__item
	  				<?php if (isset($errors['message'])) : ?>form__item--invalid<?php endif ?>">
					<label for="message">Контактные данные <sup>*</sup></label>
					<textarea id="message" name="message" placeholder="Напишите как с вами связаться"><?= $message ?></textarea>
					<span class="form__error">Напишите как с вами связаться</span>
				</div>
				<span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
				<button type="submit" class="button">Зарегистрироваться</button>
				<a class="text-link" href="pages/login.html">Уже есть аккаунт</a>
			</form>
		</main>

	</div>

	<?= $footer; ?> 

</body>

</html>
