<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Добавление лота</title>
	<link href="../css/normalize.min.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">
	<link href="../css/flatpickr.min.css" rel="stylesheet">
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
			<form class="form form--add-lot container 
			<?php if (isset($errors)):?>form--invalid<?php endif;?>"  
			action="add.php" method="post" enctype="multipart/form-data">
				<!--Добавляем form--invalid  если были ошибки валидации-->
				<h2>Добавление лота</h2>
				<div class="form__container-two">
					<div class="form__item 
					<?php if (isset($errors['lot_name'])):?>form__item--invalid<?php endif;?>">
						
						<label for="lot-name">Наименование <sup>*</sup></label>
						<input id="lot-name" type="text" name="lot_name" placeholder='Введите наименование лота' value=<? print $lot_name ?>>
						<span class="form__error">
							<!-- Это span ошибки -->
							Введите наименование лота
						</span>
					</div>
					<div class="form__item
        			<?php if (isset($errors['category_id'])) : ?>form__item--invalid<?php endif ?>">
						<!-- Если есть заданынй ключ, то срабатывает ошибка валидации-->

						<label for="category">Категория <sup>*</sup></label>
						<select id="category" name="category_id">
							<option>Выберите категорию</option>
							<?php
							foreach ($categories_dropdown as $key => $val) : ?>
								<option value="<?= $val['id']; ?>" <?php if ($val['id'] == $category_value) : ?>selected<?php endif; ?>>
									<!--сохраняем выбор-->
									<?= htmlspecialchars($val['category_name']); ?>
								</option>
							<?php endforeach; ?>
						</select>
						<span class="form__error">Выберите категорию</span>
					</div>
				</div>
				<div class="form__item form__item--wide
				<?php if (isset($errors['description'])) : ?>form__item--invalid<?php endif ?>">
					<label for="message">Описание <sup>*</sup></label>
					<textarea id="message" name="description" placeholder="Напишите описание лота"><?=$description_value?></textarea>
					<span class="form__error">Напишите описание лота</span>
				</div>
				<div class="form__item form__item--file">
					<label>Изображение <sup>*</sup></label>
					<div class="form__input-file
					<?php if (isset($errors['image'])) : ?>form__item--invalid<?php endif ?>">
						<input class="visually-hidden" type="file" id="lot-img" name="image" value="">
						<label for="lot-img">Добавить</label>
						<span class="form__error"><? print $errors['image']?></span>
					</div>
				</div>
				<div class="form__container-three">
					<div class="form__item form__item--small
					<?php if (isset($errors['start_price'])) : ?>form__item--invalid<?php endif ?>">
						<label for="lot-rate">Начальная цена <sup>*</sup></label>
						<input id="lot-rate" type="text" name="start_price" placeholder="0" value=<? print $start_price ?>>
						<span class="form__error">Введите начальную цену</span>
					</div>
					<div class="form__item form__item--small
					<?php if (isset($errors['rate_step'])) : ?>form__item--invalid<?php endif ?>">
						<label for="lot-step">Шаг ставки <sup>*</sup></label>
						<input id="lot-step" type="text" name="rate_step" placeholder="0" value=<? print $rate_step ?>>
						<span class="form__error">Введите шаг ставки</span>
					</div>
					<div class="form__item
					<?php if (isset($errors['date_dead'])) : ?>form__item--invalid<?php endif ?>">
						<label for="lot-date">Дата окончания торгов <sup>*</sup></label>
						<input class="form__input-date" id="lot-date" type="text" name="date_dead" placeholder="Введите дату в формате ГГГГ-ММ-ДД" value=<? print $date_dead ?>>
						<span class="form__error">Введите дату завершения торгов в формате ГГГГ-ММ-ДД</span>
					</div>
				</div>
				<span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
				<button type="submit" class="button">Добавить лот</button>
			</form>
		</main>

	</div>

	<?= $footer; ?>

	<script src="../flatpickr.js"></script>
	<script src="../script.js"></script>
</body>

</html>
