{include file='header.tpl'}
{include file='leftblock.tpl'}

<div class="titleName center">
<span>
    <a href="/">Главная</a> 
        {if count($template_data->menu(5))>0}
            {foreach from=$template_data->menu(5) item=breadcrumb}
                /   {$breadcrumb->name()}
            {/foreach}
        {/if} 
</span>        
</div>
<div class="PlainText center" style="width:365px;">{$template_data->content()}</div>

 {include file='rightblock.tpl'} 
{include file='footer.tpl'}