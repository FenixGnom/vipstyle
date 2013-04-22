{include file='header.tpl'}
{include file='leftblock.tpl'}

<div class="titleName"><span> {$template_data->title()}</span></div>
 <!--content start-->
<div class="plainText center" style="width:500px;">

                      {$template_data->content()}

</div>

{include file='rightblock.tpl'} 
{include file='footer.tpl'}