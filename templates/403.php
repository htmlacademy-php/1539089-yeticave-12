<?php
require_once '../helpers.php';
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>403 Ошибка доступа</title>
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
            </nav>
            <section class="lot-item container">
                <h2>403 Ошибка доступа</h2>
                <p>Для добавления лота пожалуйста зарегестрируйтесь на сайте</p>
            </section>
        </main>

    </div>

    <?php echo $footer; ?>

</body>

</html>
