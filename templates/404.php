<?php
require_once('helpers.php');
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>404 Страница не найдена</title>
    <link href="../css/normalize.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>

    <div class="page-wrapper">

        <?= $header; ?>

        <main>
            <nav class="nav">
                <ul class="nav__list container">
                    <?= $categories_list;?>
            </nav>
            <section class="lot-item container">
                <h2>404 Страница не найдена</h2>
                <p>Данной страницы не существует на сайте.</p>
            </section>
        </main>

    </div>

    <?=$footer; ?>

</body>

</html>
