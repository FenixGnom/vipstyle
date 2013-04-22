<div class="OtherBlock center">
	{if count($template_data->other_offers())>0}
		<p class="product_others">Другие товары с этим же дизайном:</p>
		
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
					<div class="productSectionTop"><!----></div>
					<div class="productSectionCenter">
						<a href="{$OtherOffers->url()}"><img src="{$OtherOffers->image_url()}" id="imgProduct"/>
						<div>{$OtherOffers->name()}</div> </a>
						<div>{$OtherOffers->price()} руб.</div>
						<div class="productZakaz"><a href="{$OtherOffers->url()}"><img src="/themes/partner2/images/zakaz.jpg" id="img" /></a></div>
					</div>
					<div class="productSectionBottom"><!----></div>
				</div>
			{/if}	
			{assign var=row value=$row+1}
		{/foreach}
                <div class="clear"></div>
				  
	{/if}
</div>


			
