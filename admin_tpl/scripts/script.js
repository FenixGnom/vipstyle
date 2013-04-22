//----------- Left navigation -------------
var actAupB='';
function aj(url,id,post,strtodo){
	if(post==undefined) post='get';
	$.ajax({
		type: (post=='get' ? 'get' : 'POST'),
		url: url,
		dataType: 'html',
		data: (function(){
			if(post=='get') return '';
			else return $('#'+post).serialize();
		})(),
		success: function(html){
			if(id==""){}
			else if(id=="eval") eval(html.toString());
			else $("#"+id).html(html);
			if(strtodo!=undefined)eval(strtodo);
		}
	});
}

function liEdit(elem,id,cssc){
	//if($("#editus-"+elem+"-"+id).length == 0) {
		
		$.get('/admin/catalogEdit/elem/'+elem+'/id/'+id+'/class/'+cssc,function(html){
			if(actAupB!="")
				$("#"+actAupB).html('');
			$("#editus-"+elem+"-"+id).html('<td colspan="2">'+html+'</td><td></td>');
			actAupB="editus-"+elem+"-"+id;
		});
		
	//}else $('.elemEdit').remove();
}

function srch_res(object,id,action){
		var todo = "$('.elemEdit').remove();\
		$('#foundEdit').html(html);";
		aj('/admin/catalogEdit/elem/'+object+'/id/'+id+'/act/'+action,'','get',todo);
}
function get_ord(link,id_load) {
	$("#ok").css('visibility','hidden');
	jQuery.ajax({
            type: "GET",
            url: link,
            beforeSend: function() {
				jQuery("#loading").css('display','block');
				
            },
            complete: function(){
                    jQuery("#loading").css('display','none');
		},
            success: function(html){			
				
                jQuery("#loading").css('display','none');
				
				jQuery("#"+id_load).html(html);
               
               
            }

      });
	
}
function get_close() {
	$('#showons').html(' ');
}
function get_con() {
	$('#ok').css('width','100%');
	$('#ok').css('height','100%');
	$('#ok').css('position','fixed');
	$('#ok').css('top','0px');
	$('#ok').css('visibility','visible');
}
function post(id,link,targetid) {
	$.post(
		link,
		$('#'+id).serialize(),
		function (html){
			if (targetid=='eval') eval(html);
			else $('#'+targetid).html(html);
		},
		'html');
}
function get(link,targetid) {
	$.get(
		link,
		function (html){
			if (targetid=='eval') eval(html);
			else $('#'+targetid).html(html);
		},
		'html');
}
function close_pop() {
	$('#ok').css('visibility','hidden');
}
function pagings(link) {
	$.get(
		link,
		function (html){
			$('#contents').html(html);
		},
		'html');
}
function more(obj,id) {
	$('#link_'+id).html('<a href="javascript:lowmore(\''+obj+'\','+id+');">Скрыть</a>');
	$.get(
		'/admin/infoshow/obj/'+obj+'/id/'+id,
		function (html){
			$('#descInfo_'+id).html(html);
		},
		'html');
}
function lowmore(obj,id) {
	$('#link_'+id).html('<a href="javascript:more(\''+obj+'\','+id+');">Смотреть</a>');
	$('#descInfo_'+id).html('');
}
function delDescription(objects,id) {
    if(!id)
	id=$('#id').val();
	if(!objects)
	objects=$('#objects').val();
	$.get(
		'/admin/del/obj/'+objects+'/id/'+id,
		function (html){
			window.location.href="/admin/description"+objects;
		},
		'html');
}
function upDescription(objects,id) {
	
	$.get(
		'/admin/updshow/obj/'+objects+'/id/'+id,
		function (html){
			if(actAupB!='')
				$('#'+actAupB).html('');
			
			$('#descInfo_'+id).html(html);
			actAupB='descInfo_'+id;
		},
		'html');
}
function addUpDesc(obj) {
	var error=0; 
	
	
	if(obj=='subcat')
	{
		if($('#subcat').val()==0)
		{
			alert('Выберите категорию');
			return;
		}
		if($('#cat').val()==0)
		{
			alert('Выберите подкатегорию');
			return;
		}
		if($('textarea[name="desc"]').val()=='')
		{
			alert('Добавьте описание');
			return;
		}
		$.post('/admin/issetdesc'+obj,$('#updates').serialize(),function (json){
			if(json.act==0)				
				alert('Описание для данной подкатегории уже существует');
			else
			{
				$.post(
				'/admin/description'+obj,
				$('#updates').serialize(),
				function (html){
					window.location.href="/admin/descriptionsubcat";
				},
				'html');
			}	
				
			
		},
		'json');
			
	}
	if(obj=='cat')
	{
		if($('#cat').val()==0)
		{
			alert('Выберите категорию');
			return;
		}
		if($('textarea[name="desc"]').val()=='')
		{
			alert('Добавьте описание');
			return;
		}
		$.post('/admin/issetdesc'+obj,$('#updates').serialize(),function (json){
			if(json.act==0)				
				alert('Описание для данной категории уже существует');
			else
			{
				$.post(
				'/admin/description'+obj,
				$('#updates').serialize(),
				function (html){
					window.location.href="/admin/descriptioncat";
				},
				'html');
			}	
				
			
		},
		'json');
	}
	if(obj=='offers')
	{
		if($('#cat').val()==0)
		{
			alert('Выберите товар');
			return;
		}
		if($('#subcat').val()==0)
		{
			alert('Выберите категорию');
			return;
		}
		if($('#products').val()==0)
		{
			alert('Выберите подкатегорию');
			return;
		}
		if($('textarea[name="desc"]').val()=='')
		{
			alert('Добавьте описание');
			return;
		}
		$.post('/admin/issetdesc'+obj,$('#updates').serialize(),function (json){
			if(json.act==0)				
				alert('Описание для этого товара уже существует');
			else
			{
				$.post(
				'/admin/description'+obj,
				$('#updates').serialize(),
				function (html){
					window.location.href="/admin/descriptionoffers";
				},
				'html');
			}	
				
			
		},
		'json');
	}
	
}
function UpdateDesc(obj) {
	$.post(
		'/admin/description'+obj,
		$('#updates').serialize(),
		function (json){
			if(json.act==1)
				window.location.href='/admin/description'+obj;
		},
		'json');
}
function addDesc(obj) {
	$.get(
		'/admin/adddesc/obj/'+obj,
		function (html){
			$('#addforms').html(html);
		},
		'html');
}
function ask(question,method){
	if(confirm(question)) return method();
	else return false;
}

