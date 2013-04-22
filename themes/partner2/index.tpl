{include file='header.tpl'}
{include file='leftblock.tpl'}

<div class="titleName center"><span>{$template_data->category_name()}</span></div>                    <!--kontents-->
                    <div class="PlainText center">
                    	
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
                    <div class="MainPaging center">
                        {include file="paging.tpl"}
                    </div>
                    <div class="productRowAll center">
						{assign var=row value=0}
						{foreach from=$template_data->offers() item=Offers}
							{if $row mod 2==0}
								<div class="clear"></div>
							{/if}
							{if $row==count($template_data->offers())}
								{if $row mod 2!=0}
								<div class="clear"></div>
								{/if}
							{/if}
						   
						
							<div class="productSection left">
								<div class="productSectionTop"><!----></div>
								<div class="productSectionCenter">
									<a href="{$Offers->url()}"><img src="{$Offers->image_url()}" id="imgProduct"/>
									<div>{$Offers->name()}</div> </a>
									<div>{$Offers->price()} руб.</div>
									<div class="productZakaz"><a href="{$Offers->url()}"><img src="/themes/partner2/images/zakaz.jpg" id="img" /></a></div>
								</div>
								<div class="productSectionBottom"><!----></div>
							</div>
							{assign var=row value=$row+1}
						{foreachelse}
							<div class="worddesc">Товаров не найдено</div>	
					
					    {/foreach}	                   
					
               		</div>
               		<div class="clear"></div>
                        
                        
                {include file='rightblock.tpl'} 
                {include file='footer.tpl'}