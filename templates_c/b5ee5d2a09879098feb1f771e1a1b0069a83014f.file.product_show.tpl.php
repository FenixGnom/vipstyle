<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 17:03:36
         compiled from "themes/partner7/product_show.tpl" */ ?>
<?php /*%%SmartyHeaderCode:142762206517535284a8485-93873221%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5ee5d2a09879098feb1f771e1a1b0069a83014f' => 
    array (
      0 => 'themes/partner7/product_show.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142762206517535284a8485-93873221',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_data' => 0,
    'ArrayTypeOffers' => 0,
    'SizeOffer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5175352861e497_12805434',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5175352861e497_12805434')) {function content_5175352861e497_12805434($_smarty_tpl) {?><!-- START of BREADCRUMBS -->
            <p id="breadcrumbs">
            	<a href="/">Главная</a>
                <?php if ($_smarty_tpl->tpl_vars['template_data']->value->is_from_serch_page()){?>
                     
                     <a href="/search/<?php echo $_SESSION['searchingText'];?>
"><span class="active">Результаты поиска</span></a>                  

                <?php }else{ ?>

                    <a href="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->category()->url();?>
"><?php echo $_smarty_tpl->tpl_vars['template_data']->value->category()->name();?>
</a>
                    <?php if ($_smarty_tpl->tpl_vars['template_data']->value->subcat()){?>
                            <a  href="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->subcat()->url();?>
">
                            <?php echo $_smarty_tpl->tpl_vars['template_data']->value->subcat()->name();?>
</a>
                            <span class="active"><?php echo $_smarty_tpl->tpl_vars['template_data']->value->name();?>
</span>
                    <?php }?>

                <?php }?>
                
                
                    
            </p>
            <!-- END of BREADCRUMBS -->
    <div class="product-gallery">
                <div class="large-image" id="fotoShow" <?php if (!$_smarty_tpl->tpl_vars['template_data']->value->front()){?>style="display:none;"<?php }else{ ?>style="display:block;"<?php }?>>
                        <a href="javascript:open_window('<?php echo $_smarty_tpl->tpl_vars['template_data']->value->imgbig_url();?>
','',500,500)"><img src="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->img_url();?>
"  /></a>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['template_data']->value->imgback_url()!=''){?>
                        <script>
                                var backFoto=1;
                        </script>
                        <div class="large-image" id="fotoShowBack" <?php if ($_smarty_tpl->tpl_vars['template_data']->value->front()){?>style="display:none;"<?php }?>>
                            <a href="javascript:open_window('<?php echo $_smarty_tpl->tpl_vars['template_data']->value->imgbackbig_url();?>
','',500,500)"><img src="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->imgback_url();?>
"  /></a>
                        </div>
                <?php }else{ ?>
                        <script>
                                var backFoto=0;
                        </script>
                <?php }?>
                    
    
            <ul id="iconImg" class="clearfix">
                
                                        <?php if ($_smarty_tpl->tpl_vars['template_data']->value->model_default()->double()){?>
                                        <li><img src="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->img_url();?>
" onclick="showInFoto(1);"/></li>
                                        
                                        
						
						<?php if ($_smarty_tpl->tpl_vars['template_data']->value->imgback_url()!=''){?>
                                                    <li><img src="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->imgback_url();?>
" onclick="showInFoto(2);"/></li>
                                                
							
						<?php }?>
					<?php }?>
            </ul>
                <div style="width:135px; margin: 30px auto;"><a href="javascript:history.back();" style="color: #636363; font-size: 14px; text-decoration: underline;">Вернуться к выбору</a></div>
    </div><!-- end of .product-gallery -->

    <div class="product-detail">
                <h2><?php echo $_smarty_tpl->tpl_vars['template_data']->value->name();?>
</h2>
                <div style=" color: #636363; font: 18px/40px 'TerminalDosisMedium',Arial,Helvetica,sans-serif;">
                    <div style="width: 110px; float: left;">Артикул: </div><label><?php echo $_smarty_tpl->tpl_vars['template_data']->value->id();?>
</label></div>
            <!--<cite>BY Lorem Ipsum</cite>!-->
            
            
            
            

            <form id="cut" class="options-form" onsubmit="return false;">
                <input name="oldid" id="oldid" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->id();?>
"/>
                <input name="id" id="name_id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->id();?>
"/>
                <input  name="pricesis" id="pricesis" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->price();?>
"/>
                <input  name="color" id="color" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->color_default()->color_abriv();?>
"/>
                <input  name="sexname" id="sexname" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->model_default()->id_abriviature();?>
"/>
                                        <fieldset>
                                            <div class="available-options">
                                    
                                    
                                                <label>Модель:</label>
                                              
                                                            <select id="model" onChange="get_query('/catalog/showsex/wages/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->id();?>
/sex/'+this.value,'product');" name="model_change" style="width:200px;">
								
							 <?php  $_smarty_tpl->tpl_vars['ArrayTypeOffers'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ArrayTypeOffers']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['template_data']->value->models(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ArrayTypeOffers']->key => $_smarty_tpl->tpl_vars['ArrayTypeOffers']->value){
$_smarty_tpl->tpl_vars['ArrayTypeOffers']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['ArrayTypeOffers']->value->id();?>
" <?php if ($_smarty_tpl->tpl_vars['ArrayTypeOffers']->value->id()==$_smarty_tpl->tpl_vars['template_data']->value->model_default()->id()){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['ArrayTypeOffers']->value->name();?>
</option>
							<?php } ?>						 
						 </select>
                                              
                                            </div>
                                 <?php if ($_smarty_tpl->tpl_vars['template_data']->value->is_hand()>0){?>           
                                <div class="available-options">
                                  
                
					<label for="options">Рукав:</label>
                                                <select name="hand" id="hand" style="width:100px;" onChange="get_query('/catalog/showsex/wages/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->id();?>
/sex/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->model_default()->id();?>
/long/'+this.value,'product'); " >
                                                    <option value='0' <?php if ($_smarty_tpl->tpl_vars['template_data']->value->color_default()->hand()==0){?> selected <?php }?>>короткий</option>
                                                    <option value='1' <?php if ($_smarty_tpl->tpl_vars['template_data']->value->color_default()->hand()==1){?> selected <?php }?>>длинный</option>
						</select>  
                                </div>
                                 <?php }?>
                                 
                                 <?php if (count($_smarty_tpl->tpl_vars['template_data']->value->sizes())>0){?>         
                                <div class="available-options">
                                  
                
					<label for="options">Размер:</label>
                                                <select name="sizes" id="size" onChange="change_size(this.options[this.selectedIndex].text,'<?php echo $_smarty_tpl->tpl_vars['template_data']->value->model_default()->id_abriviature();?>
');" style="min-width:90px">
								<?php  $_smarty_tpl->tpl_vars['SizeOffer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['SizeOffer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['template_data']->value->sizes(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['SizeOffer']->key => $_smarty_tpl->tpl_vars['SizeOffer']->value){
$_smarty_tpl->tpl_vars['SizeOffer']->_loop = true;
?>
									<option value='<?php echo $_smarty_tpl->tpl_vars['SizeOffer']->value->size();?>
'><?php echo $_smarty_tpl->tpl_vars['SizeOffer']->value->size();?>
</option>
									
								<?php } ?>							
						</select>  
                                </div>
                                 <?php }?>
                                
                                
                            
                            <p class="qty">
                                <label>Цвет:</label>
                                <div id="image_small" class="ProductSmallImageBlock center">
                                   <?php echo $_smarty_tpl->getSubTemplate ('color_product.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                                </div>
                            </p>
                            <div class="available-options">  
                            <p class="qty">
                                <label>Количество:</label>
                                <div style="position: relative; margin-bottom: 20px;">
                                    <input type="text" name="num" id="num" value="1" size="1" maxlength="2" onkeyup="getPrice(this.value);"/>
                                    <div class="numThis" id="amountprice"></div>
                                
                                </div>
                            </p>   
                                </div>
                                 <div style="clear:both;"></div>
                                                    
                                <p class="price" style="float: left;">Цена: <span id="priceTop" style="color: #F84E25;"><?php echo $_smarty_tpl->tpl_vars['template_data']->value->price();?>
</span> руб.</p>
                            
                            <input type="submit" class="submit-btn" value="Заказать" onclick="post_ord('cut','/catalog/insertcut/');"/>
                            
                                </fieldset>
                        </form><!-- end of .available-options -->
    </div><!-- end of .product-detail -->
<!-- end of #contents -->
<div class="desc_tovar"><?php echo $_smarty_tpl->tpl_vars['template_data']->value->description();?>
</div>
<?php echo $_smarty_tpl->getSubTemplate ('product_other.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>



            <?php }} ?>