{if $template_data->basket_info()->amount()!=0}
<a href="/cut">
    <img src="/themes/{$template_data->enviroment()->theme_path()}images/cart.png" alt="" class="imgleft" />
</a>
<a class="inCut" href="/cut">
    В корзине товаров: <strong>{$template_data->basket_info()->amount()}</strong>
    <div>на сумму: {$template_data->basket_info()->price()} &nbsp;руб.</div>
</a>
{else}
    <img src="/themes/{$template_data->enviroment()->theme_path()}images/cart.png" alt="" class="imgleft" />
    Корзина пустая
{/if}    
