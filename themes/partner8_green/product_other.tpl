<div class="OtherBlock center">
        {if count($template_data->other_offers())>0}
			<div class="pad_content">
				<h1>Другие товары с этим же дизайном:</h1>		
				{foreach from=$template_data->other_offers() item=OffersOther}					
						<div class="prodbox">
							<div class="prodbox_c">
							<div class="prodbox_b">
								<div class="pad_box">
                                                                        <a href="{$OffersOther->url()}">
                                                                            <img src="{$OffersOther->image_url()}" alt="" class="imgcenter" />
                                                                        </a>
                                                                        <a class="nameOffer" href="{$OffersOther->url()}">
                                                                            <h2 class="prod_title">{$OffersOther->name()}</h2>
                                                                        </a>
                                                                        <div class="prices"><span class="price"> {$OffersOther->price()} руб.</span></div>
                                                                        <div class="cat-to">
                                                                            <a  href="{$OffersOther->url()}"><img src="/themes/{$template_data->enviroment()->theme_path()}images/but_addcart.gif" /></a>
                                                                        </div>
                                                                        <div class="clr"></div>
                                                                </div>
							</div>
							</div>
						</div>
					  
				{/foreach}
			</div>
			<div class="clr"></div>	
		{/if}
</div>


