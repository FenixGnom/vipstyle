{include file='header.tpl'}
<div class="container">
    
        <!-- START of INNER-CONTAINER -->
        <div class="inner-container">

                    <div class="cart_step">

                              {if $template_data->is_result()}  
                              <h3>
                                    <span>Ваш Заказ принят!</span>
                                </h3>

                      
                                    <div class="accepted">
                                            <h4>Номер Вашего заказа <span class="number">{$template_data->order()}</span></h4>
                                            <p style="margin-left:0px;">Вся информация выслана на электронную почту</br> С Вами свяжется оператор для подтверждения заказа</p>
                                    </div>
                                    <div style="height:10px;"></div>
                                    <div >		
                                       <input type="button" class="checkout"  style="float:left; margin-left:5px;" onClick="location.href='http://maykoplat.ru/?id={$template_data->order()}&email={$template_data->email()}'" value="Оплатить">   
                                       
                                    </div>
                            {else}
                            <h3>
                                    <span>Ваш Заказ не принят!</span>
                                </h3>
                            <div class="titleContent" style="position:relative;"><span>Ваш Заказ не принят!</span></div> 

                                    <div class="accepted">
                                            <h4>Номер Вашего заказа <span class="number">{$template_data->order()}</span></h4>	
                                            <p style="margin-left:0px;">Ваш заказ не принят, но сохранен на сервере.</br> С Вами свяжется оператор для уточнения заказа</p>
                                            <br/>
                                            <p>{$template_data->answer()}</p>
                                    </div>
                            {/if}
                </div><!-- end of #product-list -->

        </div>
        <!-- END of INNER-CONTAINER -->


</div><!-- end of .container -->


    <!-- START of PAGE-BOTTOM -->
{include file='footer.tpl'}