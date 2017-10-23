<?php
/**
 * контроллер страницы категорий
 * 
 */

// подключаем модели
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';

/**
 * формирование страницы товара
 * 
 * @param object $smarty шаблонизатор
 */
function indexAction ($smarty){
    $itemId = isset($_GET['id']) ? $_GET['id'] : NULL;
    if (!$itemId) exit ();
    // получить данные продукта
    $rsProduct = getProductById($itemId);
    // получить все категории
    $rsCategories = getAllMainCatsWithChildren();
    $smarty->assign('itemIncart', 0);
    if (in_array($itemId, $_SESSION['cart'])) {
        $smarty->assign('itemInCart', 1);
    }
    $smarty->assign('pageTitle', '');
    $smarty->assign('rsProduct', $rsProduct);
    $smarty->assign('rsCategories', $rsCategories);
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'product');
    loadTemplate($smarty, 'footer');
}

