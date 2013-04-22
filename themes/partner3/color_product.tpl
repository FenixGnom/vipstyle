<div style="margin-top:5px;width:450px;margin-bottom:10px;margin-left:5px;">
	{assign value='' var=coloricon}
    
	{foreach from=$template_data->colors() item=Colors}
            {assign value='/themes/'|cat:$template_data->enviroment()->theme_path()|cat:'images/color/'|cat:$Colors->color_abriv()|cat:'.gif' var=coloricon}
           
                <div style="width:19px;float:left; height:19px;margin-left:5px;margin-top:3px;cursor:pointer;background: url('{$coloricon}');" {if count($template_data->colors())>1} onClick="{$Colors->link()};" {/if}>

                </div>
           
	{/foreach}

<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>