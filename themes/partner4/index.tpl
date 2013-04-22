{include file='header.tpl'}
{include file='leftblock.tpl'}

<div class="titleName"><span>{$template_data->category_name()}</span></div>
 
  <div class="plainText center">
	
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

  <div class="MainPaging" > 
      {include file="paging.tpl"}
  </div>
  <div class="productBlock center" >
 {assign var=row value=0}
 {foreach from=$template_data->offers() item=Offers}
        {if $row mod 2==0}
		<div class="clear"></div>
		<div class="productSectionOne left">
	{else}
		<div class="productSection left">
	{/if}
	
	
			<div class="nameProduct">
			<a href="{$Offers->url()}">{$Offers->name()}</a></div>
			<a href="{$Offers->url()}"><img src="{$Offers->image_url()}" id="imgPr"></a>
			<div class="productSectionPrice">{$Offers->price()} руб.</div>
			<div class="addToCat"><a href="{$Offers->url()}"><img src="/themes/partner4/images/zakaz.jpg" id="img"></a></div>
			<div class="lineBottomPr center"></div>

	</div>
	{assign var=row value=$row+1}
  {foreachelse}
		<div class="worddesc">Товаров не найдено</div>	
  {/foreach}	                    	
	<div class="clear"></div>                                    
                        
                        
{include file='rightblock.tpl'} 
{include file='footer.tpl'}