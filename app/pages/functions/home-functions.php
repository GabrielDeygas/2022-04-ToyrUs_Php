<?php
$GLOBALS['html_title'] = 'Accueil';

function homeRender() {
    topPartRender();
    $best_sales = getThirdBestSales();
    require_once PATH_ROOT .'app'. DS .'pages'. DS .'home.php';
    require_once PATH_ROOT .'app'. DS .'pages'. DS .'partials'. DS .'bottom-part.php';
}

function getThirdBestSales() {
    global $mysqli;

    $result = [];
    $q = 'SELECT toys.id, toys.name, toys.price, toys.image, sum(quantity) as all_sales
        FROM toys
         JOIN sales
              ON sales.toy_id=toys.id
GROUP BY toys.id, toys.price
ORDER BY all_sales desc, toys.price desc LIMIT 3';

    $q_result = mysqli_query( $mysqli, $q );

    if($q_result){
        while( $toy = mysqli_fetch_assoc( $q_result ) ) {
            $result[] = $toy;
        }
    }

    return $result;
}



