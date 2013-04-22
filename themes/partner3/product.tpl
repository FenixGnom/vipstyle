
{include file='page_header.tpl'}
{include file='leftblock.tpl'}

<div class="contentTitle">
	<span>
	{if $template_data->is_from_serch_page()}
                                 <a href="/">Главная</a>/
                                 <a href="/search/{$smarty.session.searchingText}">Результаты поиска</a>                  
                                
                            {else}
                                
                                <a href="{$template_data->category()->url()}">{$template_data->category()->name()}</a>
                                {if $template_data->subcat()}
                                        /<a  href="{$template_data->subcat()->url()}">
                                        {$template_data->subcat()->name()}</a>
                                {/if}
                                   
                            {/if}
	
	</span>
</div>

<div id="window_wages">
	{include file='product_show.tpl'}
</div>


{include file='page_footer.tpl'}