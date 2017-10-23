<?php
/**
 * Модель для работы с таблицей categories
 */

/**
 * получить дочерние категории для категории $catId
 * 
 * @param int $catId Id категории
 * @return array массив дочерних категорий
 */
function getСhildrenForCat($catId){
    global $link;
    $sql = "SELECT * FROM `categories` WHERE `parent_id` = '{$catId}'";
    $rs = mysqli_query($link, $sql);
    return createSmartyRsArray($rs);
}


/**
 * Получить главные категории с привязкой дочерних
 * 
 * @return array массив категорий
 */
function getAllMainCatsWithChildren(){
    global $link;
    $sql = 'SELECT * FROM `categories` WHERE `parent_id`=0';
    $rs = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_assoc($rs)){
        $rsChildren = getСhildrenForCat($row['id']);
        if ($rsChildren){
            $row['children'] = $rsChildren;
        }
        $smartyRs[] = $row;
    }
    return $smartyRs;
}

/**
 * получить данный категории по ID
 * 
 * @param int $catId категория
 * @return array массив - строка категории
 */
function getCatById ($catId){
    global $link;
    $catId = intval($catId);
    $sql = "SELECT * FROM `categories` WHERE `id` = '{$catId}'";
    $rs = mysqli_query($link, $sql);
    return mysqli_fetch_assoc($rs);
}

/**
 * Получить все главные категории
 * 
 * @return array массив категорий
 */
function getAllMainCategories(){
    global $link;
    $query = "SELECT * FROM `categories` WHERE `parent_id` = 0";
    $rs = mysqli_query($link, $query);
    return createSmartyRsArray($rs);
}

/**
 * Добавление новой категории
 * @param string $catName Название категории
 * @param int $catParentId ID родительской категории
 * @return integer id новой категории
 */
function insertCat($catName, $catParentId = 0){
    global $link;
    $query = "INSERT INTO `categories` (`parent_id`, `name`) VALUES ('{$catParentId}', '{$catName}')";
    mysqli_query($link, $query);
    $id = mysqli_insert_id($link);
    return $id;
}

/**
 * получить все категории
 * @return array массив категорий
 */
function getAllCategories(){
    global $link;
    $query = "SELECT * FROM `categories` ORDER BY `parent_id` ASC";
    $rs = mysqli_query($link, $query);
    return createSmartyRsArray($rs);
}

/**
 * Обновление категорий
 * @param int $itemId категории
 * @param int $parentId гдавная категория
 * @param str $newName новое имя
 * @return
 */
function updateCategoryData($itemId, $parentId = -1, $newName = ''){
    global $link;
    $set = array();
    if ($newName){
        $set[] = "`name` = '{$newName}'";
    }
    $set[] = "`parent_id` = '{$parentId}'";
    $setStr = implode($set, ', ');
    $query = "UPDATE `categories` SET {$setStr} WHERE `id` = '{$itemId}'";
    $rs = mysqli_query($link, $query);
    return $rs;
}
