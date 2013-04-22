var idLoadersInOffersInfo='inThisLoaders5';
function isValidEmail (email, strict)
 {
	  if ( !strict ) email = email.replace(/^\s+|\s+$/g, '');
	  return (/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i).test(email);
 }

function post_orders(id,link,targetid)
           {
	           	/*var codeOut = document.getElementById('captcha').value;
	           	var codeIn = hex_md5(document.getElementById('check_num').value);*/
					//okVal();

					 error=0;
                     mails=$("#milo").val();
                     prot=isValidEmail(mails);
                       if(prot!=true)
                       {

                    	//$("#milo_in").css('color','red');
                        $("#milo").css('background','#f4c0bd');
                    	error=1;
                       }



                    if($("#indeks").val()=='')
                    {
                    	//$("#indeks_in").css('color','red');
                        $("#indeks").css('background','#f4c0bd');
                    	error=1;
                    }

                     if($("#obl").val()=='')
                    {
                    	//$("#obl_in").css('color','red');
                        $("#obl").css('background','#f4c0bd');
                    	error=1;
                    }

                     if($("#adres").val()=='')
                    {
                    	//$("#adres_in").css('color','red');
                        $("#adres").css('background','#f4c0bd');
                    	error=1;
                    }

                     if($("#city").val()=='')
                    {
                    	//$("#city_in").css('color','red');
                        $("#city").css('background','#f4c0bd');
                    	error=1;
                    }

                     if($("#name3").val()=='')
                    {
                    	//$("#name3_in").css('color','red');
                        $("#name3").css('background','#f4c0bd');
                    	error=1;
                    }

                     if($("#name1").val()=='')
                    {
                    	//$("#name1_in").css('color','red');
                        $("#name1").css('background','#f4c0bd');
                    	error=1;
                    }

                     if($("#name2").val()=='')
                    {
                    	//$("#name2_in").css('color','red');
                        $("#name2").css('background','#f4c0bd');
                    	error=1;
                    }

                     if($("#phone").val()=='')
                    {
                    	//$("#phone_in").css('color','red');
                        $("#phone").css('background','#f4c0bd');
                    	error=1;
                    }
				if(error==1)
                    return;
                else
					window.document.getElementById(id).submit();





           }





  function post(id,link,targetid)
           {
	           	$.post(
	           		link,
	           		$('#'+id).serialize(),
	           		function (html){
		           		$('#'+targetid).html(html);
		           	},
		           	'html');
           }

           function post_ord(id,link,targetid)
           {
	           	$.post(
	           		link,
	           		$('#'+id).serialize(),
	           		function (json){
		           		if(json.error=='')
							window.location.href="/cut";
						else
							alert(json.error);
		           	},
		           	'json');
		         
           }

             function get(link,targetid)
           {
	           	$.get(
	           		link,
	           		function (html){
		           		$('#'+targetid).html(html);

		           	},
		           	'html');
           }






            function getcolor(link,targetid,color,id)
           {
	           loadLoaderProd('/themes/partner5/images/loadinfoa.gif');
						jQuery.ajax({
						dataType: 'json',
						type: "GET",
						url: link+'/typeload/json/sex/'+$('select[name="model_change"]').val(),
						
						success: function(json){	
							var fotoShow="<a href=\"javascript:open_window('"+json['images']['show']['big']+"','',500,500);\"><img src=\""+json['images']['show']['inside']+"\" /></a>";				
							
							jQuery('#fotoShow').html(fotoShow);					
							var smallBlock="<img src=\""+json['images']['show']['inside']+"\" onclick=\"showInFoto(1);\"/>";
							
							if(json['double']==1)
							{
								if(json['images']['back'])
								{
									var fotoShowBack="<a href=\"javascript:open_window('"+json['images']['back']['big']+"','',500,500);\"><img src=\""+json['images']['back']['inside']+"\" /></a>";						
									smallBlock+="<img src=\""+json['images']['back']['inside']+"\" onclick=\"showInFoto(2);\"/>";					
									jQuery('#fotoShowBack').html(fotoShowBack);
									backFoto=1;						
									
								}
								else
								{
									jQuery('#fotoShowBack').html('');							
									backFoto=0;
								}
								
								
								jQuery('#iconImg').html(smallBlock);								
								
						
							}
							jQuery('#price').html(json.price);
							jQuery('#pricesis').val(json.price);
							jQuery('#name_id').val(id);								
							$('#colors').html(json.color_name);					
							$('#color').val(json['color_abriv']);
							if(json['sizes'])
							{
								var mns=json['sizes'].length;
								if(mns>0)
								{	
									$('select[name="sizes"]').html('');
									var sHt='';
									for(var t=0;t<mns;t++)
										sHt+='<option value="'+json['sizes'][t]+'">'+json['sizes'][t]+'</option>';
									$('select[name="sizes"]').html(sHt);	
								}
							}	
							loadLoaderProdDel();
						
						} 
						
						
						

							});
           }

             function getrukav(link,targetid,dlina,price,priceold)
             {
	           	loadLoaderProd('/themes/partner5/images/loadinfoa.gif');    	
				
					
					$.post(
						link+'/typeload/json',
						{t:1},
						function (json){
							$('#'+targetid).html(json['inColor']);
							
							
							var showFotoF='<a href="javascript:open_window(\''+json['fotoBigF']+'\',\'\',500,500)"><img alt="" src="'+json.fotoF+'" id="img"/></a>';
							jQuery('#img_load').html(showFotoF);
							loadLoaderProdDel();
							$('#name_id').val(json.id);							
							jQuery('input[name="pricesis"]').val(json.price);
							jQuery('#price').html(json.price);
							jQuery('#colors').html(json.colorName);
						},
						
					"json");
             }


              function change_size(val,type)
              {
                $('#sizes').html(val);
				if(type=='sign')
				{
					var pr=jQuery('#pricesis').val();
					switch(val)					
					{
						case '25mm':
							jQuery('#price').html(25);
							jQuery('#pricesis').val(25);
						break;
						case '37mm':
							jQuery('#price').html(27);
							jQuery('#pricesis').val(27);
						break;
						case '56mm':
							jQuery('#price').html(31);
							jQuery('#pricesis').val(31);
						break;
					}
				}

              }

              function change_size_zn(val,pr_old)
              {   var price;
                  $('#sizes').html(val);
                switch(val)
                {
                	case '25':
                    price=pr_old+0;
                	$('#price').html(price);
		           	$('#pricesis').val(price);
                	break;
                	case '37':
                	price=pr_old+2;
                	$('#price').html(price);
		            $('#pricesis').val(price);
                	break;
                	case '56':
                	price=pr_old+6;
                	$('#price').html(price);
		            $('#pricesis').val(price);
                	break;
                }
              }

              function add_close()
              {

              	 $('#windowCurt').html('');



              }

              function change_shot(val)
              {
                  $('#sizes').html(val);

              }
              function open_window(win, params, width, height)
              {
					if(width==0)
						width=500;
					width+=40;
					if(height==0)
						height=400;
					height+=40;
					if(height>600)
						height=600;
					var left = (screen.availWidth/2) - (width/2);
					var top = (screen.availHeight/2) - (height/2);
					if(params!='')
						win+=params
					info=window.open(win,'info','resizable=1, scrollbars=1, toolbar=0, status=0, width='+width+', height='+height+', left='+left+', top='+top);
					info.focus();
             }

           function mylo(login, sc)
           {
	         document.write(login + "@" + sc);
           }

         function namylo(login, sc, sub)
        {
	     eml = "mailto:" + login + "@" + sc;
	     if (sub != "") eml += "?subject=" + sub;
	     window.location.href = eml;
        }

 function get_query(link,id_load)
{
	loadLoaderProd('/themes/partner5/images/loadinfoa.gif');
     $.ajax({   type: "GET",
                url: link,
                dataType: "html",
                success: function(html){

                         document.getElementById(id_load).innerHTML = html;
					}


			});
}

