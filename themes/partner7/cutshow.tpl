{include file='header.tpl'}
<div class="container">


        <!-- START of BREADCRUMBS -->
        <p id="breadcrumbs">
                    <a href="/">Главная</a>
                <span class="active">Покупательская корзина</span>
        </p>
        <!-- END of BREADCRUMBS -->


        <!-- START of INNER-CONTAINER -->
        <div class="inner-container">

                    <div class="cart">

                                                    <h3>
                                    <span>Покупательская корзина {if count($template_data->offers())>0}Шаг 1 из 5{/if}</span>
                                </h3>
{if count($template_data->offers())>0}
                                <table>
                                            <tr>
                                                    
                                                <th>Картинка</th>
                                                <th class="name-header">Товар</th>
                                                
                                                <th>Цена</th>
                                                <th>Количество</th>
                                                <th>Сумма (руб.)</th>
                                                <th>Удалить</th>
                                        </tr>
                                        {foreach from=$template_data->offers() item=OffersCut name=iteration}
                                            <input type="hidden" id="{$smarty.foreach.iteration.index}_count" value="{$OffersCut->amount()}"/>
                                        <tr>
                                                    
                                                <td class="thumb"><img src="{$OffersCut->images_url()}" alt="{$OffersCut->name()}" /></td>
                                                
                                                <td class="name">
                                                    {$OffersCut->name()}
                                                    <ul class="info">
                                                        <li>{$OffersCut->model_name()}</li>
                                                        {if $OffersCut->size()!=''}
                                                                <li>Размер: {$OffersCut->size()}</li>
                                                        {/if}	
                                                        <li>Цвет: {$OffersCut->color_name()}</li>

                                                        {if $OffersCut->hand()!=''}
                                                        <li>Рукав: {$OffersCut->hand()}</li>
                                                        {/if}
                                                    </ul>  
                                                </td>
                                                <td>{$OffersCut->price()}</td>
                                                <td class="qty"><input type="text" id="{$smarty.foreach.iteration.index}" value="{$OffersCut->amount()}" onblur="if(this.value=='')this.value=jQuery('#{$smarty.foreach.iteration.index}_count').val();else cutCount(this);" size="3" maxlength="2" onkeyup="cutCount(this);"/></td>
                                                <td class="red"><span id="fer_{$smarty.foreach.iteration.index}">{$OffersCut->price_amount()}</span></td>
                                                <td>
                                                        <a href="javascript:void(0);" onclick="del_cut(this)" rel="{$OffersCut->link_del()}"><img src="/themes/partner7/images/del.gif" alt=""  title="Удалить" style="width:10px;height:10px; cursor: pointer" ></a>  
                                                    </td>
                                        </tr>
                                        <tr><td colspan="8" style="border-bottom: 1px solid #ccc;"></td></tr>
                                        {/foreach}
                                </table>

                                <div class="clearfix">
                                    <div class="left-column">
                                        <a href="javascript:history.back();" class="checkout">Назад</a>
                                    </div>
                                    <div class="left-column" style="text-align: center;">
                                            <p class="total">Итого: <span id="priceAll">{$template_data->basket_info()->price()}</span> руб.</p>
                                            <br/><p class="total" style="font-size: 12px;">Стоимость без учета доставки</p>
                                            
                                    </div>
                                    <div class="right-column">
                                            <p>
                                                {if $template_data->sum() < 190}
                                                    <a href="javascript:void(0);" onclick="alert('Минимальная сумма заказа 190 руб.');" class="update_long">Оформить заказ &rarr;</a>
                                                    {else}
                                                    <a href="/cut/show_step1" class="update_long">Оформить заказ &rarr;</a>
                                                {/if}
                                            </p>
                                    </div>
                                    
                                </div>
                                            
                                {include file='delivery.tpl'}           
{else}
            Ваша корзина пуста
	{/if}

                </div><!-- end of #product-list -->

        </div>
        <!-- END of INNER-CONTAINER -->


</div><!-- end of .container -->


    <!-- START of PAGE-BOTTOM -->
{include file='footer.tpl'}