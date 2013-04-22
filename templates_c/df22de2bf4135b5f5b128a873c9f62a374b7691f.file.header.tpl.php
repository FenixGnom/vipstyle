<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 17:03:20
         compiled from "themes/partner7/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3946647851753518667d76-59021820%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df22de2bf4135b5f5b128a873c9f62a374b7691f' => 
    array (
      0 => 'themes/partner7/header.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3946647851753518667d76-59021820',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_data' => 0,
    'menuUser' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_51753518731122_28153642',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51753518731122_28153642')) {function content_51753518731122_28153642($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?php echo $_smarty_tpl->tpl_vars['template_data']->value->title();?>
-<?php echo $_smarty_tpl->tpl_vars['template_data']->value->partner()->shop_name();?>
</title>
    <meta name="keywords" content="/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->seo()->keywords();?>
"/>
    <meta name="description" content="/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->seo()->description();?>
"/>
    <link rel="stylesheet" type="text/css" media="all" href="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
styles/style.css" />
    <link rel="stylesheet" type="text/css" media="all" href="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
styles/jquery.selectBox.css" />
    <link href="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
styles/fancybox.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
images/favicon.ico" />
    <script language="JavaScript" src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
scripts/script.js"></script>
    <script language="JavaScript" src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
scripts/tools.js"></script>  
    <script type="text/javascript" src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
scripts/jquery.fancybox.js"></script>
	
</head>
<!--[if lt IE 7 ]> <body class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <body class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <body class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <body> <!--<![endif]-->
	
    <!-- START of HEADER WRAPPER -->
	<div class="header-wrapper">
    		
            <div id="header" class="clearfix">
                    
                    <!-- LOGO -->
                    <div  style="float: left; width: 600px; height: 60px;overflow: hidden;">
                        <a href="/" class="logo"><?php echo $_smarty_tpl->tpl_vars['template_data']->value->partner()->shop_name();?>
 </a>
                        <div style="color: #fff; font: 14px/21px 'TelegraficoRegular',Arial, Helvetica, sans-serif; clear: both;">
                        <?php if ($_smarty_tpl->tpl_vars['template_data']->value->partner()->contact_phone()!=''){?>	Телефон: 
                            <span style="font: 16px; font-weight: bolder"> <?php echo $_smarty_tpl->tpl_vars['template_data']->value->partner()->contact_phone();?>
</span>
                         <?php }?>
                         </div>
                     </div>
                    <!-- SLOGAN LINE -->
                    
                    
                    
                    <!-- TOP NAV -->
                    <ul class="top-nav">
                    		<li><?php if ($_smarty_tpl->tpl_vars['template_data']->value->basket_info()->amount()!=0){?>
                                            Товаров: <span id="countOffers"><?php echo $_smarty_tpl->tpl_vars['template_data']->value->basket_info()->amount();?>
</span>, на сумму: <span id="cutMany"><?php echo $_smarty_tpl->tpl_vars['template_data']->value->basket_info()->price();?>
</span> &nbsp;руб.
                                            <br/><a href="/cut" class="top_zakaz">Оформить заказ</a>
                                        <?php }else{ ?>
                                            пустая
                                        <?php }?>
                                </li>
                            <li><a href="/cut" class="cart">&nbsp;</a><span id="countOffersbubble" class="cart-bubble"><?php echo $_smarty_tpl->tpl_vars['template_data']->value->basket_info()->amount();?>
</span></li>
                    </ul><!-- end of .top-nav -->
                    
            </div><!-- end of #header -->
            
    </div>
	<!-- END OF HEADER WRAPPER -->
    
    
    <!-- START of NAVIGATION WRAPPER -->
    <div class="navigation-wrapper" >
            
            <!-- MAIN NAVIGATION -->
		    <ul id="navigation" class="clearfix" >
                        <li><a href="/">Главная</a></li>
                        <li><a>Продукты</a>
                        <ul >
                            <li><a href="/catalog/showfut">Футболки</a></li>
                            <li><a href="/cat/hoodie">Толстовки</a></li>
                            <li><a href="/cat/76/model/caps">Кепки</a></li>
                            <li><a href="/cat/106/model/pants">Трусы</a></li>
                            <li><a href="/cat/88/model/krujka">Кружки</a></li>
                            <li><a href="/cat/104/model/sign">Значки</a></li>
                            <li><a href="/cat/90/model/pad">Коврики</a></li>
                        </ul>
                    </li>
			<?php  $_smarty_tpl->tpl_vars['menuUser'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menuUser']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['template_data']->value->menu(4); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menuUser']->key => $_smarty_tpl->tpl_vars['menuUser']->value){
$_smarty_tpl->tpl_vars['menuUser']->_loop = true;
?>
                                     <li><a href="<?php echo $_smarty_tpl->tpl_vars['menuUser']->value->url();?>
" <?php if ($_smarty_tpl->tpl_vars['menuUser']->value->is_target()){?> target="_blank" <?php }?>><?php echo $_smarty_tpl->tpl_vars['menuUser']->value->name();?>
</a></li>				         	
                        <?php } ?>  
		    </ul><!-- end of #navigation -->
            
  	</div>
    <!-- END of NAVIGATION WRAPPER -->
    
    
    <!-- START of BOTTOM -->
    <div class="bottom-wrapper">
    
		    <div id="bottom" class="clearfix">
                    
                    <div class="right">

                        <form class="search" name="filter" method="post" action="/search/">
                                <fieldset>
                                    <input name="find" type="text" id="s" value="поиск по названию" onClick="this.value='';">
                                    <input class="submit" type="submit" value=" " />
                                    <input type="hidden" name="act" value="search">
                                </fieldset>
                        </form><!-- end of .search -->
                    	
                    </div>
            
		    </div><!-- end of #bottom -->
            
    </div>
    <div style="padding-bottom: 150px;"><?php }} ?>