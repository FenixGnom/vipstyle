<!-- START of BREADCRUMBS -->
            <p id="breadcrumbs">
            	<a href="/">Главная</a>
                {if $template_data->is_from_serch_page()}
                     
                     <a href="/search/{$smarty.session.searchingText}"><span class="active">Результаты поиска</span></a>                  

                {else}

                    <a href="{$template_data->category()->url()}">{$template_data->category()->name()}</a>
                    {if $template_data->subcat()}
                            <a  href="{$template_data->subcat()->url()}">
                            {$template_data->subcat()->name()}</a>
                            <span class="active">{$template_data->name()}</span>
                    {/if}

                {/if}
                
                
                    
            </p>
            <!-- END of BREADCRUMBS -->
    <div class="product-gallery">
                <div class="large-image" id="fotoShow" {if !$template_data->front()}style="display:none;"{else}style="display:block;"{/if}>
                        <a href="javascript:open_window('{$template_data->imgbig_url()}','',500,500)"><img src="{$template_data->img_url()}"  /></a>
                </div>
                {if $template_data->imgback_url()!=''}
                        <script>
                                var backFoto=1;
                        </script>
                        <div class="large-image" id="fotoShowBack" {if $template_data->front()}style="display:none;"{/if}>
                            <a href="javascript:open_window('{$template_data->imgbackbig_url()}','',500,500)"><img src="{$template_data->imgback_url()}"  /></a>
                        </div>
                {else}
                        <script>
                                var backFoto=0;
                        </script>
                {/if}
                    
    
            <ul id="iconImg" class="clearfix">
                
                                        {if $template_data->model_default()->double()}
                                        <li><img src="{$template_data->img_url()}" onclick="showInFoto(1);"/></li>
                                        
                                        
						
						{if $template_data->imgback_url()!=''}
                                                    <li><img src="{$template_data->imgback_url()}" onclick="showInFoto(2);"/></li>
                                                
							
						{/if}
					{/if}
            </ul>
                <div style="width:135px; margin: 30px auto;"><a href="javascript:history.back();" style="color: #636363; font-size: 14px; text-decoration: underline;">Вернуться к выбору</a></div>
    </div><!-- end of .product-gallery -->

    <div class="product-detail">
                <h2>{$template_data->name()}</h2>
                <div style=" color: #636363; font: 18px/40px 'TerminalDosisMedium',Arial,Helvetica,sans-serif;">
                    <div style="width: 110px; float: left;">Артикул: </div><label>{$template_data->id()}</label></div>
            <!--<cite>BY Lorem Ipsum</cite>!-->
            
            
            
            

            <form id="cut" class="options-form" onsubmit="return false;">
                <input name="oldid" id="oldid" type="hidden" value="{$template_data->id()}"/>
                <input name="id" id="name_id" type="hidden" value="{$template_data->id()}"/>
                <input  name="pricesis" id="pricesis" type="hidden" value="{$template_data->price()}"/>
                <input  name="color" id="color" type="hidden" value="{$template_data->color_default()->color_abriv()}"/>
                <input  name="sexname" id="sexname" type="hidden" value="{$template_data->model_default()->id_abriviature()}"/>
                                        <fieldset>
                                            <div class="available-options">
                                    
                                    
                                                <label>Модель:</label>
                                              
                                                            <select id="model" onChange="get_query('/catalog/showsex/wages/{$template_data->id()}/sex/'+this.value,'product');" name="model_change" style="width:200px;">
								
							 {foreach from=$template_data->models() item=ArrayTypeOffers }
								<option value="{$ArrayTypeOffers->id()}" {if $ArrayTypeOffers->id()==$template_data->model_default()->id()}selected{/if}>{$ArrayTypeOffers->name()}</option>
							{/foreach}						 
						 </select>
                                              
                                            </div>
                                 {if $template_data->is_hand()>0}           
                                <div class="available-options">
                                  
                
					<label for="options">Рукав:</label>
                                                <select name="hand" id="hand" style="width:100px;" onChange="get_query('/catalog/showsex/wages/{$template_data->id()}/sex/{$template_data->model_default()->id()}/long/'+this.value,'product'); " >
                                                    <option value='0' {if $template_data->color_default()->hand()==0} selected {/if}>короткий</option>
                                                    <option value='1' {if $template_data->color_default()->hand()==1} selected {/if}>длинный</option>
						</select>  
                                </div>
                                 {/if}
                                 
                                 {if count($template_data->sizes())>0}         
                                <div class="available-options">
                                  
                
					<label for="options">Размер:</label>
                                                <select name="sizes" id="size" onChange="change_size(this.options[this.selectedIndex].text,'{$template_data->model_default()->id_abriviature()}');" style="min-width:90px">
								{foreach from=$template_data->sizes() item=SizeOffer}
									<option value='{$SizeOffer->size()}'>{$SizeOffer->size()}</option>
									
								{/foreach}							
						</select>  
                                </div>
                                 {/if}
                                
                                
                            
                            <p class="qty">
                                <label>Цвет:</label>
                                <div id="image_small" class="ProductSmallImageBlock center">
                                   {include file='color_product.tpl'}
                                </div>
                            </p>
                            <div class="available-options">  
                            <p class="qty">
                                <label>Количество:</label>
                                <div style="position: relative; margin-bottom: 20px;">
                                    <input type="text" name="num" id="num" value="1" size="1" maxlength="2" onkeyup="getPrice(this.value);"/>
                                    <div class="numThis" id="amountprice"></div>
                                
                                </div>
                            </p>   
                                </div>
                                 <div style="clear:both;"></div>
                                                    
                                <p class="price" style="float: left;">Цена: <span id="priceTop" style="color: #F84E25;">{$template_data->price()}</span> руб.</p>
                            
                            <input type="submit" class="submit-btn" value="Заказать" onclick="post_ord('cut','/catalog/insertcut/');"/>
                            
                                </fieldset>
                        </form><!-- end of .available-options -->
    </div><!-- end of .product-detail -->
<!-- end of #contents -->
<div class="desc_tovar">{$template_data->description()}</div>
{include file='product_other.tpl'}


            