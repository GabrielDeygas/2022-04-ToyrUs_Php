<?php
$GLOBALS['html_title'] = 'Liste des Jouets';

function toysListRender() {
    topPartRender();
    $all_brands = getAllBrands();
    $max_page = getMaxPages();

    if(
        ( !empty( $_GET['page'] ) && (intval($_GET['page']) === 0 || intval($_GET['page']) > $max_page ) )
        || ( !empty( $_GET['tri'] ) && !in_array( intval($_GET['tri']), [ 1, 2 ]) )
        || ( !empty( $_GET['bid'] ) && intval($_GET['bid']) === 0 )
    ) {
        http_response_code( 400 );
        echo '<h1>BAD REQUEST</h1>';
    }
    else {
        $page_number = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $bid = isset($_GET['bid']) ? intval($_GET['bid']) : 0;
        $tri = isset($_GET['tri']) ? intval($_GET['tri']) : 1;
        $page_next = $page_number + 1;
        $page_prev = $page_number - 1;
        $string_pg_prev = '?page=' . $page_prev;
        $string_pg_next = '?page=' . $page_next;
        $string_bid = !empty($_GET['bid']) ? '&bid=' . $_GET['bid'] : '';
        $string_tri = !empty($_GET['tri']) ? '&tri=' . $_GET['tri'] : '';

        $url_prev = '';
        if($page_prev > 0 && $page_prev !== 1) {
            $url_prev = $string_pg_prev . $string_bid . $string_tri;
        } elseif ($page_prev == 1) {
            $url_prev = '/jouets';
        }
        //TODO: Construction de l'URL si besoin

        $url_next = '';
        //TODO: Construction de l'URL si besoin
        if($page_next <= $max_page) {
            $url_next = $string_pg_next . $string_bid . $string_tri;
        }


        $all_toys = getAllToys( $page_number, $max_page, $tri, $bid );
        require_once PATH_ROOT .'app'. DS .'pages'. DS .'toys-list.php';
    }

    require_once PATH_ROOT .'app'. DS .'pages'. DS .'partials'. DS .'bottom-part.php';
}

function getAllToys( int $page = 1, int $page_max = 1, int $tri = 1, int $bid = 0 ): array
{
    global $mysqli;
    $limit_offset = ($page - 1) * 4;

    $result = [];

    $prep_args = [];
    $prep_types = '';

    $arr_q = [];
    $arr_q[] =  'SELECT toys.id, toys.name, toys.price, toys.image, brands.id as brand_id, brands.name as marque';
    $arr_q[] =          'FROM toys
                         JOIN brands ON brands.id = toys.brand_id';

    if( $bid > 0 ) {
        $arr_q[] = 'AND toys.brand_id = ?';
        $prep_args[] = &$bid;
        $prep_types .= 'i';
    }

    $arr_q[] =  'ORDER BY toys.price '. ($tri === 1 ? 'ASC' : 'DESC');
    $arr_q[] =  'LIMIT ? , 4';

    $q_prep = implode( ' ', $arr_q );

    $prep_args[] = &$limit_offset;
    $prep_types .= 'i';

    $stmt = mysqli_prepare($mysqli, $q_prep);

    if (
        ! $stmt
        || ! mysqli_stmt_bind_param($stmt, $prep_types, ...$prep_args)
    ) return $result;

    mysqli_stmt_execute($stmt);
    $q_result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if( ! $q_result ) return $result;

    while ($toy = mysqli_fetch_assoc($q_result)) $result[] = $toy;

    return $result;
}




