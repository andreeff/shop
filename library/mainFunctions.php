<?php
/**
 * Основные функции
 */

/**
 * Формирование запрашиваемой страницы
 * 
 * @param string $controllerName название контроллера
 * @param string $actionName название функции обработки страницы
 */
function loadPage($smarty, $controllerName, $actionName = 'index'){
    include_once PathPrefix . $controllerName . PathPostfix;
    
    $function = $actionName.'Action';
    $function($smarty);
}

/**
 * Загрузка шаблона
 * 
 * @param object $smarty объект шаблонизатора
 * @param string $templateName название файла шаблона
 */
function loadTemplate($smarty, $templateName){
    $smarty->display($templateName.TemplatePostfix);
}

/**
 * функция отладки кода
 * 
 * @param type $value
 * @param type $die
 */
function d($value = NULL, $die = 1){
    function debugOut($a){
        echo '<br><b>'.basename($a['file']).'<b>'
                ."&nbsp;<font color='red'>({$a['line']})</font>"
                ."&nbsp;<font color='green'>({$a['function']})</font>"
                ."&nbsp; -- ".dirname($a['file']);
    }
    echo '<pre>';
        $trace = debug_backtrace();
        array_walk($trace, 'debugOut');
        echo '\n\n';
        print_r($value);
    echo '</pre>';
    if ($die) die;
}

/**
 * Преобразование работы функции выборки в ассоциативный массив
 * 
 * @param recordset $rs набор строк - результат работы SELECT
 * @return array
 */
function createSmartyRsArray($rs){
    if (!$rs)        return FALSE;
    $smartyRs = array();
    while ($row = mysqli_fetch_assoc($rs)){
        $smartyRs[] = $row;
    }
    return $smartyRs;
}

/**
 * Редирект
 * @param string $url адрес перенаправления
 */
function redirect($url){
    if (!$url) $url = '/';
    header("Location: {$url}");
    exit();
}