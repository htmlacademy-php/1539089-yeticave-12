<?php
require_once 'helpers.php';
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
            <?php echo $header_categories; ?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">

            <?php
            foreach ($lots as $key => $val) : ?>
                <?php
                $date = (time_to_dead($val['date_dead']));
                if ($date[0] > 0 or ($date[0] >= 0 and $date[1] > 0)) :
                    ?>
                    <li class="lots__item lot">
                        <div class="lot__image">
                            <img src="<?php echo htmlspecialchars($val['image']); ?>" width="350" height="260" alt="">
                        </div>
                        <div class="lot__info">
                            <span class="lot__category"><?php echo htmlspecialchars($val['category_name']); ?></span>
                            <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?php echo $val['id'] ?>"><?php echo htmlspecialchars($val['lot_name']); ?></a></h3>
                            <div class="lot__state">
                                <div class="lot__rate">
                                    <span class="lot__amount">Стартовая цена</span>
                                    <span class="lot__cost"><?php echo htmlspecialchars(lot_price($val['start_price'])); ?></span>
                                </div>
                                <div class="lot__timer timer
                                    <?php
                                    if ($date[0] < 1) :
                                        ?>timer--finishing<?php
                                    endif ?>">
                                    <?php echo htmlspecialchars($date[0] . ':' . $date[1]); ?>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </section>
</main>
