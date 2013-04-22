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
	<link href="/themes/partner2/styles/menuie.css" rel="stylesheet" type="text/css">
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
	<div class="main">
            <div class="header center">
			<div class="header-left left">
				<div class="header-leftText">
					{$template_data->partner()->shop_name()}
				</div>
			</div>
			<div class="header-right left">
				<div class="headerCart">
					<div id="bas-tt">
						{include file='cut.tpl'}
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="menuTop center">
			<div class="menuBlock">
			{assign var=rows value=0}
			{foreach from=$template_data->menu(4) item=menuUser}
					{if $rows==0}
						<div class="menuButtonsLR marginOneMenu left menuRating">
					{else}
						{if $rows!=count($template_data->menu(4))-1}
							<div class="menuButtonsLR marginFinishMenu left menuRating">
						{else}
							<div class="menuButtonsLR left menuRating">
						{/if}
					{/if}
					<a  href="{$menuUser->url()}" {if $menuUser->is_target()} target="_blank" {/if}><div class="menuButtons">{$menuUser->name()}</div></a>
					</div>					
					{assign var=rows value=rows+1}	
			{/foreach}	    
			<div class="clear"></div>
			</div>
			
            <div class="searchBlock right">
            	 <form name="filter" method=post action="/search/">
                  <input name="find" type="text" class="inputSearch left" value="поиск по названию" onClick="this.value='';">
                  <input type="submit" value="Поиск" class="searchButton left">
                  <input type="hidden" name="act" value="search">
              	</form>
                  <div class="clear"></div>
            </div>
	</div>
		<div class="contents center">

           <div class="contentsTop"><!-- --></div>
           <div class="mainContent">