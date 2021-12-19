<!DOCTYPE html>
<html lang="ru">

<head>
    <?php
    require_once 'helpers.php';
    foreach ($lot_info as $key => $val) : ?>
        <meta charset="UTF-8">
        <title><?php echo $val['lot_name'] ?></title>
        <link href="../css/normalize.min.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
</head>

<body>

    <div class="page-wrapper">

        <?php echo $header; ?>

        <main>
            <nav class="nav">
                <ul class="nav__list container">
                    <?php echo $lotpage_categories; ?>
                </ul>
            </nav>
            <section class="lot-item container">
                <?php $date = (time_to_dead($val['date_dead'])); ?>
                <h2>
                    <?php echo (htmlspecialchars($val['lot_name'])); ?>
                </h2>
                <div class="lot-item__content">
                    <div class="lot-item__left">
                        <div class="lot-item__image">
                            <img src="<?php echo htmlspecialchars($val['image']); ?>" width="730" height="548" alt="Сноуборд">
                        </div>
                        <p class="lot-item__category">Категория: <span><?php echo htmlspecialchars($val['category_name']); ?></span></p>
                        <p class="lot-item__description"><?php echo htmlspecialchars($val['description']); ?></p>
                    </div>
                    <?php if (isset($_SESSION) && !empty($_SESSION)) : ?>
                        <div class="lot-item__right">
                            <div class="lot-item__state">

                                <div class="lot-item__timer timer
                                    <?php
                                    if ($date[0] < 1) :
                                        ?>timer--finishing<?php
                                    endif ?>">
                                    <!-- Добавляем класс в зависимости от возвращаемого знаячения -->
                                    <?php echo htmlspecialchars($date[0] . ':' . $date[1]); ?>
                                </div>
                                <div class="lot-item__cost-state">
                                    <div class="lot-item__rate">
                                        <span class="lot-item__amount">Текущая цена</span>
                                        <?php if ($val['rate_sum'] != null) : ?>
                                            <!-- Если ставки есть, то вернет максимальную, если нет, то стартовую цену -->
                                            <span class="lot-item__cost">
                                    </div>
                                            <?php echo htmlspecialchars($val['rate_sum']); ?></span>
                                    <div class="lot-item__min-cost">
                                        Мин. ставка <span><?php echo htmlspecialchars($val['rate_sum']) + htmlspecialchars($val['rate_step']); ?></span>
                                    </div>
                                        <?php else : ?>
                                    <span class="lot-item__cost">
                                            <?php echo htmlspecialchars($val['start_price']); ?></span>
                                    <div class="lot-item__min-cost">
                                        Мин. ставка <span><?php echo htmlspecialchars($val['start_price']) + htmlspecialchars($val['rate_step']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post" autocomplete="off">
                                <p class="lot-item__form-item form__item form__item--invalid">
                                    <label for="cost">Ваша ставка</label>
                                    <input id="cost" type="text" name="cost" placeholder="12 000">
                                    <span class="form__error">Введите ставку</span>
                                </p>
                                <button type="submit" class="button">Сделать ставку</button>
                            </form>
                        </div>
                        <div class="history">
                            <h3>История ставок (<span>10</span>)</h3>
                            <table class="history__list">
                                <tr class="history__item">
                                    <td class="history__name">Иван</td>
                                    <td class="history__price">10 999 р</td>
                                    <td class="history__time">5 минут назад</td>
                                </tr>
                                <tr class="history__item">
                                    <td class="history__name">Константин</td>
                                    <td class="history__price">10 999 р</td>
                                    <td class="history__time">20 минут назад</td>
                                </tr>
                                <tr class="history__item">
                                    <td class="history__name">Евгений</td>
                                    <td class="history__price">10 999 р</td>
                                    <td class="history__time">Час назад</td>
                                </tr>
                                <tr class="history__item">
                                    <td class="history__name">Игорь</td>
                                    <td class="history__price">10 999 р</td>
                                    <td class="history__time">19.03.17 в 08:21</td>
                                </tr>
                                <tr class="history__item">
                                    <td class="history__name">Енакентий</td>
                                    <td class="history__price">10 999 р</td>
                                    <td class="history__time">19.03.17 в 13:20</td>
                                </tr>
                                <tr class="history__item">
                                    <td class="history__name">Семён</td>
                                    <td class="history__price">10 999 р</td>
                                    <td class="history__time">19.03.17 в 12:20</td>
                                </tr>
                                <tr class="history__item">
                                    <td class="history__name">Илья</td>
                                    <td class="history__price">10 999 р</td>
                                    <td class="history__time">19.03.17 в 10:20</td>
                                </tr>
                                <tr class="history__item">
                                    <td class="history__name">Енакентий</td>
                                    <td class="history__price">10 999 р</td>
                                    <td class="history__time">19.03.17 в 13:20</td>
                                </tr>
                                <tr class="history__item">
                                    <td class="history__name">Семён</td>
                                    <td class="history__price">10 999 р</td>
                                    <td class="history__time">19.03.17 в 12:20</td>
                                </tr>
                                <tr class="history__item">
                                    <td class="history__name">Илья</td>
                                    <td class="history__price">10 999 р</td>
                                    <td class="history__time">19.03.17 в 10:20</td>
                                </tr>
                            </table>
                        </div>
                </div>
                    <?php endif; ?>
            <!-- Тут должна быть история ставок, но в задании сказано его не реализовывать-->
            </section>
        </main>
    </div>

        <?php echo $footer; ?>

</body>
    <?php endforeach; ?>

</html>
