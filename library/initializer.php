<?php
	

		$contrllSett = array ('dirName'=>$controllerPath);

		$db =  array ('host'=>$DB_Host,
				'name'=>$DB_Name,
				'user'=>$DB_UserName,
				'password'=>$DB_Password);

		$admin_info = array ('login' => $AdminLogin,
				'password' => $AdminPassword);

		if(isset($AdminFlag))
			$admin_info['flag']=1;

		$globalUri = array ('urlfororders'=>$UrlForXML,
				'pagefororders'=>$PageForXML,
				'portfororders'=>$PortForXMLOrders,
				'catalogpageupdate'=>$UrlOfUpdatePr);
		if(!isset($TimeRenderType))		
			$TimeRenderType=1800;
		$globalUri['timeRenderOffer']=$TimeRenderType;		
				
		if(!isset($UrlOfUpdateDelivery))
			$UrlOfUpdateDelivery='http://www.vsemayki.ru/partnership/xml_delivery.xml';
		if(!isset($UrlOfUpdateType))
			$UrlOfUpdateType='http://www.vsemayki.ru/partnership/products.xml';
			
		$globalUri['updateDelivery']=$UrlOfUpdateDelivery;
		$globalUri['updateType']=$UrlOfUpdateType;
				

		$tpl = array ('source'=>$PathToTemplate);

		$user = array ('showmode'=>$ShowMode,
				'catindex'=>$CatStart,
				'prodperpage'=>$ProductsPerPage,
				'prodpageslade'=>$ProductsPageSlide,
				'ansverServer'=>$AnswerServers,
				'partnername'=>$PartnerShopName,
				'milo_partner'=>$PartnerShopMails,				
				'general_mails'=>$GeneralSermerMail,				
				'partnerid'=>$PartnerID,
				'salt'=>$PartnerSalt,
				'partnerICQ'=>$PartnerShopICQ);
				
		if(!isset($PartnerShowOthers))
			$PartnerShowOthers=0;
			
		$user['showOther']=$PartnerShowOthers;
		
		if(!isset($PartnerFlagData))
			$PartnerFlagData=0;
			
		$user['partnerFlagData']=$PartnerFlagData;
		
		if(!isset($PartnerPhone))
			$PartnerPhone='';
			
		$user['phone_partner']=$PartnerPhone;
	
		$cache = array ('dir'=>$CacheDir);
		if(!isset($typeCaching))
			$typeCaching='file';
		$cache['typeCaching']=$typeCaching;
		
		if(!isset($MemCachingIp))
			$MemCachingIp='127.0.0.1';
		$cache['CachingIp']=$MemCachingIp;
		
		if(!isset($MemCachingPort))
			$MemCachingPort=11211;
		$cache['CachingPort']=$MemCachingPort;
Registry::setParam('controllers_settings',$contrllSett);
Registry::setParam('cache_settings',$cache);
Registry::setParam('db_settings',$db);
Registry::setParam('user_settings',$user);
Registry::setParam('tpl_settings',$tpl);
Registry::setParam('admin_info',$admin_info);
Registry::setParam('globalUrl',$globalUri);
?>