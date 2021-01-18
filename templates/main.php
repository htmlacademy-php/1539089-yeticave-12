<?php
function lot_price($x)
{
    $x = ceil($x);
    if ($x >= 1000) {
        $x = number_format($x, 0, '.', ' ');
    }

    return $x . ' ' . '₽';
}
?>
<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">

            <li class="promo__item promo__item--boards">
                <?php
                foreach ($categories as $val) : ?>
                    <a class="promo__link" href="pages/all-lots.html"><?= htmlspecialchars($val); ?></a>
                <?php endforeach; ?>
            </li>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <li class="lots__item lot">
                <?php foreach ($staff as $key => $val) : ?>
                    <div class="lot__image">
                        <img src="<?= htmlspecialchars($val['image']); ?>" width="350" height="260" alt="">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?= htmlspecialchars($val['category']); ?></span>
                        <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?= htmlspecialchars($val['name']); ?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <?php require_once('index.php') ?>
                                <span class="lot__cost"><?= htmlspecialchars(lot_price($val['price'])); ?></span>
                            </div>
                            <div class="lot__timer timer">
                                12:23
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </li>
        </ul>
    </section>
</main>