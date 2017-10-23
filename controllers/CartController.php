<?php
/**
 * контроллер работы с корзиной
 * 
 */

// подключаем модели
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';
include_once '../models/OrdersModel.php';
include_once '../models/PurchaseModel.php';

/**
 * Добавление продукта в корзину
 * 
 * @param int id Get параметр - ID добавленого продукта
 * @return json информация об операции (успех, колво элементов в корзине)
 */
function addtocartAction(){
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : NULL;
    if (!$itemId)        return FALSE;
    $resData = array();
    //если значение не найдено, то добавляем
    if (isset($_SESSION['cart']) && array_search($itemId, $_SESSION['cart']) === FALSE){
        $_SESSION['cart'][] = $itemId;
        $resData['cntItems'] = count($_SESSION['cart']);
        $resData['success'] = 1;
    } else{
        $resData['success'] = 0;
    }
    echo json_encode($resData);
}

/**
 * Удаление продукта из корзины
 * 
 * @param int id Get параметр - ID удаляемого продукта
 * @return json информация об операции (успех, колво элементов в корзине)
 */
function removefromcartAction(){
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : NULL;
    if(!$itemId) exit ();
    $resData = array();
    $key = array_search($itemId, $_SESSION['cart']);
    if($key !== FALSE){
        unset($_SESSION['cart'][$key]);
        $resData['success'] = 1;
        $resData['cntItems'] = count($_SESSION['cart']);
    } else {
        $resData['success'] = 0;
    }
    echo json_encode($resData);
}

/**
 * формирование страницы заказа
 * @link /cart/ 
 * 
 */
function indexAction($smarty){
    $itemsIds = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $rsCategories = getAllMainCatsWithChildren();
    $rsProducts = getProductsFromArray($itemsIds);
    $smarty->assign('pageTitle', 'Корзина');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'cart');
    loadTemplate($smarty, 'footer');
}

/**
 * Формирование страницы заказа
 */
function orderAction($smarty){
    // получаем массив ID продуктов
    $itemsIds = isset($_SESSION['cart']) ? $_SESSION['cart'] : NULL;
    // если корзина пуста то редирект в корзину
    if (!$itemsIds){
        redirect('/cart/');
        return;
    }
    //
    $itemsCnt = array();
    foreach ($itemsIds as $item){
        // формируем ключ для массива POST
        $postVar = 'itemCnt_'.$item;
        // создаем элемент массива количества покупаемого
        // ключ массива - ID товараб значение массива - кол-во товара
        // $itemCnt[1] = 3; товар с ID == 1 покупают 3 штуки 
        $itemsCnt[$item] = isset($_POST[$postVar]) ? $_POST[$postVar] : NULL;
    }
    // получаем список продуктов по массиву корзины
    $rsProducts = getProductsFromArray($itemsIds);
    // добавляем каждому продукту дополнительное поле
    // realPrice = кол-во продуктов * на цену продукта
    // cnt - кол-во покупаемого товара
    // &$item - для того чтобы меняя при изменении переменной $item
    // менялся и массив $rsProducts
    $i = 1;
    foreach ($rsProducts as &$item){
        $item['cnt'] = isset($itemsCnt[$item['id']]) ? $itemsCnt[$item['id']] : NULL;
        if ($item['cnt']){
            $item['realPrice'] = $item['cnt'] * $item['price'];
        } else {
            // если вдруг получилось так что товар в корзине есть, а кол-во == нулю
            // то удаляем этот товар
            unset($rsProducts[$i]);
        }
        $i++;
    }
    if (!$rsProducts){
        echo 'Корзина пуста';
        return;
    }
    // полученный массив покупаемых товаров помещаем в сессионную переменную
    $_SESSION['saleCart'] =  $rsProducts;
    $rsCategories = getAllMainCatsWithChildren();
    // hideLoginBox переменная-флаг для того чтобы спрятать блоки
    // логина и пароля в боковой панели
    if (!isset($_SESSION['user'])){
        $smarty->assign('hideLoginBox', 1);
    }
    $smarty->assign('pageTitle', 'Заказ');
    $smarty->assign('rsProducts', $rsProducts);
    $smarty->assign('rsCategories', $rsCategories);
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'order');
    loadTemplate($smarty, 'footer');
}

/**
 * AJAX функция сохранения заказа
 * 
 * @param array $_SESSION['saleCart'] массив покупаемых товаров
 * @return json информация о результате выполнения
 */
function saveorderAction(){
    // получаем массив покупаемых товаров
    $cart = isset($_SESSION['saleCart']) ? $_SESSION['saleCart'] : NULL;
    // если корзина пуста, то формируем ответ с ошибкой, отдаем его в формате
    // json и выходим из функции
    if (!$cart){
        $resData['success'] = 0;
        $resData['message'] = 'Нет товаров для заказа';
        echo json_encode($resData);
        return;
    }
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $adress = $_POST['adress'];
    // создем новый заказ и получаем его ID
    $orderId = makeNewOrder($name, $phone, $adress);
    // если заказ не создан, то выдаем ошибку и завершаем функцию
    if (!$orderId){
        $resData['success'] = 0;
        $resData['message'] = 'Ошибка создания заказа';
        echo json_encode($resData);
        return;
    }
    // сохраняем товары для созданого заказа
    $res = setPurchaseForOrder($orderId, $cart);
    // если успешно, то формируем ответ, очищаем корзину
    if ($res){
        $resData['success'] = 1;
        $resData['message'] = 'Заказ сохранен';
        unset($_SESSION['saleCart']);
        unset($_SESSION['cart']);
    } else {
        $resData['success'] = 0;
        $resData['message'] = 'Ошибка внесения данных для заказа № '.$orderId;
    }
    echo json_encode($resData);
}