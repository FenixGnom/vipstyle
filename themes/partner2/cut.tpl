
    <a href="{$template_data->basket_info()->url()}" style="text-decoration: none;">
	<img src="/themes/partner2/images/basket_icon.gif" id="img" align="absmiddle" style="float:left;">
	<div style="float:left;width:150px;text-align: left;margin-left:5px;">
            {if $template_data->basket_info()->amount()!=0}

            <div>товаров: {$template_data->basket_info()->amount()},</div> <div>на сумму: {$template_data->basket_info()->price()} &nbsp;руб.</div>{else}<div>Корзина</div><div>пустая</div>{/if}
        </div>
        <div style="clear:both;"></div>
    </a>

