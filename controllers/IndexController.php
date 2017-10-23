<?php
/**
 * контроллер главной страницы
 */

// подключаем модели
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';

/**
 * тестовая функция
 */
function testAction(){
    echo 'IndexController.php > testAction';
}

function indexAction($smarty){
    //> Пагинатор
    $paginator = array();
    $paginator['perPage'] = 9;
    $paginator['currentPage'] = isset($_GET['page']) ? $_GET['page'] : 1;
    $paginator['offset'] = ($paginator['currentPage'] * $paginator['perPage']) - $paginator['perPage'];
    $paginator['link'] = '/index/?page=';
    list($rsProducts, $allCnt) = getLastProducts($paginator['offset'], $paginator['perPage']);
    $paginator['pageCnt'] = ceil($allCnt/$paginator['perPage']);
    $smarty->assign('paginator', $paginator);
    //<
    $rsCategories = getAllMainCatsWithChildren();
    $smarty->assign('pageTitle', 'Главная страница сайта');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'index');
    loadTemplate($smarty, 'footer');
}


