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
						<div id="ordersShow">
							<h3>Корзина покупателя - Шаг 5 из 5 </h3>
							<table class="cutFinish" cellpadding="0" cellspacing="0" style="width:99%;">
								<tbody>                   
											  
										<tr >
											<td style="width:40%;">Фамилия Имя Отчество</td>
											<td>
											<div style="width:460px;overflow:hidden;">
											   {$template_data->lastname()} {$template_data->name()} {$template_data->patronymic()}
											 </div>  
											</td>
										</tr>
										<tr >
											<td >Адрес доставки</td>
											<td>
												<div style="width:460px;overflow:hidden;">
													{$template_data->index()}, {$template_data->country()}, {$template_data->region()}  {$template_data->city()} {$template_data->address()}
											   </div>
											</td>
										</tr>
										<tr >
											<td >Телефон</td>
											<td>
												<div style="width:460px;overflow:hidden;">
													{$template_data->phone()}
											   </div>
											</td>
										</tr>                                    
										<tr >
											<td >Способ оплаты</td>
											<td>
												{if $template_data->pay()=='POSTAL'}
													Оплата при получении
												{else}
													Предоплата (скидка 10% на товар)
												{/if}			 
											</td>
										</tr>
										<tr >
											<td >
                                                                                                Сумма с доставкой<div class="term">				

                                                                                                <i>({$template_data->delivery()->name()} 
                                                                                                    {if $template_data->delivery()->point()!=''}
                                                                                                        - {$template_data->delivery()->point()}                                                        
                                                                                                    {/if}
                                                                                                    )
                                                                                                </i>                                                   

                                                                                                </div>
                                                                                        </td>
                                                                                        <td>
                                                                                        {$template_data->sum()} руб.
                                                                                                <i>
                                                                                                    {if $template_data->post_tarif()!=''}
                                                                                                        <span style="color: #56903e; font-size: 11px;">
                                                                                                        <span rel="tooltip" style="cursor:default;" title="сумма доставки - {$template_data->post_pay()} руб.<br>тариф на денежный перевод - {$template_data->post_tarif()} руб.">(включая почтовый тариф<br>на денежный перевод)</span>
                                                                                                        </span>	
                                                                                                    {/if} 
                                                                                                </i>
                                                                                        </td>
										</tr> 
										<tr >
											<td colspan="2" class="noborder">
                                                                                            <div class="checkout">
                                                                                            <ul class="butCut">
                                                                                                <li class="left">  
                                                                                                    <a href="/cut/show_step2" ><img src="/themes/{$template_data->enviroment()->theme_path()}images/but_back.gif" /></a>
                                                                                                </li>
                                                                                                <li class="right">  
                                                                                                    <input style="width:auto;" type="image" src="/themes/{$template_data->enviroment()->theme_path()}images/but_checkout.gif" onclick="orderSend();"/>
                                                                                                </li>                                                                                    
                                                                                            </ul>
                                                                                             
                                                                                            <div class="clr"></div>    
                                                                                            </div>    
											</td>
										</tr>	
								</tbody>
							</table>
						</div>
							
						
						

						
				</div><!-- end pad_content_inner -->
			</div>
		</div>
	</div>	
	
</div>

{include file='category.tpl'}                      
{include file='footer.tpl'}

{literal}	
<script>
	var sLoad=0;
	function orderSend()
	{
			if(sLoad==0){
				sLoad=1;
				var h=window.document.getElementById('ordersShow').offsetHeight;
				var w=window.document.getElementById('ordersShow').offsetWidth;
				$('#ordersShow').html('');
				$('#ordersShow').css('width',w+'px');
				$('#ordersShow').css('height','200px');
				$('#ordersShow').css('background','url("/themes/partner8_blue/images/loading.gif") center center no-repeat');
				window.location.href="/cut/orders";
			}
	}
</script>
{/literal}