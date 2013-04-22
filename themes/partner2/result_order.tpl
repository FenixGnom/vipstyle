{include file='header.tpl'}
{include file='leftblock.tpl'}
{literal}
<style>
	.accepted{font-size:12px;}
	h4{font-size:13px;}
</style>
{/literal}
<div class="PlainText center" style="width:360px;">
	{if $template_data->is_result()}            
		<h3>Ваш Заказ принят!</h3>                
			
		<div class="accepted">
			<h4>Номер Вашего заказа {$template_data->order()}</h4>
			<p style="margin-left:0px;">Вся информация выслана на электронную почту С Вами свяжется оператор для подтверждения заказа</p>
		</div>
		<div style="height:10px;"></div>
		<div class="options">		
			<a  style="" href="http://maykoplat.ru/?id={$template_data->order()}&email={$template_data->email()}" >Оплатить</a>
		</div>
	{else}
		<div class="heading">                
			<div class="bg">                        
				<h3>Ваш Заказ не принят!</h3>                
			</div>        
		</div>
		<div class="accepted">
			<h4>Номер Вашего заказа {$template_data->order()}</h4>	
		</div>
	{/if}
</div>
{$template_data->answer()}

 {include file='rightblock.tpl'} 
 {include file='footer.tpl'}
