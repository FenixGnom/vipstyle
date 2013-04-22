<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="robots" content="index, follow" />
  <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <meta name="keywords" content="/{$template_data->seo()->keywords()}">
  <meta name="description" content="/{$template_data->seo()->description()}">
  <meta name="title" content="{$template_data->title()}-{$template_data->partner()->shop_name()}" />
  
<title>{$template_data->title()}-{$template_data->partner()->shop_name()}</title>
<!-- //      Start Stylesheets       // -->
<link href="/themes/{$template_data->enviroment()->theme_path()}styles/style.css" rel="stylesheet" type="text/css" />
<link href="/themes/{$template_data->enviroment()->theme_path()}styles/inner.css" rel="stylesheet" type="text/css" />
<link href="/themes/{$template_data->enviroment()->theme_path()}styles/fancybox.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
    <script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}scripts/unitpngfix.js"></script>
	<link href="/themes/{$template_data->enviroment()->theme_path()}styles/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->


<!-- //      Javascript Files        // -->

<script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}scripts/jquery.js"></script>
<script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}scripts/slider.js"></script>
<script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}scripts/jquery.scrollable.js"></script>
<script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}scripts/script.js"></script>
<script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}scripts/jquery.mousewheel.js"></script>
<script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}scripts/tools.js"></script>
<script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}scripts/jquery.fancybox.js"></script>

{literal}
<script type="text/javascript" >
	$(function() {
		$("#scrollable").scrollable({horizontal:true,size: 4});
                TopPositionStart('{/literal}{$smarty.session.modelIn}{literal}');    
	});
            
</script>
{/literal}


</head>
<body>
	<div id="container">
		<div id="centercolumn">