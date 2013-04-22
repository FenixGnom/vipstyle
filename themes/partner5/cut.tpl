<a href="/cut">
	 {if $template_data->basket_info()->amount()!=0}

			товаров: {$template_data->basket_info()->amount()},<br/> на сумму: {$template_data->basket_info()->price()} &nbsp;руб.{else}пустая{/if}
</a>
