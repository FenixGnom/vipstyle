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
<div class="container">


        <!-- START of BREADCRUMBS -->
        <p id="breadcrumbs">
                    <a href="/">Главная</a>
                <span class="active">Покупательская корзина</span>
        </p>
        <!-- END of BREADCRUMBS -->


        <!-- START of INNER-CONTAINER -->
        <div class="inner-container">

                    <div class="cart_step" id="ordersShow">

                                                    <h3>
                                    <span>Подтверждение заказа Шаг 5 из 5</span>
                                </h3>


                                <table>
                                        <tr>
					<td style="width:300px;">Фамилия Имя Отчество</td>
					<td>
					<div style="width:590px;overflow:hidden;">
					   {$template_data->lastname()} {$template_data->name()} {$template_data->patronymic()}
					 </div>  
					</td>
				</tr>
				<tr>
					<td >Адрес доставки</td>
					<td>
						<div style="width:590px;overflow:hidden;">
							{$template_data->index()}, {$template_data->country()}, {$template_data->region()}  {$template_data->city()} {$template_data->address()}
					   </div>
					</td>
				</tr>
				<tr>
					<td >Телефон</td>
					<td>
						<div>
							{$template_data->phone()}
					   </div>
					</td>
				</tr>                                    
				<tr>
					<td >Способ оплаты</td>
					<td>
						{if $template_data->pay()=='POSTAL'}
							Оплата при получении
						{else}
							Предоплата (скидка 10% на товар)
						{/if}			 
					</td>
				</tr>
				<tr>
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
			
			<tr><td colspan="2" style="background:none;">
					<input type="button" class="checkout"  style="float:left; margin-left:5px;" onClick="location.href='/cut/show_step3'" value="Назад">
					<span style="float:right; margin-right:5px; ">
                                            <a style="cursor: pointer" onClick="orderSend();" value="Сформировать заказ" class="update_long">Сформировать заказ &rarr;</a>
                                        </span>
                       </tr>
                                </table>


                </div><!-- end of #product-list -->

        </div>
        <!-- END of INNER-CONTAINER -->


</div><!-- end of .container -->
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
				$('#ordersShow').css('background','url("/themes/partner7/images/loader.gif") center center no-repeat');
				window.location.href="/cut/orders";
			}
	}
</script>
{/literal}

    <!-- START of PAGE-BOTTOM -->
{include file='footer.tpl'}