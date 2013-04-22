<div class="other_product" style="margin-left:10px;">
	{if count($template_data->other_offers())>0}
		<div class="pr_others">Другие товары с этим же дизайном:</div>
		<table class="product_others" cellspacing="0">
		
		{assign var=row value=0}
		{foreach from=$template_data->other_offers() item=OtherOffers}
                    {if $row!=2}			

                        <tr>
                            <td class="pic">
                                <div class="p_b"><div class="p_l"><div class="p_r"><div class="p_rt"><div class="p_rb"><div class="p_lb">
                                    <div class="p_lt">
                                            <a href="{$OtherOffers->url()}"><img src="{$OtherOffers->image_url()}" /></a>
                                    </div></div></div></div></div></div></div>
                            </td>
                            <td class="desc" style="margin-bottom: 50px;">
                                <div class="title"><a href="{$OtherOffers->url()}">{$OtherOffers->name()}</a></div>
                                <div class="details">{$OtherOffers->price()}<span>&nbsp;руб</span> <a href="{$OtherOffers->url()}"><img src="/themes/partner5/images/order.gif" /></a></div>
                            </td>
                        </tr>
                        <tr colspan="2">
                            <td style="height : 50px;"></td>
                        </tr>
                    {/if}
		  {assign var=row value=$row+1}
		{/foreach}
		
		</table>	
	{/if}
	<div class="clear"></div>      
</div>