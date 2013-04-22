<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 16:11:24
         compiled from "themes/partner8_green/category.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1537990879517528ec1f10f7-13503413%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ff7bbec128367391e87e4006d9d00693ed39b328' => 
    array (
      0 => 'themes/partner8_green/category.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1537990879517528ec1f10f7-13503413',
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
  'unifunc' => 'content_517528ec20b405_41694016',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517528ec20b405_41694016')) {function content_517528ec20b405_41694016($_smarty_tpl) {?><div id="side">
	<div class="sidebox">
		<div class="sidebox_t">
			<div class="sidebox_b">
				<h2>Категории</h2>
				<div class="padbox_side">
					<ul>
						<li><a href="/new">Новинки</a></li>
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
				</div>
			</div>
		</div>
	</div><!-- end sidebox -->
	
</div><!-- end side --><?php }} ?>