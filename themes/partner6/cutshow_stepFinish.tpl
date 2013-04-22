{include file='header.tpl'}
{include file='leftblock.tpl'}
<div id="ordersShow">	
	<div class="TitleContent center" style="position:relative;"><span>Подтверждение заказа</span>
	<span style="position:absolute;top:0px;right:3px;">Шаг 5 из 5</span>
	</div>
	{literal}
		<style>
		input.bitButton{
			background:#000;
			color:#fff;
			font-size:11px;
			padding:2px 3px 2px 3px;
			margin-top:5px;
			cursor:pointer;
			border:1px solid #000;
		}
		label{margin-top:2px;}
		.trow2 td{padding-top:2px;}
		</style>
	{/literal}
	<table class="center" style="margin-top:20px;width:550px;">
		<tbody>                   
					  
				<tr class="trow2">
					<td style="width:180px;">Фамилия Имя Отчество</td>
					<td>
					<div style="width:380px;overflow:hidden;">
					   {$template_data->lastname()} {$template_data->name()} {$template_data->patronymic()}
					 </div>  
					</td>
				</tr>
				<tr class="trow2">
					<td >Адрес доставки</td>
					<td>
						<div style="width:380px;overflow:hidden;">
							{$template_data->index()}, {$template_data->country()}, {$template_data->region()}  {$template_data->city()} {$template_data->address()}
					   </div>
					</td>
				</tr>
				<tr class="trow2">
					<td >Телефон</td>
					<td>
						<div style="width:380px;overflow:hidden;">
							{$template_data->phone()}
					   </div>
					</td>
				</tr>                                    
				<tr class="trow2">
					<td >Способ оплаты</td>
					<td>
						{if $template_data->pay()=='POSTAL'}
							Оплата при получении
						{else}
							Предоплата (скидка 10% на товар)
						{/if}			 
					</td>
				</tr>
				<tr class="trow2">
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
				<tr class="trow1">
					<td colspan="2">
							<input type="button" class="bitButton" style="float:left;margin-left:5px;" onClick="location.href='/cut/show_step3'" value="Назад">
							<input type="button" class="bitButton" style="float:right;margin-right:5px;" onClick="orderSend();" value="Сформировать заказ"><br><div  style="clear:both;"></div>
					</td>
				</tr>	
		</tbody>
	</table>
</div>
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
				$('#ordersShow').css('background','url("/themes/partner2/images/loadinfoa.gif") center center no-repeat');
				window.location.href="/cut/orders";
			}
	}
</script>
{/literal}

 {include file='footer.tpl'}