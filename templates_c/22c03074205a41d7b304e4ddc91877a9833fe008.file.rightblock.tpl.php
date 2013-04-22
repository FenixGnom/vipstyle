<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 17:03:20
         compiled from "themes/partner7/rightblock.tpl" */ ?>
<?php /*%%SmartyHeaderCode:183086751051753518737d00-21259247%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22c03074205a41d7b304e4ddc91877a9833fe008' => 
    array (
      0 => 'themes/partner7/rightblock.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '183086751051753518737d00-21259247',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_data' => 0,
    'categories' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_517535187515e0_64798597',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517535187515e0_64798597')) {function content_517535187515e0_64798597($_smarty_tpl) {?><div id="sidebar">
        <h3><span>Категории</span></h3>
    <ul>
                <li><a href="/new"><b>Новинки</b></a></li>
                <?php  $_smarty_tpl->tpl_vars['categories'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['categories']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['template_data']->value->menu(1); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['categories']->key => $_smarty_tpl->tpl_vars['categories']->value){
$_smarty_tpl->tpl_vars['categories']->_loop = true;
?>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['categories']->value->url();?>
"><?php echo $_smarty_tpl->tpl_vars['categories']->value->name();?>
</a></li>
                <?php } ?>
    </ul>
</div><!-- end of #sidebar --><?php }} ?>