{literal}
   <style> 
    .product_others{text-align:center;margin-bottom:10px;}
   </style>  
{/literal}
<div class="other_product" style="margin-left:50px;">
	{if count($template_data->other_offers())>0}
	    <div class="product_others">Другие товары с этим же дизайном:</div>
	   
		{assign var=row value=0}
		{foreach from=$template_data->other_offers() item=OtherOffers}
				{if $row!=2}	
                                    {if $row mod 2==0}
                                        <div class="clear"></div>
                                        <div class="productSectionOne left">
                                    {/if}
                                    {if $row mod 2!=0}
                                        <div class="productSection left">
                                    {/if}
				
					<div class="nameProduct">
							<a href="{$OtherOffers->url()}">{$OtherOffers->name()}</a>
						</div>
						<a href="{$OtherOffers->url()}">
							<img src="{$OtherOffers->image_url()}" id="imgPr">
						</a>
						<div class="productSectionPrice">{$OtherOffers->price()} руб.</div>
						
						<div class="addToCat"><a href="{$OtherOffers->url()}"><img src="/themes/partner4/images/zakaz.jpg" id="img"></a></div>
						<div class="lineBottomPr center"></div>
					</div>			
				{/if}	
				{assign var=row value=$row+1}
		{/foreach}			
 

	{/if}
	
	
	
	<div class="clear"></div>      
</div>			