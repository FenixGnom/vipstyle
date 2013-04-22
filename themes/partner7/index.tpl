{include file='header.tpl'}

    <!-- END of BOTTOM -->
    
    <div class="container">
            
            
            <!-- START of BREADCRUMBS -->
            <p id="breadcrumbs">
            		<a href="/">Главная</a>
                    <span class="active">{$template_data->category_name()}</span>
            </p>
            <!-- END of BREADCRUMBS -->
            
            
            <!-- START of INNER-CONTAINER -->
            <div class="inner-container clearfix">
            
            		<div id="all-product">
                            
                        <h3>
                                <span>{$template_data->category_name()}</span>
                                
                        </h3>
                         <div class="desc">
                            {$template_data->category_desc()}
                         </div>
                        <div class="center">
                            {if count($template_data->menu(2))>0}						 

                                {foreach from=$template_data->menu(2) item=Subcategory}

                                    {if $Subcategory->is_selected()}
                                        <a class="active">{$Subcategory->name()}</a>
                                    {else}
                                        <a href="{$Subcategory->url()}" >
                                            {$Subcategory->name()}
                                        </a>
                                    {/if}

                                {/foreach}	

                            {/if}
                        </div>
                        <ul class="clearfix grid-view">
                            {assign var=rows value=ceil(count($template_data->offers())/3)}
                            {assign var=iterator value=0}	
				{assign var=row value=1}			
				{foreach from=$template_data->Offers() item=Offers}
														
						
						{if $iterator mod 3==2}
							 <li class="product last">
                                                 {else}
							<li class="product">
						{/if}
                                                <a href="{$Offers->url()}"class="thumb"><img src="{$Offers->image_url()}"></a>
                                                            <div class="data">
                                                                    <a href="{$Offers->url()}" class="title">{$Offers->name()}</a>
                                                                    <div class="clearfix info">
                                                                        <a href="{$Offers->url()}" class="add-to-cart">Заказать</a>
                                                                        <span class="price-text">{$Offers->price()}<span>руб.</span></span>
                                                                    </div>
                                                            </div>
                                                        </li>
                                            {if $iterator mod 3==2}
                                                    <div class="clear"></div>
                                                    {assign var=row value=$row+1}
                                            {/if}
                                            {assign var=iterator value=$iterator+1}
                            {foreachelse}
                                    <div class="worddesc">Товаров не найдено</div>	
                            {/foreach}	
                            
                        </ul>
							                    
                    </div><!-- end of #product-list -->
                    
                    {include file='rightblock.tpl'}
            
            </div>
            <!-- END of INNER-CONTAINER -->
            
            <!-- START of PAGINATION -->
    		<p class="pagination">
    			{include file='paging.tpl'}        		
            </p>
    		<!-- END of PAGINATION -->
                		
    
    </div><!-- end of .container -->
    
    
	<!-- START of PAGE-BOTTOM -->
{include file='footer.tpl'}