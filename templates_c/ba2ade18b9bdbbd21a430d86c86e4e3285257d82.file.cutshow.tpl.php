<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 16:13:08
         compiled from "themes/partner8_green/cutshow.tpl" */ ?>
<?php /*%%SmartyHeaderCode:168131744551752954b01036-69287394%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba2ade18b9bdbbd21a430d86c86e4e3285257d82' => 
    array (
      0 => 'themes/partner8_green/cutshow.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '168131744551752954b01036-69287394',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_data' => 0,
    'OffersCut' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_51752954bf4ab7_68233314',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51752954bf4ab7_68233314')) {function content_51752954bf4ab7_68233314($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('meta_head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div id="mainleft">
	<div class="c_inner">
		<div class="c_inner_t">
			<div class="c_inner_b">
				<div class="pad_content_inner">
					<div id="breadcrumb">
						<a href="/">Главная</a>  &gt;					
						<a >Корзина покупателя</a>  
					</div>
					<br />
					<?php if (count($_smarty_tpl->tpl_vars['template_data']->value->offers())>0){?>
						<h3>Корзина покупателя - Шаг 1 из 5 </h3>
						<div class="headings">
							<ul>
								<li class="priview">Товар</li>								
								<li class="priceHead">Цена</li>
                                                                <li class="quantity">Количество</li>
								<li class="total">Общая сумма</li>
								<li class="remove"></li>
							</ul>
						</div><!-- end headings -->
						<?php  $_smarty_tpl->tpl_vars['OffersCut'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['OffersCut']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['template_data']->value->offers(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['iteration']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['OffersCut']->key => $_smarty_tpl->tpl_vars['OffersCut']->value){
$_smarty_tpl->tpl_vars['OffersCut']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['iteration']['index']++;
?>
							<div class="proList">
                                                                <input type="hidden" id="<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['iteration']['index'];?>
_count" value="<?php echo $_smarty_tpl->tpl_vars['OffersCut']->value->amount();?>
"/>
								<ul>
									<li class="priview_img" style="text-align:center;">					
                                                                            <img src="<?php echo $_smarty_tpl->tpl_vars['OffersCut']->value->images_url();?>
" id="img" width=70 >
									</li>
                                                                        <li class="priview_name" style="text-align:center;">										
                                                                            <div class="name"><?php echo $_smarty_tpl->tpl_vars['OffersCut']->value->name();?>
</div>
                                                                            
                                                                                <?php if ($_smarty_tpl->tpl_vars['OffersCut']->value->size()!=''){?>
                                                                                Размер: <?php echo $_smarty_tpl->tpl_vars['OffersCut']->value->size();?>
								
                                                                                <?php }?>
                                                                            
									</li>
                                                                        <li class="priceHead" ><?php echo $_smarty_tpl->tpl_vars['OffersCut']->value->price();?>
 руб.</li>
									<li class="quantity"><input type="text" id="<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['iteration']['index'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['OffersCut']->value->amount();?>
" onblur="if(this.value=='')this.value=jQuery('#<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['iteration']['index'];?>
_count').val();else cutCount(this);" size="3" maxlength="2" onkeyup="cutCount(this);"/></li>
									
									<li class="total" ><span id="fer_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['iteration']['index'];?>
"><?php echo $_smarty_tpl->tpl_vars['OffersCut']->value->price_amount();?>
</span> руб.</li>
									<li class="remove"><a href="javascript:void(0);" onclick="del_cut(this)" rel="<?php echo $_smarty_tpl->tpl_vars['OffersCut']->value->link_del();?>
"><img src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
images/delete.png" alt="" class="icon" /></a></li>
								</ul>
								<div class="clr"></div>
							</div><!-- end proList -->
						<?php } ?>
						
						<div class="subtotal">
							<ul>
								<li>Всего : <span class="price2"><span id="priceAll"><?php echo $_smarty_tpl->tpl_vars['template_data']->value->sum();?>
</span> руб.</span></li>
							</ul>
							<div class="clr"></div>
						</div><!-- end subtotal -->
						<div class="checkout">
							<ul class="butCut">
								
                                                                <li class="left">
                                                                    <a class="back" href="javascript:void(0);" onclick="history.back();">Вернуться к выбору</a>  
                                                                </li>
                                                                <li class="right">
									<?php if ($_smarty_tpl->tpl_vars['template_data']->value->sum()>=190){?>
										<a href="/cut/show_step1"><img src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
images/but_checkout.gif" /></a>
									<?php }else{ ?>
										<a href="javascript:void(0);" onclick="alert('Минимальная сумма заказа 190 руб.');" ><input type="image" src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
images/but_checkout.gif" /></a>
									<?php }?>	
								</li>
							</ul>
							<div class="clr"></div>
						</div><!-- end checkout -->
                                                
                                                <?php echo $_smarty_tpl->getSubTemplate ('delivery.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

					<?php }else{ ?>
						<p>Ваша корзина пустая</p>
					<?php }?>		
				</div><!-- end pad_content_inner -->
			</div>
		</div>
	</div>	
                                 
                                
	
</div>

<?php echo $_smarty_tpl->getSubTemplate ('category.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
                      
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>