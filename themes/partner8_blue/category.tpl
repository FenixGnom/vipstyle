<div id="side">
	<div class="sidebox">
		<div class="sidebox_t">
			<div class="sidebox_b">
				<h2>Категории</h2>
				<div class="padbox_side">
					<ul>
						<li><a href="/new">Новинки</a></li>
						{foreach from=$template_data->menu(1) item=categories}
							<li><a href="{$categories->url()}">{$categories->name()}</a></li>
						{/foreach}						
					</ul>
				</div>
			</div>
		</div>
	</div><!-- end sidebox -->
	
</div><!-- end side -->