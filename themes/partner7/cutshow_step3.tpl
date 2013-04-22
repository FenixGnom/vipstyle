{include file='header.tpl'}
{literal}
	<style>	
		#tooltip{
			background:#FFFFFF;
			border:1px solid #666666;
			color:#333333;
			font:menu;
			margin:0px;
			padding:3px 5px;
			position:absolute;
			visibility:hidden;
			margin-left:5px;
		}
	</style>
{/literal}
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
                                    <span>Способ оплаты Шаг 4 из 5</span>
                                </h3>

<form id="thiszakaz" ACTION="/cut/show_step4" METHOD="POST">
                                <table>
                                        <tr>
                                                    <td style="width:300px;">
                                                            <input id="pay1" type="radio" name="prepay" value="POSTAL" {if $template_data->pay_default()=="POSTAL"}checked="true"{/if}/><label for="pay1">Оплата при получении</label>		
                                                    </td>
                                                    <td>
                                                        {$template_data->post()} руб.{if $template_data->post_tarif()!=''}<br />
                                                        <span style="color: #56903e; font-size: 11px;">
                                                                                <span rel="tooltip" style="cursor:default;" title="сумма доставки - {$template_data->post_delivery()} руб.<br>тариф на денежный перевод - {$template_data->post_tarif()} руб.">(включая почтовый тариф<br/> на денежный перевод)</span>
                                                        </span>{/if}
                                                    </td>
                                            </tr>
                                            <tr>
                                                    <td>
                                                        <input id="pay2" type="radio" name="prepay" value="PREPAY" {if $template_data->pay_default()=="PREPAY"}checked="true"{/if}/><label for="pay2">Предоплата&nbsp;<i style="font-size:11px;color:#666;">(скидка на товар 10%)</i></label>
                                                    </td>
                                                    <td>
                                                        {$template_data->prepay()} руб.<br />
                                                    </td>
                                            </tr>
			
			<tr><td colspan="2" style="background:none;">
					<input type="button" class="checkout"  style="float:left; margin-left:5px;" onClick="location.href='/cut/show_step2'" value="Назад">
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