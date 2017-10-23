<?php
/**
 * модель для работы с таблицей products
 * 
 */

/**
 * получаем последние добавленые товары
 * 
 * @param int $limit лимит товаров
 * @return array массив товаров
 */
function getLastProducts($offset = 1, $limit = 12){
    global $link;
    $sqlCnt = "SELECT count(`id`) as cnt FROM `products`";
    $rs = mysqli_query($link, $sqlCnt);
    $cnt = createSmartyRsArray($rs);
    $sql = "SELECT * FROM `products` WHERE `status`=1 ORDER BY `id` DESC";
    $sql .= " LIMIT {$offset}, {$limit}"; 
    $rs = mysqli_query($link, $sql);
    $rows = createSmartyRsArray($rs);
    return array($rows, $cnt[0]['cnt']);
}

/**
 * получить продукты для категории $itemId
 * 
 * @param int $itemId ID категории
 * @return array массив продуктов
 */
function getProductsByCat($itemId, $offset = 1, $limit = 9){
    global $link;
    $itemId = intval($itemId);
    $sqlCnt = "SELECT count(`id`) as cnt FROM `products` WHERE `category_id` = '{$itemId}'";
    $rs = mysqli_query($link, $sqlCnt);
    $cnt = createSmartyRsArray($rs);
    $sql = "SELECT * FROM `products` WHERE `category_id` = '{$itemId}' AND `status`=1 LIMIT {$offset}, {$limit}";
    $rs = mysqli_query($link, $sql);
    $rows = createSmartyRsArray($rs);
    return array($rows, $cnt[0]['cnt']);
}

/**
 * получить данные продукта для $itemId
 * 
 * @param int $itemId ID продукта
 * @return array массив данных продукта
 */
function getProductById($itemId){
    global $link;
    $itemId = intval($itemId);
    $sql = "SELECT * FROM `products` WHERE `id` = '{$itemId}'";
    $rs = mysqli_query($link, $sql);
    return mysqli_fetch_assoc($rs);
}

/**
 * Получить список продуктов из массива идентификаторов Ids
 * 
 * @param $itemsIds массив идентификаторов
 * @return array массив данных продуктов
 */
function getProductsFromArray($itemsIds){
    global $link;
    $strIds = implode($itemsIds, ', ');
    $sql = "SELECT * FROM `products` WHERE `id` in ({$strIds})";
    $rs = mysqli_query($link, $sql);
    return createSmartyRsArray($rs);
}

/**
 * Получить данные продуктов
 */
function getProducts(){
    global $link;
    $query = "SELECT * FROM `products` ORDER BY `category_id`";
    $rs = mysqli_query($link, $query);
    return createSmartyRsArray($rs);
}

/**
 * Добавление продукта
 * 
 * @param string $itemName имя
 * @param float $itemPrice цена
 * @param string $itemDesc описание
 * @param int $itemCat ID категории
 */
function insertProduct($itemName, $itemPrice, $itemDesc, $itemCat){
    global $link;
    $query = "INSERT INTO `products` SET `name` = '{$itemName}', `price` = '{$itemPrice}', `description` = '{$itemDesc}', `category_id` = '{$itemCat}'";
    $rs = mysqli_query($link, $query);
    return $rs;
}

/**
 * Обновление товара
 * 
 * @param type $itemId
 * @param type $itemName
 * @param type $itemPrice
 * @param type $itemStatus
 * @param type $itemDesc
 * @param type $itemCat
 * @param type $newFileName
 * @return type
 */
function updateProduct($itemId, $itemName, $itemPrice, $itemStatus, $itemDesc, $itemCat, $newFileName = NULL){
    global $link;
    $set = array();
    if ($itemName){
        $set[] = "`name` = '{$itemName}'";
    }
    if ($itemPrice){
        $set[] = "`price` = '{$itemPrice}'";
    }
    if ($itemStatus !== NULL){
        $set[] = "`status` = {$itemStatus}";
    }
    if ($itemDesc){
        $set[] = "`description` = '{$itemDesc}'";
    }
    if ($itemCat){
        $set[] = "`category_id` = '{$itemCat}'";
    }
    if ($newFileName){
        $set[] = "`image` = '{$newFileName}'";
    }
    $setStr = implode($set, ', ');
    $query = "UPDATE `products` SET {$setStr} WHERE `id` = '{$itemId}'";
    $rs = mysqli_query($link, $query);
    return $rs;            
}

/**
 * 
 */
function updateProductImage($itemId, $newFileName){
    $rs = updateProduct($itemId, NULL, NULL, NULL, NULL, NULL, $newFileName);
    return $rs;
}

function insertImportProducts($aProducts){
    global $link;
    if (!is_array($aProducts))        return false;
    $sql = "INSERT INTO `products` (`name`, `category_id`, `description`, `price`, `status`) VALUES ";
    $cnt = count($aProducts);
    for ($i = 0; $i < $cnt; $i++){
        if ($i > 0) $sql .= ', ';
        $sql .= "('".implode("', '", $aProducts[$i])."')";
    }
    $rs = mysqli_query($link, $sql);
    return $rs;
}