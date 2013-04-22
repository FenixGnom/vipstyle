
{include file='header.tpl'}
{include file='leftblock.tpl'}

<div class="TitleContent center" style="position:relative;"><span>Покупательская корзина</span>
{if count($template_data->offers())>0}<span style="position:absolute;top:0px;right:3px;">Шаг 1 из 5</span>{/if}
</div>

<div id="cutshow_it" class="catShowBlock" style="margin-top:10px;">
	{if count($template_data->offers())>0}
	<table border="0" cellpadding="2" cellspacing="1" width="550px" class="center">
		<tr class="thead">
			<td>Название</td>
			<td>Модель</td>
			<td>Р-р</td>
			<td>Цена</td>
			<td>Кол-во</td>
			<td>Сумма (руб.)</td>
			<td></td>
		</tr>
			{foreach from=$template_data->offers() item=OffersCut}

		<tr class="trow1">

			<td align="center" style="padding-bottom:5px;">
			<div style="padding-bottom:5px;">{$OffersCut->name()}</div>
			<div  style="padding-bottom:5px;">
				<img id="topHat_0" src="{$OffersCut->images_url()}" id="img" width=70 alt="{$OffersCut->name()}">
			</div>
			</td>
			<td align="center">
				{$OffersCut->model_name()}<br>
				{if $OffersCut->hand()!=''}
                                    <i style="font-size:10px;">({$OffersCut->hand()})</i>
                                {/if}    
			</td>
			<td align="center">
				{if $OffersCut->size()!=''}
					{$OffersCut->size()}								
				{/if}
			</td>

			<td align="center">{$OffersCut->price()}</td>
			<td  align="center">{$OffersCut->amount()}</td>
			<td  align="center">{$OffersCut->price_amount()}</td>
			<td  align="center" width="15"><a href="javascript:void(0);" onclick="del_cut(this)" rel="{$OffersCut->link_del()}"><img src="/themes/partner2/images/del.gif" alt=""  title="Удалить" style="width:10px;height:10px; cursor: pointer" ></a></td>
		</tr>
		{/foreach}
	</table>
	<div class="center buttonCuts">
		<a href="javascript:history.back();"   class="left">
			<img src="/themes/partner2/images/back.png" id="img" />
		</a>
		{if $template_data->sum() < 190}				
			<a href="javascript:void(0);" onclick="alert('Минимальная сумма заказа 190 руб.');" class="left">
				<img src="/themes/partner2/images/zakaz-in.png" id="img" />
			</a>
		{else}
			<a href="/cut/show_step1" class="left">
				<img src="/themes/partner2/images/zakaz-in.png" id="img" />
			</a>
		{/if}
		<a href="javascript:void(0);" onclick="del_cut_all()"  class="left">
			<img src="/themes/partner2/images/del-all.png" id="img" />
		</a>
		<div class="clear"></div>
	</div>
	
	{include file='delivery.tpl'} 	

	{else}
            Ваша корзина пуста
	{/if}
</div>
 
{include file='footer.tpl'}