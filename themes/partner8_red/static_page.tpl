{include file='meta_head.tpl'}
{include file='header.tpl'}

<div id="mainleft">
	<div class="c_inner">
		<div class="c_inner_t">
			<div class="c_inner_b">
				<div class="pad_content_inner">
					<div id="breadcrumb">
						<a href="/">Главная</a> 
                                                {if count($template_data->menu(5))>0}
                                                    {foreach from=$template_data->menu(5) item=breadcrumb}
                                                     &gt;   {$breadcrumb->name()}
                                                    {/foreach}
                                                {/if} 
					</div>
					<br />
					{$template_data->content()}
						
						
						

						
				</div><!-- end pad_content_inner -->
			</div>
		</div>
	</div>	
	
</div>

{include file='category.tpl'}                      
{include file='footer.tpl'}