{include file='header.tpl'}
{include file='leftblock.tpl'}
{literal}
	<style>
	.accepted{font-size:12px;}
	h4{font-size:13px;}
	</style>
{/literal}


	{if $template_data->is_result()}     

		<div class="titleName center" style="position:relative;"><span>Ваш Заказ принят!</span></div>  
		                      
				          
			
		<div class="accepted">
			<h4>Номер Вашего заказа {$template_data->order()}</h4>
			<p style="margin-left:0px;">Вся информация выслана на электронную почту <br/>С Вами свяжется оператор для подтверждения заказа</p>
		</div>
		<div style="height:10px;"></div>
		<div >		
			<a  style="background: none repeat scroll 0 0 #000000;border: 1px solid #000000;color: #FFFFFF;cursor: pointer;font-size: 11px;margin-top: 5px;padding: 2px 3px;" href="http://maykoplat.ru/?id={$template_data->order()}&email={$template_data->email()}" >Оплатить</a>
		</div>
	{else}
		<div class="titleName center" style="position:relative;"><span>Ваш Заказ не принят!</span></div>
		
		<div class="accepted">
			<h4>Номер Вашего заказа {$template_data->order()}</h4>	
		</div>
	{/if}
{$template_data->answer()}

 {include file='rightblock.tpl'} 
 {include file='footer.tpl'}