<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 17:03:36
         compiled from "themes/partner7/product_other.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10526419495175352866fba3-17845632%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd093bd01f1568f1ea10fdf809514315f3752f74' => 
    array (
      0 => 'themes/partner7/product_other.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10526419495175352866fba3-17845632',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_data' => 0,
    'iterator' => 0,
    'OtherOffers' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_517535286c56b7_20325233',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517535286c56b7_20325233')) {function content_517535286c56b7_20325233($_smarty_tpl) {?><div class="product-listing">
        <?php if (count($_smarty_tpl->tpl_vars['template_data']->value->other_offers())>0){?>
		<h3><span>Другие товары с этим же дизайном:</span></h3>
                <ul class="clearfix">
                    <?php $_smarty_tpl->tpl_vars['iterator'] = new Smarty_variable(0, null, 0);?>
		<?php  $_smarty_tpl->tpl_vars['OtherOffers'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['OtherOffers']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['template_data']->value->other_offers(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['OtherOffers']->key => $_smarty_tpl->tpl_vars['OtherOffers']->value){
$_smarty_tpl->tpl_vars['OtherOffers']->_loop = true;
?>		  
                        <?php if ($_smarty_tpl->tpl_vars['iterator']->value%3==2){?>
							 <li class="product last">
                                                 <?php }else{ ?>
							<li class="product">
						<?php }?>
                            	<a href="<?php echo $_smarty_tpl->tpl_vars['OtherOffers']->value->url();?>
" class="thumb"><img src="<?php echo $_smarty_tpl->tpl_vars['OtherOffers']->value->image_url();?>
" /></a>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['OtherOffers']->value->url();?>
" class="title"><?php echo $_smarty_tpl->tpl_vars['OtherOffers']->value->name();?>
</a>
                                <div class="clearfix info">
                                    <span class="price-text"><?php echo $_smarty_tpl->tpl_vars['OtherOffers']->value->price();?>
<span>руб.</span></span>
                                	<a href="<?php echo $_smarty_tpl->tpl_vars['OtherOffers']->value->url();?>
" class="add-to-cart">Заказать</a>
                                	
                                </div>
                            </li>
                            <?php $_smarty_tpl->tpl_vars['iterator'] = new Smarty_variable($_smarty_tpl->tpl_vars['iterator']->value+1, null, 0);?>
		<?php } ?>
                </ul>
	<?php }?>
</div><?php }} ?>