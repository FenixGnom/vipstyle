var idLoadersInOffersInfo='product';
var fancyFontColor='fff';
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
	           	
				loadLoaderProd('/themes/partner7/images/loader.gif');
						jQuery.ajax({
						dataType: 'json',
						type: "GET",
						url: link+'/typeload/json/sex/'+$('select[name="model_change"]').val(),
						
						success: function(json){	
							var fotoShow="<a href=\"javascript:open_window('"+json['images']['show']['big']+"','',500,500);\"><img src=\""+json['images']['show']['inside']+"\" /></a>";				
							
							jQuery('#fotoShow').html(fotoShow);					
							var smallBlock="<li><img src=\""+json['images']['show']['inside']+"\" onclick=\"showInFoto(1);\"/></li>";
							
							if(json['double']==1)
							{
								if(json['images']['back'])
								{
									var fotoShowBack="<a href=\"javascript:open_window('"+json['images']['back']['big']+"','',500,500);\"><img src=\""+json['images']['back']['inside']+"\" /></a>";						
									smallBlock+="<li style=\"margin-right:0px;\"><img src=\""+json['images']['back']['inside']+"\" onclick=\"showInFoto(2);\"/></li>";
									smallBlock+='<div class="clr"></div>';	
									jQuery('#fotoShowBack').html(fotoShowBack);
									backFoto=1;						
									
								}
								else
								{
									jQuery('#fotoShowBack').html('');							
									backFoto=0;
								}
								
								
								
						
							} 
							jQuery('#price').html(json.price);
							jQuery('#priceTop').html(json.price);
							jQuery('#pricesis').val(json.price);
							
							$('#colors').html(json.color_name);												
							$('#color').val(json['color_abriv']);
							jQuery('#iconImg').html(smallBlock);	
							
												
							
                                                        
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
                                                                $("#hand").selectBox('destroy');
                                                                $("#size").selectBox('destroy');
                                                                $("#model").selectBox('destroy');
                                                                $('#hand').selectBox();
                                                                $('#size').selectBox();
                                                                $('#model').selectBox();
                                                                
							}
							loadLoaderProdDel();
                                                        var s=0;
                                                          $('ul.selectBox-dropdown-menu').each(function(){
                                                            s++;
                                                          });
                                                         setInterval(selectWidth,100,s);
						} 
						
						
						

							});
                 
           }

             function getrukav(link,targetid,dlina,price,priceold)
             {
				loadLoaderProd('/themes/partner7/images/loader.gif');				
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
							jQuery('#priceTop').html(25);
						break;
						case '37mm':
							jQuery('#price').html(27);
							jQuery('#pricesis').val(27);
							jQuery('#priceTop').html(27);
						break;
						case '56mm':
							jQuery('#price').html(31);
							jQuery('#pricesis').val(31);
							jQuery('#priceTop').html(31);
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
					if(!width) width = '500';
                    if(!height) height = '500';
                    $.fancybox('<img src="'+win+'" width="'+width+'" height="'+height+'" class="prodImg">',{
                            'transitionIn'		:	'elastic',
                            'speedOut'			:	200, 
                            'overlayColor'		:	'#'+fancyFontColor,
                            'hideOnContentClick':	true
                    });
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
	loadLoaderProd('/themes/partner7/images/loader.gif');
     $.ajax({   type: "GET",
                url: link,
                dataType: "html",
                success: function(html){

                         document.getElementById(id_load).innerHTML = html;
                         $("#hand").selectBox('destroy');
                         $("#size").selectBox('destroy');
                         $("#model").selectBox('destroy');
                         $('#hand').selectBox();
                        $('#size').selectBox();
                        $('#model').selectBox();
                        var s=0;
                          $('ul.selectBox-dropdown-menu').each(function(){
                            s++;
                          });
                         setInterval(selectWidth,100,s);
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
	if(!imgLoaderPath)
            imgLoaderPath='/themes/partner7/images/loader.gif';
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

function isInt(val)
{

 if(val/1==val)
  return 1;
 else
  return 0;
}

function getPrice(valCount)
{
    $('#amountprice').html('');
    if(valCount!='')
    {
        if(valCount>0)
        {
            if(isInt(valCount)==1)
            {
                if(valCount<100)
                {
                    var Count=parseInt(valCount);
                    var Price=parseInt(jQuery('input[name="pricesis"]').val());
                    var newPrice=Count*Price;
                    $('#amountprice').html(' &times;  '+Price+' руб.');
                    jQuery('#priceTop').text(newPrice);
                }
            }
        }
        else
        {
            var newPrice=jQuery('input[name="pricesis"]').val();
            jQuery('#priceTop').text(newPrice);
            jQuery('#num').val(1);
        }
    }
    else
    {
        var newPrice=jQuery('input[name="pricesis"]').val();
        jQuery('#priceTop').text(newPrice);
    }

}
var actionCut=0;
function cutCount(obj)
{   
    if(obj!='')
    {        
        var key=obj.id;
        var count=obj.value;
        var oldkol=jQuery('#'+key+'_count').val();
        if(actionCut==0)
        {
            if(count.length > 3)
            {
                    $('#'+key).val(oldkol);                   
                    return;
            }
            for(var e=0;e<count.length;e++)
            {
                if (count[e]=='.')
                {
                    $('#'+key).val(oldkol);
                    return;
                }
            }	

            if(count.indexOf('.')>0)
            {
                    $('#'+key).val(oldkol);
                    return;
            }

            if(count.indexOf('x')>0)
            {
                    $('#'+key).val(oldkol);
                    return;
            }

            if(count.indexOf(' ')>0)
            {
                    $('#'+key).val(oldkol);
                    return;
            }
            if(count<=0)
             {$('#'+key).val(oldkol);   return;}
            if(count>99)
             {$('#'+key).val(oldkol);  return;}
            
            if(isInt(count))
            {
                if(count==oldkol)
                    return;
                
                actionCut=1;
                $.post('/cut/cutren',{key:key,count:count},function(json){
                    
                    if(json.act==1)
                    {
                        jQuery('#priceAll').html(json.many);
                        jQuery('#fer_'+key).html(json.newsum_key);
                        
                        jQuery('#countOffers').html(json.count);
                        jQuery('#countOffersbubble').html(json.count);
                        jQuery('#cutMany').html(json.many);
                        jQuery('#'+key+'_count').val(count);
                        
                        actionCut=0;
                    }
                    else
                    {
                        if(json.error)
                            alert(json.error);
                    }
                },"json");
                
            }
            else
            {
                alert('Количество - число большее 0 и меньше 100');
                $('#'+key).val(oldkol);
                return;
            }    
        } 
    }
        
   
    
}