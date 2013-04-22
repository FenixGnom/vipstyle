{include file='header.tpl'}
{include file='leftblock.tpl'}
<div class="title center" style="position:relative;"><span>Способ доставки</span>
<span style="position:absolute;top:10px;right:3px;">Шаг 3 из 5</span>
</div>
{literal}
	<style>
		input.bitButton{
			background:#000;
			color:#fff;
			font-size:11px;
			padding:2px 3px 2px 3px;
			margin-top:5px;
			cursor:pointer;
			border:1px solid #000;
		}
		label{margin-top:2px;}
		.trow2 td{padding-top:2px;}
	</style>
{/literal}

<form id="thiszakaz" ACTION="/cut/show_step3" METHOD="POST">
	<table border="0" cellpadding="2" cellspacing="1" width="520px" class="center" style="margin-top:20px;">
		{foreach from=$template_data->delivery() item=DeliveryArray name=delivery}
			<tr class="trow2">
				<td>
				<input id="delivery-{$smarty.foreach.delivery.index}" type="radio" name="delivery"  value="{$DeliveryArray->value()}"  {if $template_data->delivery_default()->value()==$DeliveryArray->value()}checked="true" {/if} />
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
		<tr class="trow1">
			<td colspan="2">
                            <input type="button" class="bitButton" style="float:left;margin-left:5px;" onClick="location.href='/cut/show_step1'" value="Назад">
                            <input type="button" class="bitButton" style="float:right;margin-right:5px;" onClick="window.document.getElementById('thiszakaz').submit()" value="Продолжить"><br><div  style="clear:both;"></div>
			</td>
		</tr>
	
	</table>	
</form>
                
 {include file='footer.tpl'}                