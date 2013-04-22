<?php

class BaseController{
    public $version=3.3;	
		
	
	public function MenuCategories($showmode=array()) {
		
		
		$showmode=Registry::getParam('user_settings');
		
		
		$clauseShowCat="";
                
		switch ($showmode['showmode']){
			case 0:
				$clauseShowCat="";
				break;
			case 1:
				$clauseShowCat="\n	 WHERE allowed in('','T')\n	";
				break;
			case 2:
				$clauseShowCat="\n	 WHERE allowed in('','T')\n	";
		}
		$sql = "SELECT * FROM categories $clauseShowCat ORDER BY new DESC";
		
		$db=new Database();
		
		$Categoryes = $db->do_select($sql);
		$s=count($Categoryes);
		$i=0;
                $menuReturn=array();
		$arrayType=array('76'=>'/model/caps','88'=>'/model/krujka','104'=>'/model/sign','90'=>'/model/pad','106'=>'/model/pants','10'=>'/model/shale','121'=>'/model/bag');
		while($i<$s)
		{
                    $tempArray=$Categoryes[$i];	
                    unset($Categoryes[$i]);
                    $tempArray['link']='/cat/'.$tempArray['id'];
                    if(isset($arrayType[$tempArray['id']]))
                        $tempArray['link'].=$arrayType[$tempArray['id']];
                    $tempArray['curent']=false;
                    if(isset($_SESSION['thisCat']) and $_SESSION['thisCat']==$tempArray['id'])
                        $tempArray['curent']=true;
                    $menuReturn[$i]=new MenuLinkStorage($tempArray['name'], $tempArray['link'], $tempArray['curent']);
                    $i++;
		}
	
		return $menuReturn;
			
		
	}

	public function new_wages($user_ins=array()) {	
	
		if(count($user_ins)==0)
			$user_ins=Registry::getParam('user_settings');
		$sqlMode='';
		switch ($user_ins['showmode']){
			case 0:
				$sqlMode='select * from offerss order by id desc limit 10';
				break;
			case 1:
				$sqlMode='SELECT offerss. *
						  FROM offerss, relation_category, categories
                          WHERE relation_category.id_offers = offerss.id
                          AND categories.id = relation_category.id_cat
                          AND categories.allowed != "F"
                          AND offerss.allowed != "F" 
						  group by relation_category.id_offers
						  order by relation_category.id_offers desc
						  limit 10  ';
            break; 			
			case 2: 
			$sqlMode="SELECT offerss. *
						  FROM offerss, relation_category, categories
                          WHERE relation_category.id_offers = offerss.id
                          AND categories.id = relation_category.id_cat
                          AND categories.allowed in ('','T')
                          AND offerss.allowed in ('','T')
						  group by relation_category.id_offers
						  order by relation_category.id_offers desc
						  limit 10  ";
			break;
			
		}
		
		
		$query = "select o.id as oldid, o.name, o.id_offer, rt.price, sex.path
					from (".$sqlMode.") o, relation_type rt, sex
					where sex.id = rt.type
					and rt.id_offers = o.id group by rt.id_offers order by rt.id_offers desc";

		
		
		
		$db=new Database();
		
                $Offers = $this->ReturnObjectOffers($db->do_select($query));  
                
		return 	$Offers;
		
	}

	

	public function MenuSaite()
	{
		$db=new Database();
		$menu=$db->do_select('select * from menu_stat order by position asc');
                $count=count($menu);
                $returnMenu=array();
		for($i=0;$i<$count;$i++)
		{
			$temp=$menu[$i];
                        $temp['url']=str_replace('http:///','/',$menu[$i]['url']);
                        $temp['target']=false;
			if($temp['target'] ==1)
                            $temp['target']=true;					
			unset($menu[$i]);
                        $returnMenu[$i]=new MenuLinkStorage($temp['title'], $temp['url'], false, $temp['target']);
				
		}
		return $returnMenu;
	}	
	
	
	public function cut_show() {
		$smartyLoad=new Smarty;	
		$user_settings = Registry::getParam('tpl_settings');
		$smartyLoad->template_dir='themes/'.$user_settings['source'];
                $CutParam=array();
		
		if($_SESSION['amounts']==0) $CutParam['amount']='0';
		else {
			if ($_SESSION['amounts'] % 10 == 1) $tovars = "товар";
			else if ($_SESSION['amounts'] % 10 > 1 && $_SESSION['amounts'] % 10 < 5 && ($_SESSION['amounts'] <10 || $_SESSION['amounts'] >20)) $tovars = "товара";
			else $tovars = "товаров";
			$CutParam['amount']=$_SESSION['amounts'];
		}
		$CutParam['many']=$_SESSION['many'];	
                
                return new BasketStorage($CutParam['amount'],$CutParam['many']);	
		
		
	}

