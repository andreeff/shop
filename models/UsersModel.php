<?php
/**
 * модель для работы с таблицей пользователей users
 * 
 */

/**
 * Регистрация нового пользователя
 * 
 * @param string $email почта
 * @param string $pwdMD5 пароль зашифрованный в MD5
 * @param string $name имя
 * @param string $phone телефон
 * @param string $adress адрес
 * @return array массив данных нового пользователя
 */
function registerNewUser($email, $pwdMD5, $name, $phone, $adress){
    global $link;
    $email = htmlspecialchars(mysqli_real_escape_string($link, $email));
    $name = htmlspecialchars(mysqli_real_escape_string($link, $name));
    $phone = htmlspecialchars(mysqli_real_escape_string($link, $phone));
    $adress = htmlspecialchars(mysqli_real_escape_string($link, $adress));
    $sql = "INSERT INTO `users` (`email`, `pwd`, `name`, `phone`, `adress`) VALUES ('{$email}', '{$pwdMD5}', '{$name}', '{$phone}', '{$adress}')";
    $rs = mysqli_query($link, $sql);
    if ($rs){
        $sql = "SELECT * FROM `users` WHERE (`email` = '{$email}' and `pwd` = '{$pwdMD5}') LIMIT 1";
        $rs = mysqli_query($link, $sql);
        $rs = createSmartyRsArray($rs);
        if (isset($rs[0])){
            $rs['success'] = 1;
        } else {
            $rs['success'] = 0;
        }
    } else {
        $rs['success'] = 0;
    }
    return $rs;
}

/**
 * проверка входных параметров
 * 
 * @param string $email
 * @param string $pwd1
 * @param string $pwd2
 * @return array результат
 */
function checkRegisterParams($email, $pwd1, $pwd2){
    $res = NULL;
    if (!$email){
        $res['success'] = 0;
        $res['message'] = 'Введите email';
    } else {
        if (!$pwd1){
            $res['success'] = 0;
            $res['message'] = 'Введите пароль';
        } else {
            if (!$pwd2){
                $res['success'] = 0;
                $res['message'] = 'Введите повтор пароля';
            } else {
                if ($pwd1 != $pwd2){
                    $res['success'] = 0;
                    $res['message'] = 'Пароли не совпадают';
                }
            }
        }
    }
    return $res;
}

/**
 * проверка почты (есть ли email в БД)
 * 
 * @param string $email
 * @return array массив - строка из таблицы users либо пустой массив
 */
function checkUserEmail($email){
    global $link;
    $email = mysqli_real_escape_string($link, $email);
    $sql = "SELECT `id` FROM `users` WHERE `email` = '{$email}'";
    $rs = mysqli_query($link, $sql);
    return createSmartyRsArray($rs);
}

/**
 * Авторизация пользователя
 * 
 * @param string $email
 * @param string $pwd
 * @return array данных пользователя
 */
function loginUser($email, $pwd){
    global $link;
    $email = htmlspecialchars(mysqli_real_escape_string($link, $email));
    $pwd = md5($pwd);
    $sql = "SELECT * FROM `users` WHERE (`email` = '{$email}' and `pwd` = '{$pwd}') LIMIT 1";
    $rs  = mysqli_query($link, $sql);
    $rs = createSmartyRsArray($rs);
    if (isset($rs[0])){
        $rs['success'] = 1;
    } else{
        $rs['success'] = 0;
    }
    return $rs;
}

/**
 * Изменение данных пользователя
 * 
 * @param str $name имя
 * @param str $phone телефон
 * @param str $adress адрес
 * @param str $pwd1  новый пароль
 * @param str $pwd2 повтор
 * @param str $curPwd текущий пароль
 * @return boolean TRUE в случае успеха
 */
function updateUserData($name, $phone, $adress, $pwd1, $pwd2, $curPwd){
    global $link;
    $email = htmlspecialchars(mysqli_real_escape_string($link, $_SESSION['user']['email']));
    $name = htmlspecialchars(mysqli_real_escape_string($link, $name));
    $phone = htmlspecialchars(mysqli_real_escape_string($link, $phone));
    $adress = htmlspecialchars(mysqli_real_escape_string($link, $adress));
    //$curPwd = htmlspecialchars(mysqli_real_escape_string($link, $curPwd));
    $pwd1 = trim($pwd1);
    $pwd2 = trim($pwd2);
    $newPwd = NULL;
    if ($pwd1 && ($pwd1 = $pwd2)){
        $newPwd = md5($pwd1);
    }
    $sql = "UPDATE `users` SET ";
    if ($newPwd){
        $sql .= "`pwd` = '{$newPwd}', ";
    }
    $sql .= "`name` = '{$name}', `phone` = '{$phone}', `adress` = '{$adress}' WHERE `email` = '{$email}' AND `pwd` = '{$curPwd}' LIMIT 1";
    $rs = mysqli_query($link, $sql);
    return $rs;
}

/**
 * получить данные заказа для текущего пользователя
 * @return array массив заказов
 */
function getCurUserOrders(){
    $userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : NULL;
    $rs = getOrdersWithProductsByUser($userId);    //d($rs);
    return $rs;
}