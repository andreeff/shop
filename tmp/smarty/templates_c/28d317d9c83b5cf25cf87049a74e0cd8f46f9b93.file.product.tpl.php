<?php /* Smarty version Smarty-3.1.6, created on 2017-10-20 14:44:07
         compiled from "../views/texturia\product.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24359e9c5f8a10916-18091107%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '28d317d9c83b5cf25cf87049a74e0cd8f46f9b93' => 
    array (
      0 => '../views/texturia\\product.tpl',
      1 => 1508499950,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24359e9c5f8a10916-18091107',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_59e9c5f8a6d7d',
  'variables' => 
  array (
    'rsProduct' => 0,
    'itemIncart' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e9c5f8a6d7d')) {function content_59e9c5f8a6d7d($_smarty_tpl) {?><div id="jf-content">
    <div class="gallery" id="image_detail">
    <div>
        <h3 class="jg_imgtitle" id="jg_photo_title"><?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['name'];?>
</h3>
    </div>
    <div class="jg_back" id="jg_back_detail">
        <a href="/">back</a>
    </div>
    <div style="text-align: center;" class="jg_dtl_photo" id="jg_dtl_photo">
        <img width="675" height="600" id="jg_photo_big" class="jg_photo" src="/images/products/<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['image'];?>
">
    </div>
    <div class="jg_detailnavi">
        <div class="jg_iconbar" style="font-size: 12px;">
        <a id="addCart_<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['itemIncart']->value){?>style="display: none;"<?php }?> href="#" onclick="addToCart(<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['id'];?>
); return false;" alt="Добавить в корзину">Добавить в корзину</a>
        <a id="removeCart_<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['id'];?>
" <?php if (!$_smarty_tpl->tpl_vars['itemIncart']->value){?>style="display: none;"<?php }?> href="#" onclick="removeFromCart(<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['id'];?>
); return false;" alt="Удалить из корзины">Удалить из корзины</a>
        </div>
    </div>
    <div class="jg_details">
    <div class="sectiontableentry1" style="font-size: 20px; padding-top: 20px;">
        <div class="jg_photo_left">
            Стоимость
        </div>
        <div class="jg_photo_right" id="jg_photo_author">
            <?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['price'];?>

        </div>
    </div>
    </div>
    <div style="clear:both;"></div>
    <div id="jg_photo_description_label" style="padding-top:20px;">Описание</div>
    <div id="jg_photo_description">
        <p><?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['description'];?>
</p>
    </div>
    <div class="sectiontableheader">
        &nbsp;
    </div>
</div>
</div>
<?php }} ?>