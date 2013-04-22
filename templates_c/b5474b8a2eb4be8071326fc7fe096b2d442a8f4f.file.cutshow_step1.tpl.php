<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 16:13:09
         compiled from "themes/partner8_green/cutshow_step1.tpl" */ ?>
<?php /*%%SmartyHeaderCode:170585566851752955f1bd77-75163169%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5474b8a2eb4be8071326fc7fe096b2d442a8f4f' => 
    array (
      0 => 'themes/partner8_green/cutshow_step1.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170585566851752955f1bd77-75163169',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_51752956082f17_72508604',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51752956082f17_72508604')) {function content_51752956082f17_72508604($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('meta_head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

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
					
						<h3>Корзина покупателя - Шаг 2 из 5 </h3>
						
						
						<form id="zakaz" method="post"  action="/cut/show_step2">		
							<table border="0" cellpadding="0" cellspacing="0" style="margin-top:20px;" width="90%">
								<tr >
									<td><b>Страна</b> (Россия) <span style="color:red">*</span></td>
									<td>
										<select name="country" id="country" onChange="change_country(this.value);">
											<option VALUE="ABKHAZIA"  >Абхазия</option>
											<option VALUE="AZERBAIJAN"  >Азербайджан</option>
											<option VALUE="ARMENIA"  >Армения</option>
											<option VALUE="BELARUS"  >Белоруссия</option>
											<option VALUE="GEORGIA"  >Грузия</option>
											<option VALUE="ISRAEL"  >Израиль</option>
											<option VALUE="KAZAKHSTAN"  >Казахстан</option>

											<option VALUE="KYRGYZSTAN"  >Киргизия</option>
											<option VALUE="LATVIA"  >Латвия</option>
											<option VALUE="LITHUANIA"  >Литва</option>
											<option VALUE="MOLDOVA"  >Молдавия</option>
											<option VALUE="RUSSIA" selected >Россия</option>
											<option VALUE="USA"  >США</option>
											<option VALUE="TAJIKISTAN"  >Таджикистан</option>

											<option VALUE="TURKMENISTAN"  >Туркмения</option>
											<option VALUE="UZBEKISTAN"  >Узбекистан</option>
											<option VALUE="UKRAINE"  >Украина</option>
											<option VALUE="ESTONIA"  >Эстония</option>
											<option VALUE="SOUTH_OSETIA"  >Южная Осетия</option>
											<option VALUE="OTHER"  >Другая</option>

										</select>
									</td>
								</tr>
								<tr >
									<td >
										<b>Почтовый индекс</b> (125284) <span style="color:red">*</span>
										<span id="index_links" ><a href='http://info.russianpost.ru/servlet/department' target='_blank'><br>список индексов России</a></span>
										<div id="row-index">пустое поле</div>
										</td>
										<td><input type="text" maxlength="80"   name="indeks" id="indeks" VALUE="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->index();?>
">
									</td>
								</tr>
								<tr >
									<td><b>Область проживания</b> (Омская обл) <span style="color:red">*</span><div id="row-obl">пустое поле</div></td>
									<td><input type="text" maxlength="80"   name="obl" id="obl" VALUE="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->region();?>
" ></td>
								</tr>
								<tr >
									<td><b>Город проживания</b>  <span style="color:red">*</span><div id="row-city">пустое поле</div></td>

									<td><input type="text" maxlength="80"   name="city" id="city" VALUE="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->city();?>
" ></td>
								</tr>
								<tr >
									<td><b>Адрес проживания</b> (ул. Ленина, д.48, кв.19) <span style="color:red">*</span><div id="row-adres">пустое поле</div></td>
									
									<td><textarea rows="3" cols="17"   name="adres" id="adres" ><?php echo $_smarty_tpl->tpl_vars['template_data']->value->address();?>
</textarea></td>
								</tr>

								<tr >
									<td><b>Фамилия получателя</b> (Иванов) <span style="color:red">*</span><div id="row-f">пустое поле</div></td>
									<td><input type="text" maxlength="80"   name="name3" id="name3" VALUE="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->lastname();?>
"></td>
								</tr>
								<tr >
									<td><b>Имя получателя</b> (Иван)  <span style="color:red">*</span><div id="row-n">пустое поле</div></td>

									<td><input type="text" maxlength="80"   name="name1" id="name1" VALUE="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->name();?>
"></td>
								</tr>
								<tr >
									<td><b>Отчество получателя</b> (Иванович) <span style="color:red">*</span><div id="row-o">пустое поле</div></td>
									<td><input type="text" maxlength="80"   name="name2" id="name2" VALUE="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->patronymic();?>
"></td>
								</tr>
								<tr >

									<td><b>Телефон (желательно сотовый)</b> (+7-905-256-XX-XX)<span style="color:red">*</span><div id="row-phon">пустое поле</div><br>
										</td>
									<td><input type="text" maxlength="80"   id="phone" name="phone" VALUE="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->phone();?>
">
									<div style="color:red;font-size:11px;"> Внимание! Мы свяжемся с Вами по телефону для подтверждения заказа. </div></td>
								</tr>
								<tr >
									<td><b>Email получателя</b> (email@email.ru)  <span style="color:red">*</span><div id="row-milo">поле пустое или имеет не правильный формат</div></td>

									<td><input type="text" maxlength="80"   name="email" id="milo" VALUE="<?php echo $_smarty_tpl->tpl_vars['template_data']->value->email();?>
"></td>
								</tr>
								<tr >
									<td><b>Комментарий</b></td>
									<td><textarea rows="4" cols="17"   name="text" maxlength="150" ><?php echo $_smarty_tpl->tpl_vars['template_data']->value->comments();?>
</textarea></td>
								</tr>					
								
								<tr >
									<td> </td>
									<td style="text-align:left;">
										<input style="width:auto;" type="checkbox" name="subs" value="Y" checked> Подписаться на новости сайта
										
									</td>
								</tr>
								<tr >
									<td colspan=2 class="noborder"><div align=center style="clear:both;"><span style="color:red">*</span> - поля обязательные для заполнения</div></td>

								</tr>
								<tr >
									<td colspan="2"  class="noborder">
                                                                            <div class="checkout">
                                                                                <ul class="butCut">
                                                                                    <li class="left">  
                                                                                        <a href="/cut" ><img src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
images/but_back.gif" /></a>
                                                                                    </li>
                                                                                    <li class="right">  
                                                                                        <a href="javascript:void(0);" onClick="post_orders('zakaz','','');"><img src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
images/but_checkout.gif" /></a>
                                                                                    </li>
                                                                                    
                                                                                </ul>
                                                                                <div class="clr"></div>    
                                                                            </div>
                                                                                
                                                                       </td>
								</tr>
							</table>
						</form>
						
	
	<script>
    $(function(){

            jQuery('form#zakaz input[type="text"]').each(function(){                
                $(this).click(function(){
                    jQuery(this).css('background','#fff');
                });
            });
			$('#adres').click(function(){
                    jQuery('#adres').css('background','#fff');
                });

    });  
</script>

						
				</div><!-- end pad_content_inner -->
			</div>
		</div>
	</div>	
	
</div>

<?php echo $_smarty_tpl->getSubTemplate ('category.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
                      
<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>