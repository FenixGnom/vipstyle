<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">

<head><title>{$template_data->title()}-{$template_data->partner()->shop_name()}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	
	<meta name="keywords" content="/{$template_data->seo()->keywords()}">
	<meta name="description" content="/{$template_data->seo()->description()}">
<link href="/themes/{$template_data->enviroment()->theme_path()}styles/styles.css" rel="stylesheet" type="text/css">
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
<div class="wrapper">
    <div class="header">
      <div class="header_l2">
       <a href="/" class="logo">
        {$template_data->partner()->shop_name()}
        <div class="logo_left"></div>
        <div class="logo_right"></div>
       </a>
      </div>
     </div>
     <div class="menubar">
      <div class="r">
       <table cellspacing="0" class="c" width="716px">
        <tr>	
                    {assign var=rows value=0}
			{foreach from=$template_data->menu(4) item=menuUser}
                            {if $rows==0}
                                     <td class="elem e1">
                            {else}
                                    <td class="elem">
                            {/if}
                                    <a  href="{$menuUser->url()}" {if $menuUser->is_target()} target="_blank" {/if}>{$menuUser->name()}</a>
                            </td>
                            {assign var=rows value=rows+1}	
                    {/foreach}	
            </tr>
       </table>
      </div>
     </div>
     <div class="menubar2">
      <div class="elem">
       <form method="post" action="/search/" class="search" style="margin-top:-5px;">
                    <input name="find" class="field" onClick="this.value='';" style="float:left;"/>
                    <input type="hidden" name="act" value="search" />
                    <input type="submit" value="" class="submit" style="float:left;margin-top:2px;" />
                    <div style="clear:both;"></div>
       </form>
      </div>
      <div class="elem"></div>
      <div class="right">
       <div id="bas-tt">
        <span>Корзина:</span><br />
         {include file='cut.tpl'}
       </div>
      </div>
     </div>
