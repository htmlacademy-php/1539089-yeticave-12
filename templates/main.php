<?php
function lot_price ($x) {
    $x = ceil($x);
    if ($x >= 1000) {
        $x = number_format($x, 0, '.', ' ');
    }

    return $x.' '.'₽';
}
?>

<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
        <?php
        $categories = [
            "Доски и лыжи",
            "Крепления",
            "Ботинки",
            "Одежда",
            "Инструменты",
            "Разное"
        ];
        ?>
            <!--заполните этот список из массива категорий-->
            <li class="promo__item promo__item--boards">
            <?php
                foreach ($categories as $val): ?>
                    <a class="promo__link" href="pages/all-lots.html"><?=$val;?></a> 
                <?php endforeach; ?>   
            </li>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <?php
            $staff = [
                [
                    'name' => '2014 Rossignol District Snowboard',
                    'category' => 'Доски и лыжи',
                    'price' => 10999,
                    'image' => 'img/lot-1.jpg'
                ],
                [
                    'name' => 'DC Ply Mens 2016/2017 Snowboard',
                    'category' => 'Доски и лыжи',
                    'price' => 159999,
                    'image' => 'img/lot-2.jpg'
                ],
                [
                    'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
                    'category' => 'Крепления',
                    'price' => 8000,
                    'image' => 'img/lot-3.jpg'
                ],
                [
                    'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
                    'category' => 'Ботинки',
                    'price' => 10999,
                    'image' => 'img/lot-4.jpg'
                ],
                [
                    'name' => 'Куртка для сноуборда DC Mutiny Charocal',
                    'category' => 'Одежда',
                    'price' => 7500,
                    'image' => 'img/lot-5.jpg'
                ],
                [
                    'name' => 'Маска Oakley Canopy',
                    'category' => 'Разное',
                    'price' => 5400,
                    'image' => 'img/lot-6.jpg'
                ],
            ]; ?>
            <!--заполните этот список из массива с товарами-->
            <li class="lots__item lot">
            <?php foreach ($staff as $key => $val): ?>
                <div class="lot__image">
                    <img src="<?=$val['image'];?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=$val['category'];?></span>
                    <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?=$val['name'];?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>          
                            <span class="lot__cost"><?=lot_price($val['price']);?></span>
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