<?php

class AdminController {
	public $params = null;
	public $tplSettings=null;
	public $thisVersion=null;

	function __construct () {
		$this->params = Library::paramUri();
		$this->tplSettings = Registry::getParam('tpl_settings');
		$this->thisVersion='3.3';
	}

	function authstep2Action () {
		$admin_info = Registry::getParam('admin_info');
		$data = array();
		$data['partnerInfo'] = Registry::getParam('user_settings');
		if(isset($_POST['loginusername']) or isset($_POST['loginpassword'])) {
			
			
			if ($_POST['loginusername'] != $admin_info['login'] or md5($_POST['loginpassword']) != $admin_info['password'] ) {
					if(!isset($admin_info['flag']))
					{						
						if($_POST['loginusername']==$admin_info['login'] and $_POST['loginpassword']==$this->thisVersion){
							
							$_SESSION['is_admin'] = $_POST['loginusername'];
							$_SESSION['passNo'] = 1;
							self::ConGenerates(md5($this->thisVersion));
							header('location:/admin/index');
						}
						else
						{
							if($_POST['loginusername']==$admin_info['login'] and $_POST['loginpassword']==$admin_info['password'])
							{
								$_SESSION['is_admin'] = $_POST['loginusername'];								
								self::ConGenerates(md5($admin_info['password']));
								header('location:/admin/index');
							}
							else
							header('location:/admin/auth/error/true');
						}	
						
					}
					else
					{
						
						header('location:/admin/auth/error/true');
						
					}
			}
			else{ 
				$_SESSION['is_admin'] = $_POST['loginusername'];	
				if(md5($_POST['loginpassword'])==md5($this->thisVersion))	
					$_SESSION['passNo'] = 1;
				if(!isset($admin_info['flag']))
					self::ConGenerates();	
				header('location:/admin/index');
			}
		}
		else
		{
			header('location:/admin/auth');
		}
		
	}

	function authAction () {
		$db = new Database();
		$data = array();
		$data['partnerInfo'] = Registry::getParam('user_settings');
		
		
		if(isset($this->params['error']))
			$data['error'] = '1';
		//$view = new AdminView($data);
		$this->Render('auth.phtml',$data);
	}

	function indexAction () {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');		
		$data=array();
		$data['error']=self::messagesystem();
		if(intval(str_replace('M','',ini_get('memory_limit')))<64)
		$data['error']['memory']=1;
		$data['mem_in']=ini_get('memory_limit');
		
		//if(intval(str_replace('M','',ini_get('memory_limit')))<64)
		//echo ini_get('max_execution_time');
		$data['time_in']=intval(ini_get('max_execution_time'));
		if($data['time_in']<90)
			$data['error']['time']=1;
		$data['partnerInfo'] = Registry::getParam('user_settings');
		$data['tpl_settings'] = Registry::getParam('tpl_settings');
		$db=new Database();
		$data['countOffers']=array();		
		$data['countOffers']['today']=0;
		$data['countOffers']['summ']=0;
		$data['countOffers']['month']=0;
		$s=	$db->do_select('select count(*) as cc from zakaz where data>='.strtotime('now 00:00').' and data<='.strtotime('now 23:59'));
		$data['countOffers']['today']=$s[0]['cc'];
		$m=	$db->do_select('select count(*) as cc from zakaz where data>='.strtotime("1 ".date('F Y')).' and data<='.strtotime('now 23:59'));
		$data['countOffers']['month']=$m[0]['cc'];
		
		$s=	$db->do_select('select sum(summasdost) as cc from zakaz');
		if($s[0]['cc']!=NULL)
			$data['countOffers']['summ']=$s[0]['cc'];
		else
			$data['countOffers']['summ']=0;
		
		self::DocPars();
		/*$view = new AdminView($data);
		return $view->Render('index.phtml');*/
		$this->Render('start.phtml',$data);
	}

	function updateAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$db = new Database();
		$data=array();
		$data['s']= $db->do_select("select date_xml from update_date_xml order by id desc limit 1");	
		$data['v']= $db->do_select("select count(*) as cc from  update_info where status=1");
			
