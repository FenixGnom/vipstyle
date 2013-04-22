<a href="/new" class="first">Новинки</a>
{foreach from=$template_data->menu(1) item=categories}
		<a href="{$categories->url()}">{$categories->name()}</a>
{/foreach}