<table border="0" class="bodyMain center">
    <tr>
     <td class="bodyMainLeft" valign=top>
      <div class="leftF">
       <div class="fut"><span>Наши футболки</span></div>
      </div>
      <div class="menuLeft">
	    {include file='category.tpl'}
      </div>
      <div class="leftF">
       <div class="fut"><span>Информация</span></div>
      </div>
	   {if $template_data->partner()->contact_icq() != ""}
				<div class="infoLink">ICQ: <span>{$template_data->partner()->contact_icq()}</span></div>
	   {/if}
	   {if $template_data->partner()->contact_email() !=""}
				<div class="infoLink">email: <a href="mailto:{$template_data->partner()->contact_email()}">{$template_data->partner()->contact_email()}</a></div>
	   {/if}
	   {if $template_data->partner()->contact_phone() !=""}
				<div class="infoLink">Телефон: <span>{$template_data->partner()->contact_phone()}</span></div>
	   {/if}

	   <div class="infoLink"><a href="/feedback">Обратная связь</a></div>

     </td>
     <td class="bodyMainCenter" valign=top>
         