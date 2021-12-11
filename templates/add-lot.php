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
			<?= isset($errors) ? 'form--invalid' : '' ?>"  
			action="add.php" method="post" enctype="multipart/form-data">
				<!--Добавляем form--invalid  если были ошибки валидации-->
				<h2>Добавление лота</h2>
				<div class="form__container-two">
					<div class="form__item 
					<?= isset($errors['lot_name']) ? 'form__item--invalid' : '' ?>"> <!--Если значением первого подвыражения является true (не ноль), 
					то выполняется второе подвыражение, которое и будет результатом условного выражения. В противном случае будет выполнено третье подвыражение и его значение будет результатом.-->
						<label for="lot-name">Наименование <sup>*</sup></label>
						<input id="lot-name" type="text" name="lot_name" placeholder='Введите наименование лота' value=<?= htmlspecialchars($lot_name ?? '');?>>
						<span class="form__error">
							Введите наименование лота
						</span>
					</div>
					<div class="form__item
        			<?= isset($errors['category_id']) ? 'form__item--invalid' : '' ?>">
						<label for="category">Категория <sup>*</sup></label>
						<select id="category" name="category_id">
							<option>Выберите категорию</option>
							<?php
							foreach ($categories_dropdown as $key => $val) : ?>
								<option value="<?= $val['id']; ?>" <?php if ($val['id'] === $category_value) : ?>selected<?php endif; ?>>
									<!--сохраняем выбор-->
									<?= htmlspecialchars($val['category_name']) ?? '' ; ?>
								</option>
							<?php endforeach; ?>
						</select>
						<span class="form__error">Выберите категорию</span>
					</div>
				</div>
				<div class="form__item form__item--wide
				<?= isset($errors['description']) ? 'form__item--invalid' : '' ?>">
					<label for="message">Описание <sup>*</sup></label>
					<textarea id="message" name="description" placeholder="Напишите описание лота"><?= htmlspecialchars($description_value ?? ''); ?></textarea>
					<span class="form__error">Напишите описание лота</span>
				</div>
				<div class="form__item form__item--file">
					<label>Изображение <sup>*</sup></label>
					<div class="form__input-file
					<?= isset($errors['image']) ? 'form__item--invalid' : '' ?>">
						<input class="visually-hidden" type="file" id="lot-img" name="image" value="">
						<label for="lot-img">Добавить</label>
						<span class="form__error"><? print $errors['image']?></span>
					</div>
				</div>
				<div class="form__container-three">
					<div class="form__item form__item--small
					<?= isset($errors['start_price']) ? 'form__item--invalid' : '' ?>">
						<label for="lot-rate">Начальная цена <sup>*</sup></label>
						<input id="lot-rate" type="text" name="start_price" placeholder="0" value=<?= htmlspecialchars($start_price ?? ''); ?>>
						<span class="form__error">Введите начальную цену</span>
					</div>
					<div class="form__item form__item--small
					<?= isset($errors['rate_step']) ? 'form__item--invalid' : '' ?>">
						<label for="lot-step">Шаг ставки <sup>*</sup></label>
						<input id="lot-step" type="text" name="rate_step" placeholder="0" value=<?= htmlspecialchars($rate_step ?? ''); ?>>
						<span class="form__error">Введите шаг ставки</span>
					</div>
					<div class="form__item
					<?= isset($errors['date_dead']) ? 'form__item--invalid' : '' ?>">
						<label for="lot-date">Дата окончания торгов <sup>*</sup></label>
						<input class="form__input-date" id="lot-date" type="text" name="date_dead" placeholder="Введите дату в формате ГГГГ-ММ-ДД" value=<?= htmlspecialchars($date_dead ?? ''); ?>>
						<span class="form__error">Введите дату завершения торгов в формате ГГГГ-ММ-ДД</span>
					</div>
				</div>
				<span class="form__error form__error--bottom"><?= isset($errors['execute_error']) ? 'Произошла ошибка с вашим запросом, код ошибки: ' . $errors['execute_error'] : 'Пожалуйста, исправьте ошибки в форме.' ?></span>
				<button type="submit" class="button">Добавить лот</button>
			</form>
		</main>

	</div>

	<?= $footer; ?>

	<script src="../flatpickr.js"></script>
	<script src="../script.js"></script>
</body>

</html>
