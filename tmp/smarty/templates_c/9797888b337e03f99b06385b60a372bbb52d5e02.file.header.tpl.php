<?php /* Smarty version Smarty-3.1.6, created on 2017-10-09 19:10:47
         compiled from "../views/default\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:898159da21fe818340-83424863%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9797888b337e03f99b06385b60a372bbb52d5e02' => 
    array (
      0 => '../views/default\\header.tpl',
      1 => 1507568330,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '898159da21fe818340-83424863',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_59da21fe866dd',
  'variables' => 
  array (
    'pageTitle' => 0,
    'TemplateWebPath' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59da21fe866dd')) {function content_59da21fe866dd($_smarty_tpl) {?><html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['TemplateWebPath']->value;?>
css/main.css" type="text/css">
        <script type='text/javascript' src="/js/jquery-1.7.1.min.js"></script>
        <script type='text/javascript' src="/js/main.js"></script>
    </head>
    <body>
        <div id="header">
            <h1>my shop - интернет магазин</h1>
        </div>
<?php echo $_smarty_tpl->getSubTemplate ('leftcolumn.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        <div id="centerColumn">

<?php }} ?>