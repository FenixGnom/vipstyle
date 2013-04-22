<div class="productBlock center">
{if count($template_data->other_offers())>0}
	 <div class="product_others">Другие товары с этим же дизайном:</div>
	{assign var=row value=0}
		{foreach from=$template_data->other_offers() item=OtherOffers}
			{if $row!=2}	
				{if $row mod 2==0}
					<div class="clear"></div>
				{/if}
				{if $row==count($template_data->other_offers())}
					{if $row mod 2!=0}
					<div class="clear"></div>
					{/if}
				{/if}
					
				<div class="productSection left">
					<div class="nameProduct">
							<a href="{$OtherOffers->url()}">{$OtherOffers->name()}</a>
						</div>
						<a href="{$OtherOffers->url()}">
							<img src="{$OtherOffers->image_url()}" id="imgPr">
						</a>
						<div class="productSectionPrice">{$OtherOffers->price()} руб.</div>
						<div class="productSectionBottom categoriesMenuLine center"></div>
						<div class="addToCat"><a href="{$OtherOffers->url()}">Заказать</a></div>
					</div>			
				{/if}
				{assign var=row value=$row+1}
		{/foreach}			  
				  
	{/if}
</div>			
