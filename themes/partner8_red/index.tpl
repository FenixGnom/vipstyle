{include file='meta_head.tpl'}
{include file='header.tpl'}
	
	<div id="mainleft">
		
					
                <div id="breadcrumb"><a href="/">Главная</a>  &gt;
                        <a style="cursor:default;">{$template_data->category_name()}</a>
                </div>			


                <div class="pad_content">
                        <h1>{$template_data->category_name()}</h1>
                        <p>{$template_data->category_desc()}</p>
                        <div class="subcat">
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
                        <div class="pagenumber">
                                {include file="paging.tpl"}							
                        </div>
                        {if count($template_data->offers())>0}
                            {foreach from=$template_data->offers() item=Offers}
                                    <div class="prodbox">
                                            <div class="prodbox_c">
                                            <div class="prodbox_b">
                                                    <div class="pad_box">
                                                            <a href="{$Offers->url()}">
                                                                <img src="{$Offers->image_url()}" alt="" class="imgcenter" />
                                                            </a>
                                                            <a class="nameOffer" href="{$Offers->url()}">
                                                                <h2 class="prod_title">{$Offers->name()}</h2>
                                                            </a>
                                                            <div class="prices"><span class="price"> {$Offers->price()} руб.</span></div>
                                                            <div class="cat-to">
                                                                  <a  href="{$Offers->url()}"><img src="/themes/{$template_data->enviroment()->theme_path()}images/but_addcart.gif" /></a>
                                                            </div>
                                                            <div class="clr"></div>
                                                    </div>
                                            </div>
                                            </div>
                                    </div><!-- end prodbox -->
                            {/foreach}
                          {else}
                              <p>По Вашему запросу ничего не найдено</p>
                          {/if}    
                        <div class="clr"></div><!-- clear float -->
                </div><!-- end pad_content -->						
                <div class="pagenumber">
                        {include file="paging.tpl"}							
                </div>
        <!-- end pad_content_inner -->
				
		
	</div><!-- end mainleft -->
                
{include file='category.tpl'}                      
{include file='footer.tpl'}