<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?php echo $page_name ?></title>
    <link href="../css/normalize.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="page-wrapper">

        <?php echo $header; ?>

        <?php echo $content; ?>

    </div>

    <?php echo $footer; ?>

    <script src="flatpickr.js"></script>
    <script src="script.js"></script>
</body>

</html>
