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

                    <div class="cart_step">

                                                    <h3>
                                    <span>Способ доставки Шаг 3 из 5</span>
                                </h3>

<form id="thiszakaz" ACTION="/cut/show_step3" METHOD="POST">
                                <table>
                                            {foreach from=$template_data->delivery() item=DeliveryArray name=delivery}
                                        <tr>
                                                <td style="width:300px;">
                                                <input  type="radio" id="delivery-{$smarty.foreach.delivery.index}" name="delivery"  value="{$DeliveryArray->value()}"  {if $template_data->delivery_default()->value()==$DeliveryArray->value()}checked="true" {/if} />
                                                <input type="hidden" name="{$DeliveryArray->value()}_name" value="{$DeliveryArray->name()}" />
                                                <input type="hidden" name="{$DeliveryArray->value()}_price" value="{$DeliveryArray->cost()}" /> 
                                                <label for="delivery-{$smarty.foreach.delivery.index}">{$DeliveryArray->name()}</label>	
                                                </td>
                                                <td>
                                                        {if $DeliveryArray->cost()!=0}
					{$DeliveryArray->cost()} руб.
                                    {else}
                                        Бесплатно
                                    {/if}  
                                                </td>
                                        </tr>
                                {/foreach}
			
			<tr><td colspan="2" style="background:none;">
					<input type="button" class="checkout"  style="float:left; margin-left:5px;" onClick="location.href='/cut/show_step1'" value="Назад">
					<input type="button" class="update"  style="float:right; margin-right:5px;" onClick="window.document.getElementById('thiszakaz').submit()" value="Продолжить"><br>
                        </tr>
                                </table>
</form>
                </div><!-- end of #product-list -->

        </div>
        <!-- END of INNER-CONTAINER -->


</div><!-- end of .container -->


    <!-- START of PAGE-BOTTOM -->
{include file='footer.tpl'}