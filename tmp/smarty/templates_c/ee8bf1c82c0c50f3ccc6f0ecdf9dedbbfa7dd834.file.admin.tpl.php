<?php /* Smarty version Smarty-3.1.6, created on 2017-10-16 16:47:30
         compiled from "../views/admin\admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2497659e4bfe6d18ce1-15297206%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee8bf1c82c0c50f3ccc6f0ecdf9dedbbfa7dd834' => 
    array (
      0 => '../views/admin\\admin.tpl',
      1 => 1508165246,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2497659e4bfe6d18ce1-15297206',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_59e4bfe6d1a8b',
  'variables' => 
  array (
    'rsCategories' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e4bfe6d1a8b')) {function content_59e4bfe6d1a8b($_smarty_tpl) {?><div id="blockNewCategory">
    Новая категория:
    <input name="newCategoryName" id="newCategoryName" type="text" value=""><br><br>
    Является подкатегорией для
    <select name="generalCatId">
        <option value="0">Главная категория</option>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rsCategories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option>
        <?php } ?>
    </select><br><br>
    <input type="button" onclick="newCategory();" value="Добавить категорию">
</div>
<?php }} ?>