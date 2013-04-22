<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head><title>{$template_data->title()}-{$template_data->partner()->shop_name()}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />

<meta name="keywords" content="/{$template_data->seo()->keywords()}">
<meta name="description" content="/{$template_data->seo()->description()}">
<link href="/themes/{$template_data->enviroment()->theme_path()}styles/style.css" rel="stylesheet" type="text/css">
<link href="/themes/{$template_data->enviroment()->theme_path()}styles/menu.css" rel="stylesheet" type="text/css">

<!--[if ie]>
	<link href="/themes/partner3/styles/menuie.css" rel="stylesheet" type="text/css">
<![endif]-->
<script language="JavaScript" src="/themes/{$template_data->enviroment()->theme_path()}scripts/jquery.js"></script>
<script language="JavaScript" src="/themes/{$template_data->enviroment()->theme_path()}scripts/script.js"></script>
<script language="JavaScript" src="/themes/{$template_data->enviroment()->theme_path()}scripts/tools.js"></script>
{literal}
<style>
#tooltip{
	background:#FFFFFF;
	border:1px solid #666666;
	color:#333333;
	font:menu;
	margin:0px;
	padding:3px 5px;
	position:absolute;
	visibility:hidden;
	margin-left:5px;
	}
</style>
{/literal}
</head>
<body>	
    <div class="major">
        <div class="main">
    
            <div class="header">
                    <div class="header-content">
                            <div class="header-contentTop center">
                                    <div class="topMenu right">
                                            <a class="left" href="/">Главная</a>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="line_normal center"></div>
                            </div>
                            <div class="header-contentBottom center">
                                    <div class="header-contentBottomNameOfMagazin left">
                                            <div class="NameM">{$template_data->partner()->shop_name()}</div>
                                    </div>
                                    <div class="CatIndex left">
                                            <div id="bas-tt" style="position:relative;">
                                                    {include file='cut.tpl'}
                                            </div>
                                    </div>
                                    <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                    </div>
            </div>
            <div class="menu center mainBack">
                    <div class="menuContent center">

                            <a class="left menuSaite" href="/docs/dost_oplata.html"><img src="/themes/partner3/images/delivery_menu.gif" /></a>
                            <a class="left menuSaite" href="/docs/size.html"><img src="/themes/partner3/images/size_menu.gif" /></a>
                            <a class="left menuSaite" href="/docs/tovar_q.html"><img src="/themes/partner3/images/quality_menu.gif" /></a>
                            <a class="left menuSaite" href="http://www.maykoplat.ru/#status" target="_blank"><img src="/themes/partner3/images/status_menu.gif" /></a>
                            <a class="left" href="http://www.maykoplat.ru/#pay" target="_blank"><img src="/themes/partner3/images/rent_orders_menu.gif" /></a>
                            <div class="clear"></div>
                    </div>
                    <div class="line_bold center"></div>
            </div>
            <div class="content center  mainBack">
		<div class="mainContent center">