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
					{if count($template_data->offers())>0}
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
						{foreach from=$template_data->offers() item=OffersCut name=iteration}
							<div class="proList">
                                                                <input type="hidden" id="{$smarty.foreach.iteration.index}_count" value="{$OffersCut->amount()}"/>
								<ul>
									<li class="priview_img" style="text-align:center;">					
                                                                            <img src="{$OffersCut->images_url()}" id="img" width=70 >
									</li>
                                                                        <li class="priview_name" style="text-align:center;">										
                                                                            <div class="name">{$OffersCut->name()}</div>
                                                                            
                                                                                {if $OffersCut->size()!=''}
                                                                                Размер: {$OffersCut->size()}								
                                                                                {/if}
                                                                            
									</li>
                                                                        <li class="priceHead" >{$OffersCut->price()} руб.</li>
									<li class="quantity"><input type="text" id="{$smarty.foreach.iteration.index}" value="{$OffersCut->amount()}" onblur="if(this.value=='')this.value=jQuery('#{$smarty.foreach.iteration.index}_count').val(); else cutCount(this);" size="3" maxlength="2" onkeyup="cutCount(this);"/></li>
									
									<li class="total" ><span id="fer_{$smarty.foreach.iteration.index}">{$OffersCut->price_amount()}</span> руб.</li>
									<li class="remove"><a href="javascript:void(0);" onclick="del_cut(this)" rel="{$OffersCut->link_del()}"><img src="/themes/{$template_data->enviroment()->theme_path()}images/delete.png" alt="" class="icon" /></a></li>
								</ul>
								<div class="clr"></div>
							</div><!-- end proList -->
						{/foreach}
						
						<div class="subtotal">
							<ul>
								<li>Всего : <span class="price2"><span id="priceAll">{$template_data->sum()}</span> руб.</span></li>
							</ul>
							<div class="clr"></div>
						</div><!-- end subtotal -->
						<div class="checkout">
							<ul class="butCut">
								
                                                                <li class="left">
                                                                    <a class="back" href="javascript:void(0);" onclick="history.back();">Вернуться к выбору</a>  
                                                                </li>
                                                                <li class="right">
									{if $template_data->sum() >= 190}
										<a href="/cut/show_step1"><img src="/themes/{$template_data->enviroment()->theme_path()}images/but_checkout.gif" /></a>
									{else}
										<a href="javascript:void(0);" onclick="alert('Минимальная сумма заказа 190 руб.');" ><input type="image" src="/themes/{$template_data->enviroment()->theme_path()}images/but_checkout.gif" /></a>
									{/if}	
								</li>
							</ul>
							<div class="clr"></div>
						</div><!-- end checkout -->
                                                
                                                {include file='delivery.tpl'}
					{else}
						<p>Ваша корзина пустая</p>
					{/if}		
				</div><!-- end pad_content_inner -->
			</div>
		</div>
	</div>	
                                 
                                
	
</div>

{include file='category.tpl'}                      
{include file='footer.tpl'}