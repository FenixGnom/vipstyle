<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 16:13:06
         compiled from "themes/partner8_green/product_other.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1509844170517529522dbfb9-96082658%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4923af0927c66fb4f4f7f3c90886daf9cc6cf9f7' => 
    array (
      0 => 'themes/partner8_green/product_other.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1509844170517529522dbfb9-96082658',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_data' => 0,
    'OffersOther' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_51752952326d80_65072874',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51752952326d80_65072874')) {function content_51752952326d80_65072874($_smarty_tpl) {?><div class="OtherBlock center">
        <?php if (count($_smarty_tpl->tpl_vars['template_data']->value->other_offers())>0){?>
			<div class="pad_content">
				<h1>Другие товары с этим же дизайном:</h1>		
				<?php  $_smarty_tpl->tpl_vars['OffersOther'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['OffersOther']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['template_data']->value->other_offers(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['OffersOther']->key => $_smarty_tpl->tpl_vars['OffersOther']->value){
$_smarty_tpl->tpl_vars['OffersOther']->_loop = true;
?>					
						<div class="prodbox">
							<div class="prodbox_c">
							<div class="prodbox_b">
								<div class="pad_box">
                                                                        <a href="<?php echo $_smarty_tpl->tpl_vars['OffersOther']->value->url();?>
">
                                                                            <img src="<?php echo $_smarty_tpl->tpl_vars['OffersOther']->value->image_url();?>
" alt="" class="imgcenter" />
                                                                        </a>
                                                                        <a class="nameOffer" href="<?php echo $_smarty_tpl->tpl_vars['OffersOther']->value->url();?>
">
                                                                            <h2 class="prod_title"><?php echo $_smarty_tpl->tpl_vars['OffersOther']->value->name();?>
</h2>
                                                                        </a>
                                                                        <div class="prices"><span class="price"> <?php echo $_smarty_tpl->tpl_vars['OffersOther']->value->price();?>
 руб.</span></div>
                                                                        <div class="cat-to">
                                                                            <a  href="<?php echo $_smarty_tpl->tpl_vars['OffersOther']->value->url();?>
"><img src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
images/but_addcart.gif" /></a>
                                                                        </div>
                                                                        <div class="clr"></div>
                                                                </div>
							</div>
							</div>
						</div>
					  
				<?php } ?>
			</div>
			<div class="clr"></div>	
		<?php }?>
</div>


<?php }} ?>