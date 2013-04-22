<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>{$template_data->title()}-{$template_data->partner()->shop_name()}</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Content-Style-Type" content="text/css">
		<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<meta name="keywords" content="/{$template_data->seo()->keywords()}">
		<meta name="description" content="/{$template_data->seo()->description()}">
		<link href="/themes/{$template_data->enviroment()->theme_path()}styles/style.css" rel="stylesheet" type="text/css">
		<link href="/themes/{$template_data->enviroment()->theme_path()}styles/one.css" rel="stylesheet" type="text/css">
		{literal}
			<!--[if ie]>
				<link href="/themes/partner6/styles/forie.css" rel="stylesheet" type="text/css">
			<![endif]-->
		{/literal}
		<script language="JavaScript" src="/themes/{$template_data->enviroment()->theme_path()}scripts/jquery.js"></script>
		<script language="JavaScript" src="/themes/{$template_data->enviroment()->theme_path()}scripts/script.js"></script>
		<script language="JavaScript" src="/themes/{$template_data->enviroment()->theme_path()}scripts/tools.js"></script>
		{literal}
			<style>
			.menubar .elem {width:20%;}	
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
  <div class="main center">

<div class="header">
    <div class="headerLeft left">
     <div class="logoStyle">
      <a href="/">
       <span>{$template_data->partner()->shop_name()}</span> </a>
     </div>
    </div>
    <div class="headerRight right">
     <div class="searchBlock">
      <form name="filter" method=post action="/search/">
       <input name="find" type="text" value="поиск по названию" onClick="this.value='';"class="searchInputHeader left">
       <input type="submit" value="  " class="butonSearchHeader left">
       <input type="hidden" name="act" value="search">
       <div class="clear"></div>
      </form>
     </div>   
     <div class="cutHeader">
      <div id="bas-tt">
		{include file='cut.tpl'}
      </div>
     </div>
     <div class="clear"></div>
     
    </div>
      
      
    <div class="clear"></div>
   </div>
   <div class="menuTop">
       {assign var=rows value=0}
    {foreach from=$template_data->menu(4) item=menuUser}  
    
		<a  href="{$menuUser->url()}" {if $menuUser->is_target()} target="_blank" {/if}>{$menuUser->name()}</a>
                {if $rows!=count($template_data->menu(4))-1}
                |	   
                {/if}
                {$rows=$rows+1}	
	{/foreach}	
   </div>
