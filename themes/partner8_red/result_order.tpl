{include file='meta_head.tpl'}
{include file='header.tpl'}

<div id="mainleft">
	<div class="c_inner">
		<div class="c_inner_t">
			<div class="c_inner_b">
				<div class="pad_content_inner">
					<div id="breadcrumb">
						<a href="/">Главная</a>  &gt;					
						<a >Корзина покупателя</a>  
					</div>
					<br />
					{if $template_data->is_result()}
						<h3>Ваш Заказ принят!</h3>
						<h4>Номер Вашего заказа {$template_data->order()}</h4>
						<p >Вся информация выслана на электронную почту</br> С Вами свяжется оператор для подтверждения заказа</p>
						<div style="height:10px;"></div>
						<div >		
							<a  class="maykoplat"  href="http://maykoplat.ru/?id={$template_data->order()}&email={$template_data->email()}" >Оплатить</a>
						</div>
					{else}
						<h3>Ваш Заказ не принят!</h3>
						<h4>Номер Вашего заказа {$template_data->order()}</h4>
						<p >Ваш заказ не принят, но сохранен на сервере.</br> С Вами свяжется оператор для уточнения заказа</p>
					{/if}	
						
					{$template_data->answer()}	
						

						
				</div><!-- end pad_content_inner -->
			</div>
		</div>
	</div>	
	
</div>

{include file='category.tpl'}                      
{include file='footer.tpl'}