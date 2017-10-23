<?php
/**
 * модель для таблицы заказов orders
 */

/**
 * создание заказа без привязки товаза
 * 
 * @param string $name имя
 * @param string $phone телефон
 * @param string $adress адрес
 * @return int ID созданого заказа
 */
function makeNewOrder($name, $phone, $adress){
    global $link;
    //> инициализация переменных
    $userId = $_SESSION['user']['id'];
    $comment = "id пользователя: {$userId}<br>
    Имя: {$name}<br>
    Телефон: {$phone}<br>
    Адрес: {$adress}";
    $dateCreated = date('Y.m.d H:i:s');
    $userIp = $_SERVER['REMOTE_ADDR'];
    //<
    $sql = "INSERT INTO `orders` (`user_id`, `date_created`, `date_payment`, `status`, `comment`, `user_ip`) VALUES ('{$userId}', '{$dateCreated}', null, '0', '{$comment}', '{$userIp}')";
    $rs = mysqli_query($link, $sql);
    if ($rs){
        $sql = "SELECT `id` FROM `orders` ORDER BY `id` DESC LIMIT 1";
        $rs = mysqli_query($link, $sql);
        $rs = createSmartyRsArray($rs);
        if (isset($rs[0])){
            return $rs[0]['id'];
        }
    }
    return FALSE;
}


/**
 * получить список заказов с привязкой продуктов для пользователя
 * 
 * @param int $userId ID пользователя
 * @return array заказов с привязкой к продуктам
 */
function getOrdersWithProductsByUser($userId){
    global $link;
    $userId = intval($userId);
    $sql = "SELECT * FROM `orders` WHERE `user_id` = '{$userId}' ORDER BY `id` DESC";
    $rs = mysqli_query($link, $sql);
    $smartyRs = array();
    while ($row = mysqli_fetch_assoc($rs)){
        $rsChildren = getPurchaseForOrder($row['id']);
        if ($rsChildren){
            $row['children'] = $rsChildren;
            $smartyRs[] = $row;
        }
    }
    return $smartyRs;
}

function getOrders(){
    global $link;
    $query = "SELECT o.*, u.name, u.email, u.phone, u.adress FROM `orders` AS `o` LEFT JOIN `users` AS `u` ON o.user_id = u.id ORDER BY `id` DESC";
    $rs = mysqli_query($link, $query);
    $smartyRs = array();
    while ($row = mysqli_fetch_assoc($rs)){
        $rsChildren = getProductsForOrder($row['id']);
        if ($rsChildren){
            $row['children'] = $rsChildren;
            $smartyRs[] = $row; 
        }
    }
    return $smartyRs;
}

function getProductsForOrder($orderId){
    global $link;
    $query = "SELECT * FROM `purchase` AS `pe` LEFT JOIN `products` AS `ps` ON pe.product_id = ps.id WHERE (`order_id` = '{$orderId}')";
    $rs = mysqli_query($link, $query);
    return createSmartyRsArray($rs);
}

function updateOrderStatus($itemId, $status){
    global $link;
    $status = intval($status);
    $query = "UPDATE `orders` SET `status` = '{$status}' WHERE `id` = '{$itemId}'";
    $rs = mysqli_query($link, $query);
    return $rs;
}

function updateOrderDatePayment($itemId, $datePayment){
    global $link;
    $query = "UPDATE `orders` SET `date_payment` = '{$datePayment}' WHERE `id` = '{$itemId}'";
    $rs = mysqli_query($link, $query);
    return $rs;
}