<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 16:13:08
         compiled from "themes/partner8_green/delivery.tpl" */ ?>
<?php /*%%SmartyHeaderCode:187856481751752954c01fb7-50708910%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '15c5c98b3a6244917937aef2dbbdab60b3adb69b' => 
    array (
      0 => 'themes/partner8_green/delivery.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '187856481751752954c01fb7-50708910',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_data' => 0,
    'delivery' => 0,
    'cost' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_51752954c55791_01990266',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51752954c55791_01990266')) {function content_51752954c55791_01990266($_smarty_tpl) {?>		
<?php if (count($_smarty_tpl->tpl_vars['template_data']->value->deliveryinfo())>0){?>   
  	
    <style>

           div.diliverys{margin-bottom:10px;margin-top:10px;}
            div.diliverys a{color:#05ACE3;font-size:12px;}
            div.diliverys a:hover{text-decoration:none;}
            .DeliveryBlockText{margin:20px;text-align:justify;font-size:12px;}
            .DeliveryBlockText h3{color:#05ACE3;text-align: left;}
            .DeliveryBlockText ul.topStyle{list-style-type:circle;margin-left:15px;}
            .DeliveryBlockText ul.topStyle li{margin-top:5px;}
            .DeliveryBlockText a{color:#05ACE3;font-weight:normal;}
            .DeliveryBlockText table{border-collapse: collapse;background:#fff;font-size:12px;}
            .DeliveryBlockText table td{padding:3px 1px 3px 2px;border-bottom:1px solid #E5E5E5;width:150px;}
            .DeliveryBlockText p{margin-bottom:3px !important;}

    </style>
    
    <div class="DeliveryBlockText center">        

        <?php  $_smarty_tpl->tpl_vars['delivery'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['delivery']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['template_data']->value->deliveryinfo(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['delivery']->key => $_smarty_tpl->tpl_vars['delivery']->value){
$_smarty_tpl->tpl_vars['delivery']->_loop = true;
?>
            <h3 id="<?php echo $_smarty_tpl->tpl_vars['delivery']->value->name_lat();?>
"><?php echo $_smarty_tpl->tpl_vars['delivery']->value->name();?>
</h3>
            <?php echo $_smarty_tpl->tpl_vars['delivery']->value->text();?>

            <?php if (count($_smarty_tpl->tpl_vars['delivery']->value->cost())>0){?>
                 <table>
                    <?php  $_smarty_tpl->tpl_vars['cost'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cost']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['delivery']->value->cost(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cost']->key => $_smarty_tpl->tpl_vars['cost']->value){
$_smarty_tpl->tpl_vars['cost']->_loop = true;
?>                              
                           <tr>
                               <td><?php echo $_smarty_tpl->tpl_vars['cost']->value->amount();?>
  футболка</td>
                               <td><?php echo $_smarty_tpl->tpl_vars['cost']->value->cost();?>
руб.</td>
                           </tr>                                
                    <?php } ?>
                 </table> 
                 <p>&nbsp;</p>
                 <p>&nbsp;</p>
            <?php }?>    
        <?php } ?>   

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
<?php }?>        


<?php }} ?>