{include file='meta_head.tpl'}
{include file='header.tpl'}
{literal}
	<style>	
		#tooltip{
			background:#FFFFFF;
			border:1px solid #666666;
			color:#333333;
			font:menu;
			margin:0px;
			padding:3px 5px;
			position:absolute;
			visibility:hidden;
			margin-left:5px;
		}
	</style>
{/literal}

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
					
						<h3>Корзина покупателя - Шаг 4 из 5 </h3>
						<div class="headings">
							<ul>
								<li class="deliveryName">Тип доставки</li>
								<li class="deliveryPrice">Цена</li>								
							</ul>
						</div><!-- end headings -->
						<form action="/cut/show_step4" method="post">
							
								<div class="proList">
									<ul>
										<li class="deliveryName" style="text-align:left;">
											<input id="pay1" type="radio" name="prepay" value="POSTAL" {if $template_data->pay_default()=="POSTAL"}checked="true"{/if}/><label for="pay1">Оплата при получении</label>	
										</li>
										<li class="deliveryPrice">
											{$template_data->post()} руб.{if $template_data->post_tarif()!=''}<br />
											<span style="color: #56903e; font-size: 11px;">
																	<span rel="tooltip" style="cursor:default;" title="сумма доставки - {$template_data->post_delivery()} руб.<br>тариф на денежный перевод - {$template_data->post_tarif()} руб.">(включая почтовый тариф<br>на денежный перевод)</span>
											</span>{/if}
										</li>								
									</ul>
									<div class="clr"></div>
								</div>
								
								<div class="proList">
									<ul>
										<li class="deliveryName" style="text-align:left;">
											<input id="pay2" type="radio" name="prepay" value="PREPAY" {if $template_data->pay_default()=="PREPAY"}checked="true"{/if}/><label for="pay2">Предоплата&nbsp;<i style="font-size:11px;color:#666;">(скидка на товар 10%)</i></label>
										</li>
										<li class="deliveryPrice">
											 {$template_data->prepay()} руб.
										</li>								
									</ul>
									<div class="clr"></div>
								</div>
								
												
							<div class="checkout">
                                                                <ul class="butCut">
                                                                    <li class="left">  
                                                                        <a href="/cut/show_step2" ><img src="/themes/{$template_data->enviroment()->theme_path()}images/but_back.gif" /></a>
                                                                    </li>
                                                                    <li class="right">  
                                                                        <input style="width:auto;" type="image" src="/themes/{$template_data->enviroment()->theme_path()}images/but_checkout.gif" />
                                                                    </li>                                                                                    
                                                                </ul>
								
								<div class="clr"></div>
							</div><!-- end checkout -->
						</form>
						
						
						

						
				</div><!-- end pad_content_inner -->
			</div>
		</div>
	</div>	
	
</div>

{include file='category.tpl'}                      
{include file='footer.tpl'}