{include file='meta_head.tpl'}
{include file='header.tpl'}

<div id="mainleft">
	<div class="c_inner">
		<div class="c_inner_t">
			<div class="c_inner_b">
				<div class="pad_content_inner">
					<div id="breadcrumb">
						<a href="/">Главная</a> &gt;					
						<a >Обратная связь</a> 
					</div>
					<br />
					<h3>Обратная связь</h3>
                                        
					<div class="errorFeetback">              
						<div>{$template_data->name_error()}</div>
						<div>{$template_data->email_error()}</div>
						<div>{$template_data->message_error()}</div>
						<div>{$template_data->captcha_error()}</div>
					</div>
					{if $template_data->is_result()}
						<div class="resultFeetback">Сообщение успешно отправлено</div>
					{/if}
					<form method=post id="feebback" action="/feedback" style="margin-top:20px;">
						<table cellpadding="0" cellspacing="0"  width="90%">
							<tr >
								<td width="100px" style="text-align:right; padding-right:13px;">Ваше Имя:<span style="color:red">*</span></td>
								<td width=""><input type="text" name="name" value="{$template_data->name()}" style="width:80%;"></td>
							</tr>
							<tr >
								<td width="100px" style="text-align:right; padding-right:13px;">Ваш E-mail:<span style="color:red">*</span></td>

								<td width=""><input type="text" name="email" value="{$template_data->email()}" style="width:80%;"></td>
							</tr>
							<tr >
								<td width="100px" style="text-align:right; padding-right:13px;">Ваш Вопрос:<span style="color:red">*</span></td>
								<td width=""><textarea name="quest" cols="50" rows="10" style="width:80%;resize: none;">{$template_data->message()}</textarea></td>
							</tr>
							<tr >
								<td width="100px" style="text-align:right; padding-right:13px;" class="noborder"></td>
								<td><img src="{$template_data->captcha()}" alt="Введите код" title="Введите код" width="75" height="16" align="top" style="margin-top:3px;">&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="text" name="check_num" style="width:83px;color:#173452; font-size:12px; height:15px;" maxlength="11" value="введите код" onclick="this.value='';" >
								&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="submit" value="отправить" name="go_mail" style="border: 1px solid #173452; cursor:pointer; width:80px; font-weight:bold;text-align:center;"></td>
							</tr>
							<tr >
								
								<td class="noborder" colspan="2" style="padding-top:10px"><span style="color:red">*</span> Поля обязательные для заполнения</td>

							</tr>
						</table>
					</form>

					{literal}
					<script>
						var foc=0;
					</script>
					{/literal}	

					{if $template_data->name_error()}
							{literal}
								<script>
									jQuery('input[name="name"]').css('background','#f4c0bd');
									if(foc==0)
									{
											jQuery('input[name="name"]').focus();
											foc=1;
									}
								</script>
							{/literal}		
					{/if}
					{if $template_data->email_error()!=''}
							{literal}
								<script>
										jQuery('input[name="email"]').css('background','#f4c0bd');
										if(foc==0)
										{
												jQuery('input[name="email"]').focus();
												foc=1;
										}
								</script>
							{/literal}		
					{/if}
					{if $template_data->message_error()!=''}
							{literal}
								<script>
										jQuery('textarea[name="quest"]').css('background','#f4c0bd');
										if(foc==0)
										{
												jQuery('textarea[name="quest"]').focus();
												foc=1;
										}
								</script>
							{/literal}		
					{/if}
					{if $template_data->captcha_error()!=''}
							{literal}
								<script>
										jQuery('input[name="check_num"]').css('background','#f4c0bd');
								</script>
							{/literal}			
					{/if}

				{literal}
				<script>
						$(function(){
							jQuery('form#feebback input[type="text"]').each(function(){                
									$(this).click(function(){
											jQuery(this).css('background','#fff');

									});
								});
								$('textarea[name="quest"]').click(function(){
												jQuery('textarea[name="quest"]').css('background','#fff');
										});	
						});
				</script>
				{/literal}
						
						
						

						
				</div><!-- end pad_content_inner -->
			</div>
		</div>
	</div>	
	
</div>

{include file='category.tpl'}                      
{include file='footer.tpl'}