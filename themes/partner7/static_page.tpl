{include file='header.tpl'}

<div class="container">
            
            <!-- START of BREADCRUMBS -->
            <p id="breadcrumbs">
            	<a href="/">Главная</a>
                     <span class="active">
                         {if count($template_data->menu(5))>0}
                            {foreach from=$template_data->menu(5) item=breadcrumb}
                                {$breadcrumb->name()}
                            {/foreach}
                        {/if} 
                     </span>                  
            </p>
            <!-- END of BREADCRUMBS -->
            
            <!-- START of INNER-CONTAINER -->
            <div class="inner-container clearfix">
                <div id="all-product">
                            
                            <h3>
                                    <span>{$template_data->title()}</span>

                            </h3>
                    <div class="PlainText" style="width:700px; text-align: left;">{$template_data->content()}</div>
                </div>
                {include file='rightblock.tpl'}

            </div>
            <!-- END of INNER-CONTAINER -->   
    </div><!-- end of .container -->
{include file='footer.tpl'}