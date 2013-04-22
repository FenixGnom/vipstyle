<div class="content">
    <div class="leftContent left">
     <div class="leftMenuTitle">Наши футболки</div>
     <div class="menuLeftContentBlock">
		{include file='category.tpl'}
     </div>
     <div class="menuLeftContentBlockBottom"></div>
     <div class="leftBlockInfo">Контакты</div>
	{if $template_data->partner()->contact_icq() != ""}
		<div class="infoParam"><span>ICQ:</span> {$template_data->partner()->contact_icq()}</div>
	{/if}
	{if $template_data->partner()->contact_email() !=""}	
		<div class="infoParam"><span>email</span><br /><span><a href="mailto:{$template_data->partner()->contact_email()}">{$template_data->partner()->contact_email()}</a></span></div>
	{/if}
	 {if $template_data->partner()->contact_phone() !=""}	
		<div class="infoParam"><span>Телефон:</span> {$template_data->partner()->contact_phone()}</div>
     {/if}
     <div class="infoParam"><a href="/feedback">Обратная связь</a></div>
    </div>
    <div class="rightContent left">