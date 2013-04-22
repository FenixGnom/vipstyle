<div class="product-listing">
        {if count($template_data->other_offers())>0}
		<h3><span>Другие товары с этим же дизайном:</span></h3>
                <ul class="clearfix">
                    {assign var=iterator value=0}
		{foreach from=$template_data->other_offers() item=OtherOffers}		  
                        {if $iterator mod 3==2}
							 <li class="product last">
                                                 {else}
							<li class="product">
						{/if}
                            	<a href="{$OtherOffers->url()}" class="thumb"><img src="{$OtherOffers->image_url()}" /></a>
                                <a href="{$OtherOffers->url()}" class="title">{$OtherOffers->name()}</a>
                                <div class="clearfix info">
                                    <span class="price-text">{$OtherOffers->price()}<span>руб.</span></span>
                                	<a href="{$OtherOffers->url()}" class="add-to-cart">Заказать</a>
                                	
                                </div>
                            </li>
                            {$iterator=$iterator+1}
		{/foreach}
                </ul>
	{/if}
</div>