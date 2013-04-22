{include file='header.tpl'}
{include file='leftblock.tpl'}

<div class="title">

    <span>
        <a href="/">Главная</a> 
        {if count($template_data->menu(5))>0}
            {foreach from=$template_data->menu(5) item=breadcrumb}
                /   {$breadcrumb->name()}
            {/foreach}
        {/if}     
    </span>
</div>
<div class="worddesc"><div>{$template_data->content()}</div></div>

{include file='footer.tpl'}