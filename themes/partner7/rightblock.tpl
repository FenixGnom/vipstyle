<div id="sidebar">
        <h3><span>Категории</span></h3>
    <ul>
                <li><a href="/new"><b>Новинки</b></a></li>
                {foreach from=$template_data->menu(1) item=categories}
                    <li><a href="{$categories->url()}">{$categories->name()}</a></li>
                {/foreach}
    </ul>
</div><!-- end of #sidebar -->