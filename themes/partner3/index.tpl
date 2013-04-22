{include file='page_header.tpl'}
{include file='leftblock.tpl'}

                                                

							<!--content-->
							<div class="contentTitle"><span>{$template_data->category_name()}</span></div>
<div class="textPlain">
	
	<div class="worddesc">{$template_data->category_desc()}</div>
</div>

 <div class="productSub center">
{if count($template_data->menu(2))>0}						 
      		
        {foreach from=$template_data->menu(2) item=Subcategory}

                {if $Subcategory->is_selected()}			 
                        <a class="productSubActive"  class="active">{$Subcategory->name()}</a>
                {else}
                        <a href="{$Subcategory->url()}" >
                                {$Subcategory->name()}
                        </a>
                {/if}
			
		{/foreach}	
							
{/if}

</div>
<div class="MainPaging" >
    {include file="paging.tpl"}
</div>
<div class="productBlock center">

{assign var=row value=0}
{foreach from=$template_data->offers() item=Offers}
    {if $row mod 2==0}
        <div class="clear"></div>
        <div class="lineBold"></div>
        <div class="productSectionOne left">
    {/if}

    {if $row mod 2!=0}
        <div class="productSection left">
    {/if}

		  <div class="nameProduct"><a href="{$Offers->url()}">{$Offers->name()}</a></div>
		  <a href="{$Offers->url()}"><img src="{$Offers->image_url()}" id="imgPr"></a>
		  <div class="productSectionPrice">{$Offers->price()} руб.</div>
		  <div class="productSectionBottom categoriesMenuLine center"></div>
		  <div class="addToCat"><a href="{$Offers->url()}">Заказать</a></div>

	</div>
	
	{if $row==count($template_data->Offers())}
		<div class="clear"></div>
		<div class="lineBold "></div>
	{/if}
	{assign var=row value=$row+1}
	{foreachelse}
		<div class="worddesc">Товаров не найдено</div>	
		
	
{/foreach}

</div>
							<!--endcontent-->
						


{include file='page_footer.tpl'}