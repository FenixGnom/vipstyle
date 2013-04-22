<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 16:11:24
         compiled from "themes/partner8_green/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:132489005517528ec0c3493-06231054%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46de5a300676d0cfe5517b9f06aa5b71446e5246' => 
    array (
      0 => 'themes/partner8_green/header.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132489005517528ec0c3493-06231054',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_data' => 0,
    'menuUser' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_517528ec1120b0_53771320',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517528ec1120b0_53771320')) {function content_517528ec1120b0_53771320($_smarty_tpl) {?><div id="header">
			<div id="topmenu">
				<div id="menu">
					<ul>
						<li id="home"><a href="/">Главная</a></li>
						
						<?php  $_smarty_tpl->tpl_vars['menuUser'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menuUser']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['template_data']->value->menu(4); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menuUser']->key => $_smarty_tpl->tpl_vars['menuUser']->value){
$_smarty_tpl->tpl_vars['menuUser']->_loop = true;
?>					
							<li><a href="<?php echo $_smarty_tpl->tpl_vars['menuUser']->value->url();?>
" <?php if ($_smarty_tpl->tpl_vars['menuUser']->value->is_target()){?> target="_blank" <?php }?>><?php echo $_smarty_tpl->tpl_vars['menuUser']->value->name();?>
</a></li>						
						<?php } ?>	
					</ul>
				</div><!-- end menu -->
				<div id="cart">
					<?php echo $_smarty_tpl->getSubTemplate ('cut.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
									
				</div>
				
			</div><!-- end topmenu -->
			<div id="top">
				<div id="logo">
				  <a href="/" class="partnerName"><?php echo $_smarty_tpl->tpl_vars['template_data']->value->partner()->shop_name();?>
</a>
                                  <?php if ($_smarty_tpl->tpl_vars['template_data']->value->partner()->contact_phone()!=''){?>
                                    <div class="partnerPhone">
                                        <?php echo $_smarty_tpl->tpl_vars['template_data']->value->partner()->contact_phone();?>

                                    </div>
                                <?php }?> 
				</div>
                                   
                                <!-- end logo -->
				<div id="topsearch">
				<form action="/search" method="post">
				<input type="hidden" name="act" value="search">
				<fieldset>
					<span class="bg_input"><input type="text" name="find" class="inputbox" value="ищете что-то?"  onblur="if(this.value=='') this.value='ищете что-то?';" onfocus="if(this.value=='ищете что-то?') this.value='';" /></span><input type="image" src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
images/but_search.gif" class="but" />
				</fieldset>
				</form>
				</div>
			</div><!-- end top -->
</div>
<div class="clr"></div>

<!-- BEGIN CONTENT -->
		<div id="content">
			<div id="c_top">
				<div id="c_bottom">
				
				<!-- begin slider -->
					<?php echo $_smarty_tpl->getSubTemplate ('slider.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				<!-- end slider -->
				
				<br style="clear:both;"  />
				<div id="maincontent">
					<div id="main"><?php }} ?>