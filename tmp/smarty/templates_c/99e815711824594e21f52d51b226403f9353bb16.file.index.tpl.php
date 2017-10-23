<?php /* Smarty version Smarty-3.1.6, created on 2017-10-23 07:27:57
         compiled from "../views/texturia\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2500959e8b4f1efdf03-22267377%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99e815711824594e21f52d51b226403f9353bb16' => 
    array (
      0 => '../views/texturia\\index.tpl',
      1 => 1508663905,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2500959e8b4f1efdf03-22267377',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_59e8b4f1eff2a',
  'variables' => 
  array (
    'rsProducts' => 0,
    'item' => 0,
    'paginator' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e8b4f1eff2a')) {function content_59e8b4f1eff2a($_smarty_tpl) {?><div class="joomcat">
    <div class="joomcat96_row">
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rsProducts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['iteration']++;
?>
            <div style="width: 216px !important; margin-right: 10px;" class="joomcat96_imgct">
                <div class="joomcat96_img img">
                    <a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/">
                        <img src="/images/products/<?php echo $_smarty_tpl->tpl_vars['item']->value['image'];?>
" width="200" height="150">
                    </a>
                </div>
                <div style="padding-bottom: 10px; padding-top: 0px;" class="joomcat96_txt">
                    <ul>
                        <li><a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a></li>
                    </ul>
                </div>
            </div>
            <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['products']['iteration']%3==0){?>
            <div class="joomcat96_clr"></div>
    </div>
    <div class="joomcat96_row">
            <?php }?>
        <?php } ?>
    </div>
    <div class="pagination">
        <?php if ($_smarty_tpl->tpl_vars['paginator']->value['currentPage']!=1){?>
            <span class="p_prev"><a href="<?php echo $_smarty_tpl->tpl_vars['paginator']->value['link'];?>
<?php echo $_smarty_tpl->tpl_vars['paginator']->value['currentPage']-1;?>
">&nbsp;</a></span>
        <?php }?>
        <strong><span><?php echo $_smarty_tpl->tpl_vars['paginator']->value['currentPage'];?>
</span></strong>
        <?php if ($_smarty_tpl->tpl_vars['paginator']->value['currentPage']<$_smarty_tpl->tpl_vars['paginator']->value['pageCnt']){?>
            <span class="p_next"><a href="<?php echo $_smarty_tpl->tpl_vars['paginator']->value['link'];?>
<?php echo $_smarty_tpl->tpl_vars['paginator']->value['currentPage']+1;?>
">&nbsp;</a></span>
        <?php }?>
    </div>
</div>
<?php }} ?>