	public function postreplace($post_name) {
		$new=str_replace('"','',$post_name);
		$new=str_replace("'","",$new);
		$new=strip_tags($new);
		return $new;
	}
	public function IsVersion($db)
	{
		$table=$db->do_select('show table status like "version"');
		if(count($table)==0)
			return false;
		else
		{
			$s=$db->do_select('select count(*) as cc from version where version="'.$this->version.'" and active=1');
			if($s[0]['cc']==0)
				return false;				
		}
		$table=$db->do_select('show table status like "offerss"');
		if(count($table)==0)
			return false;
		$s=$db->do_select('select count(*) as cc from offerss');		
		if($s[0]['cc']==0)
			return false;	
		return true;
	}
	
        
        public function returnParamsPage()
        {
            $db=new Database();       
           
            $dataReturn=array();
	    $tit=$db->do_select("select * from seo where uri='".mysql_real_escape_string($_SERVER['REQUEST_URI'])."'");		
            $user_settings = Registry::getParam('user_settings'); 
	    $dataReturn['title']=isset($tit[0]['title']) ? $tit[0]['title'] : '';
            $keywords = isset($tit[0]['keywords']) ? $tit[0]['keywords'] : '';				
            $description=isset($tit[0]['description']) ? $tit[0]['description'] : '';
            $dataReturn['seo']=new SeoStorage($description, $keywords);           
            $dataReturn['partnerDebug']=$user_settings['ansverServer'];
            $dataReturn['new_wages']=$this->new_wages($user_settings);
            $dataReturn['basket']= $this->cut_show();        
            self::SizeRenderValue();          
                   
           
            $dataReturn['partner']=new PartnerStorage($user_settings['partnername'], $user_settings['phone_partner'], $user_settings['milo_partner'], $user_settings['partnerICQ']);
	    
            $vers=$db->do_select('select version from version where active=1 order by id desc limit 1');
            $showmode = Registry::getParam('tpl_settings');
            if(!self::IsVersion($db))
               $dataReturn['returnNone']=1;
            $par_url= Library::getParams();            
            $dataReturn['partnerEnv']=new EnviromentStorage($showmode['source'],$vers[0]['version'],$par_url['controller'],$par_url['action']);           
            
            return $dataReturn;
            
        }
	public function ReturnCountTypeColorSize($db,$type,$color,$size,$addprice=0)
	{
		$db->do_insert('insert into relation_type_size values("'.$type.'","'.$size.'",'.$color.',1,'.intval($addprice).')');	
	}
	public function addColor($db,$colr,$name)
	{
		
		$d=$db->do_select('select count(*) as cc from color where abriv="'.$colr.'" ');
		if($d[0]['cc']==0)
		{
			$db->do_insert('insert into color values(0,"'.$name.'","'.$colr.'")');
			$s=$db->do_select('select id from color where name="'.$name.'" and abriv="'.$colr.'"');
		}
		else
			$s=$db->do_select('select id from color where abriv="'.$colr.'"');
		return $s[0]['id'];
	}
	
