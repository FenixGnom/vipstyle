<div class="menuCategories"><a href="/new"><b>Новинки</b></a></div>
{foreach from=$template_data->menu(1) item=categories}
   <div class="menuCategories"><a href="{$categories->url()}">{$categories->name()}</a></div>
{/foreach}