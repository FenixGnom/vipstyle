{include file='meta_head.tpl'}
{include file='header.tpl'}

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
					
						<h3>Корзина покупателя - Шаг 3 из 5 </h3>
						<div class="headings">
							<ul>
								<li class="deliveryName">Тип доставки</li>
								<li class="deliveryPrice">Цена</li>								
							</ul>
						</div><!-- end headings -->
						<form id="thiszakaz" action="/cut/show_step3" method="post">
							{foreach from=$template_data->delivery() item=DeliveryArray name=delivery}
								<div class="proList">
									<ul>
										<li class="deliveryName" style="text-align:left;">
											<input id="delivery-{$smarty.foreach.delivery.index}" type="radio" name="delivery"  value="{$DeliveryArray->value()}"  {if $template_data->delivery_default()->value()==$DeliveryArray->value()}checked="true" {/if} />
											<input type="hidden" name="{$DeliveryArray->value()}_name" value="{$DeliveryArray->name()}" />
                                                                                        <input type="hidden" name="{$DeliveryArray->value()}_price" value="{$DeliveryArray->cost()}" />                                                                                        
                                                                                        <label for="delivery-{$smarty.foreach.delivery.index}">{$DeliveryArray->name()}</label>
										</li>
										<li class="deliveryPrice">
											 {if $DeliveryArray->cost()!=0}
					{$DeliveryArray->cost()} руб.
                                    {else}
                                        Бесплатно
                                    {/if}  
										</li>								
									</ul>
									<div class="clr"></div>
								</div>
							{/foreach}						
							<div class="checkout">
                                                                <ul class="butCut">
                                                                    <li class="left">  
                                                                        <a href="/cut/show_step1" ><img src="/themes/{$template_data->enviroment()->theme_path()}images/but_back.gif" /></a>
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