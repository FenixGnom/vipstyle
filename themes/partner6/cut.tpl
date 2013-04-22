<div style="position:relative;height:20px;">
	<div style="position:absolute;top:0px;left:3px;">
		<a style="font-size:14px;color:#05337E;"  href="/cut">
			<img src="/themes/{$template_data->enviroment()->theme_path()}images/cut_us.jpg" id="img" align="absmiddle" style="float:left;margin-top:3px;margin-right:10px;">
			<div style="float:left;text-align:left;">
				<div style="margin-top:6px;font-weight:bold;">
					
					  {if $template_data->basket_info()->amount()!=0}
	
						товаров: {$template_data->basket_info()->amount()}, на сумму: {$template_data->basket_info()->price()} &nbsp;руб.
                                          {else}пустая{/if}
					
				</div>
			</div>
			<div style="clear:both;"></div>
		</a>
	</div>
</div>