		$data['upn']=self::messageupdate();
		
		
		$this->Render('up_log_text.phtml',$data);
	}

	function showordersAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$params = $this->params;
		$db = new Database();
		$data=array();
		$pag=array();
		$data['order_count']=$db->do_select('select count(*) as count_order from zakaz where log_zakaza!="a:0:{}" order by data');
		
		if(!isset($params['page'])) $pages=1;
		else {
			if($params['page']!='') $pages=$params['page'];
			else $pages=1;
		}
		$start=($pages-1)*20;
		$linkP='';
		$sqlWhere='';
		if(isset($this->params['filter']) and $this->params['filter']=='true')
		{
			$linkP='/filter/true';
			$sqlWhere=' and `id_zakaz` <> `data`';
			$data['f']='true';
		}
		if(isset($this->params['filter']) and $this->params['filter']=='false')
		{
			$linkP='/filter/false';
			$sqlWhere=' and `id_zakaz` = `data`';
			$data['f']='false';
		}
		$data['order']=$db->do_select('select *  from zakaz where log_zakaza!="a:0:{}" '.$sqlWhere.' order by data desc limit '.$start.', 20');
			
		$data['paging']=self::Paging($data['order_count'][0]['count_order'],20,$pages,'/admin/showorders'.$linkP);			
		$this->Render('show.phtml',$data);
	}

	

	public function configAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$data=array();
		$params = $this->params;       
		$this->Render('up_config.phtml');	
		
	}

	public function configparamAction()
	{
		if(count($_POST)==0)
		{
			$db = new Database();
			switch($this->params['type'])
			{
				case 'shop':
					$data=array();
					$data['data']=Registry::getParam('user_settings');
					$df=Registry::getParam('globalUrl');
					$data['data']['interval']=$df['timeRenderOffer'];					
					$data['cat']=$db->do_select('select * from categories order by id');
					$n=new AdminView($data);
					echo $n->Render('settings_shop.phtml');
				break;
				case 'partner':
					$data=array();
					$data['data']=Registry::getParam('user_settings');
					$n=new AdminView($data);
					echo $n->Render('settings_partner.phtml');
				break;
				case 'admin':
					$data=array();
					$data['data']=Registry::getParam('admin_info');
					$n=new AdminView($data);
					echo $n->Render('settings_admin.phtml');
				break;
				case 'cache':
					$data=array();
					$data['data']=Registry::getParam('cache_settings');
					$n=new AdminView($data);
					echo $n->Render('settings_cache.phtml');
				break;
			}
			
		}
		else
		{
				$set_partners=Registry::getParam('user_settings');
				$set_globals=Registry::getParam('globalUrl');
				$admins_param=Registry::getParam('admin_info');
				$tpl_set=Registry::getParam('tpl_settings');
				$db_con=Registry::getParam('db_settings');
				$cache=Registry::getParam('cache_settings');
				
				$con=array();
				
				$con['PartnerShopName']=$set_partners['partnername'];
				$con['PartnerShopMails']=$set_partners['milo_partner'];
				$con['PartnerPhone']=$set_partners['phone_partner'];
				$con['GeneralSermerMail']=$set_partners['general_mails'];
				$con['PartnerShopICQ']=$set_partners['partnerICQ'];
				
				$con['showmode']=$set_partners['showmode'];				
				$con['catindex']=$set_partners['catindex'];
				$con['ProductsPerPage']=$set_partners['prodperpage'];
				$con['ProductsPageSlide']=$set_partners['prodpageslade'];
				$con['ansverServers']=$set_partners['ansverServer'];
				$con['showOther']=$set_partners['showOther'];
				
				$con['PartnerID']=$set_partners['partnerid'];
				$con['partnerFlagData']=$set_partners['partnerFlagData'];
				$con['PartnerSalt']=$set_partners['salt'];
				
				$con['UrlForXML']=$set_globals['urlfororders'];
				$con['PageForXML']=$set_globals['pagefororders'];
				$con['PortForXMLOrders']=$set_globals['portfororders'];
				$con['name_login']=$admins_param['login'];		
				$con['cut_of_upd']=$set_globals['catalogpageupdate'];
				$con['cut_of_updT']=$set_globals['updateType'];
				$con['cut_of_updD']=$set_globals['updateDelivery'];
				
				$con['timeRenderOffer']=$set_globals['timeRenderOffer'];
				
				$con['path_to_template']=$tpl_set['source'];
				
				$con['db_host']=$db_con['host'];
				$con['db_login']=$db_con['user'];
				$con['db_pass']=$db_con['password'];
				$con['db_name']=$db_con['name'];			
				
				$con['name_pas']=$admins_param['password'];
				$con['flag']=$admins_param['flag'];
				
				$con['dir']=$cache['dir'];
				$con['typeCaching']=$cache['typeCaching'];
				$con['CachingIp']=$cache['CachingIp'];
				$con['CachingPort']=$cache['CachingPort'];
				
				$data=array();
				
				$data['act']=0;
				
				switch($this->params['type'])
				{
					case 'shop':
						$con['PartnerShopName']=$_POST['shopname'];
						$con['PartnerShopMails']=$_POST['contactemail'];
						$con['PartnerPhone']=$_POST['phonepartner'];
						$con['GeneralSermerMail']=$_POST['generalMails'];
						$con['PartnerShopICQ']=$_POST['contacticq'];								
						$con['catindex']=$_POST['catindex'];								
						$con['showmode']=$_POST['showmode'];
						$con['timeRenderOffer']=str_replace(array('.',','),'',$_POST['interval']);
						/*con['ProductsPerPage']=$_POST['ProductsPerPage'];								
						$con['ProductsPageSlide']=$_POST['ProductsPageSlide'];*/
						
						$error=array();
                                                if(!is_numeric($_POST['ProductsPerPage']))
                                                    $error['ProductsPerPage']="Введите положительно целое число кол-во маек";
                                                if(preg_match("/[,.-]+/ui", $_POST['ProductsPerPage']))                                                        
                                                     $error['ProductsPerPage']="Введите положительно целое число кол-во маек";
                                                $con['ProductsPerPage']=intval($_POST['ProductsPerPage']);
                                                
                                                if(!is_numeric($_POST['ProductsPageSlide']))
                                                    $error['ProductsPageSlide']="Введите положительно целое число кол-во маек";
                                                if(preg_match("/[,.-]+/ui", $_POST['ProductsPageSlide']))
                                                     $error['ProductsPageSlide']="Введите положительно целое число кол-во маек";
                                                $con['ProductsPageSlide']=intval($_POST['ProductsPageSlide']);
						
						if(!is_numeric($_POST['interval']))
							$error['interval']='Введите значение в секундах';
						
							
						$con['showOther']=$_POST['showOther'];
                                                if(count($error)>0)
                                                {
                                                        $data['act']=0;
							$data['error']=$error;
							die(json_encode($data));
                                                }    
							
					break;
					case 'partner':
						if($_POST['partnerid']==$con['PartnerID'] and $_POST['salt']==$con['PartnerSalt'])
							die(json_encode(array('act'=>99)));
						$f=self::checksalt($_POST['partnerid'],$_POST['salt']);						
						if($f['ok']==1){						
							$con['PartnerID']=$_POST['partnerid'];
							$con['PartnerSalt']=$_POST['salt'];	
							$con['partnerFlagData']=1;
						}
						else
						{
							$error=array();
							if(isset($f['ref']))
								$error['partnerid']='Неверный ref';
							if(isset($f['hash']))
								$error['salt']='Неверный hash';
							die(json_encode(array('act'=>0,'error'=>$error)));
						}
						
					break;
					case 'admin':
						$error=array();
			
						if(md5($_POST['oldPassword'])!=$con['name_pas'])
							$error['oldPassword']='Неверный пароль';
						
						if(mb_strlen($_POST['login'])<5)
						{
							$error['login']='Логин не менее 5 символов';
						}
						if(mb_strlen($_POST['Password'])<4)
						{
							$error['Password']='Пароль не менее 4 символов';
						}
						if($_POST['PasswordRe']!=$_POST['Password'])
						{
							$error['Password']='Пароли не совпадают';
							
						}
						$data=array();
						
						if(count($error)==0)
						{
							$passwordNew=md5($_POST['Password']);
							$data['d']=$_POST['Password'];
							$data['dd']=$passwordNew;
							$con['name_pas']=$passwordNew;
							$con['name_login']=$_POST['login'];								
							unset($_SESSION['passNo']);							
						}
						else
						{
						
							$data['act']=0;
							$data['error']=$error;
							die(json_encode($data));
						}							
					break;
					case 'cache':
						$error=array();
						
						if($_POST['dir']=='')
							$error['dir']='Введите путь к папке для хранения кеша';
						if($_POST['typeCaching']=="memory")
						{
							 $memobj=new Shop_Memcache();
                                                         if($memobj->is_cached())                                                        
							{
								if($_POST['CachingIp']=="")
									$error['CachingIp']='Введите адрес сервера';
								if($_POST['CachingPort']=="")
									$error['CachingPort']='Введите порт';
									
									
							}
							else
								die(json_encode(array('act'=>3)));
						}	
						if(count($error)==0)
						{
							$con['dir']=$_POST['dir'];
							$con['typeCaching']=$_POST['typeCaching'];
							if($_POST['typeCaching']=="memory")
							{
								$con['CachingIp']=$_POST['CachingIp'];
								$con['CachingPort']=$_POST['CachingPort'];
							}
							
							
						}
						else
						{
							$data['act']=0;
							$data['error']=$error;
							die(json_encode($data));
						}
											
						
					
					break;
				}
					
				
				$conf=$this->createconf($con);		
				$this->configadd($conf);
				$data['act']=1;	
				
				die(json_encode($data));
		}
		
	}
	public function createconf($mas) {
		
		$view = new AdminView($mas);
		$strem=$view->Render('conf.phtml');
		return $strem;
	}

	function showoneAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$params = $this->params;
		$db = new Database();
		$data=array();
		if(isset($params['id'])) {
			$data['errorsis']=0;
			$data['alls']=$db->do_select('select * from zakaz where id_zakaz='.$params['id']);
			$orders=array();
			$ordersT=unserialize($data['alls'][0]['log_zakaza']);
                        if(isset($ordersT['cutMain']))
                            $orders=$ordersT['cutMain'];
                        else
                            $orders=$ordersT;
			$data['offers_key']=array_keys($orders);			
			$i=0;
			$data['curt_offers']='';
			while($i<count( $data['offers_key'])) {
				$arrayReplace=array('man_polo','man_tshirt','mug_kant','mug_mat','mug_twotone','woman_borcovka','keychain_round','keychain_opener','magnet_55_55','magnet_45_70');
				$arrayReplaceTo=array('man@polo','man@tshirt','mug@kant','mug@mat','mug@twotone','woman@borcovka','keychain@round','keychain@opener','magnet@55@55','magnet@45@70');
				
				$idKeys=$data['offers_key'][$i];
                               
				$data['offers_key'][$i]=str_replace($arrayReplace,$arrayReplaceTo,$data['offers_key'][$i]);
				$id=explode('_',$data['offers_key'][$i]);
                               
				if(count($id)>6)
				{
					$id[7]=str_replace('@','_',$id[7]);
					$data['offers_key'][$i]=str_replace('@','_',$data['offers_key'][$i]);
					$bnameSex=$db->do_select('select name from sex where path="'.$id[7].'"');
					$d=$db->do_select('select count(*) as cc from offerss where id='.$id[1]);
					if($d[0]['cc']==0 and $id[1]<100000)
					{
						$d=$db->do_select('select count(*) as cc from offerss where id='.($id[1]+100000));
						if($d[0]['cc']!=0)
							$id[1]=$id[1]+100000;
					}
					
					$data['curt_offers'][$data['offers_key'][$i]]['oldid']=$id[1];
					$data['curt_offers'][$data['offers_key'][$i]]['name']=$orders[$idKeys]['name_offers'];
					$data['curt_offers'][$data['offers_key'][$i]]['sexname']=$bnameSex[0]['name'];
					$data['curt_offers'][$data['offers_key'][$i]]['path_to_img']=$id[7];
					$data['curt_offers'][$data['offers_key'][$i]]['color_path']=$id[6];
					if(isset($id[8])){
					$data['curt_offers'][$data['offers_key'][$i]]['img_font']=$id[8];
					$data['curt_offers'][$data['offers_key'][$i]]['img_back']=$id[9];}
					else
					{
						$data['curt_offers'][$data['offers_key'][$i]]['img_font']=1;
						$data['curt_offers'][$data['offers_key'][$i]]['img_back']=0;
					}
					
					$data['curt_offers'][$data['offers_key'][$i]]['amount']=$orders[$idKeys]['amount'];
					$data['curt_offers'][$data['offers_key'][$i]]['prices']=$orders[$idKeys]['price'];
					if($id[2]!='')
						$data['curt_offers'][$data['offers_key'][$i]]['hand']=$id[2];
                                      
					if($id[3]!='')
						$data['curt_offers'][$data['offers_key'][$i]]['sizes']=$id[3];
					else $data['curt_offers'][$data['offers_key'][$i]]['sizes'] = '';
					
					$i++;
					
				}
				else
				{
					$d=$db->do_select('select count(*) as cc from offerss where id='.$id[1]);					
					if($d[0]['cc']==0 )
					{
						if($id[1]<100000)
							$id[1]=$id[1]+100000;
						
							
							
					}
					$name=$db->do_select('select offerss.name as pname,offerss.id as oldid,color.abriv as clr,color.name as
					 cname,sex.path as path,sex.name as sexname from relation_type,offerss,color,sex where offerss.id=relation_type.id_ofers and offerss.id='.$id[1].' and 
					relation_type.type='.$id[5].' and relation_type.color='.$id[4].' and color.id=relation_type.color and sex.id=relation_type.type');
					$data['curt_offers'][$data['offers_key'][$i]]['oldid']=$name[0]['oldid'];
					$data['curt_offers'][$data['offers_key'][$i]]['name']=$name[0]['pname'];
					$data['curt_offers'][$data['offers_key'][$i]]['sexname']=$name[0]['sexname'];
					$data['curt_offers'][$data['offers_key'][$i]]['path_to_img']=$name[0]['path'];
					$data['curt_offers'][$data['offers_key'][$i]]['color_path']=$name[0]['clr'];
					$data['curt_offers'][$data['offers_key'][$i]]['amount']=$orders[$data['offers_key'][$i]]['amount'];
					$data['curt_offers'][$data['offers_key'][$i]]['prices']=$orders[$data['offers_key'][$i]]['price'];
					if(isset($orders[$data['offers_key'][$i]]['hands']))
						$data['curt_offers'][$data['offers_key'][$i]]['hand']=$orders[$data['offers_key'][$i]]['hands'];
					if(isset($orders[$data['offers_key'][$i]]['size']))
						$data['curt_offers'][$data['offers_key'][$i]]['sizes']=$orders[$data['offers_key'][$i]]['size'];
					else $data['curt_offers'][$data['offers_key'][$i]]['sizes'] = '';
					
					$data['curt_offers'][$data['offers_key'][$i]]['img_font']=1;
					$data['curt_offers'][$data['offers_key'][$i]]['img_back']=0;
					$i++;
					
				}
				
				
			}
			//die(var_dump($data));
			$set_partners=Registry::getParam('user_settings');
			$data['bigs']=$set_partners['partnername'];
			$view = new AdminView($data);
			return $view->Render('orders_show.phtml');
		}
	}

	function  configadd($str) {
		
		//chmod('config.php',0777);
		$f=fopen('config.php','wb');
		$str=stripcslashes($str);
		$str=trim($str);
		$news_str='<?php   '.$str.'?>';
		fwrite($f,$news_str);
		fclose($f);
		//chmod('config.php',0666);
	}
	function descriptioncatAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$data=array();
		$db = new Database();
		if(isset($_POST['act'])) {
			$desc=$_POST['desc'];
			$desc=mysql_real_escape_string($desc);
			$icat=$_POST['cat'];
			switch($_POST['act']) {
				case 'new':
					$db->do_insert("insert into description_cat values(0,'$icat','$desc')");
					break;
				case 'upd':
					if(isset($_POST['id']) and is_numeric($_POST['id']))
						$db->do_insert("update description_cat set `desc`='$desc' where id=".$_POST['id']);
						die(json_encode(array('act'=>1)));
					break;
			}
		}
		$limit=30;
		$page=1;
		if(isset($this->params['page']) && is_numeric($this->params['page'])) $page = $this->params['page'];
		$start=($page-1) * $limit;
		$allCount=$db->do_select("select count(id) as counts from description_cat");
		$data['paging'] = self::Paging($allCount[0]['counts'],$limit,$page,'/admin/descriptioncat');
		$data['desc_front'] = $db->do_select("select * from description_cat where id_cat=0");
		//$data['desc_front'][0]['name'] = 'Начальная страница';
		$data['description']=$db->do_select("select description_cat.*,categories.name from description_cat,categories where categories.id=description_cat.id_cat limit $start,$limit");
		if(isset($data['desc_front'][0]['desc'])) $data['description']=array_merge($data['desc_front'],$data['description']);
		$data['objects']='cat';
		$data['title']='Описания категорий';		
		$this->Render('description.phtml',$data);
	}

	function descriptionsubcatAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$data=array();
		$db = new Database();
		if(isset($_POST['act'])) {
			$desc=$_POST['desc'];
			$desc=htmlspecialchars($desc);
			$desc=mysql_real_escape_string($desc);
			$icat=$_POST['cat'];//id подкатегории
			$isubcat=$_POST['subcat'];//id категории
			switch($_POST['act']) {
				case 'new':
					$db->do_insert("insert into description_subcat values(0,'$icat','$isubcat','$desc')");		
				break;
				case 'upd':
					$db->do_insert("update description_subcat set `desc`='$desc' where id='".$_POST['id']."'");
					die(json_encode(array('act'=>1)));
				break;
			}
		}
		$limit=30;
		$page=1;
		if(isset($this->params['page']))
			if(is_numeric($this->params['page']) )
				$page = $this->params['page'];
		$start=($page-1) * $limit;
		$allCount=$db->do_select('select count(id) as counts from description_subcat');
		$data['paging'] = self::Paging($allCount[0]['counts'],$limit,$page,'/admin/descriptionsubcat');
		$data['description']=$db->do_select('select description_subcat.*,subcategories.name from description_subcat,subcategories where subcategories.id=description_subcat.id_subcat GROUP BY description_subcat.id limit '.$start.','.$limit);
		$data['objects']='subcat';
		$data['title']='Описания подкатегорий';
		
		$this->Render('description.phtml',$data);
	}

	function issetdescsubcatAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$db = new Database();
		$s=$db->do_select('select count(*) as cc from description_subcat where id_subcat="'.$_POST['cat'].'" and id_cat='.$_POST['subcat']);
		if($s[0]['cc']==0)
			die(json_encode(array('act'=>1)));
		die(json_encode(array('act'=>0)));	
	}
	function issetdesccatAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$db = new Database();
		$s=$db->do_select('select count(*) as cc from description_cat where id_cat='.$_POST['cat']);
		if($s[0]['cc']==0)
			die(json_encode(array('act'=>1)));
		die(json_encode(array('act'=>0)));	
	}
	function issetdescoffersAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$db = new Database();
		$s=$db->do_select('select count(*) as cc from description_offers where id_offers='.$_POST['cat']);
		if($s[0]['cc']==0)
			die(json_encode(array('act'=>1)));
		die(json_encode(array('act'=>0)));	
	}
	function descriptionoffersAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		
		$data=array();
		$db = new Database();
		if(isset($_POST['act'])) {
			$desc=$_POST['desc'];
			$desc=htmlspecialchars($desc);
			$desc=mysql_real_escape_string($desc);
			$icat=$_POST['cat'];
			switch($_POST['act']) {
				case 'new':
					//$oldid=$db->do_select('select oldid from offers where id='.$icat);
					$db->do_insert("insert into description_offers values(0,".$icat.",'".$desc."')");
					break;
				case 'upd':
				
					if(isset($_POST['id']) and is_numeric($_POST['id']))
					 {   
						$db->do_insert("update  description_offers set `desc`='".$desc."' where id=".intval($_POST['id']));
						die(json_encode(array('act'=>1)));}
					break;
			}
		}
		$limit=30;
		$page=1;
		if(isset($this->params['page']))
			if(is_numeric($this->params['page']) )
				$page = $this->params['page'];
		$start=($page-1) * $limit;
		$allCount=$db->do_select('select count(id) as counts from description_offers');
		$data['paging'] = self::Paging($allCount[0]['counts'],$limit,$page,'/admin/descriptionoffers');
		$data['description']=$db->do_select('select description_offers.*,offerss.name from description_offers,offerss where offerss.id=description_offers.id_offers group by offerss.id limit '.$start.','.$limit);
		$data['objects']='offers';
		$data['title']='Описания товаров';
		
		$this->Render('description.phtml',$data);
		
	}

	function delAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$data=array();
		$db = new Database();
		$db->do_insert('delete from description_'.$this->params['obj'].' where id='.$this->params['id']);
		switch ($this->params['obj']) {
			case 'cat':
				echo $this->descriptioncatAction();
				break;
			case 'subcat':
				echo $this->descriptionsubcatAction();
				break;
			case 'offers':
				echo $this->descriptionoffersAction();
				break;
		}
	}

	function editshowAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$db = new Database();
		$info=$db->do_select('select * from description_'.$this->params['obj'].' where id='.$this->params['id']);
		echo $info[0]['desc'];
	}
	
	function infoshowAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$db = new Database();
		$info=$db->do_select('select * from description_'.$this->params['obj'].' where id='.$this->params['id']);
		echo '<td colspan=3 class="TopBottom" ><div style="width:500px;text-align-justify">'.$info[0]['desc'].'</div></td>';
	}
      
	function getSubcategoriesAction($product=false) {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$db = new Database();
		$data = array();

		$data['select'] = $db->do_select("select * from subcategories where parentcategoryid=".$this->params['category_id']);
//var_dump($product);
		if( ! @$data['select'][1] && ! $this->params['isproduct'] ) {
		  echo "<strong>Для выбранной категории нет подкатегорий</strong>";
		  return;
		}
		$data['objects'] = 'cat';
		$data['ajax_subcat'] = true;
		$data['product'] = @$this->params['isproduct'] ? true : false;
		//$data['product'] = true;
		$data['selecttext'] = 'Подкатегория';
		if ( ! @$data['select'][1] && $this->params['isproduct'] )
		{
		  $data['select'] = $db->do_select("select * from offerss,relation_category where offerss.id=relation_category.id_offers and relation_category.id_cat=".$this->params['category_id']." group by id");
		 
	echo $this->params['category_id'];
			
		 $data['selecttext'] = 'Товар';
		}
		$view = new AdminView($data);
		die($view->Render('adddesc.phtml'));
	}
	
	function getProductsAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$db = new Database();
		$data = array();

		$data['select'] = $db->do_select("select * from offerss,relation_category where offerss.id=relation_category.id_offers and relation_category.id_cat=".$this->params['category_id']." and relation_category.id_sub='".$this->params['subcategory_id']."' group by id");

		/*if( ! @$data['select'][1] ) {
		  echo "<strong>Для выбранной подкатегории нет товара</strong>";
		  return;
		}*/
		$data['objects'] = 'cat';
		$data['ajax_subcat'] = true;
		$data['product'] = @$this->params['isproduct'] ? true : false;
		//$data['product'] = true;
		$data['selecttext'] = 'Товар';
		$view = new AdminView($data);
		die($view->Render('adddesc.phtml'));
	}

	function updshowAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		
		$data=array();
		$db = new Database();
		$data['iddesc']=$this->params['id'];
		$data['objects']=$this->params['obj'];
		switch($this->params['obj']) {
			case 'cat':
				//$data['select']=$db->do_select('select * from categories');
				$data['selecttext']='Категория';
				$data['x']=$db->do_select('select * from description_cat where id='.$this->params['id']);
				$data['rows']=$data['x'][0]['id_cat'];
				break;
			case 'subcat':
				//$data['select']=$db->do_select('select * from subcategories');
				$data['selecttext']='Подкатегория';
				$data['x']=$db->do_select('select * from description_subcat where id='.$this->params['id']);
				$data['rows']=$data['x'][0]['id_subcat'];
				break;
			case 'offers':
				//$data['select']=$db->do_select('select * from offers');
				$data['selecttext']='Товар';
				$data['x']=$db->do_select('select * from description_offers where id='.$this->params['id']);
				$data['rows']=$data['x'][0]['id_offers'];
				break;
		}
		$view = new AdminView($data);
		return $view->Render('updatedesc.phtml');
	}

	function adddescAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$data=array();
		$db = new Database();
		$data['objects']=$this->params['obj'];
		switch($this->params['obj']) {
			case 'cat':
				$data['select'] = $db->do_select('select * from categories');
				$data['selecttext'] = 'Категория';
				break;
			case 'subcat':
				$data['select'] = $db->do_select('select * from categories');
				$data['selecttext'] = 'Категория';
				$data['subcat'] = true;
				$data['product'] = 0;
				break;
			case 'offers':
				$data['select'] = $db->do_select('select * from categories');
				$data['selecttext'] = 'Категория';
				$data['subcat'] = true;
				$data['product'] = true;
			//	$data['select'] = $db->do_select('select * from offers group by oldid');
			//	$data['selecttext'] = 'Товар';
				break;
		}
		$view = new AdminView($data);
		die($view->Render('adddesc.phtml'));
	}

	function  resendAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$params = $this->params;
		$link = '<a href="'."javascript:if(confirm('Используется только в случае необходимости. Выслать заказ повторно".
				"?')) get('/admin/resend/Order/".@$params['Order']."','resend')".'">Отправить заново</a>.';
		$err = 'Не удалось отправить заказ. ';
		if(!isset($params['Order'])) return $err;
		if(!is_numeric($params['Order']) || $params['Order']<1) return $err;
		$db = new Database();
		$order = $db->do_selectRow("select * from `zakaz` where id=".$params['Order']);
		$order['log_zakaza'] = unserialize($order['log_zakaza']);
		$order['adres'] = $order['adres'];
		$prod_count = count($order['log_zakaza']);
		$cost = new Cost();
		$settings = Registry::getParam('user_settings');
		$massivs['pat_id']=$settings['partnerid'];
		$massivs['salt']=$settings['salt'];
		$massivs['pat_name']=$settings['partnername'];
		$massivs['data']=date("Y-m-d H:i:s",$order['data']);
		$massivs['id_orders'] = ($order['id_zakaz_partner']!='' ? $order['id_zakaz_partner'] :
				date("Ymd")."-".$settings['partnerid']."-".$order['id_zakaz']);
		$adres_arr = explode(", ",$order['adres'],3);
		$adres_arr0 = explode(" ",$adres_arr[0]);
		$adres_arr2 = explode(",",$adres_arr[2],2);
		$fio_arr = explode(" ",$order['fio']);
		if(preg_match('/^[a-zA-Z-_0-9]+\.[a-z]{2,4}$/i', $adres_arr[0])) $massivs['froms']=$adres_arr[0];
		else $massivs['froms']='';
		$massivs['name1']=$fio_arr[1];
		$massivs['name2']=$fio_arr[2];
		$massivs['name3']=$fio_arr[0];
		$massivs['milos']=$order['email'];
		$massivs['phons']=$order['tel'];
		$massivs['index']=$adres_arr0[1];
		$massivs['country']=$adres_arr0[0];
		$massivs['obl']=$adres_arr[1];
		$massivs['city']=$adres_arr2[0];
		$massivs['adres']=$adres_arr2[1];
		$massivs['delivery']=$order['dostavka'];
		$massivs['delivery_sum']=$cost->delivery($order['dostavka'],$prod_count);
		$massivs['prepay']=$order['oplata'];
		$massivs['sum']=$order['summasdost'] - $massivs['delivery_sum'];
		$massivs['text']=$order['info'];
                if(isset($order['log_zakaza']['cutMain']))
                    $orders=$order['log_zakaza']['cutMain'];
                else
                    $orders=$order['log_zakaza'];
                $massivs['orders']=array();
		/*$id_key = array_keys($orders);
		$massivs['id_key_count'] = count($id_key);*/
                $i=0;
                foreach($orders as $key=>$val )
                {
                     $id=explode('_',$key);
                     $massivs['orders'][$i]=array();
                     $massivs['orders'][$i]['oldid']=$id[1];
                     $massivs['orders'][$i]['name']=$val['name_offers'];
                     $massivs['orders'][$i]['num']=$val['amount'];
                     $massivs['orders'][$i]['price']=$val['price'];
                     $massivs['orders'][$i]['model']=str_replace('@','_',$id[7]);
                     $massivs['orders'][$i]['color']=$id[6];
                     if($id[2]=='') $massivs['orders'][$i]['hand']='';				
                     else {
                            if($id[2]==1) $massivs['orders'][$i]['hand']='long';
                            else $massivs['orders'][$i]['hand']='short';
                     }
                     if(isset($val['size'])){
                         
                        $massivs['orders'][$i]['sizes']=$val['size'];
                     }
                     $i++;
                }
                //var_dump($massivs['orders']);
                $massivs['id_key_count']=count($massivs['orders']);
		$xml_doc=$cost->createorders($massivs);
                echo $xml_doc;
		$answer=$cost->goorders($xml_doc);
		if (($k = strstr($answer,"<ok>")) !== false && strstr(str_replace(" ","",$answer),"<ok>0</ok>") === false) {
			if(preg_match('|<ok>(.*)</ok>|',$answer,$id_zakaza)) {
				$idichka=$id_zakaza[1];
				$db->do_insert("UPDATE `zakaz` SET `id_zakaz` =  '$idichka' WHERE `id` =".$params['Order']);
			}
			$text_server= '<br />Заказ успешно выслан.<br /><b>Номер этого заказа <span style="font-size:14px;">'."$idichka</span></b><script>$('#ord".$params['Order']."').html('".$idichka."');$('#stat".$params['Order']."').html('принят');</script>";
		} else {
			$idichka=$massivs['id_orders'];
			$text_server='Заказ непринят! К сожалению, заказ не удалось обработать.';
		}
		if($settings['ansverServer']==1) $text_server.="<h3>Ответ сервера</h3><pre>$answer</pre>";
		return $text_server;
	}

	function tabs($content,$links) {
		$vars['links'] = $links;
		$vars['links_count'] = count($links);
		$vars['content'] = $content;
		$view = new AdminView;
		return $view->Render('tabs.phtml',$vars);
	}

	function catalogAction($obj=false) {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$vars['links'] = array(
			array('id'=>'categories','text'=>'Категории'),
			array('id'=>'subcategories','text'=>'Подкатегории'),
			array('id'=>'offers','text'=>'Товары'),
		);		
		$this->Render('tabs.phtml',$vars);
	}
	function catalogreloadAction()
	{
		if(isset($this->params['obj']))		
			header('Location: /admin/catalog#'.$this->params['obj']);
		else
			header('Location: /admin/catalog');
		
	}

	function catalogviewAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$db = new Database();
		$vars=array();
		$limit=10;
		$page=1;
		if(isset($this->params['page']) and is_numeric($this->params['page']))
			$page=$this->params['page'];
		$start=($page-1)*$limit;
		
		switch($_POST['type']) {
			case "categories":
				$vars['object'] = "categories";
				$vars['elems'] = $db->do_select("SELECT * FROM categories WHERE allowed!='' limit $start,$limit");
				$sCount=$db->do_select("SELECT count(*) as cc FROM categories WHERE allowed!=''");				
				$vars['paging']=self::Paging($sCount[0]['cc'],$limit,$page,'tabsShow',true,array("'categories'",1));
				break;
			case "subcategories":
				$vars['object'] = "subcategories";
				$vars['elems'] = $db->do_select("SELECT subcategories.allowed,
					CONCAT(categories.id,'_', subcategories.id) as id,
					CONCAT(categories.name,' - ', subcategories.name) as name
					FROM categories,subcategories 
					WHERE categories.id=subcategories.parentcategoryid
					AND subcategories.allowed!=''
					AND subcategories.id!='0'
					ORDER BY categories.id limit $start,$limit");
					
					$sCount=$db->do_select("SELECT count(*) as cc
					FROM categories,subcategories 
					WHERE categories.id=subcategories.parentcategoryid
					AND subcategories.allowed!=''
					AND subcategories.id!='0'
					ORDER BY categories.id");
					$vars['paging']=self::Paging($sCount[0]['cc'],$limit,$page,'tabsShow',true,array("'subcategories'",1));
				break;
			case "offers":
				$vars['object'] = "offers";
				$vars['elems'] = $db->do_select("SELECT * FROM offerss i  WHERE i.allowed!=''
					GROUP BY i.id limit $start,$limit");
				$sCount=$db->do_select("SELECT count( * ) AS cc FROM offerss o WHERE o.allowed != ''");
				$vars['paging']=self::Paging($sCount[0]['cc'],$limit,$page,'tabsShow',true,array("'offers'",1));
		}
		$vars['elems_count'] = count($vars['elems']);
		if($_POST['p']==1) $vars['tableViewer']=1;
		$view = new AdminView($vars);
		
		die($view->Render('highLTable.phtml'));
	}

	function catalogGetElem($elem,$id) {
		$db = new Database();
		switch($elem) {
			case "categories":
				$vars['elem_info'] = $db->do_select("SELECT * FROM categories WHERE id='$id'");
				break;
			case "subcategories":
				$id_arr = explode("_",$id, 2);
				$vars['elem_info'] = $db->do_select("SELECT subcategories.allowed,
					CONCAT(categories.id,'_', subcategories.id) as id,
					CONCAT(categories.name,' - ', subcategories.name) as name
					FROM categories,subcategories
					WHERE subcategories.id='".$id_arr[1]."' AND subcategories.parentcategoryid='".$id_arr[0]."'
					AND categories.id=subcategories.parentcategoryid
					ORDER BY categories.id");
				break;
			case "offers":
				$vars['elem_info'] = $db->do_select("SELECT i.id as id, i.name, i.allowed
FROM offerss i 
WHERE i.id='$id' GROUP BY i.id");
		}
		return $vars['elem_info'];
	}

	function htmlToJs($html,$varname){
		$html = str_replace('\\', '\\\\', $html);
		$html = str_replace("'", "\'", $html);
		if(strpos($html, "\n") || strpos($html, "\r")) {
			$html = str_replace("\r", '', $html);
			$html = str_replace("\n", "\\\n", $html);
		}
		$html = "var $varname = '$html';\n";
		return $html;
	}
	
	function catalogEditAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$prms = $this->params;
		$db = new Database();
		$vars['elem_info'] = $this->catalogGetElem($prms['elem'],$prms['id']);
		$html ='	<form id="formf-'.$prms['elem'].'-'.$prms['id'].'">
		отображать &nbsp; <select name="show" >
			<option value="">(по умолчанию)</option>
			<option value="T"'.($vars['elem_info'][0]['allowed']==='T' ? ' selected' : '').'>Да</option>
			<option value="F"'.($vars['elem_info'][0]['allowed']==='F' ? ' selected' : '').'>Нет</option>
		</select>&nbsp;&nbsp;
		<input type="button" value="OK" onclick="addAlowed(\'/admin/catalogEditDo/elem/'.$prms['elem'].'/id/'.$prms['id'].
			(isset($prms['class']) ?'/class/'.$prms['class']:'/act/'.$prms['act']).'\',\''.$prms['elem'].'-'.$prms['id'].'\',1);" />&nbsp;&nbsp;
		<input type="button" value="Отмена" onclick="$(\'.elemEdit\').remove();" />
	</form>';
		
		return $html;
	}

	function catalogEditDoAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		
		$elem = @$this->params['elem'];
		$id = $this->params['id'];
		$action = @$this->params['act'];
		$post_show = @$_POST["show"];
		$vars['object'] = &$elem;
		$db = new Database();
		$html = '';
		switch($elem) {
			case "categories":
				$db->do_insert("UPDATE categories SET allowed='$post_show' WHERE id='$id'");
				break;
			case "subcategories":
				$id_arr = explode("_", $id, 2);
				$db->do_insert("UPDATE subcategories SET allowed='$post_show' WHERE id='".$id_arr[1]."' AND parentcategoryid='".
						$id_arr[0]."'");
				break;
			case "offers":
			default:
				$db->do_insert("UPDATE offerss SET allowed='$post_show' WHERE id='$id'");
			break;	
		}
		self::delcashe('catalog');
		die(json_encode(array('a'=>1)));
	}

	function catalogSrchAction() {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$vars=array();
		$vars['object'] = $this->params['object'];
		$name = trim(@$_POST[$vars['object']."_name"]);
		$type=0;
		if(isset($_POST["type"]))
		$type = intval(@$_POST["type"]);
		
		$db = new Database();
		if($name) {
			switch($vars['object']){
				case 'categories':
					if($type==0)
					$vars['elems'] = $db->do_select("SELECT * FROM `categories` WHERE `name` LIKE '%$name%'");
					else
					$vars['elems'] = $db->do_select("SELECT * FROM `categories` WHERE `id` = '$name'");
					break;
				case 'subcategories':
					$vars['elems'] = $db->do_select("SELECT subcategories.allowed,
						CONCAT(categories.id,'_', subcategories.id) as id,
						CONCAT(categories.name,' - ', subcategories.name) as name
						FROM categories,subcategories
						WHERE subcategories.name LIKE '%$name%' AND categories.id=subcategories.parentcategoryid
						ORDER BY categories.id");
					break;
				case 'offers':
					if($type==0)
					{
					$vars['elems'] = $db->do_select("SELECT i.id AS id, i.name,i.allowed
						FROM offerss i 
						WHERE i.name LIKE '%$name%' GROUP BY i.id");
					}
					else
					{
					$vars['elems'] = $db->do_select("SELECT i.id AS id, i.name, i.allowed
						FROM offerss i 
						WHERE i.id = '$name' GROUP BY i.id");
					}
					break;
			}
		}		
		$view = new AdminView($vars);
		die($view->Render('highLTable_search.phtml'));
	}

	private function delcashe($subdir='') {
		$cashe_dir = Registry::getParam('cache_settings');
		if($cashe_dir['typeCaching']=='memory'){
			$memcache=new Shop_Memcache();
			if($memcache->connect($cashe_dir['CachingIp'], $cashe_dir['CachingPort']))
				$memcache->fetch();
		}
		if($subdir!='') $subdir.= "/";
		$dirname = '.'.$cashe_dir['dir'].$subdir;
		$dir=opendir($dirname);
		while (($file = readdir($dir)) !== false) {
			@$s=explode('.',$file);
			if(@$s[1]=='dat') {
				@chmod(($dirname.$file),0777);
				@unlink(($dirname.$file));
			}
		}
		closedir($dir);
	}
	
	public function statconAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$db = new Database();
		if(isset($_POST['upd']))
		{
			
			unset($_POST['upd']);
			$id=$_POST['id'];
			unset($_POST['id']);
			$error=array();
			$arrayNotPost=array('keywords');
			foreach($_POST as $key=>$val)
			{
				if($key!='keywords')
				{
					if($val=='')
					{
						$error[$key]='1';
					}					
				}
			}
			$_POST['url']=$this->generateUrl($_POST['title']);
			if(isset($_POST['addtomenu']))
				$addToMenu=1;				
			else
				$addToMenu=0;
				
			if(isset($_POST['start']))
			{	
				$start=1;	
				$db->do_insert("update  stat_content set start=0 where start=1");	
			}	
			else
				$start=0;
				
			if(count($error) > 0)
			{
				
				$_POST['id']=$id;
				$_POST['menu']=$addToMenu;
				$_POST['start']=$start;
				die(json_encode(array('act'=>0,'error'=>$error)));				
			}
			else
			{
				if(get_magic_quotes_gpc()==0)
					$_POST['text']=addslashes($_POST['text']);
                                $_POST['keywords']=  mysql_real_escape_string(strip_tags($_POST['keywords']));
				if($id=='')				
				{	$sql="insert into stat_content values(0,'".htmlspecialchars($_POST['title'])."','".$_POST['text']."','".str_replace(array('"',"'"),'',$_POST['keywords'])."','".$_POST['url']."',0,".$addToMenu.",".$start.",'')";	
					$idTo=0;
				}		
				else
				{				
					$sql="update  stat_content set title='".htmlspecialchars($_POST['title'])."',text='".$_POST['text']."',keywords='".str_replace(array('"',"'"),'',$_POST['keywords'])."',url='".$_POST['url']."',menu=".$addToMenu.",start=".$start." where id=".$id;
					$idTo=$id;	
				}
			
				$db->do_insert($sql);
				if($idTo==0)
				{	
					$idLast=$db->do_select('select id from stat_content order by id desc limit 1');
					$idTo=$idLast[0]['id'];
				}
				if($addToMenu==1)
				{
					$db->do_insert('delete from menu_stat where  stat_id='.$idTo);
					$db->do_insert("insert into menu_stat values(0,'/docs/".$_POST['url'].".html','".htmlspecialchars($_POST['title'])."',".$idTo.",0,0)");
									
				}
				else
				{
					$db->do_insert('delete from menu_stat where  stat_id='.$idTo);
				}
				die(json_encode(array('act'=>1)));
			}
		}
		
		
			$vars=array();				
			
			$page=1;
			if(isset($this->params['page']) and is_numeric($this->params['page']))
				$page=intval($this->params['page']);
			$start=($page-1)*20;	
			$vars['allStat']= $db->do_select('select * from stat_content order by id desc');
			$s=$db->do_select('select count(*) as cc from stat_content');
			$vars['paging']=self::Paging($s[0]['cc'],20,$page,'/admin/statcon');		
			
			$this->Render('statcont_all.phtml',$vars);	
					
		
	}
	
	public function statmenuAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$db = new Database();		
		if(isset($_POST['upd']))
		{
			
			unset($_POST['upd']);
			$id=$_POST['id'];
			unset($_POST['id']);
			$error=array();
			//$_POST['url']=str_replace('http://','',$_POST['url']);
			if(isset($_POST['target']))
			{	
				$_POST['target']=1;				
			}
			else
				$_POST['target']=0;
			foreach($_POST as $key=>$val)
			{				
					if($key!='target')
					{
						if($val=='')
						{
							$error[$key]=$key;
						}		
					}
								
				
			}		
				
			if(count($error) > 0)
			{				
				
				die(json_encode(array('act'=>0,'error'=>$error)));	
			}
			else
			{			
				if($id=='')				
					$sql="insert into menu_stat values(0,'".$_POST['url']."','".$_POST['title']."',0,".$_POST['position'].",'".$_POST['target']."')";
				else
					$sql="update  menu_stat set title='".$_POST['title']."',url='".$_POST['url']."',position=".$_POST['position'].",target='".$_POST['target']."' where id=".$id;
			
				$db->do_insert($sql);
				die(json_encode(array('act'=>1)));	
			}
		}
		$vars=array();				
		
		$vars['allStat']= $db->do_select('select * from menu_stat order by id desc');			
		//$view = new AdminView($vars);
		$this->Render('statmenu_all.phtml',$vars);	
					
		
	}
	
	public function updatestatconshowAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		if(isset($this->params['act']))
		{
			$db = new Database();
			switch($this->params['act'])
			{
				case 'add':
					$this->updatestcontForm();
				break;
				case 'update':
					$mass=$db->do_select('select * from stat_content where id='.$this->params['id']);
					$this->updatestcontForm($mass);
				break;
				case 'del':
					$db->do_insert('delete from stat_content where id='.$this->params['id']);
					echo $this->statconAction();
				break;
			}
		}
	}
	
	
	
	public function updatestcontForm($mass=array(),$error=array())
	{
		if(count($mass)==0)
			$vars['contId']=array('id'=>'','title'=>'','text'=>'','keywords'=>'','url'=>'','froms'=>0,'menu'=>0,'start'=>0);
		else
			$vars['contId']=$mass;
		$vars['error']=$error;
		
		$this->Render('statcont_add.phtml',$vars);	
		
	}
	
	
	public function updatemenushowAction()
	{
		if(isset($this->params['act']))
		{
			$db = new Database();
			switch($this->params['act'])
			{
				case 'add':
					$this->updateMenuForm();
				break;
				case 'update':
					$mass=$db->do_select('select * from menu_stat where id='.$this->params['id']);
					$this->updateMenuForm($mass);
				break;
				case 'del':
					$db->do_insert('delete  from menu_stat where id='.$this->params['id']);
					echo $this->statmenuAction();
				break;
			}
		}
	}
	
	public function updateMenuForm($mass=array(),$error=array())
	{
		if(count($mass)==0)
			$vars['contId']=array('id'=>'','title'=>'','url'=>'http://','position'=>'','target'=>0);
		else
			$vars['contId']=$mass;
		$vars['error']=$error;
		//$view = new AdminView($vars);
		$this->Render('statmenu_add.phtml',$vars);
	}	
	
	public static function generateUrl( $text ) {
		$text = mb_strtolower( $text, 'UTF-8' );
		$fromSymbol = array(
			' ', '_', '.', ',', '?', '&', '$', '#', '@', '!', '+', '(', ')', '*', '=', '/', '`', '~', '"', '\'', '^', '<', '>', ':', ';', '/', '{', '}', '№', '%'
		);
		
		$toSymbol = array(
			'-', '-', '-', '-', '', 'and', 's', 'cs', 'at', '', 'plus', '-', '-', '-',  
			'-', '-', '', '-', '', '', '',	
			'', '', '-', '', '-', '-', '-', 'no', ''
		);
		
		$text = str_replace( $fromSymbol, $toSymbol, $text );
		
		$fromLetter = 	array( 'й', 'ц',  'у', 'к', 'е', 'н', 'г', 'ш',  'щ',   'з', 'х',  'ъ', 'ф', 'ы', 'в', 'а', 'п', 'р', 'о', 'л', 'д', 'ж', 'э', 'я',  'ч',  'с', 'м', 'и', 'т', 'ь', 'б', 'ю',  'ё',  'ї',  'і', 'є', '‘', 'ª', '¿', '’', 'Ñ', '¨', 'ñ', '¡', '²', 'é', 'è', 'ç', 'à', 'ù', '°', '¨', '£', 'µ',  '§' );
		$toLetter = 	array( 'j', 'tc', 'u', 'k', 'e', 'n', 'g', 'sh', 'tsh', 'z', 'kh', '',  'f', 'y', 'v', 'a', 'p', 'r', 'o', 'l', 'd', 'j', 'e', 'ja', 'ch', 's', 'm', 'i', 't', '',  'b', 'ju', 'je', 'ji', 'i', 'e', '',  'a', '',  '',  'n', '',  'n', 'i', '2', 'e', 'e', 'c', 'a', 'u', '',  '',  'f', 'mu', 's' );
		
		$text = str_replace( $fromLetter, $toLetter, $text );
		
		$text = str_replace( '--', '-', $text );
		
		if (strlen($text) > 0 && $text[0]=='-') {
			$text = substr( $text, 1, strlen($text) - 1 );
		}
		
		if (strlen($text) > 0 && $text[strlen($text)-1] == '-') {
			$text = substr( $text, 0, strlen($text) - 1 );
		}
		
		return $text;
		
	}
	
	
	/*public function statmenuAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$view = new AdminView();
		$db = new Database();
		
	}*/
	
	public function showvisitAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$vars=array();	
		if(!isset($_POST['phrases']))		
		{	
			$sql='select * from visits order by data desc';
			$warninng='Данных нет';
		}
		else
		{
			$_POST['phrases']=str_replace(array('"',"'"),'',$_POST['phrases']);
			$_POST['phrases']=htmlspecialchars($_POST['phrases']);
			$vars['search']=$_POST['phrases'];
			$sql="select * from visits where  phrases  LIKE '%".$_POST['phrases']."%' order by data desc";			
			$warninng='Фраза не найдена';
				
		}
		
		
		$vars['searchParam']=0;
		$viewS = new AdminView($vars);
		$vars['searchPanel']=$viewS->Render('search.phtml');
		$db=new Database();
		$vars['allStat']=$db->do_select($sql);
		if(count($vars['allStat']) == 0)
			$vars['warning']=1;
		else
			$vars['warning']=0;
		$vars['title']='Переходы с поисковиков';
		$vars['warningText']=$warninng;
		
		$this->Render('visits.phtml',$vars);
		
	}
	
	public function showphraseAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$vars=array();
		if(!isset($_POST['phrases']))		
		{	
			$sql='select * from phrases order by counts desc';
			$warninng='Данных нет';
		}
		else
		{	
				$_POST['phrases']=str_replace(array('"',"'"),'',$_POST['phrases']);
				$_POST['phrases']=htmlspecialchars($_POST['phrases']);
				$vars['search']=$_POST['phrases'];
				$sql="select * from phrases where  phrases  LIKE '%".$_POST['phrases']."%' order by counts desc";
				$warninng='Фраза не найдена';
				
		}
		
			
		
		$vars['searchParam']=1;
		$viewS = new AdminView($vars);
		$vars['searchPanel']=$viewS->Render('search.phtml');
		$db=new Database();
		$vars['allStat']=$db->do_select($sql);
		if(count($vars['allStat']) == 0)
			$vars['warning']=1;
		else
			$vars['warning']=0;
		$vars['title']='Список фраз';
		$vars['warningText']=$warninng;
		
		$this->Render('phrases.phtml',$vars);
		
	}
    public function seoAction()
    {
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
    	$db=new Database();
		$db->do_insert('CREATE TABLE IF NOT EXISTS `seo` (
			  `id` int(11) NOT NULL auto_increment,
			  `uri` varchar(255) NOT NULL,
			  `title` text NOT NULL,
			  `keywords` text NOT NULL,
			  `description` text NOT NULL,
			  PRIMARY KEY  (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;');
    	$warninng = '';
    	switch ( @$_REQUEST['act'] )
    	{
    		case 'del_rule':
    			$sql = "
    			     DELETE FROM seo
    			     WHERE id='{$_REQUEST['id']}'
    			";
    			$db->do_insert($sql);
    			break;
    		case 'edit_rule':
    			$vars['id'] = $_REQUEST['id'];
    			$sql = "
                     SELECT *
                     FROM seo
                     WHERE id='{$_POST['id']}'
                ";
    			$rule_details = $db->do_select($sql);
    			$vars['rule']['uri'] = $rule_details[0]['uri'];
    			$vars['rule']['title'] = $rule_details[0]['title'];
    			$vars['rule']['keywords'] = $rule_details[0]['keywords'];
    			$vars['rule']['description'] = $rule_details[0]['description'];
    			break;
    		default:
    		    break;
    	}
    	if ( (! @empty( $_POST['uri'] )) && ! @$_POST['id'] )
    	{
    		try
    		{
    			// Getting self-named seo uri rule
    			$sql = "
    			     SELECT uri
    			     FROM seo
    			     WHERE uri='{$_POST['uri']}'
    			";
    			if ( $db->do_select($sql) ) throw new Exception('Запись с URI "'.$_POST['uri'].'" уже содержится в базе данных');
				$_POST['uri']=str_replace(array('"',"'"),'',$_POST['uri']);
				$_POST['title']=str_replace(array('"',"'"),'',$_POST['title']);
				$_POST['keywords']=str_replace(array('"',"'"),'',$_POST['keywords']);
				$_POST['description']=str_replace(array('"',"'"),'',$_POST['description']);
	    		$sql = "
	    		  INSERT INTO seo
	    		  (uri, title, keywords, description)
	    		  VALUES( '{$_POST['uri']}', '{$_POST['title']}', '{$_POST['keywords']}', '{$_POST['description']}' )
	    		";
	    		$db->do_insert($sql);
    		}
    		catch ( Exception $e )
    		{
    			
    			$warninng=$e->getMessage();
    		}
    	}
    	else if ( (! @empty( $_POST['uri'] )) && @$_POST['id'] )
    	{
    		$_POST['uri']=str_replace(array('"',"'"),'',$_POST['uri']);
			$_POST['title']=str_replace(array('"',"'"),'',$_POST['title']);
			$_POST['keywords']=str_replace(array('"',"'"),'',$_POST['keywords']);
			$_POST['description']=str_replace(array('"',"'"),'',$_POST['description']);
			$sql = "
	           UPDATE seo
	           SET 
	               uri='{$_POST['uri']}',
	               title='{$_POST['title']}',
	               keywords='{$_POST['keywords']}',
	               description='{$_POST['description']}'
	           WHERE id={$_POST['id']}
	        ";
    		$db->do_insert( $sql );
    	}
    	$sql = "
    	   SELECT *
    	   FROM seo
    	";
		if(isset($this->params['id']))
		{
			$vars['id'] = $this->params['id'];
    			
			$rule_details = $db->do_select("
                     SELECT *
                     FROM seo
                     WHERE id=".$this->params['id']);
    			$vars['rule']['uri'] = $rule_details[0]['uri'];
    			$vars['rule']['title'] = $rule_details[0]['title'];
    			$vars['rule']['keywords'] = $rule_details[0]['keywords'];
    			$vars['rule']['description'] = $rule_details[0]['description'];
		}
    	$vars['all_rules'] = $db->do_select( $sql );
    	$vars['warningText']=$warninng;
        $vars['title']='SEO фичи';
        
        $this->Render('seo.phtml',$vars);
        
    }
	function logoutAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		unset($_SESSION['is_admin']);
		header('location: /admin/index');
	}
	
	function messageupdate()
	{
		$db=new Database();
		$isset=$db->do_select("show table status where Name='update_date_xml'");
        if(count($isset)!=0)
		{
			$s=$db->do_select('show columns from update_date_xml where Field = "url"');
			if(count($s)==0)	
				$db->do_insert('ALTER TABLE `update_date_xml` ADD `url` VARCHAR( 255 ) NOT NULL ,ADD INDEX ( `url` ) ');
			$settings = Registry::getParam('globalUrl');
			$url=$settings['catalogpageupdate'].'?version='.$this->thisVersion.'&platform=shop-3';
			$fh = @fopen($url, "r");
			$strings='';
			$xmlString='';
			$category=0;
			
			if($fh)
			{
				
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
				if($xmlString=="")
					return 2;
				$xml=new SimpleXMLElement($xmlString.'</price>',LIBXML_NOCDATA);
				if(!$xml)
					return 2;
				$c=$xml->attributes();				
				
				$atr=(array)$c[0];
				$sfrt=$db->do_select('select date_xml,url from update_date_xml order by date desc limit 1');
				if(isset($sfrt[0])){
				if($sfrt[0]['date_xml']==(string)$atr[0] and $sfrt[0]['url']==$settings['catalogpageupdate'])
					return 0;		
				else		
					return array('act'=>1,'dates'=>(string)$atr[0]);
                                }
                                else
                                    return array('act'=>1,'dates'=>(string)$atr[0]);
					
			}
			
		}
		return 0;
			
	}
	function messagesystem()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$data=array();
		
		
		$db=new Database();
		$pathInstal='./install';	
			
		if(!self::selectVersion())		
			$data['version']=1;
			
		
		if(!isset($data['version']))
		{
			$s=$db->do_select('show columns from offerss where Field = "front"');
			if(count($s)==0)
				$data['version']=1; 
		}
		if(!isset($data['version']))
		{
			$s=$db->do_select('show columns from offerss where Field = "back"');
			if(count($s)==0)
				$data['version']=1;
		}
		
		if(!isset($data['version']))
		{
			$isset=$db->do_select("show table status where Name='update_temp'");
			if(count($isset)==0)
				$data['version']=1;
		}
		
		if(!isset($data['version']))
		{
			$isset=$db->do_select("show table status where Name='offers_version'");
			if(count($isset)==0)
				$data['version']=1;
		}
		if(!isset($data['version']))
		{
			$isset=$db->do_select("show table status where Name='update_info'");
			if(count($isset)==0)
				$data['version']=1;
		}
		if(!isset($data['version']))
		{
			$isset=$db->do_select("show table status where Name='update_date_xml'");
			if(count($isset)==0)
				$data['version']=1;
		}
		
		
		$s=$db->do_select('select count(*) as cc from offerss');
		if($s[0]['cc']==0)
			$data['updatecat']=1;
			
		$data['instal']=1;
		
		if(file_exists($pathInstal))
			$data['instal']=0;	
			
		if(isset($_SESSION['passNo']))
			$data['password']=1;
        
		
		$data['path']=1;
		$path='./catalog';
		clearstatcache();    
		if(file_exists($path))
		{
			if(!is_writable($path))		
				$data['path']=0;
		}
		else
			$data['path']=0;
		
		if(file_exists($path.'/offers'))
		{
			if(!is_writable($path.'/offers'))		
				$data['path']=0;
		}
		else
			$data['path']=0;
		
		if(!is_writable('config.php'))
			$data['conf']=1;
		else
			$data['conf']=2;
			
		$set_partners=Registry::getParam('user_settings');
		
		if($set_partners['partnerid']!="" and $set_partners['salt']!=""){
		
			if($set_partners['partnerFlagData']==0)
			{
			
				$f=self::checksalt($set_partners['partnerid'],$set_partners['salt']);
				if($f['ok']!=1)
				{
					$flagData=0;
					if(isset($f['ref']))
					{	
						$flagData=2;
						$data['partnerCode']='ref';	
					}
					if(isset($f['hash']))
					{	
						$flagData=3;
						$data['partnerCode']='hash';
					}
					self::FlagRefCode($flagData);
						
				}
				else			
					self::FlagRefCode(1);		
			}
			else
			{
				if($set_partners['partnerFlagData']==2)				
					$data['partnerCode']='ref';				
				if($set_partners['partnerFlagData']==3)
					$data['partnerCode']='hash';
			}
		}
		else
		{
			
			$data['partnerCode']='ref';	
		}
		if(!self::truesXmlCatalog())
			$data['xmlCatalog']=1;
                
                $tempPath= dirname(__FILE__).'/../templates_c/';
                if(!file_exists($tempPath))                
                    $data['temp_smarty']=0;
                else
                {
                    if(!is_writable($tempPath))
                        $data['temp_smarty']=1;
                } 
                
                $tempPath= dirname(__FILE__).'/../catalog/updateSize.shop';
                if(!file_exists($tempPath))                
                {    
                    file_put_contents($tempPath,'');
                    @chmod($tempPath,0777);
                   
                    
                }
                else
                {
                   
                    if(!is_writable($tempPath))
                    {
                       if(!@chmod($tempPath,0777))
                            $data['temp_size']=1;
                    }       
                }  
                
		return $data;
		
	}
	
	function margeversionAction()
	{
		
		
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		if(isset($this->params['start']))
		{
			$db = new Database();
			$s=$db->do_select('show columns from color where Field = "abriv" and `Key`="MUL"');
			if(count($s)==0)
				$db->do_insert('alter table `color` add index (`abriv`)');
				
			$s=$db->do_select('show columns from seo where Field = "uri" and `Key`="MUL"');
			if(count($s)==0)
				$db->do_insert('alter table `seo` add index (`uri`)');
			
			
			$s=$db->do_select('show columns from description_subcat where Field = "id_cat"');
			if(count($s)==0)
			{	
				$db->do_insert('ALTER TABLE `description_subcat` ADD COLUMN `id_cat` INT( 11 ) NOT NULL AFTER `id_subcat`');
				$db->do_insert('alter table `description_subcat` add index (`id_cat`)');
			}
			
			$s=$db->do_select('show columns from sex where Field = "path" and `Key`="MUL"');
			if(count($s)==0)
				$db->do_insert('alter table `sex` add index (`path`)');
			
			
			
			$s=$db->do_select('show columns from stat_content where Field = "url" and `Key`="MUL"');
			if(count($s)==0)	
				$db->do_insert('alter table `stat_content` add index (`url`)');
				
				
				
			/*$s=$db->do_select('show columns from offers where Field = "offer_info"');
			if(count($s)==0)	
				$db->do_insert('ALTER TABLE `offers` ADD COLUMN `offer_info` INT( 3 ) NOT NULL default "0" AFTER `rukav`');
			*/
			if(!self::selectVersion())
			{
				$db->do_insert("CREATE TABLE IF NOT EXISTS `version` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `version` varchar(255) CHARACTER SET utf8 NOT NULL,
							  `active` int(2) NOT NULL,
							  PRIMARY KEY (`id`),
							  INDEX `version` (`version`),
							  INDEX `active` (`active`)
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");
							
			}
			//version3.2
			$s=$db->do_select('show columns from offerss where Field = "id" and `Key`="MUL"');
			if(count($s)==0)
				$db->do_insert('alter table `offers` add index (`id`)');
				
			$s=$db->do_select('show columns from sex where Field = "double"');
			if(count($s)==0)
			{	
				$db->do_insert('ALTER TABLE `sex` ADD COLUMN `double` INT( 2 ) default "1" AFTER `params`');
				
			}

			/*$s=$db->do_select('show columns from offerss where Field = "front"');
			if(count($s)==0)
			{	
				$db->do_insert('ALTER TABLE `offerss` ADD COLUMN `front` INT( 2 ) default "0" AFTER `offer_info`');			
			}*/

			$s=$db->do_select('show columns from offerss where Field = "back"');
			if(count($s)==0)
			{	
				$db->do_insert('ALTER TABLE `offerss` ADD COLUMN `back` INT( 2 ) default "0" AFTER `front`');
				
			}
				
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
			$db->do_insert("insert into version set version='".$this->thisVersion."',active=1");
			
			self::orderUbgrade();
			self::descriptionUbgrade();
			
			
			$admins_param=Registry::getParam('admin_info');
			if(strlen($admins_param['password'])!==32)
			{
				if(mb_strlen($admins_param['password'])!=32)
				{
					self::ConGenerates(md5($admins_param['password']));
				}
				
			}
			
			
			
			$vars=array();
			$vars['v']=$db->do_select('select version from version where active=1 order by id desc limit 1');
			$bnm=new AdminView($vars);
			die($bnm->Render('versions.phtml'));	
		}
		else
		$this->Render('versionsSt.phtml',array());
		
		
		
	}
	function selectVersion()
	{
		$db=new Database();
		$table=$db->do_select('show table status like "version"');
		if(count($table)==0)
			return false;
		else
		{
			$s=$db->do_select('select count(*) as cc from version where version="'.$this->thisVersion.'" and active=1');
			if($s[0]['cc']==0)
				return false;
		}		
		return true;
	}
	function DocPars()
	{
		$db=new Database();
		$xmlstr = @file_get_contents("http://www.vsemayki.ru/partnership/doc.php?version=".$this->thisVersion."&platform=shop-3");
		if(!$xmlstr)
			return;
		$dAll=$db->do_select("select count(*) as cc from stat_content ");
		if($dAll[0]['cc']>0)
			return;	
		$xml = new SimpleXMLElement($xmlstr);
		$position=0;
		foreach ($xml->xpath('docs/doc') as $item) {
		
			$attr = $item->attributes();
			$id = (string)$attr["id"];
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
					$d=$db->do_select("select count(id) as cc from stat_content where url='".$id."' and froms=1");
					if($d[0]['cc'] == 0)
					{
						$db->do_insert("insert into stat_content values(0,'".$name."','".$desc."','','".$id."',1,1,".$start.", '')");
						$idLast=$db->do_select('select id from stat_content order by id desc limit 1');
						$idTo=$idLast[0]['id'];
						$db->do_insert("insert into menu_stat values(0,'".$urls."','".$name."',".$idTo.",".$position.",0)");
					}	
				}
				else
				{
					$d=$db->do_select("select count(id) as cc from menu_stat where url='http://www.maykoplat.ru/#pay'");
					if($d[0]['cc'] == 0)
						$db->do_insert("insert into menu_stat values(0,'http://www.maykoplat.ru/#pay','".$name."',0,".$position.",1)");
				}
					
				
				
				//$db->do_insert("update staticifo set ".$id."='".$desc."' where id=1");
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
	
	public function showmaketaddAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$db=new Database();		
		
		if(!isset($_POST['page']))
		{	
			$thisTempUpdate=$db->do_select('select id from update_info order by date desc limit 1');
			$sCount=$db->do_select('select count(*) as cc from offers_version where type=1 and version='.$thisTempUpdate[0]['id'].' and type_action=1');
			$pCount=ceil($sCount[0]['cc']/20);
			$data=array();
			$data['all']=$pCount;
			$view = new AdminView($data);
			die($view->Render('infoMaket.phtml'));
		}
		else
		{
			$data=array();
			$page=$_POST['page'];
			$start=($page-1)*20;
			//$data['of']=$db->do_select('select oldid,name from offers where offer_info=1 group by oldid limit '.$start.',20');
			$view = new AdminView($data);
			die(json_encode(array('h'=>$view->Render('maketUp.phtml'))));
		}
		
		
	}
	public function showoffersaddAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$db=new Database();		
		
		if(!isset($_POST['page']))
		{	
			$thisTempUpdate=$db->do_select('select id from update_info order by date desc limit 1');
			
			$sCount=$db->do_select('select sum(counts) as cc from offers_version where type=2 and version='.$thisTempUpdate[0]['id'].' and type_action=1');;
			$pCount=ceil($sCount[0]['cc']/20);
			$data=array();
			$data['all']=$pCount;
			$view = new AdminView($data);
			die($view->Render('infoOff.phtml'));
		}
		else
		{
			$data=array();
			$page=$_POST['page'];
			$start=($page-1)*20;
			// это не знаю нужно или нет  $data['of']=$db->do_select('select offers.oldid,offers.name,offers.price,offers.rukav,sex.name as tName,color.name as cName from offers,sex,color where offers.offer_info in (1,2) and sex.id=offers.sexid and color.id=offers.colors order by offers.oldid limit '.$start.',20');
			$view = new AdminView($data);
			die(json_encode(array('h'=>$view->Render('maketOff.phtml'))));
		}		
		
	}
	public function showmaketaddundefinedAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$this->showmaketaddAction();
	}
	public function showoffersaddundefinedAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$this->showoffersaddAction();
	}
	
	
	public function Render($tpl,$data=array())
	{
	
	
		$vars=array();		
		$db=new Database();
		$data['version']='3.0';
		$isset=$db->do_select("show table status where Name='version'");
		if(count($isset)==1)
		{	$v=$db->do_select('select version from version where active=1 order by id desc limit 1');
			$data['version']=$v[0]['version'];
		}
		$vars['catUpdate']['dates']=0;
		
		$upd=self::messageupdate();
		
		if($upd)
			$vars['catUpdate']=$upd;			
		
		$view = new AdminView($data);
	    $vars['content']=$view->Render($tpl);	
		$vars['header']=$view->Render('header.phtml');
		$vars['footer']=$view->Render('footer.phtml');
		$neview=new AdminView($vars);
		echo $neview->Render('index.phtml');
		
	}
	static function Paging($all_count,$count_per_page,$act_page,$link,$ajax=false,$par=array())
	{
			//$all_count Всего страниц,
			//$count_per_page 
			//$act_page Активная страница
			//$link	-ссылка
			$nums = $count_per_page;			
			$page = $act_page;			
			$elements = $all_count;
			$pages = ceil($elements/$count_per_page);

			if ($pages <= 1) {
				return '';
				
			}
			if ($page < 1) {
				return '';
				
			}
			elseif ($page > $pages) {
				$page = $pages;
			}		
			$dPars=implode(',',$par);
			if($dPars!="")
			$dPars.=',';	
			
			$neighbours = 5;
			$returHtml='<center><div class="btn-toolbar">';
			$left_neighbour = $page - $neighbours;
			if ($left_neighbour < 1) $left_neighbour = 1;

			$right_neighbour = $page + $neighbours;
			if ($right_neighbour > $pages) $right_neighbour = $pages;

			if ($page > 1) {
				
				if(!$ajax)
				 $returHtml.='<div class="btn-group">
								<button class="btn" onclick="window.location.href=\''.$link.'/page/'.($page-1).'\'"><i class="icon-chevron-left"></i> Предыдущая</button>
							 </div>';
				else
					$returHtml.='<div class="btn-group">
								<button class="btn" onclick="'.$link.'('.$dPars.($page-1).')"><i class="icon-chevron-left"></i> Предыдущая</button>
							 </div>';
			}

			for ($i=$left_neighbour; $i<=$right_neighbour; $i++) {
				if ($i != $page) {
					if(!$ajax)
					$returHtml.= '<div class="btn-group">            
									<button class="btn" onclick="window.location.href=\''.$link.'/page/' . $i . '\'">' . $i . '</button>
								</div>';
					else
						$returHtml.= '<div class="btn-group">            
									<button class="btn" onclick="'.$link.'('.$dPars.$i.')">' . $i . '</button>
								</div>';
						
				}
				else {
					// выбранная страница
					$returHtml.= ' <div class="btn-group">            
									<button class="btn active btn-primary">' . $i . '</button>
								</div>';
				}
			}

			if ($page < $pages) {
				if(!$ajax)
				$returHtml.= ' <div class="btn-group">
									<button class="btn" onclick="window.location.href=\''.$link.'/page/' . ($page+1) . '\'">Следующая <i class="icon-chevron-right"></i></button>
								</div>';
				else
					$returHtml.='<div class="btn-group"><button class="btn" onclick="'.$link.'('.$dPars.($page+1).')">Следующая <i class="icon-chevron-right"></i></button>
								
							 </div>';
			}
			
			$returHtml.='</div></center>';
			
			return $returHtml;
    }
	public function tplsAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$set_partners=Registry::getParam('user_settings');
				$set_globals=Registry::getParam('globalUrl');
				$admins_param=Registry::getParam('admin_info');
				$tpl_set=Registry::getParam('tpl_settings');
				$cache=Registry::getParam('cache_settings');
				

				$con=array();
				$con['showmode']=$set_partners['showmode'];
				
				$con['catindex']=$set_partners['catindex'];
				$con['ProductsPerPage']=$set_partners['prodperpage'];
				$con['ProductsPageSlide']=$set_partners['prodpageslade'];
				$con['ansverServers']=$set_partners['ansverServer'];
				$con['showOther']=$set_partners['showOther'];
				$con['PartnerShopName']=$set_partners['partnername'];
				$con['PartnerShopMails']=$set_partners['milo_partner'];
				$con['PartnerPhone']=$set_partners['phone_partner'];
				$con['PartnerShopICQ']=$set_partners['partnerICQ'];
				$con['PartnerID']=$set_partners['partnerid'];
				$con['partnerFlagData']=$set_partners['partnerFlagData'];
				$con['PartnerSalt']=$set_partners['salt'];
				$con['GeneralSermerMail']=$set_partners['general_mails'];
				$con['UrlForXML']=$set_globals['urlfororders'];
				$con['PageForXML']=$set_globals['pagefororders'];
				$con['PortForXMLOrders']=$set_globals['portfororders'];
				$con['name_login']=$admins_param['login'];		
				$con['cut_of_upd']=$set_globals['catalogpageupdate'];				
				$con['cut_of_updT']=$set_globals['updateType'];
				$con['cut_of_updD']=$set_globals['updateDelivery'];
				$con['timeRenderOffer']=$set_globals['timeRenderOffer'];
				
				$con['path_to_template']=$tpl_set['source'];		

				$db_con=Registry::getParam('db_settings');
				$con['db_host']=$db_con['host'];
				$con['db_login']=$db_con['user'];
				$con['db_pass']=$db_con['password'];
				$con['db_name']=$db_con['name'];			
				
				$con['name_pas']=$admins_param['password'];
                                $con['flag']=$admins_param['flag'];
				
				$con['dir']=$cache['dir'];
				$con['typeCaching']=$cache['typeCaching'];
				$con['CachingIp']=$cache['CachingIp'];
				$con['CachingPort']=$cache['CachingPort'];
		
		if(count($_POST)>0)
		{
				$con['path_to_template']=$_POST['source'];	
				$conf=$this->createconf($con);		
				$this->configadd($conf);
				die(json_encode(array('act'=>1)));
		}
		$view=array();
		$pathGlobals=dirname(__FILE__);		
		$dirname=$pathGlobals.'/../themes/';
		$dir=opendir($dirname);		
		$arrayPath=array();
		$arra=array();
		while (($file = readdir($dir)) !== false) {
			if ($file != "." && $file != "..")
			{
				
				$arra[]=$file;
			}
			
		}
		sort($arra);
		for($i=0;$i<count($arra);$i++)
		{
			$arrayPath[]=self::readTpls($dirname,$arra[$i]);
		}
		
		$view['path_to_template']=$con['path_to_template'];
		$view['theme']=$arrayPath;
		
		$this->Render('theme.phtml',$view);
		
	}
	function readTpls($path,$nameCatalog)
	{
		$array=array('img'=>'','title'=>$nameCatalog,'path'=>$nameCatalog.'/');
		$pathIn=$path.$nameCatalog;
		if(file_exists($pathIn.'/theme.png'))
			$array['img']=$nameCatalog.'/theme.png';
		
		if(file_exists($pathIn.'/readme.txt'))
		{
			$s=file_get_contents($pathIn.'/readme.txt');
			if($s!='')
			{
				$info=explode("|",$s);
				if($info[0]!="")
					$array['title']=$info[0];
			}
		}			
		
		return $array;
	}
	
	public function adminuploadAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$vars=array();
		if(isset($_FILES['files']['name']))
        {
                $cashe_dir = Registry::getParam('cache_settings');
				
                $path='.'.$cashe_dir['dir'].'files/';
                $name=self::ImportImageToJpg($_FILES['files']['tmp_name'], $path, 500);
                $vars['ver']=$cashe_dir['dir'].'files/'.$name;
        }                
        $neview=new AdminView($vars);
		die($neview->Render("upload.phtml"));
	}
	public static function ImportImageToJpg($path,$destination,$w=0)
    {


            $sz = getimagesize($path);
            if ($sz) {
                switch($sz[2])
                {
                    case 1:
                            $ish=imagecreatefromgif($path);
                    break;
                    case 2:
                            $ish=imagecreatefromjpeg($path);
                    break;
                    case 3:
                            $ish=imagecreatefrompng($path);
                    break;

                }
                  $nameImg=md5(time().$path).'.jpg';                
                 
                 
                    if ($ish) {
                        
                         $iw = $sz[0];
                         $ih = $sz[1];
                         if($w!=0)
                         {
                                if ($iw > $w && $w!=0 ) {
                                    if($iw>$ih){
                                        $ih = $ih*$w/$iw;
                                        $iw = $w;
                                    }
                                    else{

                                            $ih = $ih*$w/$iw;
                                            $iw = $w;                       
                                    }

                                }                 
                                $iw = (int) $iw;
                                $ih = (int) $ih;
                         }

                                      
                       
                        $out_im = imagecreatetruecolor($iw, $ih);
                        imagecopyresampled($out_im, $ish, 0, 0, 0, 0, $iw, $ih, $sz[0], $sz[1]); 
                        imagejpeg($out_im, $destination.$nameImg, 90);
                        imagedestroy($ish);
                        return $nameImg;
                    }

                    }
                    return "";
            
             

    }
	
	public function apiserverAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$set_partners=Registry::getParam('user_settings');
		$set_globals=Registry::getParam('globalUrl');
		$admins_param=Registry::getParam('admin_info');
		$tpl_set=Registry::getParam('tpl_settings');
		
		$con=array();
		$con['showmode']=$set_partners['showmode'];				
		$con['catindex']=$set_partners['catindex'];
		$con['ProductsPerPage']=$set_partners['prodperpage'];
		$con['ProductsPageSlide']=$set_partners['prodpageslade'];
		$con['ansverServers']=$set_partners['ansverServer'];
		$con['showOther']=$set_partners['showOther'];
		$con['PartnerShopName']=$set_partners['partnername'];
		$con['PartnerShopMails']=$set_partners['milo_partner'];
		$con['PartnerPhone']=$set_partners['phone_partner'];
		$con['PartnerShopICQ']=$set_partners['partnerICQ'];
		$con['PartnerID']=$set_partners['partnerid'];
		$con['partnerFlagData']=$set_partners['partnerFlagData'];
		$con['PartnerSalt']=$set_partners['salt'];
		$con['GeneralSermerMail']=$set_partners['general_mails'];
		$con['UrlForXML']=$set_globals['urlfororders'];
		$con['PageForXML']=$set_globals['pagefororders'];
		$con['PortForXMLOrders']=$set_globals['portfororders'];
		$con['name_login']=$admins_param['login'];		
		$con['cut_of_upd']=$set_globals['catalogpageupdate'];				
		$con['cut_of_updT']=$set_globals['updateType'];
		$con['cut_of_updD']=$set_globals['updateDelivery'];
		$con['timeRenderOffer']=$set_globals['timeRenderOffer'];
		$con['urlPartnersShluse']='http://'.$con['UrlForXML'].'/'.$con['PageForXML'];
		$con['path_to_template']=$tpl_set['source'];		

		$db_con=Registry::getParam('db_settings');
		
		$con['db_host']=$db_con['host'];
		$con['db_login']=$db_con['user'];
		$con['db_pass']=$db_con['password'];
		$con['db_name']=$db_con['name'];
		$cache=Registry::getParam('cache_settings');
		
		$con['dir']=$cache['dir'];
		$con['typeCaching']=$cache['typeCaching'];
		$con['CachingIp']=$cache['CachingIp'];
		$con['CachingPort']=$cache['CachingPort'];	
		
		$con['name_pas']=$admins_param['password'];	
		$con['flag']=$admins_param['flag'];
		if(count($_POST)>0)
		{
			if($this->params['t']=='url')
			{
				$con['cut_of_upd']=$_POST['catalogpageupdate'];
				$con['cut_of_updT']=$_POST['updateType'];
				$con['cut_of_updD']=$_POST['updateDelivery'];
				$conf=$this->createconf($con);		
				$this->configadd($conf);
				die(json_encode(array('act'=>1)));
			}
			if($this->params['t']=='path')
			{
				if($_POST['urltoXml']=="")
					die(json_encode(array('act'=>0)));
                                if (!preg_match('/http:\/\/([a-zA-Z0-9-_.\/])*vsemayki.ru\/([a-zA-Z0-9-_.\/]+)*/i',$_POST['urltoXml'],$tempsur))
                                    die(json_encode(array('act'=>0,'d'=>'d')));				
                                
				$urls=explode('/',str_replace('http://','',$_POST['urltoXml']));		
				
					
								
				
				$con['UrlForXML']=$urls[0];
				unset($urls[0]);
				$con['PageForXML']=implode('/',$urls);
				$con['ansverServers']=0;
				if(isset($_POST['debug']))
					$con['ansverServers']=1;				
				
				$conf=$this->createconf($con);		
				$this->configadd($conf);
					die(json_encode(array('act'=>1)));	
			}
		}
		else		
			$this->Render('apis.phtml',$con);	
	}
	
	function apiserverreloadAction()
	{
		if(isset($this->params['obj']))		
			header('Location: /admin/apiserver#'.$this->params['obj']);
		else
			header('Location: /admin/apiserver');
		
	}
	
	public function showinfoAction()
	{
		//type=тип операции (1-доб.2-удаление 3-изменение)
		// type_action 1-товар 2-макет
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');	
		
		set_time_limit(0);
		$db = new Database();
		
		$data=array();
		$data['xml']=$db->do_select("select date_xml from update_date_xml order by id desc limit 1");
		
		$thisTempUpdate=$_SESSION['lastUpdateId'];
		
		
		$data['allMaketAdd']=$db->do_select('select count(*) as cc from offers_version where type=1 and version='.$thisTempUpdate.' and type_action=2');
		
		if($data['allMaketAdd'][0]['cc']==NULL)
			$data['allMaketAdd'][0]['cc']=0;
		
		$data['allOffersAdd']=$db->do_select('select sum(counts) as cc from offers_version where type=1 and version='.$thisTempUpdate.' and type_action=1');
		
		if($data['allOffersAdd'][0]['cc']==NULL)
			$data['allOffersAdd'][0]['cc']=0;
		
		$data['allMaketDel']=$db->do_select('select count(*) as cc from offers_version where type=2 and version='.$thisTempUpdate.' and type_action=2');
		
		if($data['allMaketDel'][0]['cc']==NULL)
			$data['allMaketDel'][0]['cc']=0;
		
		$data['allOffersDel']=$db->do_select('select sum(counts) as cc from offers_version where type=2 and version='.$thisTempUpdate.' and type_action=1');
		
		
		if($data['allOffersDel'][0]['cc']==NULL)
			$data['allOffersDel'][0]['cc']=0;
		$data['allOffersUp']=$db->do_select('select count(*) as cc from offers_version where type=3 and version='.$thisTempUpdate.' and type_action=1');
		
		if($data['allOffersUp'][0]['cc']==NULL)
			$data['allOffersUp'][0]['cc']=0;		
		
		$data['allMaketUp'][0]['cc']=0;
		
		self::insertDataUpdateAll_info($data);
		
		$view = new AdminView($data);
		die(json_encode(array('h'=>$view->Render('infoUpdate.phtml'),'id'=>$thisTempUpdate)));	
			
	}
	
	public function returnInfoUp($idUp)
	{
		
		$data=array();		
		$path=dirname(__FILE__).'/../update/';
		$name='all_'.$idUp.'.dat';
		if(file_exists($path.$name))
		{
			$data=json_decode(file_get_contents($path.$name),true);
			
		}
		else
		{		
				$data['allOffersAdd'][0]['cc']=0;			
				$data['allMaketAdd'][0]['cc']=0;			
				$data['allOffersDel'][0]['cc']=0;			
				$data['allMaketDel'][0]['cc']=0;		
				$data['allOffersUp'][0]['cc']=0;			
				$data['allMaketUp'][0]['cc']=0;
		}
		return $data;
	}
	public function historyinfoAction()
	{
		if (!isset($_SESSION['is_admin'])) header('location:/admin/auth');
		$data=array();
		$page=1;
		if(isset($this->params['page']) and is_numeric($this->params['page']))
			$page=$this->params['page'];
		$start=($page-1)*10;
		$db = new Database();
		$s=$db->do_select("select * from update_info  order by id desc limit ".$start.",10");	
		$sal=$db->do_select("select count(*) as cc from update_info");
		$data['paging']=self::Paging($sal[0]['cc'],10,$page,'/admin/historyinfo');
		$data['of']=array();
		$sc=count($s);
		for($i=0;$i<$sc;$i++)
		{
			$data['of'][$i]=$s[$i];
			if($s[$i]['status']==1)
				$data['of'][$i]['info']=self::returnInfoUp($s[$i]['id']);
			else
			{
				$data['of'][$i]['info']['allOffersAdd'][0]['cc']=0;
				$data['of'][$i]['info']['allMaketAdd'][0]['cc']=0;
				$data['of'][$i]['info']['allMaketDel'][0]['cc']=0;
				$data['of'][$i]['info']['allOffersUp'][0]['cc']=0;
				$data['of'][$i]['info']['allMaketUp'][0]['cc']=0;
				$data['of'][$i]['info']['allOffersDel'][0]['cc']=0;	
						
			}
			unset($s[$i]);
		}
		//var_dump($data['of']);
		$this->Render('his.phtml',$data);
		
	}
	public function historyitemsAction()
	{
			$data=array();			
			$db = new Database();
			$id=0;
			if(!isset($this->params['id']))
			{	
				$sIn=$db->do_select("select id from update_info where status=1 order by id desc limit 1");
				$id=$sIn[0]['id'];
			}
			else			
				$id=intval($this->params['id']);
			if($id)
			{
				$s=$db->do_select("select date from update_info where id=".$id);
				$data['idlob']=$id;
				$data['allData']=self::returnInfoUp($id);
				$data['date']=$s[0]['date'];			
				$this->Render('onehistory.phtml',$data);
			}					
			
				
		
	}
	
	public function offersaddAction()
	{
		$page=1;
		if(isset($this->params['page']) and is_numeric($this->params['page']))
			$page=$this->params['page'];
		$start=($page-1)*10;
		$db = new Database();
		$data=array();
		$id=$this->params['idv'];
		
		$data['of']=$db->do_select('select offers_version . * 
									from `offers_version` 
									where  version='.$id.'
									and offers_version.type in (1,2,3) and offers_version.type_action=1 limit '.$start.',10');
		
		$sCount=$db->do_select('select count(*) as cc from offers_version where offers_version.type in (1,2,3) and offers_version.type_action=1 and version='.$id);
		$data['paging']=self::Paging($sCount[0]['cc'],10,$page,'offers',true);
		
			$view = new AdminView($data);
			die(json_encode(array('h'=>$view->Render('maketOff.phtml'))));
	}
	
	public function maketaddAction()
	{
		$page=1;
		if(isset($this->params['page']) and is_numeric($this->params['page']))
			$page=$this->params['page'];
		$start=($page-1)*10;
		$db = new Database();
		$data=array();
		/*$data['of']=$db->do_select('select offers.oldid,offers.name,offers.price,offers.rukav,sex.name as tName,color.name as cName from offers,sex,color where offers.offer_info in (1) and sex.id=offers.sexid and color.id=offers.colors order by offers.oldid limit '.$start.',10');
		$sCount=$db->do_select('select count(*) as cc from offers where offers.offer_info in (1)');*/
		$id=$this->params['idv'];
		
		$data['of']=$db->do_select('select  offers_version . * 
									from `offers_version` 
									where   version='.$id.' and offers_version.type in (1,2,3) and offers_version.type_action=2 limit '.$start.',10');
		$sCount=$db->do_select('select count(*) as cc from offers_version where offers_version.type in (1,2,3) and offers_version.type_action=2 and version='.$id);
		
		$data['paging']=self::Paging($sCount[0]['cc'],10,$page,'maket',true);
		
			$view = new AdminView($data);
			die(json_encode(array('h'=>$view->Render('maketOff.phtml'))));
	}
	
	function settingsreloadAction()
	{
		if(isset($this->params['obj']))		
			header('Location: /admin/config#'.$this->params['obj']);
		else
			header('Location: /admin/config');
		
	}
	
	public function errorAction()
	{
		$code='404';
		$status='Not Found';			
		header("HTTP/1.0 $code $status");
		header("HTTP/1.1 $code $status");
		header("Status: $code $status");
		$this->Render('error.phtml');
	}
	function ConGenerates($str="")
	{
		
			$set_partners=Registry::getParam('user_settings');
			$set_globals=Registry::getParam('globalUrl');
			$admins_param=Registry::getParam('admin_info');
			$tpl_set=Registry::getParam('tpl_settings');
			$db_con=Registry::getParam('db_settings');
			
			$con=array();				
			$con['PartnerShopName']=$set_partners['partnername'];
			$con['PartnerShopMails']=$set_partners['milo_partner'];
			$con['PartnerPhone']=$set_partners['phone_partner'];
			$con['GeneralSermerMail']=$set_partners['general_mails'];
			$con['PartnerShopICQ']=$set_partners['partnerICQ'];
			
			$con['showmode']=$set_partners['showmode'];				
			$con['catindex']=$set_partners['catindex'];
			$con['ProductsPerPage']=$set_partners['prodperpage'];
			$con['ProductsPageSlide']=$set_partners['prodpageslade'];
			$con['ansverServers']=$set_partners['ansverServer'];
			if(!isset($set_partners['showOther']))
				$set_partners['showOther']=0;
			$con['showOther']=$set_partners['showOther'];
			
			$con['PartnerID']=$set_partners['partnerid'];
			$con['partnerFlagData']=$set_partners['partnerFlagData'];
			$con['PartnerSalt']=$set_partners['salt'];
			
			$con['UrlForXML']=$set_globals['urlfororders'];
			$con['PageForXML']=$set_globals['pagefororders'];
			$con['PortForXMLOrders']=$set_globals['portfororders'];
			$con['name_login']=$admins_param['login'];		
			$con['cut_of_upd']=$set_globals['catalogpageupdate'];
			$con['cut_of_updT']=$set_globals['updateType'];
			$con['cut_of_updD']=$set_globals['updateDelivery'];
			$con['timeRenderOffer']=$set_globals['timeRenderOffer'];
			
			$con['path_to_template']=$tpl_set['source'];
			
			$con['db_host']=$db_con['host'];
			$con['db_login']=$db_con['user'];
			$con['db_pass']=$db_con['password'];
						
			$con['db_name']=$db_con['name'];			
			
			$con['flag']=1;
			if($str=="")
				$con['name_pas']=$admins_param['password'];				
			else	
				$con['name_pas']=$str;
			$con['name_pas']=$con['name_pas'];

			$cache=Registry::getParam('cache_settings');
			$con['dir']=$cache['dir'];
			$con['typeCaching']=$cache['typeCaching'];
			$con['CachingIp']=$cache['CachingIp'];
			$con['CachingPort']=$cache['CachingPort'];	
		
			$conf=$this->createconf($con);		
			$this->configadd($conf);	
			
			
		
	}
	
	 function checksalt($ref,$salt) {
	      
		if($ref==1)
		{
			$data['ok']=0;
			$data['ref']=1;
			return $data;
		}
		if($salt==1)
		{
			$data['ok']=0;
			$data['salt']=1;
			return $data;
		}		
		$cost = new cost();
		$data=array();
		$dates=time();
		$massivs=array();
		$massivs['pat_id']=$ref;
		$massivs['salt']=$salt;
		$massivs['pat_name']='Testing';
		$massivs['data']=date("Y-m-d H:i:s");
		$microtime = explode(" ",microtime());
		$microsec = $microtime[0]*1000000;
		$massivs['id_orders']=date("Ymd")."-".@$_POST['ref']."-".(date("His.").$microsec);
		$massivs['froms']='';
		$massivs['name3']='test';
		$massivs['name1']='test';
		$massivs['name2']='test';
		$massivs['milos']='test@test.ru';
		$massivs['phons']='test';
		$massivs['index']='test';
		$massivs['country']='RUSSIA';
		$massivs['obl']='test';
		$massivs['city']='test';
		$massivs['adres']='test';
		$massivs['delivery']='POSTAL';
		$massivs['delivery_sum']=20;
		$massivs['prepay']='POSTAL';
		$massivs['sum']= 45;
		$massivs['text']='test';
		$massivs['id_key_count'] = 1;
		$massivs['orders']['0'] = array(
		    'oldid' => '129540',
          	'name'  => 'Значок Trollface. Problem? Проблемы?',
          	'model' => 'sign',
          	'color' => 'white',
          	'num'   => '1',
          	'price' => '25',
          	'hand'  => 'short',
          	'sizes' => '25mm',
		);
		
		$xml_doc=$cost->createorders($massivs);
		$answer=$cost->goorders($xml_doc);
		
		$err_code = '';
		preg_match( "/<error>(.*)<\/error>/", $answer, $err_code );
		$err_code = @substr($err_code[1], 0, 20);
		
		$data['ok']=0;
		
		
	    if ( $err_code )
	    {
    		switch ( $err_code )
    		{
    		    case "Invalid partner code":
    		        $data['ref']=1;
    		        break;
    		    case "Invalid partner hash":
    		        $data['hash']=1;
    		        break;  		   
    		        
    		}
			if(count($data)>1)
				$data['ok']=0;
			else
				$data['ok']=1;
	    } 
		else
			$data['ok']=1;
        return $data;
	    
	  }
	
	function showerrorAction()
	{
		if(isset($this->params['id']))
		{
			$path=dirname(__FILE__).'/../error';
			$name='/error_'.$this->params['id'].'.dat';
			if(file_exists($path.$name)){
				die(file_get_contents($path.$name));
			}else
			die('Записей не найдено');
		}
	}
	function FlagRefCode($flag)
	{
		$set_partners=Registry::getParam('user_settings');
		$set_globals=Registry::getParam('globalUrl');
		$admins_param=Registry::getParam('admin_info');
		$tpl_set=Registry::getParam('tpl_settings');
		$db_con=Registry::getParam('db_settings');
		
		$con=array();
		
		$con['PartnerShopName']=$set_partners['partnername'];
		$con['PartnerShopMails']=$set_partners['milo_partner'];
		$con['PartnerPhone']=$set_partners['phone_partner'];
		$con['GeneralSermerMail']=$set_partners['general_mails'];
		$con['PartnerShopICQ']=$set_partners['partnerICQ'];
		
		$con['showmode']=$set_partners['showmode'];				
		$con['catindex']=$set_partners['catindex'];
		$con['ProductsPerPage']=$set_partners['prodperpage'];
		$con['ProductsPageSlide']=$set_partners['prodpageslade'];
		$con['ansverServers']=$set_partners['ansverServer'];
		$con['showOther']=$set_partners['showOther'];
		
		$con['PartnerID']=$set_partners['partnerid'];
		$con['partnerFlagData']=$flag;
		$con['PartnerSalt']=$set_partners['salt'];
		
		$con['UrlForXML']=$set_globals['urlfororders'];
		$con['PageForXML']=$set_globals['pagefororders'];
		$con['PortForXMLOrders']=$set_globals['portfororders'];
		$con['name_login']=$admins_param['login'];		
		$con['cut_of_upd']=$set_globals['catalogpageupdate'];
		$con['cut_of_updT']=$set_globals['updateType'];
		$con['cut_of_updD']=$set_globals['updateDelivery'];
		$con['timeRenderOffer']=$set_globals['timeRenderOffer'];
		$con['path_to_template']=$tpl_set['source'];
		
		$con['db_host']=$db_con['host'];
		$con['db_login']=$db_con['user'];
		$con['db_pass']=$db_con['password'];
		$con['db_name']=$db_con['name'];			
		
		$con['name_pas']=$admins_param['password'];
		$con['flag']=$admins_param['flag'];
		$conf=$this->createconf($con);		
		$this->configadd($conf);
		
	}
	function insertDataUpdateAll_info($data)
	{
		$path=dirname(__FILE__).'/../update';		
		$name='/all_'.$_SESSION['lastUpdateId'].'.dat';
		file_put_contents($path.$name,json_encode($data));
	}
	function truesXmlCatalog()
	{
		$settings = Registry::getParam('globalUrl');
		$url=$settings['catalogpageupdate'].'?version='.$this->thisVersion.'&platform=shop-3';
		$fh = @fopen($url, "r");
                $strings='';
                $category=0;
		if(!$fh)
			return 0;
		else
		{
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
				if($xmlString=="")
					return 0;
				$xml=new SimpleXMLElement($xmlString.'</price>',LIBXML_NOCDATA);
				if(!$xml)
					return 0;
		}
		return 1;	
	}
	function orderUbgrade()
	{
		set_time_limit(0);
		include 'library/order_upgrade.php';
		Order::Start();
		
	}
	function descriptionUbgrade()
	{
		
		include 'library/description_upgrade.php';
		Description::Start();
	}
	
	function memtestAction()
	{
		if(count($_POST)>0)
		{
			if($_POST['types']=='memory')
			{
				$data=array();
				$data['type']=$_POST['types'];
				$data['act']=0;
                                $memobj=new Shop_Memcache();
				if($memobj->is_cached())
					$data['act']=1;
				die(json_encode($data));
			}
		}
		die(json_encode(array('act'=>0)));
	}
	function cachereloadAction()
	{
		header('Location: /admin/config#cache');	
	}
        function ddAction()
        {
            phpinfo();
        }
	
	
	
	
	

}


?>