function get_query_dels(link)
{

     $.ajax({   type: "GET",
                url: link,
                dataType: "html"



			});
}


function post_query(str,link,id_load)
{
     $.ajax({   type: "POST",
                url: link,
                data: str,
                dataType: "html",
                success: function(html){
						$("#"+id_load).html(html);

					}


			});
}

function post_query_order(str,link,id_load)
{
     $.ajax({   type: "POST",
                url: link,
                data: str,
                dataType: "json",
                success: function(json){
						if(json.error=='')
							window.location.href="/cut";
						else
							alert(json.error);

					}


			});
}

function change_country(val)
{
   switch(val)
   {
   	case 'RUSSIA':
   	    link="<a href='http://info.russianpost.ru/servlet/department' target='_blank'><br>список индексов России</a>";
   	break;
   	case 'UKRAINE':
   	     link="<a href='http://www.ukrposhta.com/www/upost.nsf/(documents)/938F720155657110C22573B4003F0F43' target='_blank'><br>список индексов Украины</a>";
   	break;
   	case 'BELARUS':
   	     link="<a href='http://zip.belpost.by/' target='_blank'><br>список индексов Белорусии</a>";
   	break;
   	case 'AZERBAIJAN':
   	     link="<a href='http://www.azerpost.rabita.az/htmlaz/indexler.html' target='_blank'><br>список индексов Азербайджана</a>";
   	break;
   	case 'GEORGIA':
   	     link="<a href='http://www.georgianpost.ge/index.php?lang=eng&page=10' target='_blank'><br>список индексов Грузии</a>";
   	break;
   	case 'LATVIA':
   	     link="<a href='http://www2.pasts.lv/en//uzzinas/nodalas/' target='_blank'><br>список индексов Латвии</a>";
   	break;
   	case 'LITHUANIA':
   	     link="<a href='http://www.post.lt/en/?id=184' target='_blank'><br>список индексов Литвы</a>";
   	break;
   	case 'KAZAKHSTAN':
   	     link="<a href='http://www.almaty.kz/page.php?lang=1&page_id=328' target='_blank'><br>список индексов Казахстана</a>";
   	break;
   	case 'ARMENIA':
   	     link="<a href='http://spyur.am/htmfix/armen_r.htm#index_O' target='_blank'><br>список индексов Армении</a>";
   	break;
   	case 'ESTONIA':
   	     link="<a href='http://www.infoweb.ee/et/index/Почтовые%20индексы/?CatMID=8' target='_blank'><br>список индексов Эстонии</a>";
   	break;
   	case 'UZBEKISTAN':
   	     link="<a href='http://www.pochta.uz/Indexs/indexs2.htm' target='_blank'><br>список индексов Узбекистана</a>";
   	break;
   	case 'MOLDOVA':
   	     link="<a href='http://www.posta.md/ro/postal_code.html' target='_blank'><br>список индексов Молдавии</a>";
   	break;
    default:
        link="";
    break;
   }

   //$('#index_links').html(link);
}
function loadLoaderProd(imgLoaderPath)
{
	$('#'+idLoadersInOffersInfo).css('position','relative');
	var hh=window.document.getElementById(idLoadersInOffersInfo).offsetHeight;
	var ww=window.document.getElementById(idLoadersInOffersInfo).offsetWidth;
	ww=ww-2;
	hh=hh-2;
	var html='<div id="inAjaxLoaders" style="position:absolute;top:1px;left:1px;width:'+ww+'px;height:'+hh+'px;background: url(\''+imgLoaderPath+'\') center no-repeat #FFF;"></div>';
	$('#'+idLoadersInOffersInfo).append(html);
	
}
function loadLoaderProdDel()
{
	$('#inAjaxLoaders').remove();
}
function showInFoto(types)
 {
	if(backFoto==1)
	{
		if(types==2)
		{
			jQuery('#fotoShowBack').css('display','block');
			jQuery('#fotoShow').css('display','none');
			
		}		
		else
		{
			jQuery('#fotoShowBack').css('display','none');
			jQuery('#fotoShow').css('display','block');
			
		}
	}
 }
function del_cut(val)
 {
     var idObject=val.rel;
    
     if (confirm("Удалить товар? ")) {
            window.location.href=idObject;
        } 

     
 }
 function del_cut_all()
 {
     if (confirm("Удалить все товары из корзины? ")) {
            window.location.href="/cut/delall";
        }  
 }