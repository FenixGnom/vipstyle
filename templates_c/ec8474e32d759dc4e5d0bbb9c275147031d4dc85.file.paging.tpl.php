<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 16:11:24
         compiled from "themes/partner8_green/paging.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1469670756517528ec193334-10270941%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec8474e32d759dc4e5d0bbb9c275147031d4dc85' => 
    array (
      0 => 'themes/partner8_green/paging.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1469670756517528ec193334-10270941',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_data' => 0,
    'Paging' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_517528ec1eb967_59025139',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517528ec1eb967_59025139')) {function content_517528ec1eb967_59025139($_smarty_tpl) {?>
   	<?php if ($_smarty_tpl->tpl_vars['template_data']->value->pagginator()->previus()){?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->pagginator()->previus()->url();?>
"><<</a>
    <?php }?>
    <?php  $_smarty_tpl->tpl_vars['Paging'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['Paging']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['template_data']->value->pagginator()->links(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['Paging']->key => $_smarty_tpl->tpl_vars['Paging']->value){
$_smarty_tpl->tpl_vars['Paging']->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['Paging']->value->is_selected()==0){?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['Paging']->value->url();?>
"><?php echo $_smarty_tpl->tpl_vars['Paging']->value->name();?>
</a>
            <?php }else{ ?>
                    <b><?php echo $_smarty_tpl->tpl_vars['Paging']->value->name();?>
</b>
            <?php }?>
    <?php } ?>
    <?php if ($_smarty_tpl->tpl_vars['template_data']->value->pagginator()->next()){?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->pagginator()->next()->url();?>
">>></a>
    <?php }?>
   <?php }} ?>