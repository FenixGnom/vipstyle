{include file='header.tpl'}
{include file='leftblock.tpl'}

<div class="title"><a href="#">{$template_data->category_name()}</a></div>
	<div class="worddesc">{$template_data->category_desc()}</div>
            {if count($template_data->menu(2))>0}
                   
                       
                        {foreach from=$template_data->menu(2) item=Subcategory}
                                
                                {if $Subcategory->is_selected()}
                                        <a class="list_cat active">{$Subcategory->name()}</a>
                                {else}
                                        <a class="list_cat" href="{$Subcategory->url()}" >
                                                {$Subcategory->name()}
                                        </a>
                                {/if}
                                
                        {/foreach}
                       
                   
                   
                    
            {/if}

<div class="paging">
     {include file="paging.tpl"}
</div>
 {assign var=row value=0}
    {foreach from=$template_data->offers() item=Offers}	
	
	<table class="item{if $row ==0} item1{/if}" cellspacing="0">
		<tr>
			<td class="pic">
				<div class="p_b"><div class="p_l"><div class="p_r"><div class="p_rt"><div class="p_rb"><div class="p_lb"><div class="p_lt">
											<a href="{$Offers->url()}"><img src="{$Offers->image_url()}" /></a>
										</div></div></div></div></div></div></div>
			</td>
			<td class="desc">
				<div class="title"><a href="{$Offers->url()}">{$Offers->name()}</a></div>
				<div class="details">{$Offers->price()}<span>&nbsp;руб</span> <a href="{$Offers->url()}"><img src="/themes/partner5/images/order.gif" /></a></div>
			</td>
		</tr>
	</table>
  {assign var=row value=$row+1}
  {foreachelse}
		<div class="worddesc">Товаров не найдено</div>	
  {/foreach}	       
<div class="paging">
     {include file="paging.tpl"}
</div>

{include file='footer.tpl'}