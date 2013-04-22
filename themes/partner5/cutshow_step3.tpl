{include file='header.tpl'}
{include file='leftblock.tpl'}
<div class="title center" style="position:relative;"><span>Способ оплаты</span>
<span style="position:absolute;top:10px;right:3px;">Шаг 4 из 5</span>
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
		.trow2 td{padding-top:2px;}
	</style>
{/literal}
<form id="thiszakaz" ACTION="/cut/show_step4" METHOD="POST">
	<table border="0" cellpadding="2" cellspacing="1" width="520px" class="center" style="margin-top:20px;">
		
			<tr class="trow2">
				<td>
					<input id="pay1" type="radio" name="prepay" value="POSTAL" {if $template_data->pay_default()=="POSTAL"}checked="true"{/if}/><label for="pay1">Оплата при получении</label>		
				</td>
				<td>
					 {$template_data->post()} руб.{if $template_data->post_tarif()!=''}<br />
                                    <span style="color: #56903e; font-size: 11px;">
                                                            <span rel="tooltip" style="cursor:default;" title="сумма доставки - {$template_data->post_delivery()} руб.<br>тариф на денежный перевод - {$template_data->post_tarif()} руб.">(включая почтовый тариф<br>на денежный перевод)</span>
                                    </span>{/if}
				</td>
			</tr>
			<tr class="trow2">
				<td>
                                    <input id="pay2" type="radio" name="prepay" value="PREPAY" {if $template_data->pay_default()=="PREPAY"}checked="true"{/if}/><label for="pay2">Предоплата&nbsp;<i style="font-size:11px;color:#666;">(скидка на товар 10%)</i></label>
				</td>
				<td>
                                    {$template_data->prepay()} руб.<br />
				</td>
			</tr>
		
		<tr class="trow1">
			<td colspan="2">
					<input type="button" class="bitButton" style="float:left;margin-left:5px;" onClick="location.href='/cut/show_step2'" value="Назад">
					<input type="button" class="bitButton" style="float:right;margin-right:5px;" onClick="window.document.getElementById('thiszakaz').submit()" value="Продолжить"><br><div  style="clear:both;"></div>
			</td>
		</tr>
	
	</table>	
</form>

 {include file='footer.tpl'}



