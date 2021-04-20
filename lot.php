<?php
    require_once('helpers.php');
    date_default_timezone_set('Asia/Sakhalin');
    $con = connection();
   
    if (!isset($_GET['id']) || !ctype_digit($_GET['id']) ) { 
        return error404();
    }
        $lot_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $query_lot = "SELECT lots.*, category_name, rate_sum   
        FROM lots
        INNER JOIN categories
        ON lots.category_id = categories.id
        LEFT JOIN rates 
        ON rates.id = (
        SELECT ra.id
        FROM rates ra
        WHERE ra.lot_id = lots.id
        ORDER BY ra.rate_sum DESC LIMIT 1
        )
        WHERE lots.id = $lot_id;";

        $lot_resourse = mysqli_query($con, $query_lot);

        $lot_info = mysqli_fetch_all($lot_resourse, MYSQLI_ASSOC);

        if (empty($lot_info)){
            return error404();
        }
            $lotpage_content = include_template(
                'lotpage.php',
                    [
                        'lot_info' => $lot_info
                    ]
            );
            print ($lotpage_content);
