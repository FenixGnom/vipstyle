		
{if count($template_data->deliveryinfo())>0}   
  {literal}	
    <style>

           div.diliverys{margin-bottom:10px;margin-top:10px;}
            div.diliverys a{color:#05ACE3;font-size:12px;}
            div.diliverys a:hover{text-decoration:none;}
            .DeliveryBlockText{margin:20px;text-align:justify;font-size:12px;}
            .DeliveryBlockText h3{color:#05ACE3;text-align:left;}
            .DeliveryBlockText ul.topStyle{list-style-type:circle;margin-left:15px;}
            .DeliveryBlockText ul.topStyle li{margin-top:5px;}
            .DeliveryBlockText a{color:#05ACE3;font-weight:normal;}
            .DeliveryBlockText table{border-collapse: collapse !important;background:#fff;width:auto;}
            .DeliveryBlockText table td{border:0px !important;;padding:3px 1px 3px 2px;border-bottom:1px solid #E5E5E5 !important;width:150px;font-size:12px !important;}
            .DeliveryBlockText p{margin-bottom:3px !important;}

    </style>
    {/literal}
    <div class="DeliveryBlockText center">        

        {foreach  from=$template_data->deliveryinfo() item=delivery}
            <h3 id="{$delivery->name_lat()}">
                <span>{$delivery->name()}</span>
            </h3>
            {$delivery->text()}
            {if count($delivery->cost())>0}
                 <table>
                    {foreach from=$delivery->cost() item=cost name=ct}                              
                           <tr>
                               <td>{$cost->amount()}  футболка</td>
                               <td>{$cost->cost()}руб.</td>
                           </tr>                                
                    {/foreach}
                 </table> 
                 <p>&nbsp;</p>
                 <p>&nbsp;</p>
            {/if}    
        {/foreach}   

        <p>&nbsp;</p>
        <p>&nbsp;</p>

        <h2 style="margin-bottom: 0 !important;">Внимание!</h2>

        <ul class="topStyle">
                <li>Минимальная сумма заказа 190руб.</li>
                <li>Заказы на сумму свыше 5000руб. без полной предоплаты не отправляются.</li>
                <li>Стоимость доставки одной кружки приравнивается к стоимости доставки одной футболки.</li>
                <li>Стоимость доставки одного коврика для мыши приравнивается к стоимости доставки одной футболки.</li>
                <li> Стоимость доставки от 1 до 20 значков приравнивается к стоимости доставки одной футболки<br> от 21 до 40 - к стоимости доставки двух футболок и так далее.<br> Если, кроме значков, в заказ входят еще какие-либо товары, то первые 20 значков в цене доставки не учитываются. </li>
                <li>Стоимость доставки одной бейсболки приравнивается к стоимости доставки одной футболки.</li>
                <li>Доставка с оплатой при получении возможна только по России! Во все остальные страны - 100% предоплата.</li>
        </ul>	
    </div>
{/if}        