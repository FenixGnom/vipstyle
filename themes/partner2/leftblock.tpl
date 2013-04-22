<div class="leftCont left">
    <div class="categoriesName"><span>Наши футболки</span></div>
    <div class="categriesMenu">
        {include file='category.tpl'}
    </div>
    <div class="categoriesName"><span>Информация</span></div>
    <div class="menuInfo">
                            {foreach from=$template_data->menu(4) item=menuUser}     		
                                    <div class="menuInfodiv"><a  href="{$menuUser->url()}" {if $menuUser->is_target()} target="_blank" {/if} >{$menuUser->name()}</a></div>
                            {/foreach}						

    </div>
    <div class="categoriesName"><span>Контакты</span></div>
    <div class="menuInfo">
    {if $template_data->partner()->contact_icq() != ""}
        <div class="menuInfoICQ">ICQ: {$template_data->partner()->contact_icq()}</div>
    {/if}
    {if $template_data->partner()->contact_email() !=""}
        <div class="menuInfodiv">e-mail:<br><a href="mailto:{$template_data->partner()->contact_email()}">{$template_data->partner()->contact_email()}</a></div>
    {/if}
    {if $template_data->partner()->contact_phone() !=""}
        <div class="menuInfodiv">Телефон:<br/> {$template_data->partner()->contact_phone()}</div>
    {/if}
    <div class="menuInfodiv"><a href="/feedback">Обратная связь</a></div>

    </div>
</div>
<div class="centerCont left">
