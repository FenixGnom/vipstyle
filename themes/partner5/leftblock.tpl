<div class="middle"><div class="ml2"><div class="ml3"><div class="ml4">
 <div class="ml5"><div class="ml6"><div class="ml7"><div class="ml8"><div class="ml9">
  <div class="leftNav">
   <div class="tit tit1">Наши футболки</div>
    <div class="menu">
		{include file='category.tpl'}
    </div>
   <div class="tit tit2">Информация</div>
    <div class="info">
	 {if $template_data->partner()->contact_icq() != ""}
		ICQ: {$template_data->partner()->contact_icq()}
	{/if}<br />
	{if $template_data->partner()->contact_email() !=""}	
		e-mail <br /><a href="mailto:{$template_data->partner()->contact_email()}">{$template_data->partner()->contact_email()}</a>
	{/if}<br />
	{if $template_data->partner()->contact_phone() !=""}	
		Телефон: {$template_data->partner()->contact_phone()}
	{/if}<br />
	 <a href="/feedback">Обратная связь</a>
     
    </div>
  </div>
<div class="content">