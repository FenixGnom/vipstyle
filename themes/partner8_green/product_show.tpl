
<div class="c_inner">
        <div class="c_inner_t">
                <div class="c_inner_b">
                        <div class="pad_content_inner">
                                <div id="breadcrumb">
                                        <a href="/">Главная</a>  &gt;
                                {if $template_data->is_from_serch_page()}
                                            <a href="/search/{$smarty.session.searchingText}">Результаты поиска</a>  
                                {else}
                                        <a href="{$template_data->category()->url()}">{$template_data->category()->name()}</a>
                                        {if $template_data->subcat()}
                                                &gt;<a  href="{$template_data->subcat()->url()}">
                                                {$template_data->subcat()->name()}</a>
                                        {/if}

                                {/if}
                                </div><br />

                                <form id="cut" name="product_zak" onsubmit="return false;">
                                        <input name="oldid" id="oldid" type="hidden" value="{$template_data->id()}">
                                        <input name="id" id="name_id" type="hidden" value="{$template_data->id()}">
                                        <input  name="pricesis" id="pricesis" type="hidden" value="{$template_data->price()}">
                                        <input  name="color" id="color" type="hidden" value="{$template_data->color_default()->color_abriv()}">
                                        <input  name="sexname" id="sexname" type="hidden" value="{$template_data->model_default()->id_abriviature()}">

                                        <div id="description">
                                                <div id="product_image">
                                                        <div id="fotoShow" {if !$template_data->front()}style="display:none;"{/if}>
                                                                <a href="javascript:open_window('{$template_data->imgbig_url()}','',500,500)"><img src="{$template_data->img_url()}"  /></a>
                                                        </div>
                                                        {if $template_data->imgback_url()!=''}					
                                                                <div id="fotoShowBack" {if $template_data->front()}style="display:none;"{/if}>
                                                                        <a href="javascript:open_window('{$template_data->imgbackbig_url()}','',500,500)"><img src="{$template_data->imgback_url()}"  /></a>
                                                                </div>
                                                        {/if}								
                                                        <div class="thumb" id="iconImg">
                                                                {if $template_data->model_default()->double()}
                                                                        <img src="{$template_data->img_url()}" width="70" onclick="showInFoto(1);"/>
                                                                        {if $template_data->imgback_url()!=''}
                                                                                <img src="{$template_data->imgback_url()}" width="70" onclick="showInFoto(2);"/>
                                                                        {/if}
                                                                {/if}
                                                                <div class="clr"></div>
                                                        </div>
                                                        <div style="text-align: center;">        
                                                                <a class="back" href="javascript:void(0);" onclick="history.back();">Вернуться к выбору</a>        
                                                        </div>        
                                                </div><!-- end product_image -->
                                                <div id="product_description">
                                                        <div class="title_description"><h2>{$template_data->name()}</h2></div>
                                                                <div class="row">
                                                                        <ul>
                                                                                <li class="col1">Артикул</li>
                                                                                <li class="col2">{$template_data->id()}</li>
                                                                        </ul>
                                                                </div>
                                                                <br style="clear:both;"  />        
                                                                <div class="row">
                                                                        <ul>
                                                                                <li class="col1">Модель</li>
                                                                                <li class="col2">											
                                                                                        <select onChange="get_query('/catalog/showsex/wages/{$template_data->id()}/sex/'+this.value,'window_wages');" name="model_change" style="width:250px;">

                                                                                                    {foreach from=$template_data->models() item=ArrayTypeOffers }
                                                                                                        <option value="{$ArrayTypeOffers->id()}" {if $ArrayTypeOffers->id()==$template_data->model_default()->id()}selected{/if}>{$ArrayTypeOffers->name()}</option>
                                                                                                {/foreach}						 
                                                                                            </select>
                                                                                </li>
                                                                        </ul>
                                                                </div>
                                                                <br style="clear:both;"  />

                                                                {if $template_data->is_hand()>0}
                                                                        <div class="row">
                                                                                <ul>
                                                                                        <li class="col1">Рукав</li>
                                                                                        <li class="col2">
                                                                                                <select name="hand" id="hand" onChange="get_query('/catalog/showsex/wages/{$template_data->id()}/sex/{$template_data->model_default()->id()}/long/'+this.value,'window_wages'); " >
                                                                                                <option value='0' {if $template_data->color_default()->hand()==0} selected {/if}>короткий</option>
                                                                                                <option value='1' {if $template_data->color_default()->hand()==1} selected {/if}>длинный</option>
                                                                                                </select>
                                                                                        </li>
                                                                                </ul>
                                                                        </div>
                                                                        <br style="clear:both;"  />
                                                                {/if}
                                                                {if count($template_data->sizes())>0}
                                                                        <div class="row">
                                                                                <ul>
                                                                                        <li class="col1">Размер</li>
                                                                                        <li class="col2">
                                                                                                <select name="sizes"  onChange="change_size(this.options[this.selectedIndex].text,'{$template_data->model_default()->id_abriviature()}');" style="min-width:90px">
                                                                                                        {foreach from=$template_data->sizes() item=SizeOffer}
                                                                                                                <option value='{$SizeOffer->size()}'>{$SizeOffer->size()}</option>

                                                                                                        {/foreach}							
                                                                                                </select>
                                                                                        </li>
                                                                                </ul>
                                                                        </div>
                                                                        <br style="clear:both;"  />
                                                                {/if}
                                                                <div class="row">
                                                                        <ul>
                                                                                <li class="col1">Цвет</li>
                                                                                <li class="col2" id="image_small">
                                                                                            {include file='color_product.tpl'}
                                                                                </li>
                                                                        </ul>
                                                                </div>
                                                                <br style="clear:both;"  />

                                                                <div class="row">
                                                                        <ul>
                                                                                <li class="col1">Количество</li>
                                                                                <li class="col2" style="position: relative;">
                                                                                        <input type="text" name="num" id="num" value="1" size="5" maxlength="2" onkeyup="getPrice(this.value);">
                                                                                        <div class="numThis" id="amountprice"></div>
                                                                                </li>
                                                                        </ul>
                                                                </div>
                                                                <br style="clear:both;"  />

                                                                <div class="row">
                                                                        <ul>
                                                                                <li class="col1">Цена</li>
                                                                                <li class="col2"><span id="price">{$template_data->price()}</span> руб.</li>
                                                                        </ul>
                                                                </div>
                                                                <br style="clear:both;"  />
                                                                 
                                                                 								  
                                                                    
                                                                <hr /><br />
                                                                
                                                                    <input type="image" style="border:0px;margin-left:280px;" src="/themes/{$template_data->enviroment()->theme_path()}images/but_addcart.gif" class="imgleft" onclick="post_ord('cut','/catalog/insertcut/');"/>
                                                                    <div class="clr"></div>
                                                               
                                                                <p>{$template_data->description()}</p>

                                                </div><!-- end product_description -->
                                                <div class="clr"></div>
                                        </div><!-- end description -->
                                        <div class="clr"></div><!-- clear float -->
                                </form>

                        </div><!-- end pad_content_inner -->
                </div>
        </div>
</div>	
{include file='product_other.tpl'}
