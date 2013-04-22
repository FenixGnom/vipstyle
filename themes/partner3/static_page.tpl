{include file='page_header.tpl'}
{include file='leftblock.tpl'}

<div class="contentTitle center">
    <span>
        <a href="/">Главная</a> 
        {if count($template_data->menu(5))>0}
            {foreach from=$template_data->menu(5) item=breadcrumb}
                /   {$breadcrumb->name()}
            {/foreach}
        {/if}     
    </span>
</div>
<div class="textPlain center">{$template_data->content()}</div>

{include file='page_footer.tpl'}