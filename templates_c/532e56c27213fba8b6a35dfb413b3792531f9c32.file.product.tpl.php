<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 16:13:06
         compiled from "themes/partner8_green/product.tpl" */ ?>
<?php /*%%SmartyHeaderCode:401909389517529520b2f03-07229842%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '532e56c27213fba8b6a35dfb413b3792531f9c32' => 
    array (
      0 => 'themes/partner8_green/product.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '401909389517529520b2f03-07229842',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_51752952104236_05211057',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51752952104236_05211057')) {function content_51752952104236_05211057($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('meta_head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div id="mainleft">
    <div id="window_wages">                           
    <?php echo $_smarty_tpl->getSubTemplate ('product_show.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </div> 
</div>    

<?php echo $_smarty_tpl->getSubTemplate ('category.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
                      
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>