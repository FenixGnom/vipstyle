<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
 <head><title>{$template_data->title()}-{$template_data->partner()->shop_name()}</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">

<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<meta name="keywords" content="/{$template_data->seo()->keywords()}">
<meta name="description" content="/{$template_data->seo()->description()}">
  <link href="/themes/{$template_data->enviroment()->theme_path()}/styles/style.css" rel="stylesheet" type="text/css">
  <script language="JavaScript" src="/themes/{$template_data->enviroment()->theme_path()}/scripts/jquery.js"></script>
  <script language="JavaScript" src="/themes/{$template_data->enviroment()->theme_path()}/scripts/script.js"></script>
  <script language="JavaScript" src="/themes/{$template_data->enviroment()->theme_path()}/scripts/md5-min.js"></script>
  <script language="JavaScript" src="/themes/{$template_data->enviroment()->theme_path()}/scripts/tools.js"></script>
  <!--[if ie 7]>
	{literal}
	<STYLE>
		.textLogo{margin-left:-420px;}
	</STYLE>
	{/literal}
<![endif]-->
   
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
        <div class="headerLeft left">
         <div class="searchBlock center">
          <form name="filter" method="post" action="/search/">
           <input name="find" type="text" value="" class="left inputSearch" value="поиск по названию" onClick="this.value='';">
           <input type="submit" value="  " class="left buttonSearch">
           <input type="hidden" name="act" value="search">
          </form>
         </div>
        </div>
        <div class="headerCenter left"></div>
        <div class="headerRight left">
         <div id="bas-tt">
                    {include file='cut.tpl'}
         </div>
        </div>
        <div class="clear"></div>
       </div>
       <div class="headerLogo">
        <div class="textLogo">
        <span>{$template_data->partner()->shop_name()}</span>
        </div>
       </div>
       <div class="mainMenuTop center">
                    <div class="menu left" style="padding-left:10px;padding-right:10px;">
                            <a  href="/"  >Главная</a>
                    </div>
                    {assign var=rows value=0}
			{foreach from=$template_data->menu(4) item=menuUser}
                                    
                                    {if $rows!=count($template_data->menu(4))-1}
                                    
                                            <div class="menu left" style="padding-left:10px;padding-right:10px;">
                                    {else}
                                            <div class="menuLast left" style="padding-left:10px;padding-right:10px;">
                                    {/if}
                                    <a  href="{$menuUser->url()}" {if $menuUser->is_target()} target="_blank" {/if}>{$menuUser->name()}</a>
                                    </div>					
                                    {$rows=$rows+1}	
                    {/foreach}  

        <div class="clear"></div>
       </div>