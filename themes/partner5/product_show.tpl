<div>
    <span style="font-size: 18px; line-height: 30px;">{$template_data->name()}</span>
    <br/>
    Артикул: {$template_data->id()}
</div>
<div id="inThisLoaders5">
	<form name="product_zak" id="cut" class="detBox" style="margin-top:10px;">
		<input name="oldid" id="oldid" type="hidden" value="{$template_data->id()}">
		<input name="id" id="name_id" type="hidden" value="{$template_data->id()}">
		<input  name="pricesis" id="pricesis" type="hidden" value="{$template_data->price()}">
		<input  name="color" id="color" type="hidden" value="{$template_data->color_default()->color_abriv()}">
		<input  name="sexname" id="sexname" type="hidden" value="{$template_data->model_default()->id_abriviature()}">
		
		<table cellspacing="0" border="0" valign=top>
		<tr>
				<td width="255" style="height:auto;" >
					<div id="fotoShow" {if !$template_data->front()}style="display:none;"{/if}>
					<a href="javascript:open_window('{$template_data->imgbig_url()}','',500,500)"><img src="{$template_data->img_url()}"  /></a>
				</div>
				{if $template_data->imgback_url()!=''}
					<script>
						var backFoto=1;
					</script>
					<div id="fotoShowBack" {if $template_data->front()}style="display:none;"{/if}>
						<a href="javascript:open_window('{$template_data->imgbackbig_url()}','',500,500)"><img src="{$template_data->imgback_url()}"  /></a>
					</div>
				{else}
					<script>
						var backFoto=0;
					</script>
				{/if}
				{literal}
				<style>
					#iconImg{margin:auto;width:180px; margin-top:5px;margin-bottom:10px;}
					#iconImg img{float:left;width:70px;height:70px;margin-right:10px;cursor:pointer;}
				</style>
				{/literal}
				<div id="iconImg" >
					{if $template_data->model_default()->double()}
						<img src="{$template_data->img_url()}" width="70" onclick="showInFoto(1);"/>
						{if $template_data->imgback_url()!=''}
							<img src="{$template_data->imgback_url()}" width="70" onclick="showInFoto(2);"/>
						{/if}
					{/if}
					<div style="clear:both;"></div>
				</div>
			<!--//stop-->		
            </div>
				</td>
				<td>
					Модель:<br />
					<div class="outner">
							<select onChange="get_query('/catalog/showsex/wages/{$template_data->id()}/sex/'+this.value,'window_wages');" name="model_change" style="width:250px;">
								
							{foreach from=$template_data->models() item=ArrayTypeOffers }
								<option value="{$ArrayTypeOffers->id()}" {if $ArrayTypeOffers->id()==$template_data->model_default()->id()}selected{/if}>{$ArrayTypeOffers->name()}</option>
							{/foreach}						 
						 </select>
					</div>
					{if $template_data->is_hand()>0}
						
						рукав:<br />
						<div class="outner">
							<select name="hand" id="hand" onChange="get_query('/catalog/showsex/wages/{$template_data->id()}/sex/{$template_data->model_default()->id()}/long/'+this.value,'window_wages'); " >
								 <option value='0' {if $template_data->color_default()->hand()==0} selected {/if}>короткий</option>
                                                                 <option value='1' {if $template_data->color_default()->hand()==1} selected {/if}>длинный</option>
						</select>
						</div>
					{/if}
					 {if count($template_data->sizes())>0}	
							<div class="outner">
								размер:<br />							
									<select name="sizes"  onChange="change_size(this.options[this.selectedIndex].text,'{$template_data->model_default()->id_abriviature()}');" style="min-width:90px">
								{foreach from=$template_data->sizes() item=SizeOffer}
									<option value='{$SizeOffer->size()}'>{$SizeOffer->size()}</option>
									
								{/foreach}							
						</select>						
							</div>
					{/if}
					кол-во:<br />
					<input name="num" id="num" value="1" size="5" maxlength="3">
					<div style="margin-top:10px;margin-left:5px;">цвет:</div>
					<div id="image_small">
						{include file='color_product.tpl'}
					</div>
				</td>
			</tr>
		</table>
		<b>Выбранный товар:</b><br>
		 {$template_data->model_default()->name()}
				{if $template_data->is_hand()}		
			(<span id="rukav">{if $template_data->color_default()->hand()==0}короткий{else}длинный{/if}</span> рукав)
		{/if}		
		<b>цвет:</b> 
		<span id="colors">{$template_data->color_default()->name()}</span>;
		{if count($template_data->sizes())>0}
			<b>размер:</b> <span id="sizes">{$template_data->size_default()->size()}</span>;
		{/if}               
		<span id="price">{$template_data->price()}</span> руб.
		<div class="order"><a href="javascript:post_ord('cut','/catalog/insertcut/');">Заказать</a></div>
                {if $template_data->description()!=""}
                    <div style="margin-top:10px;text-align: left;font-size:12px;padding:10px;">
                        
                        {$template_data->description()}
                    </div>    
                {/if} 
	</form>
               
</div>
<div >
    {include file='product_other.tpl'}
</div>
    
