{include file='header.tpl'}
{include file='leftblock.tpl'}

<div class="title" style="position:relative;"><span>Адрес доставки</span>
<span style="position:absolute;top:10px;right:3px;">Шаг 2 из 5</span>
</div>
{literal}
<style>
	input.bitButton{
		background:#000;
		color:#fff;
		font-size:11px;
		padding:2px 3px 2px 3px;
		margin-top:5px;
		cursor:pointer;
		border:1px solid #000;
	}
	textarea{resize: none;}
</style>
{/literal}
<form id="zakaz" method="post"  action="/cut/show_step2">		
		<table border="0" cellpadding="3" cellspacing="1" style="margin-top:20px;" width="520px" class="zakaz center">
			<tr class="trow2">
				<td><b>Страна</b> (Россия) <span style="color:red">*</span></td>
				<td>
					<select name="country" id="country" onChange="change_country(this.value);">
						<option VALUE="ABKHAZIA"  >Абхазия</option>
						<option VALUE="AZERBAIJAN"  >Азербайджан</option>
						<option VALUE="ARMENIA"  >Армения</option>
						<option VALUE="BELARUS"  >Белоруссия</option>
						<option VALUE="GEORGIA"  >Грузия</option>
						<option VALUE="ISRAEL"  >Израиль</option>
						<option VALUE="KAZAKHSTAN"  >Казахстан</option>

						<option VALUE="KYRGYZSTAN"  >Киргизия</option>
						<option VALUE="LATVIA"  >Латвия</option>
						<option VALUE="LITHUANIA"  >Литва</option>
						<option VALUE="MOLDOVA"  >Молдавия</option>
						<option VALUE="RUSSIA" selected >Россия</option>
						<option VALUE="USA"  >США</option>
						<option VALUE="TAJIKISTAN"  >Таджикистан</option>

						<option VALUE="TURKMENISTAN"  >Туркмения</option>
						<option VALUE="UZBEKISTAN"  >Узбекистан</option>
						<option VALUE="UKRAINE"  >Украина</option>
						<option VALUE="ESTONIA"  >Эстония</option>
						<option VALUE="SOUTH_OSETIA"  >Южная Осетия</option>
						<option VALUE="OTHER"  >Другая</option>

					</select>
				</td>
			</tr>
			<tr class="trow1">
				<td  >
					<b>Почтовый индекс</b> (125284) <span style="color:red">*</span>
					<span id="index_links" ><a href='http://info.russianpost.ru/servlet/department' target='_blank'><br>список индексов России</a></span>
					<div id="row-index">пустое поле</div>
					</td>
					<td><input type="text" maxlength="80"  style="width:200px;" name="indeks" id="indeks" VALUE="{$template_data->index()}">
				</td>
			</tr>
			<tr class="trow2">
				<td><b>Область проживания</b> (Омская обл) <span style="color:red">*</span><div id="row-obl">пустое поле</div></td>
				<td><input type="text" maxlength="80"  style="width:200px;" name="obl" id="obl" VALUE="{$template_data->region()}" ></td>
			</tr>
			<tr class="trow2">
				<td><b>Город проживания</b>  <span style="color:red">*</span><div id="row-city">пустое поле</div></td>

				<td><input type="text" maxlength="80"  style="width:200px;" name="city" id="city" VALUE="{$template_data->city()}" ></td>
			</tr>
			<tr class="trow1">
				<td><b>Адрес проживания</b> (ул. Ленина, д.48, кв.19) <span style="color:red">*</span><div id="row-adres">пустое поле</div></td>
				
				<td><textarea rows="3" cols="17"  style="width:200px;" name="adres" id="adres" >{$template_data->address()}</textarea></td>
			</tr>



			<tr class="trow2">
				<td><b>Фамилия получателя</b> (Иванов) <span style="color:red">*</span><div id="row-f">пустое поле</div></td>
				<td><input type="text" maxlength="80"  style="width:200px;" name="name3" id="name3" VALUE="{$template_data->lastname()}"></td>
			</tr>
			<tr class="trow1">
				<td><b>Имя получателя</b> (Иван)  <span style="color:red">*</span><div id="row-n">пустое поле</div></td>

				<td><input type="text" maxlength="80"  style="width:200px;" name="name1" id="name1" VALUE="{$template_data->name()}"></td>
			</tr>
			<tr class="trow2">
				<td><b>Отчество получателя</b> (Иванович) <span style="color:red">*</span><div id="row-o">пустое поле</div></td>
				<td><input type="text" maxlength="80"  style="width:200px;" name="name2" id="name2" VALUE="{$template_data->patronymic()}"></td>
			</tr>
			<tr class="trow1">

				<td><b>Телефон (желательно сотовый)</b> (+7-905-256-XX-XX)<span style="color:red">*</span><div id="row-phon">пустое поле</div><br>
					<div style="color:red;font-size:11px;"> Внимание! Мы свяжемся с Вами по телефону для подтверждения заказа. </div></td>
				<td><input type="text" maxlength="80"  style="width:200px;" id="phone" name="phone" VALUE="{$template_data->phone()}"></td>
			</tr>
			<tr class="trow2">
				<td><b>Email получателя</b> (email@email.ru)  <span style="color:red">*</span><div id="row-milo">поле пустое или имеет не правильный формат</div></td>

				<td><input type="text" maxlength="80"  style="width:200px;" name="email" id="milo" VALUE="{$template_data->email()}"></td>
			</tr>
			<tr class="trow1">
				<td><b>Комментарий</b></td>
				<td><textarea rows="4" cols="17"  style="width:200px;" name="text" maxlength="150" >{$template_data->comments()}</textarea></td>
			</tr>
			<tr class="trow2">
				<td colspan=2><input type="checkbox" name="subs" value="Y" checked> Подписаться на новости сайта</td>

			</tr>
			
			<tr class="trow1"><td colspan="2">
					<input type="button" class="bitButton" style="float:left;margin-left:5px;" onClick="location.href='/cut'" value="Назад">
					<input type="button" class="bitButton" style="float:right;margin-right:5px;" onClick="post_orders('zakaz','','');" value="Продолжить"><br><div align=center style="clear:both;"><span style="color:red">*</span> - поля обязательные для заполнения</div></td></tr>
		</table>
	</form>
{literal}	
	<script>
    $(function(){

            jQuery('form#zakaz input[type="text"]').each(function(){                
                $(this).click(function(){
                    jQuery(this).css('background','#fff');
                });
            });
			$('#adres').click(function(){
                    jQuery('#adres').css('background','#fff');
                });

    });  
</script>
{/literal}

 {include file='footer.tpl'}