
    {if $template_data->pagginator()->previus()}
            <a href="{$template_data->pagginator()->previus()->url()}">&lt;</a>
    {/if}
    {foreach from=$template_data->pagginator()->links() item=Paging}
            {if $Paging->is_selected()==0}
                    <a href="{$Paging->url()}">{$Paging->name()}</a>
            {else}
                    <a class="active">{$Paging->name()}</a>
            {/if}
    {/foreach}
    {if $template_data->pagginator()->next()}
            <a href="{$template_data->pagginator()->next()->url()}">&gt;</a>
    {/if}
   