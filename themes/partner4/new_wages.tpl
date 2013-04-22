{foreach from=$template_data->novelty() item=New_wages}
	<div class="newWages">
		<a href="{$New_wages->url()}"><img src="{$New_wages->image_url()}" id="imgProduct"/>
		<div >{$New_wages->name()}</div></a>	
	</div>
{/foreach}
