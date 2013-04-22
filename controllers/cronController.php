<?php
include 'library/error.php';
include 'library/uploadXml.php';
class CronController {
	private $params;
	private $updStngs;
	public $thisVersion=3.3;

	function __construct () {
    ini_set('display_errors', 1);
		$this->params = Library::paramUri();
		$this->updStngs = Registry::getParam('globalUrl');
		
	}

	
	private function errorAllPars()
	{
		$return=array();
		if(!file_exists('./catalog'))		
			$return[]='Отсутствует папка catalog';
		else
		{
			if(!is_writable('./catalog'))
				$return[]='Папка catalog не открыта для записи';
		}
		if(count($return)>0)
			return $return;
		else
			return 0;
	}
	
	public function catalogdataAction()
	{
		if($d=self::errorAllPars())		
		{	
			self::insertErrorFileLog(implode(',',$d));
			die(json_encode(array('act'=>4,'error'=>implode(',',$d))));
		}
		else
			if(isset($_POST['first']) and isset($_POST['last']))
				{
					self::updateByXml($_POST['first'],$_POST['last']);
				}
			else
				self::updateByXml();
			
		
	}
	public function tempdataAction()
	{
	 
		$db=new Database();
		$d=array();
		$thisTempUpdate=self::InsertNewUpdate($db);	
		
		$is=$db->do_select('select count(*) as cc from version where active=1  and version="'.$this->thisVersion.'" order by id desc limit 1');
		if($is[0]['cc']==0)
			$d['error']='Обновите версию партнерского магазина.';		
			
		$isset=$db->do_select("show table status where Name='update_temp'");
        if(count($isset)==0)
			$d['error']='Обновите версию партнерского магазина.';
			
		$isset=$db->do_select("show table status where Name='offers_version'");
        if(count($isset)==0)			
			$d['error']='Обновите версию партнерского магазина.';
		$isset=$db->do_select("show table status where Name='update_info'");
        if(count($isset)==0)		
			$d['error']='Обновите версию партнерского магазина.';
		$isset=$db->do_select("show table status where Name='update_date_xml'");
        if(count($isset)==0)
			$d['error']='Обновите версию партнерского магазина.';
		
                $tempPath= dirname(__FILE__).'/../catalog/updateSize.shop';
                if(!file_exists($tempPath))                
                {   
                    file_put_contents($tempPath,'');                      
                    @chmod($tempPath,0777);
                        
                    
                }
                else
                {
                     clearstatcache();    
                    if(!is_writable($tempPath))
                    {
                        if(!@chmod($tempPath,0777))
                           $d['error']='Файл catalog/updateSize.shop не доступен для записи.';     
                    }
                        
                }  	
		self::StructCreateBd();
			
		if(isset($d['error']) and $d['error']!='')
		{	
			self::insertErrorFileLog($d['error']);
			die(json_encode(array('act'=>0,'error'=>$d['error'])));
		}
		
		$isset=$db->do_select("show table status where Name='update_temp_relation'");
        if(count($isset)==0)
		{
			$sql='CREATE TABLE IF NOT EXISTS `update_temp_relation` (
					`id_offers` int(20) NOT NULL,
					`type` varchar(20) NOT NULL,
					`color` varchar(20) NOT NULL,
					`hand` int(2) NOT NULL,
					`price` int(20) NOT NULL,
					INDEX `id_offers` (`id_offers`),
					INDEX `type` (`type`),
					INDEX `color` (`color`)
					)  ENGINE=MyISAM DEFAULT CHARSET=utf8;';
					$db->do_insert($sql);
		}	
		$isset=$db->do_select("show table status where Name='update_temp_new'");
        if(count($isset)==0)
		{
			$sql='CREATE TABLE IF NOT EXISTS `update_temp_new` (
				  `id` int(20) NOT NULL,
				  `name` varchar(20) NOT NULL,
				  `id_updating` int(20) NOT NULL,
				  `allowed` varchar(10) not null,
				  INDEX `id` (`id`)
				)ENGINE=MyISAM DEFAULT CHARSET=utf8;';
				$db->do_insert($sql);
		}
		$isset=$db->do_select("show table status where Name='offerss'");
        if(count($isset)==0)
		{
			$sql="CREATE TABLE IF NOT EXISTS `offerss` (
									`id` int(20) NOT NULL,
									`name` varchar(255) NOT NULL,
									  `front` int(1) NOT NULL,
									  `back` int(1) NOT NULL,
									  `allowed` varchar(5) NOT NULL,
									  `id_offer` INT( 20 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									  INDEX `oldidid` (`id`),
									  INDEX `allowed` (`allowed`)
									) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
			$db->do_insert($sql);
				
		}
		$s=$db->do_select('show columns from offerss where Field = "id_offer"');
		if(count($s)==0)
			$db->do_insert('alter table `offerss` add `id_offer` int( 20 ) not null auto_increment primary key');
		
		$isset=$db->do_select("show table status where Name='relation_category'");
        if(count($isset)==0)
		{
			$sql="CREATE TABLE IF NOT EXISTS `relation_category` (
									  `id_offers` int(20) NOT NULL,
									  `id_cat` int(20) NOT NULL,
									  `id_sub` varchar(255) NOT NULL,
									  INDEX `subcategoryid` (`id_cat`),
									  INDEX `categoryid` (`id_sub`),
									  INDEX `oldid` (`id_offers`)
									) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
			$db->do_insert($sql);						
		}		
		
		
		
		$db->do_insert('truncate table update_temp');
		$db->do_insert('truncate table update_temp_new');
		$db->do_insert('truncate table update_temp_relation');
		$db->do_insert('truncate table relation_category');
		$db->do_insert('drop table offers');
		
		$db->do_insert('CREATE TABLE IF NOT EXISTS `relation_type` (
						  `id_offers` int(20) NOT NULL,
						  `type` varchar(20) NOT NULL,
						  `color` varchar(20) NOT NULL,
						  `hand` int(2) NOT NULL,
						  `price` int(20) NOT NULL,
						  INDEX `id_offers` (`id_offers`),
						  INDEX `type` (`type`),
						  INDEX `color` (`color`)
						)ENGINE=MyISAM DEFAULT CHARSET=utf8;'); 

		$db->do_insert('CREATE TABLE IF NOT EXISTS `relation_type_size` (
						  `id_type` varchar(20) NOT NULL,
						  `size` varchar(10) NOT NULL,
						  `color` int(5) NOT NULL
						)');
		$s=$db->do_select('show columns from relation_type_size where Field = "color" and `Key`="MUL"');
		if(count($s)==0)
			$db->do_insert('alter table `relation_type_size` add index (`color`)');	
		
		
			
		$s=$db->do_select('show columns from relation_type_size where Field = "id_type" and `Key`="MUL"');
		if(count($s)==0)
			$db->do_insert('alter table `relation_type_size` add index (`id_type`)');	
		$s=$db->do_select('show columns from relation_type_size where Field = "status"');
		if(count($s)==0)
			$db->do_insert('alter table `relation_type_size` add column `status` int( 11 ) not null');
		$s=$db->do_select('show columns from relation_type_size where Field = "size"');	
                if(count($s)==0)
			$db->do_insert('alter table `relation_type_size` add column `size` varchar( 10 )');   
		elseif($s[0]['Type']=='varchar(10)')
			$db->do_insert('alter table `relation_type_size` change `size` `size` varchar( 20 )');
          
		$s=$db->do_select('show columns from relation_type_size where Field = "add_price"');	
		if(count($s)==0)
			$db->do_insert('alter table `relation_type_size` add column `add_price` int( 10 )');
			
        $s=$db->do_select('show columns from subcategories where Field = "id"');	
		if($s[0]['Type']=='varchar(20)')
                    $db->do_insert('alter table `subcategories` CHANGE `id` `id` VARCHAR( 255 )'); 
		
		$s=$db->do_select('show columns from offerss where Field = "allowed"');
		if(count($s)==0)
			$db->do_insert('alter table `offerss` add column `allowed` varchar( 5 ) default "" after back');

		$s=$db->do_select('show columns from offerss where Field = "allowed"');
		if(count($s)==0)
			$db->do_insert('alter table `offerss` add column `allowed` varchar( 5 ) default "" after back');
		
		$s=$db->do_select('show columns from offerss where Field = "id_offer"');
		if(count($s)==0)
			$db->do_insert('ALTER TABLE `offerss` ADD `id_offer` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY  after allowed');
                $s=$db->do_select('show columns from  description_subcat where Field="id_subcat"');
                $type=intval(str_replace(array('varchar(',')'),'',$s[0]['Type']));
                if($type==20)
                    $db->do_insert('alter table `description_subcat` CHANGE `id_subcat` `id_subcat` VARCHAR( 50 )'); 
	//	$db->do_insert('insert into update_temp select `oldid`, `name`, `sexid`, `colors`, `price`, `subcategoryid`, `categoryid`, `rukav`,'.$thisTempUpdate.' as `id_updating` from offers');
		$db->do_insert('insert into update_temp_new select `id`, `name`,'.$thisTempUpdate.' as `id_updating`,allowed from offerss');
		$db->do_insert('insert into update_temp_relation select `id_offers`, `type`,color,hand,price from relation_type');
		$db->do_insert('truncate table relation_type');
		$_SESSION['encode']="utf-8";
                restore_error_handler();
                //cmoding start
                $path=dirname(__FILE__).'/../catalog/';
                @chmod($path.'xmlproduct.xml',0777);
                //@chmod('./catalog/notifycations.xml',0777);
                @chmod($path.'xml_delivery.xml',0777);
                @chmod($path.'offers_all.xml',0777);
                @chmod($path.'category.xml',0777);
                @chmod($path.'xmlProdType',0777);
                //chmoding stop
		
		
		die(json_encode(array('act'=>1)));
	}
	function insertErrorFileLog($str)
	{
		$db=new Database();
		if(!isset($_SESSION['lastUpdateId'])){
			$_SESSION['lastUpdateId']=self::ReturnNewUpdate($db);	
		}
		$path=dirname(__FILE__).'/../error';
		$name='/error_'.$_SESSION['lastUpdateId'].'.dat';
		if(file_exists($path)){
			if(!is_writable($path))
				die(json_encode(array('act'=>5,"error"=>'Выставьте права на папку error')));
				
		}
		else
			mkdir($path,0777);
		file_put_contents($path.$name,$str);		
	}
	private function InsertNewUpdate($dbCon)
	{
		$thisT=time();
		$dbCon->do_insert('insert into update_info values(0,'.$thisT.',0)');
		$s=$dbCon->do_select('select id from update_info where `date`='.$thisT.' order by `date` desc limit 1');
		$_SESSION['lastUpdateId']=$s[0]['id'];
		return $s[0]['id'];
	}
	
	private function ReturnNewUpdate($dbCon)
	{
		$s=$dbCon->do_select('select id from update_info order by `date` desc limit 1');
		return $s[0]['id'];
	}
	public function deliverydataAction()
	{
		restore_error_handler();
		$settings = Registry::getParam('globalUrl');
		$xmlstr = @file_get_contents($settings['updateDelivery'].'?version='.$this->thisVersion.'&platform=shop-3');
		if(!$xmlstr)
		{	
			self::insertErrorFileLog('Не удалось соединиться с сервером vsemayki.ru');
			die(json_encode(array('act'=>2,"error"=>'Не удалось соединиться с сервером vsemayki.ru')));
		}
        $files=fopen('./catalog/xml_delivery.xml','w+');
        $res = @fwrite($files,$xmlstr);
        unset($xmlstr);
        fclose($files);
		die(json_encode(array('act'=>1)));
		
	}	
	private function updateByXml($first,$last) {
		
		
		$db = new Database();
		$settings = Registry::getParam('globalUrl');	
		//set_time_limit(0);
		// Updating XML delivery scheme
		restore_error_handler();
		$path=$settings['catalogpageupdate'].'?version='.$this->thisVersion.'&platform=shop-3';		
		
		uploadXml::upXml($path,'./catalog/xmlproduct.xml',$first,$last);
	
	}
	
	public function ReturnEncode($url)
	{
		$fh = fopen($url, "r");
		$s=0;
		$encode='windows-1251';
               
		while (! feof($fh)){
			$line = fgets($fh, 4096);
			if($s>0)
				return $encode;
			else
			{
				$s=strpos($line, 'encoding="utf-8"');
				if($s)
					$encode='utf-8';
			}			
		}
		fclose($fh);
                 $_SESSION['encode']=$encode;
		return $encode;
	}
	public function ReturnNotification($url,$encode)
	{
		$fh = fopen($url, "r");
		$string='';
		
		$notification=0;
		#create vertion xml
		
		while (! feof($fh)){
			$line = fgets($fh, 4096);
			
			if($notification==0)
			{
				$s=strpos($line, '<notifycations>');
				if($s)
				{	$notification=1;
					$f=explode('<notifycations>',$line);
					$string.='<notifycations>'.$f[1];
				}
			}
			else
			{
				$s=strpos($line, '</notifycations>');
				if(!$s)
					$string.=$line;
				else
				{
					$f=explode('</notifycations>',$line);
					$string.=$f[0].'</notifycations>';					
					$notification=0;
					if($string!='')
						$string='<?xml version="1.0" encoding="'.$encode.'"?>'.$string;
					$files=fopen('./catalog/notifycations.xml','w+');
					$res = fwrite($files,$string);
					unset($string);
					fclose($files);
					//@chmod('./catalog/notifycations.xml',0777);
					break;
				}	
			}
			
			
		}
		fclose($fh);		
		
		
	}
	public function ReturnCat($url,$encode)
	{
		$fh = fopen($url, "r");
		$strings='';
		$off=0;
		$category=0;
                
		while (! feof($fh))
		{
			$line = fgets($fh, 4096);
			if($category<2)
			{
				$category=1;
				if($off==0)
				{
					$s=strpos($line, '<categories>');
					if($s)
					{	$off=1;
									
						$f=explode('<categories>',$line);                                        
						$strings='<?xml version="1.0" encoding="'.$encode.'"?><categories>'.$f[1];
						$this->inFileOffers('./catalog/category.xml',$strings,true);
						$strings='';
											
						
					}
				}
				else
				{
					$end=explode('</categories>',$line);
				  
					if(count($end)>1)
					{
						$strings.=$end[0].'</categories>'; 
						$this->inFileOffers('./catalog/category.xml',$strings);
						unset($end);
						$category=2; 
						$off=0;	
					}
					else
						$this->inFileOffers('./catalog/category.xml',$line);                         
				}
			}
                       
        }
		
		fclose($fh);
		
		
	}
	
	public function OnlyOffers($url,$encode)
	{
		$fh = fopen($url, "r");
		$strings='';
		$off=0;
                
		while (! feof($fh)){
			$line = fgets($fh, 4096);
			
			if($off==0)
			{
				$s=strpos($line, '<offers>');
				if($s)
				{	$off=1;
                                
					$f=explode('<offers>',$line);                                        
					$strings='<offers>'.$f[1];
                                       
                                        $this->inFileOffers('./catalog/offers_all.xml',$strings,true);
                                        $strings='';
                                        
					
				}
			}
			else
			{
                            $end=explode('</offer></offers>',$line);
                          
                            if(count($end)>1)
                            {
                                $strings=$end[0].'</offers>'; 
                                $this->inFileOffers('./catalog/offers_all.xml',$strings);
                                unset($end);
				$off=0;	
                            }
                            else
                                $this->inFileOffers('./catalog/offers_all.xml',$line);                          
			}
                       
            }
		
		fclose($fh);
               
		/*$d=explode('</offers>',$strings);   
              
                if(isset($d[1]))
                {
                    $files=fopen('./catalog/offers_all.xml','w+');
                    fwrite($files,$d[0].'</offers>');
                   
                    fclose($files);                   
                }*/
		
		
		//@chmod('./catalog/offers_all.xml',0777);		
	}
        
        public function inFileOffers($path,$str,$start=false)
        {
            restore_error_handler();
			if($start==false)
                $files=fopen($path,'a+');
            else
                $files=fopen($path,'w+');
            if(!fwrite($files,$str))
			die('asdasd');
            fclose($files);                   
        }
	public function ReturnOffers($url,$encode)
	{
		if(!file_exists('./catalog/offers_all.xml'))
			return 	0;
		$fh = fopen('./catalog/offers_all.xml', "r");
                
		$strings='';
		$offers=0;
		$count=1;
		$countInFile=0;
		$limit=100;
		
		$tempA='';
		while (! feof($fh)){
			$line = fgets($fh, 4096);	
			
			$line=str_replace('<offers>','',$line);
			
				
			$f=explode('</offer>',$tempA.$line);
			$cT=count($f);
			$tempA=$f[($cT-1)];
			unset($f[($cT-1)]);			
			$countInFile=$countInFile+($cT-1);
			$strings.=implode('</offer>',$f);
			
			if($countInFile>=$limit)
			{	
				header('Content-Type: application/xml; charset=utf-8');                                
				$strings.='</offer>';
				$strings=str_replace('</models><offer id=','</models></offer><offer id=',$strings);	
				$files=fopen('./catalog/offers/offer_'.$count.'.xml','w+');
				$res = fwrite($files,'<?xml version="1.0" encoding="'.$encode.'"?><offers>'.$strings.'</offers>');
				$strings='';
				$count++;
				$countInFile=0;
			}
		}	

		fclose($fh);
		
		if($strings!='')
		{
			
			header('Content-Type: application/xml; charset=utf-8');	
			$strings.='</offer>';
			$strings=str_replace('</models><offer id=','</models></offer><offer id=',$strings);	
			$files=fopen('./catalog/offers/offer_'.$count.'.xml','w+');
			$res = fwrite($files,'<?xml version="1.0" encoding="'.$encode.'"?><offers>'.$strings.'</offers>');
			$strings='';
			$count++;			
		}
		$tempA=str_replace('</offers>','',$tempA);	
		
		if($tempA!='')
		{
			header('Content-Type: application/xml; charset=utf-8');	
			$tempA.='</offer>';
			$tempA=str_replace('</models><offer id=','</models></offer><offer id=',$tempA);	
			$files=fopen('./catalog/offers/offer_'.$count.'.xml','w+');
			$res = fwrite($files,'<?xml version="1.0" encoding="'.$encode.'"?><offers>'.$tempA.'</offers>');
			$tempA='';
			$count++;
		}	
		
		return 	$count;
	}
	
	public function partparsAction()
	{
		restore_error_handler();
		if(!file_exists('./catalog/xmlproduct.xml'))
		{	
			self::insertErrorFileLog('Ошибка разбора XML. Отсутствует обязательный файл /catalog/xmlproduct.xml');
			die(json_encode(array('act'=>0,'error'=>'Ошибка разбора XML. Отсутствует обязательный файл /catalog/xmlproduct.xml')));
		}
		$url='./catalog/xmlproduct.xml';		
		$encodeF=self::ReturnEncode($url);		
		self::ReturnNotification($url,$encodeF);		
		self::ReturnCat($url,$encodeF);	
		self::OnlyOffers($url,$encodeF);
		$countOffers=(self::ReturnOffers($url,$encodeF)-1);
               
		if($countOffers==0)
		{
			self::insertErrorFileLog('Каталог товаров пустой');
			die(json_encode(array('act'=>0,'error'=>'Каталог товаров пустой.','of'=>$countOffers)));
		}
		//
		if($countOffers!=0)
		{
			$f=fopen('./catalog/offers_all.xml','w+');
			$res = fwrite($f,'');		
			fclose($f);
			//@chmod('./catalog/offers_all.xml',0777);
				
			die(json_encode(array('act'=>1,'of'=>$countOffers)));
		}
		else{
			self::insertErrorFileLog('Ошибка разбора XML. Ошибка в файле /catalog/offers_all.xml. Проверьте его существование.');
			die(json_encode(array('act'=>0,'error'=>'Ошибка разбора XML. Ошибка в файле /catalog/offers_all.xml. Проверьте его существование.')));
		}
		
		
	}
	
	public function returnDateUpdateXML($url)
	{
		$fh = fopen($url, "r");
		$strings='';
		$xmlString='';
		$category=0;
		while (! feof($fh)){
			$line = fgets($fh, 4096);
			
			if($category==0)
			{
				$s=strpos($line, '<company>');
				if($s)
				{	$category=1;
					$strings.=$line;
					$d=explode('<company>',$strings);
					$xmlString=$d[0];
					unset($d[1]);				
					
				}
				else
					$strings.=$line;
			}
			else
				break;
			
        }
		fclose($fh);
		
		$xml=new SimpleXMLElement($xmlString.'</price>',LIBXML_NOCDATA);
		$c=$xml->attributes();
		$atr=(array)$c[0];
		$db=new Database();
		$settings = Registry::getParam('globalUrl');	
		$db->do_insert('insert into update_date_xml values(0,"'.(string)$atr[0].'",'.time().',"'.$settings['catalogpageupdate'].'")');		
		return true;
			
	}
	
	public function notifacitionAction()
	{
		if(!file_exists('./catalog/notifycations.xml'))		
			die(json_encode(array('act'=>1,'text'=>'','vers'=>'')));
		
		$s=file_get_contents('./catalog/notifycations.xml');
		if($s!='')
		{
			$xml = new SimpleXMLElement($s,LIBXML_NOCDATA);
			$c=$xml->xpath('notice');
			
			
			$attribut=$c[0]->attributes();
			$version=(string)$attribut['version'];
			$znach=htmlspecialchars_decode((string)$attribut['rule']);
			$n=(array)$c[0];
			$text=(string)$n[0];
			$textOn='';
			switch($znach){
			case '<':
				$textOn='Версия используемого движка ниже '.$version;
			break;
			case '<':
				$textOn='Версия используемого движка выше '.$version;
			break;
			case '<=':
				$textOn='Версия используемого движка ниже или равна '.$version;
			break;
			case '>=':
				$textOn='Версия используемого движка выше или равна '.$version;
			break;
			case '=':
				$textOn='Версия используемого движка  равна '.$version;
			break;
			}
			
			//var_dump($znach);
			
			die(json_encode(array('act'=>1,'text'=>$text,'vers'=>$textOn)));
		}
		die(json_encode(array('act'=>0)));
	}
	public function updatecatAction()
	{
		
		if(!file_exists('./catalog/category.xml'))		
		{	
			self::insertErrorFileLog('Ошибка разбора XML. Ошибка в файле /catalog/category.xml. Проверьте его существование.');
			die(json_encode(array('act'=>0,'error'=>'Ошибка разбора XML. Ошибка в файле /catalog/category.xml. Проверьте его существование.')));
		}
		//set_time_limit(0);
		$db = new Database();
		$settings = Registry::getParam('globalUrl');
		//$codeXml=file_get_contents('./catalog/xmlproduct.xml');
		$codeXml=file_get_contents('./catalog/category.xml');
		
                if(!isset($_SESSION['encode']))                
                    $_SESSION['encode']=='utf-8';
                
                
                if($_SESSION['encode']=='utf-8')
                {
                    if(!preg_match('/\<category (.*)\<name\>[а-яa-z]+\<\/name\>/ui',$codeXml))
                    {
                            self::insertErrorFileLog('Каталог товаров пустой');
                            die(json_encode(array('act'=>0,'error'=>'Каталог товаров пустой.')));
                    }
                }
                else
                {
                    if(!preg_match('/\<category (.*)\<name\>(.*)?\<\/name\>/i',$codeXml))
                    {
                            self::insertErrorFileLog('Каталог товаров пустой');
                            die(json_encode(array('act'=>0,'error'=>'Каталог товаров пустой.')));
                    }
                } 
                
                  
		restore_error_handler();
		$temps=explode('<offers>',$codeXml);
		$codeXml=$temps[0];
		$xml = new SimpleXMLElement($codeXml);
		if(!$xml)
		{
			self::insertErrorFileLog('Ошибка разбора XML. Ошибка в файле /catalog/xmlproduct.xml. ');
			die(json_encode(array('act'=>0,'error'=>'Ошибка разбора XML. Ошибка в файле /catalog/xmlproduct.xml')));
		}
		$prevCats = $db->do_saaofv("SELECT id, allowed FROM categories",'id');
		$prevSCats = $db->do_saaofv("SELECT id, parentcategoryid, allowed FROM subcategories", array('parentcategoryid',
			'id'));
		
		$db->do_insert("TRUNCATE TABLE categories");
		$db->do_insert("TRUNCATE TABLE subcategories");
		
		foreach ($xml->xpath('category') as $item_cut ) {		
			$attr_c = $item_cut->attributes();
			$id = (string)$attr_c["id"];
			$name = (string)$item_cut->name;
			$name=str_replace(array("'",'"'),'',$name);
			$new=(string)$attr_c["new"];
			$allCats='';
			if(isset($prevCats[$id]['allowed']))
				$allCats=$prevCats[$id]['allowed'];
			$db->do_insert("insert into categories values('$id','$name','$new','".$allCats."')");
			$subcategories = $item_cut->subcategories;
			$rel_sub = array();
			$j=0;
			$db->do_insert("insert into subcategories values('0','','$id','T')");
			foreach ($subcategories->xpath('subcategory') as $subcategory) {
				$subcategory_attr = $subcategory->attributes();
				$rel_sub = (string)$subcategory_attr["id"];
				$name_s=(string)$subcategories->subcategory[$j];
				$name_s=str_replace(array("'",'"'),'',$name_s);
				$AllowdParams='';
				if(isset($prevSCats["$id^$rel_sub^"]['allowed']))
					$AllowdParams=$prevSCats["$id^$rel_sub^"]['allowed'];
				$db->do_insert("insert into subcategories values('$rel_sub','$name_s','$id','".
						$AllowdParams."')");
				$j++;
			}
			unset($subcategories);
			
		}
		unset($xml);
		unset($prevCats);
		unset($prevSCats);
		
		//
		
			$f2=fopen('./catalog/category.xml','w+');
			$res = fwrite($f2,'');		
			fclose($f2);
			//@chmod('./catalog/category.xml',0777);	
			
			die(json_encode(array('act'=>1)));
		
			
		
	}

	public function updatetypeAction()
	{
		//set_time_limit(0);
		restore_error_handler();
		$xmlTempFile = "catalog/xmlProdType.xml";
		$data=array();
		$db = new Database();
		$settings = Registry::getParam('globalUrl');
		$db->do_insert("truncate table relation_type_size");	
		$prod=array();
		
		$xmlstr = @file_get_contents($settings['updateType'].'?version='.$this->thisVersion.'&platform=shop-3');
		
		if($xmlstr)
		{   
			$files=fopen("./$xmlTempFile",'w+');
			$res = fwrite($files,$xmlstr);
			unset($xmlstr);
			fclose($files);
			if(!file_exists('./catalog/xmlProdType.xml'))		
			{	
				self::insertErrorFileLog('Ошибка разбора XML. Ошибка в файле /catalog/xmlProdType.xml. Проверьте его существование.');
				die(json_encode(array('act'=>0,'error'=>'Ошибка разбора XML. Ошибка в файле /catalog/xmlProdType.xml. Проверьте его существование.')));
			}
			$simText=file_get_contents("./$xmlTempFile");				
			
			$xml=new SimpleXMLElement($simText,LIBXML_NOCDATA);
			
			if(!$xml)
			{	
				self::insertErrorFileLog('Ошибка  разбора файла /catalog/xmlProdType.xml.');
				die(json_encode(array('act'=>0,'error'=>' Ошибка  разбора файла /catalog/xmlProdType.xml.')));
			}			
			
			
			$arryaToTypes=array();
			foreach($xml->xpath('producttype') as $producttype) {
				
			
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
			$pathF=dirname(__FILE__).'/../catalog/updateSize.shop';			
			file_put_contents($pathF,(intval($settings['timeRenderOffer'])+time()));
			@chmod($pathF,0777);
			self::DocsPars();			
			die(json_encode(array('act'=>1)));
		}
		else{
			self::insertErrorFileLog('Не удалось соедениться с сервером vsemayki.ru');
			die(json_encode(array('act'=>2,'error'=>'Не удалось соедениться с сервером vsemayki.ru')));
		}
		
	}
	
	

	public function DocsPars()
	{
	
		$db=new Database();
		$xmlstr = @file_get_contents("http://www.vsemayki.ru/partnership/doc.php?version=".$this->thisVersion."&platform=shop-3");		
		if($xmlstr){
			$xml = new SimpleXMLElement($xmlstr);
		} else {
			self::insertErrorFileLog('Не удалось соединиться с сервером vsemayki.ru');
			die(json_encode(array('act'=>2,'error'=>'Не удалось соединиться с сервером vsemayki.ru')));
			//return;
		}
		//$dAll=$db->do_select("select count(*) as cc from stat_content ");
		
		$position=0;
		foreach ($xml->xpath('docs/doc') as $item) {
		
			$attr = $item->attributes();
			$id = (string)$attr["id"];
			$d=$db->do_select("select count(id) as cc from stat_content where url='".$id."' and froms=1");
			if($d[0]['cc'] == 0)
			{
					$desc = $item->description;
					$name = $item->name;
					$desc=str_replace(array('src="/img/'),'src="http://www.vsemayki.ru/img/',$desc);
					$desc=str_replace(array('src="/i/'),'src="http://www.vsemayki.ru/i/',$desc);
					$desc=str_replace(array('src="/tmp/'),'src="http://www.vsemayki.ru/tmp/',$desc);				
					$desc=str_replace('class="rt_table_style1"','',$desc);
					
					$desc=str_replace('width: 100%;','width:90%;',$desc);
					$desc=str_replace(array('"',"'"),'\"',$desc);
					if($id!="" and $id!="main") {									
					$start=0;
					$urls='/docs/'.$id.'.html';				
					if($id!='oplatitzakaz')
					{
						
						
							$db->do_insert("insert into stat_content values(0,'".$name."','".$desc."','','".$id."',1,1,".$start.", '')");
							$idLast=$db->do_select('select id from stat_content order by id desc limit 1');
							$idTo=$idLast[0]['id'];
							$db->do_insert("insert into menu_stat values(0,'".$urls."','".$name."',".$idTo.",".$position.",0)");
							
					}
					else
					{
						$d=$db->do_select("select count(id) as cc from menu_stat where url='http://www.maykoplat.ru/#pay'");
						if($d[0]['cc'] == 0)
							$db->do_insert("insert into menu_stat values(0,'http://www.maykoplat.ru/#pay','".$name."',0,".$position.",1)");
					}
						
					
					
					
				}
			}
			
		
			unset($attr);
			unset($id);
			unset($desc);
			unset($name);
			unset($d);	
			unset($idLast);
			unset($idTo);
			$position++;			
		}
		
	
	}
	
	
	private function delcashe($subdir='') {
		
		$cashe_dir = Registry::getParam('cache_settings');
		if($subdir!='') $subdir.= "/";
		$dirname = '.'.$cashe_dir['dir'].$subdir;
		$dir=opendir($dirname);
		while (($file = readdir($dir)) !== false) {
			@$s=explode('.',$file);
			
			if(isset($s[1]) and $s[1]=='dat') {
				//@chmod(($dirname.$file),0777);
				unlink(($dirname.$file));
			}
		}
		closedir($dir);
			
	}

	public function updatecatalogAction()
	{
		//set_time_limit(0);
		
		//restore_error_handler();
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$tstart = $mtime;
		$sqlOffers=array();
		$sqlCatOffers=array();
		$sqlColorOffers=array();
		$db = new Database();
		
		if($_POST['m']==1)
		{	
			$db->do_insert("TRUNCATE TABLE offerss");
			$_SESSION['lastUpdateId']=self::ReturnNewUpdate($db);	
		}elseif(!isset($_SESSION['lastUpdateId'])){
			$_SESSION['lastUpdateId']=self::ReturnNewUpdate($db);
			
		}
		
		if(file_exists('./catalog/offers/offer_'.$_POST['m'].'.xml'))
			$codeXml = file_get_contents('./catalog/offers/offer_'.$_POST['m'].'.xml');
		else
			die(json_encode(array('act'=>2,'time'=>$_POST['time'],'all'=>$_POST['all'],'percent'=>100)));
		$tempCode =str_replace(array('<?xml version="1.0" encoding="utf-8"?><offers>','</offer></offers>'),'',$codeXml);
		if(trim($tempCode)=="")	
		{
			$percent=(100*$_POST['m'])/$_POST['all'];
			die(json_encode(array('act'=>1,'time'=>$_POST['time'],'all'=>$_POST['all'],'next'=>($_POST['m']+1),'cc'=>0,'percent'=>(int)$percent)));
		}	
		//$arrayInfo=array();
		
			$xml= new SimpleXMLElement($codeXml);
			if(!$xml){				
				self::insertErrorFileLog('Ошибка разбора XML. Неверный формата XML.');
				die(json_decode(array('act'=>5,'error'=>'Ошибка разбора XML. Неверный формата XML.')));			
			}	
			unset($codeXml);
			
			
			foreach ( $xml->xpath('offer') as $item )
			{			
						$CountAllPr=$_POST['cc']++;
						$models = $item->models;
						$name = str_replace('Футболка','',mysql_real_escape_string((string)$item->name));
						
						
						
						//$name=str_replace(array("\'",'\"',"\\"),'',$name);
							
						$arrayCategories=array();			
						if(!$item->categoryId)
						{
							$categoryArray = $item->categories;
							$fn=0;
							foreach ($categoryArray->xpath('category') as $categItems) {
								$categItemsAttr=$categItems->attributes();
								$arrayCategories[$fn]=array();
								$arrayCategories[$fn]['catid']=(string)$categItemsAttr['id'];
								$arrayCategories[$fn]['subcategory']=(string)$categItemsAttr['subcategory'];
								$fn++;
							}
						}
						else
						{
							
							$categoryID = $item->categoryId;
							$subcategoryID = $item->subcategory;
						}


							
						
						
						$attr = $item->attributes();
						unset($item);
						$id = (string)$attr["id"];
						
						
						 if(count($arrayCategories)==0)
								{
								
								//запись в category_subcat(id-$id,id_cat-$categoryID,id_subcat-$subcategoryID)
								/*$db->do_insert("INSERT into relation_category values('".$id."','".$categoryID."','".$subcategoryID."')");*/
								$sqlCatOffers[]="('".$id."','".$categoryID."','".$subcategoryID."')";
								
								}
								else
								{
									for($mmmm=0;$mmmm<count($arrayCategories);$mmmm++)
									{
										
										/*$db->do_insert("INSERT into relation_category values('".$id."','".$arrayCategories[$mmmm]['catid']."','".$arrayCategories[$mmmm]['subcategory']."');");*/
										$sqlCatOffers[]="('".$id."','".$arrayCategories[$mmmm]['catid']."','".$arrayCategories[$mmmm]['subcategory']."')";
									}
								}
						
						
						$imgFont=0;
						$imgBack=0;
						
						if($attr["has_front"] and (string)$attr["has_front"]=="Y")
							$imgFont=1;
						if($attr["has_back"] and (string)$attr["has_back"]=="Y")
							$imgBack=1;	
						
						
						
						/*$db->do_insert("INSERT into offerss values('".$id."','".$name."','".$imgFont."','".$imgBack."','',NULL)");*/
						$sqlOffers[]="('".$id."','".$name."','".$imgFont."','".$imgBack."','',NULL)";
						
						self::moAllowed($id);	
						
						unset($attr);
						$prevOffers = $db->do_selectVal("SELECT COUNT(*) as cnt FROM offers_oldid WHERE id='$id'");
						if($prevOffers==0) $db->do_insert("INSERT into offers_oldid values ($id,'');");
						unset($prevOffers);
						
						$newOffers_info=0;
						$issetNewOffers=self::OffersIsset($db,$id);				
						if($issetNewOffers==0)
							$newOffers_info=1;
						
						foreach ($models->xpath('model') as $model) {
						
							$price = (string)$model->price;
							$colors = $model->colors;
							$sex = (string)$model->type;
							
							unset($model);
							
							@$subdata = $db->do_select("select id from sex where path='$sex'");
							unset($sex);
							if(count($subdata)>0)
								$sexId = $subdata[0]['id'];
							else
								$sexId=0;
							unset($subdata);
							
							foreach ($colors->xpath('color') as $color) {
								$colorAtr = $color->attributes();
								unset($color);
								$colorAbr = (string)$colorAtr["id"];
								$hand=0;
								if(isset($colorAtr["hand"]))
									$hand=(string)$colorAtr["hand"];
								unset($colorAtr);
								$colorId=0;
								$colorId = $db->do_selectVal("select id from color where abriv='$colorAbr'");
								
								unset($colorAbr);
								$rukav=0;
								
								self::insertNameOffers($id,$name);
								
								//die($sexID);
								if ($hand != 2)
									{
										/*$db->do_insert("INSERT into relation_type values($id,$sexId,$colorId,$hand,$price)");*/
										self::issetOfAllParamsOffers ($db,$id,$sexId,$price);
										$sqlColorOffers[]="($id,$sexId,$colorId,$hand,$price)";
									}
								else
									{
										/*$db->do_insert("INSERT into relation_type values($id,$sexId,$colorId,0,$price)");
										$db->do_insert("INSERT into relation_type values($id,$sexId,$colorId,1,$price)");*/
										$sqlColorOffers[]="($id,$sexId,$colorId,0,$price)";
										$sqlColorOffers[]="($id,$sexId,$colorId,1,$price)";
										self::issetOfAllParamsOffers ($db,$id,$sexId,$price);
									}
								
								
								unset($colorId);
								unset($rukav);
							}
							unset($colors);
							unset($sexId);
							unset($price);
						}
						unset($models);
			}
			
			unset($xml);
			
			$db->do_insert('insert DELAYED into offerss values'.implode(',',$sqlOffers));
			$db->do_insert('insert DELAYED into relation_type values'.implode(',',$sqlColorOffers));
			$db->do_insert('insert DELAYED into relation_category values'.implode(',',$sqlCatOffers));
			
		
		@unlink('./catalog/offers/offer_'.$_POST['m'].'.xml');
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + $mtime[0];
		$tend = $mtime;
		$timer_st=($tend - $tstart);
		$_POST['time']=$timer_st+$_POST['time'];
		$db = new Database();
		if($_POST['m']==$_POST['all'])
		{
			$sfd=$db->do_select("select count( distinct (oldid) ) as cc from offers");
			$db->do_insert("insert into obnovka values (0,'".date('d.m.Y G:i')."','".$sfd[0]['cc']."','".$_POST['time']."');");
			die(json_encode(array('act'=>2,'all'=>$_POST['all'],'time'=>$_POST['time'],'cc'=>$sfd[0]['cc'],'mem'=>memory_get_usage())));
		}
		else
		{
			$percent=(100*$_POST['m'])/$_POST['all'];
			die(json_encode(array('act'=>1,'time'=>$_POST['time'],'all'=>$_POST['all'],'next'=>($_POST['m']+1),'cc'=>$CountAllPr,'mem'=>memory_get_usage(),'percent'=>(int)$percent)));
		}
		
		 
		
	}
	
	function delcacheAction()
	{
		$db=new Database();
		if(!isset($_SESSION['lastUpdateId'])){
			$_SESSION['lastUpdateId']=self::ReturnNewUpdate($db);	
		}
		$isset=$db->do_select("show table status where Name='offers_oldid'");
		if(count($isset)>0)
                    $db->do_insert('truncate table offers_oldid');
		self::returnDateUpdateXML('./catalog/xmlproduct.xml');
		$cache_settings = Registry::getParam('cache_settings');
		if($cache_settings['typeCaching']=='file'){
		$this->delcashe();
		$this->delcashe('catalog');
		}
		else
		{
			$memcache=new Shop_Memcache();
			if($memcache->connect($cache_settings['CachingIp'], $cache_settings['CachingPort']))
				$memcache->fetch();
			
		}
		include 'library/description_upgrade.php';
		Description::Start();
		$db->do_insert('update update_info set status=1 where id='.$_SESSION['lastUpdateId']);
		die(json_encode(array('act'=>1)));
	}
	
	private function utfArrToCp($arr) {
		foreach($arr as $key=>$val) {
			if (is_array($arr[$key])) $arr[$key] = $this->utfArrToCp($val);
			elseif(!is_numeric($val)) $arr[$key]=$val;
		}
		return $arr;
	}
	
	private function OffersIsset($db,$oldid)
	{
		$sNew=$db->do_select('select count(*) as cc from update_temp_new where id='.$oldid);		
		return $sNew[0]['cc'];		
	}
	private function OffersDel($db,$oldid)
	{
		$sNew=$db->do_select('select count(*) as cc from relation_type where id_offers='.$oldid);
		return $sNew[0]['cc'];		
	}	
	private function OffersNone($db,$oldid)
	{
		$sNew=$db->do_select('select count(*) as cc from offerss where id='.$oldid);
		return $sNew[0]['cc'];		
	}	
	private function OffersRelationTemp($db,$oldid)
	{
		$sNew=$db->do_select('select count(*) as cc from update_temp_relation where id_offers='.$oldid);
		
		return $sNew[0]['cc'];		
	}
	//type=тип операции (1-доб.2-удаление 3-изменение)
	//1-товар 2-макет	
	
	public function endupdateAction()
	{
		//set_time_limit(0);
		$db = new Database();
		$limits=500;
		if(!isset($_POST['started']))
		{
			
			$temp=$db->do_select('select count(*) as cc from offerss');
			$allcount=ceil($temp[0]['cc']/$limits);
			die(json_encode(array('act'=>11,'allcount'=>$allcount)));
		}
		else{
			$arrayInsert=array();
		
			$start=$_POST['started']*$limits;
			$typeActin=1;
			if(!isset($_SESSION['lastUpdateId'])){
				$_SESSION['lastUpdateId']=self::ReturnNewUpdate($db);	
			}
			$thisTempUpdate=$_SESSION['lastUpdateId'];	
						
			$sNew=$db->do_select('select id as oldid from offerss limit '.$start.','.$limits);
			$count=count($sNew);
			for($i=0;$i<$count;$i++)
			{
				$dIn=self::OffersIsset($db,$sNew[$i]['oldid']);
							
				if($dIn==0)
				{				
					//$data['addNewMaket']++;
					//$db->do_insert('insert into offers_version values(0,1,'.$sNew[$i]['oldid'].','.$thisTempUpdate.',"Макет добавлен","",2,0)');
					$arrayInsert[]='(0,1,'.$sNew[$i]['oldid'].','.$thisTempUpdate.',"Макет добавлен","",2,0)';
					$dAdd=self::OffersDel($db,$sNew[$i]['oldid']);
					//$db->do_insert('insert into offers_version values(0,1,'.$sNew[$i]['oldid'].','.$thisTempUpdate.',"Добавлено товаров:'.$dAdd.' ","",1,'.$dAdd.')');
					$arrayInsert[]='(0,1,'.$sNew[$i]['oldid'].','.$thisTempUpdate.',"Добавлено товаров:'.$dAdd.' ","",1,'.$dAdd.')';
				}
				else
				{
					$dAdd=self::OffersDel($db,$sNew[$i]['oldid']);
					if($dAdd>$dIn)
						$arrayInsert[]='(0,1,'.$sNew[$i]['oldid'].','.$thisTempUpdate.',"Добавлено товаров:'.($dAdd-$dIn).' ","",1,'.($dAdd-$dIn).')';
					//$db->do_insert('insert into offers_version values(0,1,'.$sNew[$i]['oldid'].','.$thisTempUpdate.',"Добавлено товаров:'.($dAdd-$dIn).' ","",1,'.($dAdd-$dIn).')');
				}
				unset($sNew[$i]);
			}
			unset($sNew);
			$db->do_insert('insert DELAYED into offers_version values '.implode(',',$arrayInsert));
			//$nextPage=++;
			if($_POST['started'] ==$_POST['allcount'])			
				die(json_encode(array('act'=>1)));
			else
			{
				die(json_encode(array('act'=>12,'next'=>($_POST['started']+1),'allcount'=>$_POST['allcount'])));
			}	
		}
	}
	public function enddelAction()
	{
		//set_time_limit(0);
		$db = new Database();
		if(!isset($_SESSION['lastUpdateId'])){
			$_SESSION['lastUpdateId']=self::ReturnNewUpdate($db);	
		}
		$thisTempUpdate=$_SESSION['lastUpdateId'];
		$limits=500;
		if(!isset($_POST['started']))
		{
			$temp=$db->do_select('select count(*) as cc from update_temp_new');
			$allcount=ceil($temp[0]['cc']/$limits);
			die(json_encode(array('act'=>11,'allcount'=>$allcount)));
		}
		else
		{
			$arrayInsert=array();
			$start=$_POST['started']*$limits;
			$sNew=$db->do_select('select id as oldid from update_temp_new  limit '.$start.','.$limits);
			$count=count($sNew);
			for($i=0;$i<$count;$i++)
			{
				$delM=self::OffersDel($db,$sNew[$i]['oldid']);
				if($delM==0)
				{
					
					//$db->do_insert('insert into offers_version values(0,2,'.$sNew[$i]['oldid'].','.$thisTempUpdate.',"Макет удален","",2,0)');
					$arrayInsert[]='(0,2,'.$sNew[$i]['oldid'].','.$thisTempUpdate.',"Макет удален","",2,0)';
					$dAdd=self::OffersIsset($db,$sNew[$i]['oldid']);
					
					//$db->do_insert('insert into offers_version values(0,2,'.$sNew[$i]['oldid'].','.$thisTempUpdate.',"Удалено товаров:'.$dAdd.' ","",1,'.$dAdd.')');
					$arrayInsert[]='(0,2,'.$sNew[$i]['oldid'].','.$thisTempUpdate.',"Удалено товаров:'.$dAdd.' ","",1,'.$dAdd.')';					
				}
				else{
				
					$delF=self::OffersIsset($db,$sNew[$i]['oldid']);
					if($delF<$delM)
						$arrayInsert[]='(0,2,'.$sNew[$i]['oldid'].','.$thisTempUpdate.',"Удалено товаров:'.($delM-$delF).' ","",1,'.($delM-$delF).')';
					//$db->do_insert('insert into offers_version values(0,2,'.$sNew[$i]['oldid'].','.$thisTempUpdate.',"Удалено товаров:'.($delM-$delF).' ","",1,'.($delM-$delF).')');
					
					
				}
				unset($sNew[$i]);
			}
			unset($sNew);
			$db->do_insert('insert DELAYED into offers_version values '.implode(',',$arrayInsert));
			if($_POST['started'] ==$_POST['allcount'])			
				die(json_encode(array('act'=>1)));
			else
			{
				die(json_encode(array('act'=>12,'next'=>($_POST['started']+1),'allcount'=>$_POST['allcount'])));
			}	
		}		
		
		
		
	}
	
	
	public function ReturnColorsInsert($id,$name)
	{
		$db=new Database();
		
		$colorId = $db->do_select("select count(*) as cc from color where abriv='$id'");
		if ($colorId[0]['cc']==0) 
		{	
			$name=mb_strtolower($name,'utf-8');		
			$db->do_insert("insert into color values(0,'$name','$id')");			
		}
		
	}
	
	public function issetOfAllParamsOffers($dbCon,$id,$sexId,$price)
	{		
		
		$f=$dbCon->do_select("select count(*) as cc from update_temp_relation where id_offers=".$id." and type=".$sexId);
		if($f[0]['cc']!=0)
		{			
			$sNameSex=$dbCon->do_select('select name from sex where id='.$sexId);
			$prs=$dbCon->do_select("select price from update_temp_relation where id_offers=".$id." and type=".$sexId." limit 1" );
			if(intval($prs[0]['price']!=intval($price)))			
			{	
					
				$dC=$dbCon->do_select('select count(*) as cc from `offers_version` where artcl='.$id.' and name="'.$sNameSex[0]['name'].'" and version='.$_SESSION['lastUpdateId']);
				
				if($dC[0]['cc']==0)
				{	$dbCon->do_insert('insert into `offers_version` values(0,3,'.$id.','.$_SESSION['lastUpdateId'].',"Изменена цена с '.$prs[0]['price'].' на '.$price.'","'.$sNameSex[0]['name'].'",1,0)');
				}
				
				
			}
			
		}	
		
			
		
	}
	
	function insertNameOffers($id,$nameS)
	{
		$path=dirname(__FILE__).'/../update';
		$name='/offers_'.$id.'.dat';
		if(file_exists($path)){
			if(!is_writable($path))
				chmod($path,0777);
		}
		else
			mkdir($path,0777);
		if(!file_exists($path.$name))	
			file_put_contents($path.$name,$nameS);	
		
	}
	
	function moAllowed($id)
	{
		$db=new Database();
		$isset=$db->do_select("show table status where Name='offers_oldid'");
		
		if(count($isset)>0)
		{
			$s=$db->do_select('select allowed from offers_oldid where id='.$id);
			if(isset($s[0]))
				$db->do_insert('update offerss set allowed="'.$s[0]['allowed'].'" where id='.$id);
		}
		else
		{
			$s=$db->do_select('select allowed from update_temp_new where id='.$id);
			if(isset($s[0]))
				$db->do_insert('update offerss set allowed="'.$s[0]['allowed'].'" where id='.$id);
		}
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
	function StructCreateBd()
	{
		$db=new Database();
		$db->do_insert("CREATE TABLE IF NOT EXISTS `categories` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `name` varchar(255) DEFAULT NULL,
						  `new` char(1) DEFAULT NULL,
						  `allowed` char(1) DEFAULT NULL,
						  PRIMARY KEY (`id`),
						  INDEX `new` (`new`),
						  INDEX `allowed` (`allowed`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

		$db->do_insert("CREATE TABLE IF NOT EXISTS `color` (
						  `id` int(11) NOT NULL auto_increment,
						  `name` varchar(255) collate utf8_general_ci NOT NULL,
						  `abriv` varchar(255) collate utf8_general_ci NOT NULL,
						  PRIMARY KEY  (`id`),
						  INDEX `abriv` (`abriv`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");



		$db->do_insert ("CREATE TABLE IF NOT EXISTS `seo` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `uri` varchar(255) NOT NULL,
						  `title` text NOT NULL,
						  `keywords` text NOT NULL,
						  `description` text NOT NULL,
						  PRIMARY KEY (`id`),
						  INDEX `uri` (`uri`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;");

		$db->do_insert ("CREATE TABLE IF NOT EXISTS `description_cat` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `id_cat` int(11) NOT NULL,
						  `desc` text COLLATE utf8_general_ci NOT NULL,
						  PRIMARY KEY (`id`),
						  INDEX `id_cat` (`id_cat`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");

		$db->do_insert ("CREATE TABLE IF NOT EXISTS `description_offers` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `id_offers` int(11) NOT NULL,
						  `desc` text COLLATE utf8_general_ci NOT NULL,
						  PRIMARY KEY (`id`),
						INDEX `id_offers` (`id_offers`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");

		$db->do_insert ("CREATE TABLE IF NOT EXISTS `description_subcat` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `id_subcat` varchar(50) NOT NULL,
						  `id_cat` int(11) NOT NULL,
						  `desc` text COLLATE utf8_general_ci NOT NULL,
						  PRIMARY KEY (`id`),
						  INDEX `id_subcat` (`id_subcat`),
						  INDEX `id_cat` (`id_cat`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

						
		$db->do_insert ("CREATE TABLE IF NOT EXISTS `obnovka` (
						  `id` int(11) NOT NULL auto_increment,
						  `data` varchar(255) collate utf8_general_ci NOT NULL,
						  `kolvo` varchar(255) collate utf8_general_ci NOT NULL,
						  `times` varchar(255) collate utf8_general_ci NOT NULL,
						  PRIMARY KEY  (`id`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

		$db->do_insert ("CREATE TABLE IF NOT EXISTS `offerss` (
						`id` int(20) NOT NULL,
						`name` varchar(255) NOT NULL,
						  `front` int(1) NOT NULL,
						  `back` int(1) NOT NULL,
						  `allowed` varchar(5) NOT NULL,
						  INDEX `oldidid` (`id`),
						  INDEX `allowed` (`allowed`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8;");		
									
		$db->do_insert("CREATE TABLE IF NOT EXISTS `update_temp_new` (
						  `id` int(20) NOT NULL,
						  `name` varchar(20) NOT NULL,
						  `id_updating` int(20) NOT NULL,
						  `allowed` varchar(10) not null,
						  INDEX `id` (`id`)
						)ENGINE=MyISAM DEFAULT CHARSET=utf8;");


		$db->do_insert ("CREATE TABLE IF NOT EXISTS `sex` (
						  `id` int(11) NOT NULL auto_increment,
						  `name` varchar(255) collate utf8_general_ci NOT NULL,
						  `path` varchar(255) collate utf8_general_ci NOT NULL,
						  `name_z` varchar(255) collate utf8_general_ci default NULL,
						  `tpl_name` varchar(255) collate utf8_general_ci NOT NULL,
						  `name_alls` varchar(255) collate utf8_general_ci NOT NULL,
						  `params` text NOT NULL,
						  `double` int(2) default '1',
						  PRIMARY KEY  (`id`),
						  INDEX `path` (`path`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;");

		$db->do_insert ("CREATE TABLE IF NOT EXISTS `stat_content` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`title` text NOT NULL,
						`text` mediumtext NOT NULL,
						`keywords` text NOT NULL,
						`url` varchar(255) NOT NULL,
						`froms` tinyint(1) NOT NULL,
						`menu` smallint(1) NOT NULL DEFAULT '0',
						`start` tinyint(1) NOT NULL DEFAULT '0',
						`search_query` varchar(255) NULL,
						PRIMARY KEY (`id`),
						INDEX `url` (`url`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8");

		$db->do_insert ("CREATE TABLE IF NOT EXISTS `menu_stat` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`url` varchar(255) NOT NULL,
						`title` varchar(255) NOT NULL,
						`stat_id` int(11) NOT NULL,
						`position` int(11) NOT NULL,
						`target` tinyint(1) NOT NULL DEFAULT '0',
						PRIMARY KEY (`id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8");
						
		$db->do_insert ("CREATE TABLE IF NOT EXISTS `subcategories` (
						  `id` varchar(50) NOT NULL,
						  `name` varchar(255) DEFAULT NULL,
						  `parentcategoryid` int(11) NOT NULL DEFAULT 0,
						  `allowed` char(1) DEFAULT NULL,
						  PRIMARY KEY (`id`,`parentcategoryid`),
						  KEY `allowed` (`allowed`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

		$db->do_insert ("CREATE TABLE IF NOT EXISTS `zakaz` (
							  `id` int(11) NOT NULL auto_increment,
							  `id_zakaz` int(11) NOT NULL,
							  `id_zakaz_partner` varchar(255) collate utf8_general_ci NOT NULL,
							  `log_zakaza` text collate utf8_general_ci NOT NULL,
							  `info` text collate utf8_general_ci NOT NULL,
							  `adres` varchar(255) collate utf8_general_ci NOT NULL,
							  `dostavka` varchar(255) collate utf8_general_ci NOT NULL,
							  `oplata` varchar(255) collate utf8_general_ci NOT NULL,
							  `fio` varchar(255) collate utf8_general_ci NOT NULL,
							  `tel` varchar(255) collate utf8_general_ci NOT NULL,
							  `email` varchar(255) collate utf8_general_ci NOT NULL,
							  `summasdost` varchar(255) collate utf8_general_ci NOT NULL,
							  `rassilka` tinyint(2) NOT NULL default '0',
							  `partners` varchar(255) collate utf8_general_ci NOT NULL,
							  `status` smallint(2) NOT NULL,
							  `data` int(11) NOT NULL,
							  PRIMARY KEY  (`id`)
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");
							
		$db->do_insert ("CREATE TABLE IF NOT EXISTS `phrases` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `phrases` text CHARACTER SET utf8 NOT NULL,
						  `counts` int(11) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");
							
		$db->do_insert ("CREATE TABLE IF NOT EXISTS `visits` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `data` int(11) NOT NULL,
						  `phrases` text CHARACTER SET utf8 NOT NULL,
						  `zakaz` int(11) NOT NULL,
						  `count_zakaz` int(11) NOT NULL DEFAULT '0',
						  `system_search` varchar(255) CHARACTER SET utf8 NOT NULL,
						  `main_page` varchar(255) CHARACTER SET utf8 NOT NULL,
						  `session_id` varchar(255) CHARACTER SET utf8 NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8  ;");
		
		$db->do_insert("CREATE TABLE IF NOT EXISTS `version` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `version` varchar(255) CHARACTER SET utf8 NOT NULL,
						  `active` int(2) NOT NULL,
						  PRIMARY KEY (`id`),
						  INDEX `version` (`version`),
						  INDEX `active` (`active`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");						

		$db->do_insert("CREATE TABLE IF NOT EXISTS `update_temp` (
						`oldid` int(11) DEFAULT NULL,
						`name` varchar(255) DEFAULT NULL,
						`sexid` int(11) DEFAULT NULL,
						`colors` int(11) DEFAULT NULL,
						`price` varchar(255) DEFAULT NULL,
						`subcategoryid` varchar(20) NOT NULL DEFAULT '',
						`categoryid` int(11) DEFAULT NULL,
						`rukav` int(2) NOT NULL DEFAULT '0',
						`id_updating` int(11) NOT NULL,
						KEY `oldid` (`oldid`),					  
						KEY `subcategoryid` (`subcategoryid`),
						KEY `categoryid` (`categoryid`),
						KEY `sexid` (`sexid`),
						KEY `colors` (`colors`),
						KEY `rukav` (`rukav`),
						KEY `id_updating` (`id_updating`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

		$db->do_insert("CREATE TABLE IF NOT EXISTS `offers_version` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `type` smallint(2) NOT NULL DEFAULT '1',
						  `artcl` int(11) NOT NULL,
						  `version` int(11) NOT NULL,
						  `info` text NOT NULL,
						  `name` varchar(255) NOT NULL,
						  `type_action` tinyint(3) NOT NULL DEFAULT '1',
						  `counts` int(11) NOT NULL,
						  PRIMARY KEY (`id`),
						  KEY `artcl` (`artcl`),
						  KEY `type` (`type`),
						  KEY `name` (`name`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8");

		$db->do_insert("CREATE TABLE IF NOT EXISTS `update_info` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`date` int(11) NOT NULL,
						`status` tinyint(3) NOT NULL DEFAULT '0',
						PRIMARY KEY (`id`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8");	
						
		$db->do_insert("CREATE TABLE IF NOT EXISTS `update_date_xml` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`date_xml` varchar(255) NOT NULL,
						`date` int(11) NOT NULL,
						`url` varchar(255) NOT NULL,						
						PRIMARY KEY (`id`),
						KEY `date_xml` (`date_xml`),
						KEY `url` (`url`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8");
	}
	
	
}
?>