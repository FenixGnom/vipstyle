<div class="mainsMenu"><span><a href="/new">Новинки</a></span></div><div class="menuLeftLine"></div>
 
{foreach from=$template_data->menu(1) item=categories}
		<div class="mainsMenu"><a href="{$categories->url()}">{$categories->name()}</a></div><div class="menuLeftLine"></div>
{/foreach} 