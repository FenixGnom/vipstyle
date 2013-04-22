<div class="OtherBlock center">
        {if count($template_data->other_offers())>0}
		<p class="product_others">Другие товары с этим же дизайном:</p>
		{foreach from=$template_data->other_offers() item=OtherOffers}		  
				<div class="mainProduct left" style="border:0px;">				
					<a href="{$OtherOffers->url()}"><img class="prodBrImg" src="{$OtherOffers->image_url()}"></a>
					<div class="mainProductName">
						<a href="{$OtherOffers->url()}">{$OtherOffers->name()}</a>
					</div>
					<div class="mainProductPrise">{$OtherOffers->price()} руб.</div>

				</div>
			  
		{/foreach}	  
	{/if}
</div>