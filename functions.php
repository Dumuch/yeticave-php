<?php
session_start();
function render_template($__view, $__data)
{
    extract($__data);
    ob_start();
    require_once($__view);
    $output = ob_get_clean();
    return $output;
}


function out_time()
{
    date_default_timezone_set('Asia/Irkutsk');
    $dates=explode("-", date("m-d-Y"));
    $then=mktime(0, 0, 0, $dates[0], $dates[1]+1, $dates[2]);
    $now=time();
    $how=$then-$now;
    $hours=floor($how/3600);
    $mins=floor(($how-($hours*3600))/60);
    return $hours . " : " . $mins;
}


$visit_name = 'visit_pages';
function visit_history($lot_id, $visit_name)
{
    $visit_id = [];
    $coincidence = false;
    $expire = strtotime('+30 days');
    $path = '/';

    if (isset($_COOKIE[$visit_name])) {
        $visit_id = json_decode($_COOKIE[$visit_name]);

        foreach ($visit_id as $key) {
            if ($key == $lot_id) {
                $coincidence = true;
            }
        }
    };

    if ($coincidence == false) {
        array_push($visit_id, $lot_id);
    };

    $visit_id = json_encode($visit_id);

    setcookie($visit_name, $visit_id, $expire, $path);
}


function define_visit_history($visit_name, $products)
{
    $visit_value = json_decode($_COOKIE[$visit_name]);

    $products_history = [];

    if (!empty($visit_value)) {
        foreach ($visit_value as $item) {
            foreach ($products as $key => $value) {
                if ($item == $value['id']) {
                    array_push($products_history, $products[$key]);
                };
            }
        }
    }

    return $products_history;
}

function searchUserByEmail($email, $users)
{
    $user = [];
    foreach ($users as $item) {
        if ($email == $item['email']) {
            $user = $item;
        }
    }
    return $user;
}


function db_get_prepare_stmt(mysqli $link, string $sql, array $data = [])
{
    $stmt = mysqli_prepare($link, $sql);

    if (empty($data)) {
        return $stmt;
    }

    static $allowed_types = [
        'integer' => 'i',
        'double' => 'd',
        'string' => 's',
    ];

    $types = '';
    $stmt_data = [];

    foreach ($data as $value) {
        $type = gettype($value);

        if (!isset($allowed_types[$type])) {
            throw new \UnexpectedValueException(sprintf('Unexpected parameter type "%s".', $type));
        }

        $types .= $allowed_types[$type];
        $stmt_data[] = $value;
    }

    mysqli_stmt_bind_param($stmt, $types, ...$stmt_data);

    return $stmt;
}
