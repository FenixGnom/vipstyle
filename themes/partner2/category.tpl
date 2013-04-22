<ul>
<li><div class="catLink"><a href="/new">Новинки</a></div><div class="catListBot"><!----></div></li>
	{foreach from=$template_data->menu(1) item=categories}
		<li><div class="catLink"><a href="{$categories->url()}">{$categories->name()}</a></div><div class="catListBot"><!----></div></li>
	{/foreach}
	
</ul>