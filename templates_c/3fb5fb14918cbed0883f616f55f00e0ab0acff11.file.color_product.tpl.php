<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 16:13:06
         compiled from "themes/partner8_green/color_product.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1156887499517529522903c1-05418299%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3fb5fb14918cbed0883f616f55f00e0ab0acff11' => 
    array (
      0 => 'themes/partner8_green/color_product.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1156887499517529522903c1-05418299',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_data' => 0,
    'Colors' => 0,
    'coloricon' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_517529522d7593_66939611',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517529522d7593_66939611')) {function content_517529522d7593_66939611($_smarty_tpl) {?><div style="width:230px;">
    <?php $_smarty_tpl->tpl_vars['coloricon'] = new Smarty_variable('', null, 0);?>
    
	<?php  $_smarty_tpl->tpl_vars['Colors'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['Colors']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['template_data']->value->colors(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['Colors']->key => $_smarty_tpl->tpl_vars['Colors']->value){
$_smarty_tpl->tpl_vars['Colors']->_loop = true;
?>
            <?php $_smarty_tpl->tpl_vars['coloricon'] = new Smarty_variable((((('/themes/').($_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path())).('images/color/')).($_smarty_tpl->tpl_vars['Colors']->value->color_abriv())).('.gif'), null, 0);?>
           
                <div style="width:19px;float:left; height:19px;margin-left:5px;margin-top:3px;cursor:pointer;background: url('<?php echo $_smarty_tpl->tpl_vars['coloricon']->value;?>
');" <?php if (count($_smarty_tpl->tpl_vars['template_data']->value->colors())>1){?> onClick="<?php echo $_smarty_tpl->tpl_vars['Colors']->value->link();?>
;" <?php }?>>

                </div>
           
	<?php } ?>

<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div><?php }} ?>