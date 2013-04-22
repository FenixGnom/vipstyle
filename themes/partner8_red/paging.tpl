
   	{if $template_data->pagginator()->previus()}
            <a href="{$template_data->pagginator()->previus()->url()}"><<</a>
    {/if}
    {foreach from=$template_data->pagginator()->links() item=Paging}
            {if $Paging->is_selected()==0}
                    <a href="{$Paging->url()}">{$Paging->name()}</a>
            {else}
                    <b>{$Paging->name()}</b>
            {/if}
    {/foreach}
    {if $template_data->pagginator()->next()}
            <a href="{$template_data->pagginator()->next()->url()}">>></a>
    {/if}
   