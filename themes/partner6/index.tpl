{include file='header.tpl'}
{include file='leftblock.tpl'}

<div class="TitleContent center"><span>{$template_data->category_name()}</span></div>
     <!--content start-->
     <div class="PlainText">		
      <div class="worddesc">{$template_data->category_desc()}</div>
     </div>
     <div class="MainPaging" >{include file="paging.tpl"}</div>
	  {if count($template_data->menu(2))>0}	
		 <div class="productSub center">
			<div class="categories">
				
				 {foreach from=$template_data->menu(2) item=Subcategory}

                                                        {if $Subcategory->is_selected()}
						<a class="productSubActive"  class="active">{$Subcategory->name()}</a>
					{else}
						<a href="{$Subcategory->url()}" >
							{$Subcategory->name()}
						</a>
					{/if}
					
				{/foreach}	
			</div>
		</div>	
	{/if}
    
			
     
     <div class="ProductBlock center" >
			{assign var=rows value=ceil(count($template_data->offers())/3)}
            	{assign var=iterator value=0}	
				{assign var=row value=1}			
				{foreach from=$template_data->Offers() item=Offers}
														
						
						{if $iterator mod 3==2}
							 <div class="mainProduct left">
						{else}
							<div class="mainProductB left">
						{/if}
					   
						
							<a href="{$Offers->url()}"><img class="prodBrImg" src="{$Offers->image_url()}"></a>
							<div class="mainProductName">
								<a href="{$Offers->url()}">{$Offers->name()}</a>
							</div>
							<div class="mainProductPrise">{$Offers->price()} руб.</div>
							{if $row!=$rows}	
								<div class="mainPrLine center"></div>
							{/if}	
						</div>
						{if $iterator mod 3==2}
							<div class="clear"></div>
							{assign var=row value=$row+1}
						{/if}
						{assign var=iterator value=$iterator+1}
				{foreachelse}
					<div class="worddesc">Товаров не найдено</div>	
				{/foreach}		
     
     </div>
                        
                        
{include file='footer.tpl'}