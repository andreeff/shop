<?php
/**
 * контроллер страницы категорий
 * 
 */

// подключаем модели
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';

/**
 * формирование страницы категорий
 * 
 * @param object $smarty шаблонизатор
 */
function indexAction ($smarty){
    $catId = isset($_GET['id']) ? $_GET['id'] : NULL;
    if (!$catId) exit ();
    $rsProducts = NULL;
    $rsChildCats = NULL;
    $rsCategory = getCatById($catId);
    // если главная категория то показываем дочерние
    // иначе показываем товары категории
    if ($rsCategory['parent_id'] == 0){
        $rsChildCats = getСhildrenForCat($catId);
    } else {
        //$rsProducts = getProductsByCat($catId);
        //> Пагинатор
        $paginator = array();
        $paginator['perPage'] = 9;
        $paginator['currentPage'] = isset($_GET['page']) ? $_GET['page'] : 1;
        $paginator['offset'] = ($paginator['currentPage'] * $paginator['perPage']) - $paginator['perPage'];
        $paginator['link'] = '/category/'.$catId.'/?page=';
        list($rsProducts, $allCnt) = getProductsByCat($catId, $paginator['offset'], $paginator['perPage']);
        $paginator['pageCnt'] = ceil($allCnt/$paginator['perPage']);
        $smarty->assign('paginator', $paginator);
        //<
    }
    $rsCategories = getAllMainCatsWithChildren();
    $smarty->assign('pageTitle', 'Товары категории '.$rsCategory['name']);
    $smarty->assign('rsCategory', $rsCategory);
    $smarty->assign('rsProducts', $rsProducts);
    $smarty->assign('rsChildCats', $rsChildCats);
    $smarty->assign('rsCategories', $rsCategories);
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'category');
    loadTemplate($smarty, 'footer');
}