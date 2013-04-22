<div id="header">
			<div id="topmenu">
				<div id="menu">
					<ul>
						<li id="home"><a href="/">Главная</a></li>
						
						{foreach from=$template_data->menu(4) item=menuUser}					
							<li><a href="{$menuUser->url()}" {if $menuUser->is_target()} target="_blank" {/if}>{$menuUser->name()}</a></li>						
						{/foreach}	
					</ul>
				</div><!-- end menu -->
				<div id="cart">
					{include file='cut.tpl'}									
				</div>
				
			</div><!-- end topmenu -->
			<div id="top">
				<div id="logo">
				  <a href="/" class="partnerName">{$template_data->partner()->shop_name()}</a>
                                  {if $template_data->partner()->contact_phone()!=''}
                                    <div class="partnerPhone">
                                        {$template_data->partner()->contact_phone()}
                                    </div>
                                {/if} 
				</div>
                                   
                                <!-- end logo -->
				<div id="topsearch">
				<form action="/search" method="post">
				<input type="hidden" name="act" value="search">
				<fieldset>
					<span class="bg_input"><input type="text" name="find" class="inputbox" value="ищете что-то?"  onblur="if(this.value=='') this.value='ищете что-то?';" onfocus="if(this.value=='ищете что-то?') this.value='';" /></span><input type="image" src="/themes/{$template_data->enviroment()->theme_path()}images/but_search.gif" class="but" />
				</fieldset>
				</form>
				</div>
			</div><!-- end top -->
</div>
<div class="clr"></div>

<!-- BEGIN CONTENT -->
		<div id="content">
			<div id="c_top">
				<div id="c_bottom">
				
				<!-- begin slider -->
					{include file='slider.tpl'}
				<!-- end slider -->
				
				<br style="clear:both;"  />
				<div id="maincontent">
					<div id="main">