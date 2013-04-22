<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 16:11:23
         compiled from "themes/partner8_green/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:608669125517528ebe39769-84013520%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '05d5703628e0ea7806101745a27ec51f5a769fd1' => 
    array (
      0 => 'themes/partner8_green/index.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '608669125517528ebe39769-84013520',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_data' => 0,
    'Subcategory' => 0,
    'Offers' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_517528ec016e58_33662444',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517528ec016e58_33662444')) {function content_517528ec016e58_33662444($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('meta_head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	
	<div id="mainleft">
		
					
                <div id="breadcrumb"><a href="/">Главная</a>  &gt;
                        <a style="cursor:default;"><?php echo $_smarty_tpl->tpl_vars['template_data']->value->category_name();?>
</a>
                </div>			


                <div class="pad_content">
                        <h1><?php echo $_smarty_tpl->tpl_vars['template_data']->value->category_name();?>
</h1>
                        <p><?php echo $_smarty_tpl->tpl_vars['template_data']->value->category_desc();?>
</p>
                        <div class="subcat">
                                <?php if (count($_smarty_tpl->tpl_vars['template_data']->value->menu(2))>0){?>						 

                                                <?php  $_smarty_tpl->tpl_vars['Subcategory'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['Subcategory']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['template_data']->value->menu(2); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['Subcategory']->key => $_smarty_tpl->tpl_vars['Subcategory']->value){
$_smarty_tpl->tpl_vars['Subcategory']->_loop = true;
?>

                                                                <?php if ($_smarty_tpl->tpl_vars['Subcategory']->value->is_selected()){?>			 
                                                                                <a class="active"><?php echo $_smarty_tpl->tpl_vars['Subcategory']->value->name();?>
</a>
                                                                <?php }else{ ?>
                                                                                <a href="<?php echo $_smarty_tpl->tpl_vars['Subcategory']->value->url();?>
" >
                                                                                                <?php echo $_smarty_tpl->tpl_vars['Subcategory']->value->name();?>

                                                                                </a>
                                                                <?php }?>

                                                <?php } ?>	

                                <?php }?>
                        </div>
                        <div class="pagenumber">
                                <?php echo $_smarty_tpl->getSubTemplate ("paging.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
							
                        </div>
                        <?php if (count($_smarty_tpl->tpl_vars['template_data']->value->offers())>0){?>
                            <?php  $_smarty_tpl->tpl_vars['Offers'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['Offers']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['template_data']->value->offers(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['Offers']->key => $_smarty_tpl->tpl_vars['Offers']->value){
$_smarty_tpl->tpl_vars['Offers']->_loop = true;
?>
                                    <div class="prodbox">
                                            <div class="prodbox_c">
                                            <div class="prodbox_b">
                                                    <div class="pad_box">
                                                            <a href="<?php echo $_smarty_tpl->tpl_vars['Offers']->value->url();?>
">
                                                                <img src="<?php echo $_smarty_tpl->tpl_vars['Offers']->value->image_url();?>
" alt="" class="imgcenter" />
                                                            </a>
                                                            <a class="nameOffer" href="<?php echo $_smarty_tpl->tpl_vars['Offers']->value->url();?>
">
                                                                <h2 class="prod_title"><?php echo $_smarty_tpl->tpl_vars['Offers']->value->name();?>
</h2>
                                                            </a>
                                                            <div class="prices"><span class="price"> <?php echo $_smarty_tpl->tpl_vars['Offers']->value->price();?>
 руб.</span></div>
                                                            <div class="cat-to">
                                                                  <a  href="<?php echo $_smarty_tpl->tpl_vars['Offers']->value->url();?>
"><img src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
images/but_addcart.gif" /></a>
                                                            </div>
                                                            <div class="clr"></div>
                                                    </div>
                                            </div>
                                            </div>
                                    </div><!-- end prodbox -->
                            <?php } ?>
                          <?php }else{ ?>
                              <p>По Вашему запросу ничего не найдено</p>
                          <?php }?>    
                        <div class="clr"></div><!-- clear float -->
                </div><!-- end pad_content -->						
                <div class="pagenumber">
                        <?php echo $_smarty_tpl->getSubTemplate ("paging.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
							
                </div>
        <!-- end pad_content_inner -->
				
		
	</div><!-- end mainleft -->
                
<?php echo $_smarty_tpl->getSubTemplate ('category.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
                      
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>