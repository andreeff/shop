<div id="jf-right">
    {*категории*}
    <div class="jfmod module" id="Mod88">
        <div class="jfmod-top"></div>
        <div class="jfmod-mid">
            <h3>Меню</h3>
            <div class="jfmod-content">
                <ul class="menu">
                {foreach $rsCategories as $item}
                    <li class="item-444"><a href="/category/{$item['id']}/"><span>{$item['name']}</span></a></li>
                    {if isset($item['children'])}
                        <ul class="menu" style="padding: 0px 0px 10px 20px;">
                            {foreach $item['children'] as $itemChild}
                                <li class="item-444"><a href="/category/{$itemChild['id']}/"><span>{$itemChild['name']}</span></a></li>
                            {/foreach}
                        </ul>
                    {/if}
                {/foreach}
                </ul>
            </div>
        </div>
        <div class="jfmod-bot"></div>
    </div>
    {*корзина*}
    <div class="jfmod module_blue" id="Mod89">
        <div class="jfmod-top"></div>
        <div class="jfmod-mid">
            <h3>Корзина</h3>
            <div class="jfmod-content"><div class="joomimg89_main">
                    <div class="joomimg_row" style="font-size: 16px;">
                        <a href="/cart/" title="Перейти в корзину">В корзине</a>
                        <span id="cartCntItems">
                            {if $cartCntItems > 0}{$cartCntItems}{else}пусто{/if}
                        </span>
                    </div>
                    <div class="joomimg_clr"></div>
            </div></div>
        </div>
        <div class="jfmod-bot"></div>
    </div>
    {*Авторизация регистрация*}
    <div class="jfmod module_orangebold" id="Mod90">
        <div class="jfmod-top"></div>
        <div class="jfmod-mid">
            <div class="jfmod-content">
                {if isset($arUser)}
                    <div id="userBox">
                        <a href="/user/" id="userLink">{$arUser['displayName']}</a><br>
                        <a href="/user/logout/" onclick="logout();">Выход</a>
                    </div>
                {else}
                    <div id="userBox" class="hideme">
                        <a href="/user/" id="userLink"></a><br>
                        <a href="/user/logout/" onclick="logout();">Выход</a>
                    </div>
                    {if !isset($hideLoginBox)}
                    <div id="loginBox">
                        <div id="form-login">
                            Введите логин и пароль
                            <fieldset class="input">
                                <p id="form-login-username">
                                    <input type="text" id="loginEmail" name="username" value="Username" class="unputbox" alt="username" onblur="if(this.value=='') this.value='Username';" onfocus="if(this.value=='Username') this.value='';">
                                </p>
                                <p id="form-login-password">
                                    <input type="password" id="loginPwd" name="passwd" value="Password" class="inputbox" onblur="if(this.value=='') this.value='Password';" onfocus="if(this.value=='Password') this.value='';" alt="password">
                                </p>
                                <p style="text-align: right;">
                                    <input type="button" class="buttonLogin" onclick="login();" value="Войти">
                                </p>
                            </fieldset>
                        </div>
                    </div>
                    <div id="registerBox">
                        <div class="re-link menuCaption showHidden" onclick="showRegisterBox();">Регистрация</div>
                        <div id="form-login">
                            
                            <div id="registerBoxHidden" class="hideme">
                                <fieldset class="input">
                                    <p>
                                    email:<br>
                                    <input type="email" id="email" name="email" value=""><br>
                                    пароль:<br>
                                    <input type="password" id="pwd1" name="pwd1" value="">
                                    повторить пароль:<br>
                                    <input type="password" id="pwd2" name="pwd2" value="">
                                    <input type="button" 
                                          class="buttonLogin" onclick="registerNewUser();" value="Зарегестрироваться">
                                    </p>
                                </fieldset>
                            </div>
                            
                        </div>
                    </div>
                    {/if}
                {/if}
            </div>
        </div>
        <div class="jfmod-bot"></div>
    </div>
    
</div>