function getSubcategories(category_id, isproduct) {
	$.get(
		'/admin/getsubcategories/category_id/'+category_id+'/isproduct/'+isproduct,
		function (html){
			$('#subcategories').html(html);
		},
	'html');
}

function getProducts(category_id, subcategory_id) {
	$.get(
			'/admin/getproducts/category_id/'+category_id+'/subcategory_id/'+subcategory_id,
			function (html){
				$('#products_field').html(html);
			},
		'html');
}

function logoutsis()
{
	$.get(
			'/admin/logout/',
			function (html){
				location.href='/admin';
			},
		'html');
		
}
function DelSeoRule(id)
{
	if(!id)
	 id=$('#delSeoMainNah').val();
	$.ajax({
			type: "POST",
			url: "/admin/seo",
			data: "act=del_rule&id="+id,
			success: function (data){
				window.location.href="/admin/seo";
			}
	});
}

function EditSeoRule(id)
{
	$.ajax({
			type: "POST",
			url: "/admin/seo",
			data: "act=edit_rule&id="+id,
			success: function (data){
				$('#contents').html(data);
			}
	});
}

function open_window(win,width, height)
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
		
		info=window.open(win,'info','resizable=1, scrollbars=1, toolbar=0, status=0, width='+width+', height='+height+', left='+left+', top='+top);
		info.focus();
 }