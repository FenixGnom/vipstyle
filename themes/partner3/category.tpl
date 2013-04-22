<div class="categoriesMenu"><span><a href="/new">Новинки</a></span></div><div class="categoriesMenuLine lineWidthMenu"></div>
{foreach from=$template_data->menu(1) item=categories}
		<div class="categoriesMenu"><a href="{$categories->url()}">{$categories->name()}</a></div><div class="categoriesMenuLine lineWidthMenu"></div>
{/foreach} 	
