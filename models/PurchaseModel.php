<?php
/**
 * модель для таблицы покупок purchase
 */

/**
 * внесение в БД данных продуктов с привязкой к заказу
 * 
 * @param int $orderId заказа
 * @param array $cart массив корзины
 * @return boolean TRUE случае успешного добавления в БД
 */
function setPurchaseForOrder($orderId, $cart){
    global $link;
    $sql = "INSERT INTO `purchase` (`order_id`, `product_id`, `price`, `amount`) VALUES ";
    $values = array();
    // формируем массив строк для запроса для каждого товара
    foreach ($cart as $item){
        $values[] = "('{$orderId}', '{$item['id']}', '{$item['price']}', '{$item['cnt']}')";
    }
    $sql .= implode($values, ', ');
    $rs = mysqli_query($link, $sql);
    return $rs;
}

/**
 * получить покупки по ID заказа
 * 
 * @param int $orderId ID заказа
 * @return array массив заказов с привязкой продуктов
 */
function getPurchaseForOrder($orderId){
    global $link;
    $sql = "SELECT `pe`.*, `ps`.`name` FROM `purchase` as `pe` JOIN `products` as `ps` ON `pe`.`product_id` = `ps`.`id` WHERE `pe`.`order_id` = {$orderId}";
    $rs = mysqli_query($link, $sql);
    return createSmartyRsArray($rs);
}