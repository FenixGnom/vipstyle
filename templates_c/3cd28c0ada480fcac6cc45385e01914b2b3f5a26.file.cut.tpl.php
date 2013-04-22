<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 16:11:24
         compiled from "themes/partner8_green/cut.tpl" */ ?>
<?php /*%%SmartyHeaderCode:66857585517528ec115ec1-42180602%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3cd28c0ada480fcac6cc45385e01914b2b3f5a26' => 
    array (
      0 => 'themes/partner8_green/cut.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '66857585517528ec115ec1-42180602',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_517528ec146450_77087861',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517528ec146450_77087861')) {function content_517528ec146450_77087861($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['template_data']->value->basket_info()->amount()!=0){?>
<a href="/cut">
    <img src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
images/cart.png" alt="" class="imgleft" />
</a>
<a class="inCut" href="/cut">
    В корзине товаров: <strong><?php echo $_smarty_tpl->tpl_vars['template_data']->value->basket_info()->amount();?>
</strong>
    <div>на сумму: <?php echo $_smarty_tpl->tpl_vars['template_data']->value->basket_info()->price();?>
 &nbsp;руб.</div>
</a>
<?php }else{ ?>
    <img src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
images/cart.png" alt="" class="imgleft" />
    Корзина пустая
<?php }?>    
<?php }} ?>