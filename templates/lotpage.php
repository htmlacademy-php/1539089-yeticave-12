<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
  require_once('helpers.php');
  foreach ($lot_info as $key => $val) : ?>
    <meta charset="UTF-8">
    <title><?= $val['lot_name'] ?></title>
    <link href="../css/normalize.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>

    <div class="page-wrapper">

    <?= $header; ?>

    <main>
        <nav class="nav">
            <ul class="nav__list container">
            <?=$lotpage_categories;?>
            </ul>
        </nav>
        <section class="lot-item container">
        <?php $date = (time_to_dead($val['date_dead'])); ?>
        <h2>
            <?=(htmlspecialchars($val['lot_name'])); ?>
        </h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <img src="<?= htmlspecialchars($val['image']); ?>" width="730" height="548" alt="Сноуборд">
                </div>
                <p class="lot-item__category">Категория: <span><?= htmlspecialchars($val['category_name']); ?></span></p>
                <p class="lot-item__description"><?= htmlspecialchars($val['description']); ?></p>
            </div>
            <div class="lot-item__right">
            <div class="lot-item__state">
            <div class="lot-item__timer timer
                <?php
                    if ($date[0] < 1) : ?>timer--finishing<?php endif ?>">
                    <!-- Добавляем класс в зависимости от возвращаемого знаячения -->
                <?=htmlspecialchars($date[0] . ':' . $date[1]);?>
            </div>
            <div class="lot-item__cost-state">
                <div class="lot-item__rate">
                    <span class="lot-item__amount">Текущая цена</span>
                    <?php if ($val['rate_sum'] != NULL) : ?>
                        <!-- Если ставки есть, то вернет максимальную, если нет, то стартовую цену -->
                    <span class="lot-item__cost">
                        <?= htmlspecialchars($val['rate_sum']); ?></span>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span><?= htmlspecialchars($val['rate_sum']) + htmlspecialchars($val['rate_step']); ?></span>
                    </div>
                    <?php else : ?>
                        <span class="lot-item__cost">
                            <?= htmlspecialchars($val['start_price']); ?></span>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span><?= htmlspecialchars($val['start_price']) + htmlspecialchars($val['rate_step']); ?></span>
                    <?php endif; ?>
                    </div>
                </div>
                <!-- Тут должна быть форма для ставки, но в задании сказано его не реализовывать-->
                </div>
                <!-- Тут должна быть история ставок, но в задании сказано его не реализовывать, но я могу попробовать))-->
        </section>
    </main>
    </div>

<?= $footer; ?>

</body>
<?php endforeach; ?>
</html>
