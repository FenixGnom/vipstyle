</div>
    <div class="push"></div>
   </div>
<div class="footer center">
    <div class="fotterHref mainBack">
     <div class="lineBold  center" style="width:710px;"></div>
     <div class="hrefPosition center">
         {assign var=rows value=0}
	    {foreach from=$template_data->menu(4) item=menuUser}      		
					<a  href="{$menuUser->url()}"{if $menuUser->is_target()} target="_blank" {/if} >{$menuUser->name()}</a> 
                                        {if $rows!=count($template_data->menu(4))-1}
                                        |
                                        {/if}
                                        {$rows=$rows+1}	
	   	 {/foreach}	   
     </div>
	 <div class="counters"><!--your counters here--></div>
     <div class="fotterCopy">{$template_data->partner()->shop_name()} &copy; </div>
	 <div class="clear"></div>
    </div>
   </div>
 </div>
  
<!--Версия партнеского магазина {$template_data->enviroment()->version()}-->
 </body>
</html>