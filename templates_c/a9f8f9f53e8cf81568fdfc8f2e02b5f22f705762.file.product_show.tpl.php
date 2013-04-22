<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 16:13:06
         compiled from "themes/partner8_green/product_show.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9680792785175295210fd30-27749889%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a9f8f9f53e8cf81568fdfc8f2e02b5f22f705762' => 
    array (
      0 => 'themes/partner8_green/product_show.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9680792785175295210fd30-27749889',
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
  'unifunc' => 'content_51752952289bd4_07323989',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51752952289bd4_07323989')) {function content_51752952289bd4_07323989($_smarty_tpl) {?>
<div class="c_inner">
        <div class="c_inner_t">
                <div class="c_inner_b">
                        <div class="pad_content_inner">
                                <div id="breadcrumb">
                                        <a href="/">Главная</a>  &gt;
                                <?php if ($_smarty_tpl->tpl_vars['template_data']->value->is_from_serch_page()){?>
                                            <a href="/search/<?php echo $_SESSION['searchingText'];?>
">Результаты поиска</a>  
                                <?php }else{ ?>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->category()->url();?>
"><?php echo $_smarty_tpl->tpl_vars['template_data']->value->category()->name();?>
</a>
                                        <?php if ($_smarty_tpl->tpl_vars['template_data']->value->subcat()){?>
                                                &gt;<a  href="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->subcat()->url();?>
">
                                                <?php echo $_smarty_tpl->tpl_vars['template_data']->value->subcat()->name();?>
</a>
                                        <?php }?>

                                <?php }?>
                                </div><br />

                                <form id="cut" name="product_zak" onsubmit="return false;">
                                        <input name="oldid" id="oldid" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->id();?>
">
                                        <input name="id" id="name_id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->id();?>
">
                                        <input  name="pricesis" id="pricesis" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->price();?>
">
                                        <input  name="color" id="color" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->color_default()->color_abriv();?>
">
                                        <input  name="sexname" id="sexname" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->model_default()->id_abriviature();?>
">

                                        <div id="description">
                                                <div id="product_image">
                                                        <div id="fotoShow" <?php if (!$_smarty_tpl->tpl_vars['template_data']->value->front()){?>style="display:none;"<?php }?>>
                                                                <a href="javascript:open_window('<?php echo $_smarty_tpl->tpl_vars['template_data']->value->imgbig_url();?>
','',500,500)"><img src="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->img_url();?>
"  /></a>
                                                        </div>
                                                        <?php if ($_smarty_tpl->tpl_vars['template_data']->value->imgback_url()!=''){?>					
                                                                <div id="fotoShowBack" <?php if ($_smarty_tpl->tpl_vars['template_data']->value->front()){?>style="display:none;"<?php }?>>
                                                                        <a href="javascript:open_window('<?php echo $_smarty_tpl->tpl_vars['template_data']->value->imgbackbig_url();?>
','',500,500)"><img src="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->imgback_url();?>
"  /></a>
                                                                </div>
                                                        <?php }?>								
                                                        <div class="thumb" id="iconImg">
                                                                <?php if ($_smarty_tpl->tpl_vars['template_data']->value->model_default()->double()){?>
                                                                        <img src="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->img_url();?>
" width="70" onclick="showInFoto(1);"/>
                                                                        <?php if ($_smarty_tpl->tpl_vars['template_data']->value->imgback_url()!=''){?>
                                                                                <img src="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->imgback_url();?>
" width="70" onclick="showInFoto(2);"/>
                                                                        <?php }?>
                                                                <?php }?>
                                                                <div class="clr"></div>
                                                        </div>
                                                        <div style="text-align: center;">        
                                                                <a class="back" href="javascript:void(0);" onclick="history.back();">Вернуться к выбору</a>        
                                                        </div>        
                                                </div><!-- end product_image -->
                                                <div id="product_description">
                                                        <div class="title_description"><h2><?php echo $_smarty_tpl->tpl_vars['template_data']->value->name();?>
</h2></div>
                                                                <div class="row">
                                                                        <ul>
                                                                                <li class="col1">Артикул</li>
                                                                                <li class="col2"><?php echo $_smarty_tpl->tpl_vars['template_data']->value->id();?>
</li>
                                                                        </ul>
                                                                </div>
                                                                <br style="clear:both;"  />        
                                                                <div class="row">
                                                                        <ul>
                                                                                <li class="col1">Модель</li>
                                                                                <li class="col2">											
                                                                                        <select onChange="get_query('/catalog/showsex/wages/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->id();?>
/sex/'+this.value,'window_wages');" name="model_change" style="width:250px;">

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
                                                                                </li>
                                                                        </ul>
                                                                </div>
                                                                <br style="clear:both;"  />

                                                                <?php if ($_smarty_tpl->tpl_vars['template_data']->value->is_hand()>0){?>
                                                                        <div class="row">
                                                                                <ul>
                                                                                        <li class="col1">Рукав</li>
                                                                                        <li class="col2">
                                                                                                <select name="hand" id="hand" onChange="get_query('/catalog/showsex/wages/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->id();?>
/sex/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->model_default()->id();?>
/long/'+this.value,'window_wages'); " >
                                                                                                <option value='0' <?php if ($_smarty_tpl->tpl_vars['template_data']->value->color_default()->hand()==0){?> selected <?php }?>>короткий</option>
                                                                                                <option value='1' <?php if ($_smarty_tpl->tpl_vars['template_data']->value->color_default()->hand()==1){?> selected <?php }?>>длинный</option>
                                                                                                </select>
                                                                                        </li>
                                                                                </ul>
                                                                        </div>
                                                                        <br style="clear:both;"  />
                                                                <?php }?>
                                                                <?php if (count($_smarty_tpl->tpl_vars['template_data']->value->sizes())>0){?>
                                                                        <div class="row">
                                                                                <ul>
                                                                                        <li class="col1">Размер</li>
                                                                                        <li class="col2">
                                                                                                <select name="sizes"  onChange="change_size(this.options[this.selectedIndex].text,'<?php echo $_smarty_tpl->tpl_vars['template_data']->value->model_default()->id_abriviature();?>
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
                                                                                        </li>
                                                                                </ul>
                                                                        </div>
                                                                        <br style="clear:both;"  />
                                                                <?php }?>
                                                                <div class="row">
                                                                        <ul>
                                                                                <li class="col1">Цвет</li>
                                                                                <li class="col2" id="image_small">
                                                                                            <?php echo $_smarty_tpl->getSubTemplate ('color_product.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                                                                                </li>
                                                                        </ul>
                                                                </div>
                                                                <br style="clear:both;"  />

                                                                <div class="row">
                                                                        <ul>
                                                                                <li class="col1">Количество</li>
                                                                                <li class="col2" style="position: relative;">
                                                                                        <input type="text" name="num" id="num" value="1" size="5" maxlength="2" onkeyup="getPrice(this.value);">
                                                                                        <div class="numThis" id="amountprice"></div>
                                                                                </li>
                                                                        </ul>
                                                                </div>
                                                                <br style="clear:both;"  />

                                                                <div class="row">
                                                                        <ul>
                                                                                <li class="col1">Цена</li>
                                                                                <li class="col2"><span id="price"><?php echo $_smarty_tpl->tpl_vars['template_data']->value->price();?>
</span> руб.</li>
                                                                        </ul>
                                                                </div>
                                                                <br style="clear:both;"  />
                                                                 
                                                                 								  
                                                                    
                                                                <hr /><br />
                                                                
                                                                    <input type="image" style="border:0px;margin-left:280px;" src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
images/but_addcart.gif" class="imgleft" onclick="post_ord('cut','/catalog/insertcut/');"/>
                                                                    <div class="clr"></div>
                                                               
                                                                <p><?php echo $_smarty_tpl->tpl_vars['template_data']->value->description();?>
</p>

                                                </div><!-- end product_description -->
                                                <div class="clr"></div>
                                        </div><!-- end description -->
                                        <div class="clr"></div><!-- clear float -->
                                </form>

                        </div><!-- end pad_content_inner -->
                </div>
        </div>
</div>	
<?php echo $_smarty_tpl->getSubTemplate ('product_other.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>