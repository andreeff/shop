<?php /* Smarty version Smarty-3.1.6, created on 2017-10-16 16:19:18
         compiled from "../views/admin\adminHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:723459e4bfe6bb3ff9-14126781%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f57e82fa5ed0880e976fb6af9573ee08cc54de83' => 
    array (
      0 => '../views/admin\\adminHeader.tpl',
      1 => 1508163137,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '723459e4bfe6bb3ff9-14126781',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pageTitle' => 0,
    'TemplateWebPath' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_59e4bfe6c28af',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e4bfe6c28af')) {function content_59e4bfe6c28af($_smarty_tpl) {?><html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['TemplateWebPath']->value;?>
css/main.css" type="text/css">
        <script type='text/javascript' src="/js/jquery-1.7.1.min.js"></script>
        <script type='text/javascript' src="<?php echo $_smarty_tpl->tpl_vars['TemplateWebPath']->value;?>
js/admin.js"></script>
    </head>
    <body>
        <div id="header">
            <h1>Управление сайтом</h1>
        </div>
<?php echo $_smarty_tpl->getSubTemplate ('adminLeftcolumn.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <div id="centerColumn">
<?php }} ?>