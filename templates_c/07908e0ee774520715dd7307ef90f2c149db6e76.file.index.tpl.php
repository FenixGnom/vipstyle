<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 17:03:20
         compiled from "themes/partner7/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:39834022551753518556197-98491394%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '07908e0ee774520715dd7307ef90f2c149db6e76' => 
    array (
      0 => 'themes/partner7/index.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '39834022551753518556197-98491394',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_data' => 0,
    'Subcategory' => 0,
    'iterator' => 0,
    'Offers' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_51753518662444_54241806',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51753518662444_54241806')) {function content_51753518662444_54241806($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


    <!-- END of BOTTOM -->
    
    <div class="container">
            
            
            <!-- START of BREADCRUMBS -->
            <p id="breadcrumbs">
            		<a href="/">Главная</a>
                    <span class="active"><?php echo $_smarty_tpl->tpl_vars['template_data']->value->category_name();?>
</span>
            </p>
            <!-- END of BREADCRUMBS -->
            
            
            <!-- START of INNER-CONTAINER -->
            <div class="inner-container clearfix">
            
            		<div id="all-product">
                            
                        <h3>
                                <span><?php echo $_smarty_tpl->tpl_vars['template_data']->value->category_name();?>
</span>
                                
                        </h3>
                         <div class="desc">
                            <?php echo $_smarty_tpl->tpl_vars['template_data']->value->category_desc();?>

                         </div>
                        <div class="center">
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
                        <ul class="clearfix grid-view">
                            <?php $_smarty_tpl->tpl_vars['rows'] = new Smarty_variable(ceil(count($_smarty_tpl->tpl_vars['template_data']->value->offers())/3), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars['iterator'] = new Smarty_variable(0, null, 0);?>	
				<?php $_smarty_tpl->tpl_vars['row'] = new Smarty_variable(1, null, 0);?>			
				<?php  $_smarty_tpl->tpl_vars['Offers'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['Offers']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['template_data']->value->Offers(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['Offers']->key => $_smarty_tpl->tpl_vars['Offers']->value){
$_smarty_tpl->tpl_vars['Offers']->_loop = true;
?>
														
						
						<?php if ($_smarty_tpl->tpl_vars['iterator']->value%3==2){?>
							 <li class="product last">
                                                 <?php }else{ ?>
							<li class="product">
						<?php }?>
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['Offers']->value->url();?>
"class="thumb"><img src="<?php echo $_smarty_tpl->tpl_vars['Offers']->value->image_url();?>
"></a>
                                                            <div class="data">
                                                                    <a href="<?php echo $_smarty_tpl->tpl_vars['Offers']->value->url();?>
" class="title"><?php echo $_smarty_tpl->tpl_vars['Offers']->value->name();?>
</a>
                                                                    <div class="clearfix info">
                                                                        <a href="<?php echo $_smarty_tpl->tpl_vars['Offers']->value->url();?>
" class="add-to-cart">Заказать</a>
                                                                        <span class="price-text"><?php echo $_smarty_tpl->tpl_vars['Offers']->value->price();?>
<span>руб.</span></span>
                                                                    </div>
                                                            </div>
                                                        </li>
                                            <?php if ($_smarty_tpl->tpl_vars['iterator']->value%3==2){?>
                                                    <div class="clear"></div>
                                                    <?php $_smarty_tpl->tpl_vars['row'] = new Smarty_variable($_smarty_tpl->tpl_vars['row']->value+1, null, 0);?>
                                            <?php }?>
                                            <?php $_smarty_tpl->tpl_vars['iterator'] = new Smarty_variable($_smarty_tpl->tpl_vars['iterator']->value+1, null, 0);?>
                            <?php }
if (!$_smarty_tpl->tpl_vars['Offers']->_loop) {
?>
                                    <div class="worddesc">Товаров не найдено</div>	
                            <?php } ?>	
                            
                        </ul>
							                    
                    </div><!-- end of #product-list -->
                    
                    <?php echo $_smarty_tpl->getSubTemplate ('rightblock.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

            
            </div>
            <!-- END of INNER-CONTAINER -->
            
            <!-- START of PAGINATION -->
    		<p class="pagination">
    			<?php echo $_smarty_tpl->getSubTemplate ('paging.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
        		
            </p>
    		<!-- END of PAGINATION -->
                		
    
    </div><!-- end of .container -->
    
    
	<!-- START of PAGE-BOTTOM -->
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>