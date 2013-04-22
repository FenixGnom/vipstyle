<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>{$template_data->Title()}-{$template_data->PartnerName()}</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Content-Style-Type" content="text/css">
		<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<meta name="keywords" content="{$template_data->Keywords()}">
		<meta name="description" content="{$template_data->Description()}">
		<link href="{$template_data->PartnerTplPath()}/styles/style.css" rel="stylesheet" type="text/css">
		<link href="{$template_data->PartnerTplPath()}/styles/one.css" rel="stylesheet" type="text/css">
		{literal}
			<!--[if ie]>
				<link href="/themes/partner6/styles/forie.css" rel="stylesheet" type="text/css">
			<![endif]-->
		{/literal}
		<script language="JavaScript" src="{$template_data->PartnerTplPath()}/scripts/jquery.js"></script>
		<script language="JavaScript" src="{$template_data->PartnerTplPath()}/scripts/script.js"></script>
		<script language="JavaScript" src="{$template_data->PartnerTplPath()}/scripts/tools.js"></script>
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
   {include file='page_header.tpl'}
   <div class="content">
    <div class="leftContent left">
     <div class="leftMenuTitle">Наши футболки</div>
     <div class="menuLeftContentBlock">
		{include file='menu_cart.tpl'}
     </div>
     <div class="menuLeftContentBlockBottom"></div>
     <div class="leftBlockInfo">Контакты</div>
	{if $template_data->PartnerIcq()!= ""}
		<div class="infoParam"><span>ICQ:</span> {$template_data->PartnerIcq()}</div>
	{/if}
	{if $template_data->PartnerEmail() != ""}	
		<div class="infoParam"><span>email</span><br /><span><a href="mailto:{$template_data->PartnerEmail()}">{$template_data->PartnerEmail()}</a></span></div>
	{/if}
	 {if $template_data->PartnerPhone() != ""}	
		<div class="infoParam"><span>Телефон:</span> {$template_data->PartnerPhone()}</div>
     {/if}
     <div class="infoParam"><a href="/feedback">Обратная связь</a></div>
    </div>
    <div class="rightContent left">
    <!--content-->
		{$template_data->Content()}
    <!--endcontent-->
    </div>
    <div class="push"></div>
   </div>
	{include file='page_footer.tpl'}
  </div>
  
<!--Версия партнеского магазина {$template_data->Version()}-->
 </body>
</html>