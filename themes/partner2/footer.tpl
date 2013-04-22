	<div class="footer center">
		<div class="cont">
			<div class="fotterHref">
				
				{foreach from=$template_data->menu(4) item=menuUser}     		
					<a  href="{$menuUser->url()}" {if $menuUser->is_target()} target="_blank" {/if} >{$menuUser->name()}</a> |
	   			{/foreach}
			</div>
			<div class="counters right"><!--your counters here--></div>
			<div class="fotterCopy">
				 {$template_data->partner()->shop_name()} &copy;
			</div>
		</div>
	</div>                        
<!--Версия партнеского магазина {$template_data->enviroment()->version()}-->
</body>
</html>
