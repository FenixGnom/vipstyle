<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{$template_data->title()}-{$template_data->partner()->shop_name()}</title>
    <meta name="keywords" content="/{$template_data->seo()->keywords()}"/>
    <meta name="description" content="/{$template_data->seo()->description()}"/>
    <link rel="stylesheet" type="text/css" media="all" href="/themes/{$template_data->enviroment()->theme_path()}styles/style.css" />
    <link rel="stylesheet" type="text/css" media="all" href="/themes/{$template_data->enviroment()->theme_path()}styles/jquery.selectBox.css" />
    <link href="/themes/{$template_data->enviroment()->theme_path()}styles/fancybox.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="/themes/{$template_data->enviroment()->theme_path()}images/favicon.ico" />
    <script language="JavaScript" src="/themes/{$template_data->enviroment()->theme_path()}scripts/script.js"></script>
    <script language="JavaScript" src="/themes/{$template_data->enviroment()->theme_path()}scripts/tools.js"></script>  
    <script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}scripts/jquery.fancybox.js"></script>
	
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
                        <a href="/" class="logo">{$template_data->partner()->shop_name()} </a>
                        <div style="color: #fff; font: 14px/21px 'TelegraficoRegular',Arial, Helvetica, sans-serif; clear: both;">
                        {if $template_data->partner()->contact_phone() !=""}	Телефон: 
                            <span style="font: 16px; font-weight: bolder"> {$template_data->partner()->contact_phone()}</span>
                         {/if}
                         </div>
                     </div>
                    <!-- SLOGAN LINE -->
                    
                    
                    
                    <!-- TOP NAV -->
                    <ul class="top-nav">
                    		<li>{if $template_data->basket_info()->amount()!=0}
                                            Товаров: <span id="countOffers">{$template_data->basket_info()->amount()}</span>, на сумму: <span id="cutMany">{$template_data->basket_info()->price()}</span> &nbsp;руб.
                                            <br/><a href="/cut" class="top_zakaz">Оформить заказ</a>
                                        {else}
                                            пустая
                                        {/if}
                                </li>
                            <li><a href="/cut" class="cart">&nbsp;</a><span id="countOffersbubble" class="cart-bubble">{$template_data->basket_info()->amount()}</span></li>
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
			{foreach from=$template_data->menu(4) item=menuUser}
                                     <li><a href="{$menuUser->url()}" {if $menuUser->is_target()} target="_blank" {/if}>{$menuUser->name()}</a></li>				         	
                        {/foreach}  
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
    <div style="padding-bottom: 150px;">