<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 16:12:37
         compiled from "themes/partner8_green/static_page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6679916565175293569b770-55572302%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e73e6537ebba0a57e93bf67a14eaa021727de628' => 
    array (
      0 => 'themes/partner8_green/static_page.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6679916565175293569b770-55572302',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_data' => 0,
    'breadcrumb' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5175293570f222_85342208',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5175293570f222_85342208')) {function content_5175293570f222_85342208($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('meta_head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div id="mainleft">
	<div class="c_inner">
		<div class="c_inner_t">
			<div class="c_inner_b">
				<div class="pad_content_inner">
					<div id="breadcrumb">
						<a href="/">Главная</a>  
                                                <?php if (count($_smarty_tpl->tpl_vars['template_data']->value->menu(5))>0){?>
                                                    <?php  $_smarty_tpl->tpl_vars['breadcrumb'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['breadcrumb']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['template_data']->value->menu(5); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['breadcrumb']->key => $_smarty_tpl->tpl_vars['breadcrumb']->value){
$_smarty_tpl->tpl_vars['breadcrumb']->_loop = true;
?>
                                                     &gt;   <?php echo $_smarty_tpl->tpl_vars['breadcrumb']->value->name();?>

                                                    <?php } ?>
                                                <?php }?>    
					</div>
					<br />
					<?php echo $_smarty_tpl->tpl_vars['template_data']->value->content();?>

						
						
						

						
				</div><!-- end pad_content_inner -->
			</div>
		</div>
	</div>	
	
</div>

<?php echo $_smarty_tpl->getSubTemplate ('category.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
                      
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>