	public function addTypeOffer($db,$type)
	{
		$d=$db->do_select('select count(*) as cc from sex where path="'.$type.'"');
		if($d[0]['cc']==0)
			return false;
		return true;
	}
	public function SizeRenderValue()
	{	
		$path=dirname(__FILE__).'/../catalog';
		$f=@file_get_contents($path.'/updateSize.shop');
		if($f and $f!=''){
			if(time()>=$f)
				self::rendersSizeTime($path.'/updateSize.shop');
		}
		else
			self::rendersSizeTime($path.'/updateSize.shop');
	}
	public function rendersSizeTime($file)
	{
		$xmlTempFile = "catalog/xmlProdType.xml";
		$data=array();
		$db = new Database();
		$settings = Registry::getParam('globalUrl');		
		$db->do_insert("truncate table relation_type_size");		
		
		$xmlstr = @file_get_contents($settings['updateType'].'?version='.$this->thisVersion.'&platform=shop-3');
		
		if($xmlstr)
		{   
			$files=fopen("./$xmlTempFile",'w+');
			$res = fwrite($files,$xmlstr);
			unset($xmlstr);
			fclose($files);
			if(file_exists('./catalog/xmlProdType.xml'))		
			{
				$simText=file_get_contents("./$xmlTempFile");				
			
				$xml=new SimpleXMLElement($simText,LIBXML_NOCDATA);
				
				if(!$xml)					
					return;				
				
				
				
				foreach($xml->xpath('producttype') as $producttype)
				{
				
			
					$params=$producttype->attributes();
					$prodId=(string)$params['id'];
					$prodName=mysql_real_escape_string((string)$producttype->name);
					$arryaToTypes[$prodId]['name']=	$prodName;
					$prodId=(string)$params['id'];
					$Double=0;
					if($params['double'] and (string)$params['double']=="Y")
						$Double=1;		
					$paramInsert='relation';
					$relation=1;	
					
					foreach ($producttype->xpath('colors/color') as $select_color=>$color)
					{					
						$parColor=$color->attributes();	
						$sizeColor=(array)$color->sizes;
						$idColor=(string)$parColor['id'];
						$nameColor=mb_strtolower((string)$color->name,'utf-8');
						$idColorInsert=$this->addColor($db,$idColor,$nameColor);
						
						if(isset($sizeColor['size'])){
							
							foreach($color->xpath('sizes/size') as $sizems)
							{
								$sPar=$sizems->attributes();
								$addPrice=0;
								if($sPar['add_price'])
									$addPrice=(string)$sPar['add_price'];
								$sizeName=(string)$sizems[0];	
								$this->ReturnCountTypeColorSize($db,$prodId,$idColorInsert,$sizeName,$addPrice);		
							}
						}
						else
						{
							$paramInsert='';
							$this->ReturnCountTypeColorSize($db,$prodId,$idColorInsert,'',0);
						}
					}
					if(!$this->addTypeOffer($db,$prodId))
						$db->do_insert('insert into sex values(0,"'.$prodName.'","'.$prodId.'","","","","'.$paramInsert.'" 	 ,'.$Double.')');
					
					unset($producttype);
					unset($color);			
					unset($prodName);
					unset($prodId);
					unset($prodTpl);
					unset($prodSizes);
				}
				
				unset($xml);
				
				@file_put_contents($file,(intval($settings['timeRenderOffer'])+time()));
				@chmod($file,0777);
				
			}	
			
		}
		
	}
        
        public function ReturnObjectOffers($array)
        {
            $arrayReturn=array(); 
            $view=new View();
            $countArray=count($array);
            for($a=0;$a<$countArray;$a++)
            {
                $sTemp=$array[$a];
                $sTemp['images']=$view->LoadProdImage($sTemp['oldid'], $sTemp['path']);
                $sTemp['url']='/product/'.$sTemp['oldid'].'/model/'.$sTemp['path'];
                $arrayReturn[$a]=new OfferStorage($sTemp['oldid'], $view->ShowTypeOffer($sTemp['name'], $sTemp['path']), $sTemp['price'],$sTemp['images'],$sTemp['url']);
                unset($array[$a]);
                unset($sTemp);
            }
            return $arrayReturn;
        } 
        
        function NameOffersFromType($name,$type)
        {
            
            $arrayNamereplace=array('Футболка','Трусы','Бейсболка','Кружка','Сланцы','Трусы','Коврик','Значок','Шапка','Брелок круглый','Термос');
            
	    		
            $db=new Database();
            $sql=$db->do_select('select name from sex where path="'.$type.'"');
            if(isset($sql[0]))
             {   
				$name=str_replace($sql[0]['name'],'',$name);
				$name=str_replace($arrayNamereplace,'',$name);
				return $sql[0]['name'].' "'.trim($name).'"';
			 }
            else
                 return $name;    
        }
		public function prace_add_param($db,$type,$color,$size,$price)
		{
			$s=$db->do_select('select add_price from relation_type_size where id_type="'.$type.'" and color='.$color.' and size="'.$size.'" and status=1');
			return ($price+intval($s[0]['add_price']));
		}
        

}

?>
