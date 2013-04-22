
<div style="position:absolute;top:5px;right:0px;">
	<a style="font-size:13px;text-decoration:none;color:#000;text-align:left;" href="{$template_data->basket_info()->url()}">
		<img src="/themes/partner3/images/cut_us.jpg" id="img" align="absmiddle" style="float:left;">
		<div style="float:left;margin-left:5px;"> 
			{if $template_data->basket_info()->amount()!=0}
	
	товаров: {$template_data->basket_info()->amount()},<br/> на сумму: {$template_data->basket_info()->price()} &nbsp;руб.{else}пустая{/if}
		</div>
	</a>
</div>

