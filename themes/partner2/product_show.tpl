<div class="ProductShowName">{$template_data->name()}</div>
<div style="font-size: 12px;">Артикул: {$template_data->id()}</div>
<div class="ProductShowBlock center" id="inThisLoaders2">
    
    <div class="ProductShowBlockTop"><!----></div>
     
	
	<div class="ProductShowBlockCenter">
        <form id="cut" name="product_zak" onsubmit="return false;">
            <input name="oldid" id="oldid" type="hidden" value="{$template_data->id()}">
            <input name="id" id="name_id" type="hidden" value="{$template_data->id()}">
            <input  name="pricesis" id="pricesis" type="hidden" value="{$template_data->price()}">
            <input  name="color" id="color" type="hidden" value="{$template_data->color_default()->color_abriv()}">
            <input  name="sexname" id="sexname" type="hidden" value="{$template_data->model_default()->id_abriviature()}">
				
			<div style="font-size:12px;">
			Модель:
                            <select onChange="get_query('/catalog/showsex/wages/{$template_data->id()}/sex/'+this.value,'window_wages');" name="model_change" style="width:280px;">

                                    {foreach from=$template_data->models() item=ArrayTypeOffers }
                                            <option value="{$ArrayTypeOffers->id()}" {if $ArrayTypeOffers->id()==$template_data->model_default()->id()}selected{/if}>{$ArrayTypeOffers->name()}</option>
                                    {/foreach}						 
                            </select>
                                <br/><br/>
			</div>
            <div class="ProductShowFoto left" style="height:auto;">
			<!--//start-->
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
					#iconImg{margin:auto;width:160px; margin-top:5px;margin-bottom:10px;}
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
			
			<div class="ProductShowParams left">
				
				<div>
					
					
					{if $template_data->is_hand()>0}
						Рукав:<br>
						<select name="hand" id="hand" onChange="get_query('/catalog/showsex/wages/{$template_data->id()}/sex/{$template_data->model_default()->id()}/long/'+this.value,'window_wages'); " >
                                                    <option value='0' {if $template_data->color_default()->hand()==0} selected {/if}>короткий</option>
                                                    <option value='1' {if $template_data->color_default()->hand()==1} selected {/if}>длинный</option>
						</select><br><br>
					{/if}
					{if count($template_data->sizes())>0}
						Размер:<br>
						<select name="sizes"  onChange="change_size(this.options[this.selectedIndex].text,'{$template_data->model_default()->id_abriviature()}');" style="min-width:90px">
								{foreach from=$template_data->sizes() item=SizeOffer}
									<option value='{$SizeOffer->size()}'>{$SizeOffer->size()}</option>
									
								{/foreach}							
						</select>
					{/if}
					<br><br>
					Количество:<br>
					<input type="text" name="num" id="num" value="1" size="5" maxlength="3"><br><br>
				</div>
			</div>
			
            <div class="clear"></div>
			<div style="font-size:13px;font-weight:bold;text-align:left;margin-left:10px;">Цвет:</div>	
            <div id="image_small" class="ProductSmallImageBlock center">
               {include file='color_product.tpl'}
            </div>
            <div class="ResProductTxt">
                <b>Выбранный товар:</b><br>
                {$template_data->model_default()->name()}
				{if $template_data->is_hand()}	
					(<span id="rukav">{if $template_data->color_default()->hand()==0}короткий{else}длинный{/if}</span> рукав)
				{/if}
				<br />	
				<b>цвет:</b> 
				<span id="colors">{$template_data->color_default()->name()}</span>;
				{if count($template_data->sizes())>0}
					<b>размер:</b> <span id="sizes">{$template_data->size_default()->size()}</span>;
				{/if}               
            </div>
            <div class="ResProductTxtPrice">цена: <span id="price">{$template_data->price()} </span> руб.</div>
            <div class="buttonAddCart">
				<input type="submit" value="" style="width:93px;height:17px;background: url('/themes/partner2/images/zakaz.jpg');border:0px;" onclick="post_ord('cut','/catalog/insertcut/');">
			</div>
		</form>
            
            
                {if $template_data->description()!=""}
                    <div style="margin-top:10px;text-align: left;font-size:12px;padding:10px;">
                        
                        {$template_data->description()}
                    </div>    
                {/if}
                    
    </div>
    <div class="ProductShowBlockBottom"><!----></div>
</div>
<div class="center">
    {include file='product_other.tpl'}
</div>
