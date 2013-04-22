<p>
	<a href="/cut">
		<img src="/themes/partner4/images/cut_us.jpg" id="img" align="absmiddle">
		{if $template_data->basket_info()->amount()!=0}
	
			товаров: {$template_data->basket_info()->amount()}, на сумму: {$template_data->basket_info()->price()} &nbsp;руб.{else}пустая{/if}
	</a>	
</p>