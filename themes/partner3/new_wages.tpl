{foreach from=$template_data->returnNewProducts()  item=New_wages}
	<div class="productSectionNew">
		<a href="/product/{$New_wages['oldid']}/model/{$New_wages['path']}"><img src="{$View->LoadProdImage($New_wages['oldid'],$New_wages['path'])}" id="imgProduct"/>
		<div >{$View->ShowTypeOffer($New_wages['name'],$New_wages['path'])}</div></a>
	</div>
{/foreach}
