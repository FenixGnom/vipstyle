<?php
include dirname(__FILE__).'/../library/template_model/model/cut.page.php';
include dirname(__FILE__).'/../library/template_model/model/cut_address.page.php';
include dirname(__FILE__).'/../library/template_model/model/cut_delivery.page.php';
include dirname(__FILE__).'/../library/template_model/model/cut_pay.page.php';
include dirname(__FILE__).'/../library/template_model/model/cut_confirmation.page.php';
include dirname(__FILE__).'/../library/template_model/model/cut_order.page.php';
include dirname(__FILE__).'/../library/template_model/model/delivery.entity.php';
include dirname(__FILE__).'/../library/template_model/model/infodelivery.entity.php';
include dirname(__FILE__).'/../library/DeliveryData.php';
include dirname(__FILE__).'/../library/Api.php';
class CutController   extends BaseController {
	public $params = null;
	public $tplSettings=null;
        public $apiKey='';
        public $apiPath='';
        public $deliveryApi=null;
	
	function __construct ($check = true) {
		if (!$check) return;
		$this->params = Library::paramUri();
		$this->tplSettings = Registry::getParam('tpl_settings');
		$this->ur = Library::getParams();
                $this->apiKey = '530b2a64fb6b618510c8a4d410ce4f93'; 
                $this->apiPath = 'http://www.vsemayki.ru/api/delivery/'; 
                $this->deliveryApi=new ApiDelivery($this->apiPath,$this->apiKey);
	}
	public function indexAction() {
		return $this->showAction();
	}

	
	public function showAction() {	
		$paramPageView= new CutPageStorage();               
                $dataReturn=$this->returnParamsPage();                
                $paramPageView->set_partner($dataReturn['partner']);
                $paramPageView->set_enviroment($dataReturn['partnerEnv']);
                $paramPageView->set_novelty($dataReturn['new_wages'],$dataReturn['partnerDebug'] );
                $paramPageView->set_seo($dataReturn['seo']);
                $paramPageView->set_basket_info($dataReturn['basket']);
                $paramPageView->add_menu(4, $this->MenuSaite(), $dataReturn['partnerDebug']);
                $paramPageView->set_title($dataReturn['title']==''? 'Корзина покупателя' :$dataReturn['title']);               
                $paramPageView->add_menu(1,$this->MenuCategories(),$dataReturn['partnerDebug']);
                
                $smartyLoad=new Smarty;
		$smartyLoad->debugging = false;		
		$smartyLoad->template_dir='themes/'.$paramPageView->enviroment()->theme_path();
                
                $db = new Database();
                $this->view=new View();
		if($_SESSION['amounts']==0)
		{
			$_SESSION['construct']=array();
			$_SESSION['cutspr']=array();			
		}
				
		$id_m = array_keys($_SESSION['cutspr']);
			
		$i = 0;		
		$offerCut=array();
		$id_m_enc = array();
		while($i<count($id_m)) {
			$id_m_enc[$i] = urlencode($id_m[$i]);
			$ids=explode('_',$id_m[$i]);
			
			$name=$db->do_select('select offerss.name as pname,offerss.id,color.abriv as clr,color.name as cname,
				sex.path as path,sex.name as sexname,offerss.front,offerss.back,sex.double from offerss,color,sex,relation_type 
				where offerss.id='.$ids[0].' and color.id=relation_type.color and relation_type.color='.$ids[4].' and sex.id='.$ids[5].' and sex.id=relation_type.type and offerss.id=relation_type.id_offers');
			$offerCut[$i]=array();
                        
                        $model=$name[0]['path'];
                        
                        $hand='';
                        $handImg=0;
			if($model=='man-long' or $model=='man' or $model=='woman-long' or $model=='woman')
			{
                            if(isset($_SESSION['cutspr'][$id_m[$i]]['hands']))
                            {
                                $hand=$this->view->HandShow($_SESSION['cutspr'][$id_m[$i]]['hands']);
                                $handImg=$_SESSION['cutspr'][$id_m[$i]]['hands'];
                            }
				
			}
                        
                        
			$linkEdit='/cut/dels_on/delid/'.urldecode($id_m_enc[$i]);
                        if($name[0]['front']==1)
                        {
                            $img=$this->view->LoadProdImageFut ($name[0]['id'], $name[0]['path'], $name[0]['clr'], 250, $handImg, $name[0]['front']);
                            $img_big=$this->view->LoadProdImageFut ($name[0]['id'], $name[0]['path'], $name[0]['clr'], 500, $handImg, $name[0]['front']);
                        }
                        else
                        {   
                            $img=$this->view->LoadProdImageFutBack ($name[0]['id'], $name[0]['path'], $name[0]['clr'], 250, $handImg, $name[0]['back']);
                            $img_big=$this->view->LoadProdImageFutBack ($name[0]['id'], $name[0]['path'], $name[0]['clr'], 500, $handImg, $name[0]['back']);
                        }
			$namePr=$this->NameOffersFromType($name[0]['pname'], $model);		
			$model_name=$name[0]['sexname'];
			$amount=$_SESSION['cutspr'][$id_m[$i]]['amount'];
			$price=$_SESSION['cutspr'][$id_m[$i]]['price'];		
			$size='';
			if(isset($_SESSION['cutspr'][$id_m[$i]]['size']))
				$size=$_SESSION['cutspr'][$id_m[$i]]['size'];
                        
                        $offerCut[$i]=new OffersCutStorage($namePr, $price, $amount, $model_name, $hand, $size, $img,$linkEdit,$img_big,$name[0]['cname']);
			$i++;
		}
		
		
		$DeliveryBlock=self::ReturnTextDelivery();
                
		
		$paramPageView->set_offers($offerCut,$dataReturn['partnerDebug']);
        $paramPageView->set_deliveryinfo($DeliveryBlock); 
                
             
                
		$paramPageView->set_count_offer_set_($_SESSION['amounts']);
        $paramPageView->set_sum_offer_set_($_SESSION['many']);  
		
				
		$smartyLoad->assign("template_data",$paramPageView);	
		$smartyLoad->display('cutshow.tpl');	
		
	}

        public function show_step1Action() {
		
		$paramPageView= new CutAdressPageStorage();               
                $dataReturn=$this->returnParamsPage();                
                $paramPageView->set_partner($dataReturn['partner']);
                $paramPageView->set_enviroment($dataReturn['partnerEnv']);
                $paramPageView->set_novelty($dataReturn['new_wages'],$dataReturn['partnerDebug'] );
                $paramPageView->set_seo($dataReturn['seo']);
                $paramPageView->set_basket_info($dataReturn['basket']);
                $paramPageView->add_menu(4, $this->MenuSaite(), $dataReturn['partnerDebug']);
                $paramPageView->set_title($dataReturn['title']==''? 'Корзина покупателя' :$dataReturn['title']);               
                $paramPageView->add_menu(1,$this->MenuCategories(),$dataReturn['partnerDebug']);
                
                $smartyLoad=new Smarty;
		$smartyLoad->debugging = false;		
		$smartyLoad->template_dir='themes/'.$paramPageView->enviroment()->theme_path();
		
		if($_SESSION['many']<190)
			header('Location: /cut');
				
			 if(count($_SESSION['cutspr'])>0)
           {
				
                
                 if(isset($_SESSION['dataUsers']) and count($_SESSION['dataUsers'])>3)
                    $userData= $_SESSION['dataUsers'];
                 else	
                    $userData=array('obl'=>'','indeks'=>'','city'=>'','adres'=>'','name1'=>'','name2'=>'','name3'=>'','phone'=>'','email'=>'','text'=>'','country'=>'');
				
		$paramPageView->set_region($userData['obl']); 
                $paramPageView->set_country($userData['country']); 
                $paramPageView->set_index($userData['indeks']);
                $paramPageView->set_city($userData['city']);
                $paramPageView->set_address($userData['adres']);
                $paramPageView->set_name($userData['name1']);
               
                $paramPageView->set_lastname($userData['name3']);
                $paramPageView->set_patronymic($userData['name2']);
                $paramPageView->set_phone($userData['phone']);
                $paramPageView->set_email($userData['email']);
                $paramPageView->set_comments($userData['text']);
				
				
                $smartyLoad->assign("template_data",$paramPageView);

                $smartyLoad->display('cutshow_step1.tpl');
				
				
				
				
           }
           else
                 header('Location: /cut');
	}	
	

        public function show_step2Action() {
                
		$paramPageView= new CutDeliveryPageStorage();               
                $dataReturn=$this->returnParamsPage();                
                $paramPageView->set_partner($dataReturn['partner']);
                $paramPageView->set_enviroment($dataReturn['partnerEnv']);
                $paramPageView->set_novelty($dataReturn['new_wages'],$dataReturn['partnerDebug'] );
                $paramPageView->set_seo($dataReturn['seo']);
                $paramPageView->set_basket_info($dataReturn['basket']);
                $paramPageView->add_menu(4, $this->MenuSaite(), $dataReturn['partnerDebug']);
                $paramPageView->set_title($dataReturn['title']==''? 'Корзина покупателя' :$dataReturn['title']);               
                $paramPageView->add_menu(1,$this->MenuCategories(),$dataReturn['partnerDebug']);
                
                $smartyLoad=new Smarty;
		$smartyLoad->debugging = false;		
		$smartyLoad->template_dir='themes/'.$paramPageView->enviroment()->theme_path();
                
		if($_SESSION['many']<190)
                    header('Location: /cut');
		if(count($_SESSION['cutspr'])==0)
                    header('Location: /cut');
		
                $cost=new Cost();
		if(!isset($_POST) )	
                {   if(count($_SESSION['dataUsers'])<3)	
                                header('Location: /cut');
                }
		if(count($_POST)>0)
                {
                    $_SESSION['dataUsers']=$_POST; 				
                    foreach ($_SESSION['dataUsers'] as $key=>$val)
                    {
                        $_SESSION['dataUsers'][$key]= strip_tags($val);
                    }
				
                }
               
                $_SESSION['dataUsers']['city']=mb_strtolower($_SESSION['dataUsers']['city'],'utf-8');		
		
                $array=array();
                $array['city']=$_SESSION['dataUsers']['city'];
                $array['products']=self::returnTypeProduct();
                
                $deliverys=$this->deliveryApi->returnTypeDelivery($array,"xml");
			
               
                $deliveryObj=array();
                for($i=0;$i<count($deliverys);$i++)
                {
                    if($deliverys[$i]['name_type']=='Самовывоз')
                        $deliverys[$i]['name_type']= 'Самовывоз ('.$deliverys[$i]['name'].')';   
                    $deliveryObj[$i]=new DeliveryStorage($deliverys[$i]['name_type'], $deliverys[$i]['type'], $deliverys[$i]['price'],'');
                    
                }
                
                
		$default='POSTAL';
                if(isset($_SESSION['dataUsers']['deliveryMain']))	
                    $default=$_SESSION['dataUsers']['deliveryMain'];

                $paramPageView->set_delivery($deliveryObj, $dataReturn['partnerDebug']);
                $paramPageView->set_delivery_default(new DeliveryStorage('Почта России',$default,$cost->delivery($default,$_SESSION['amounts']),''));
               
              

                $smartyLoad->assign("template_data",$paramPageView);
                $smartyLoad->display('cutshow_step2.tpl');
					
					
			
				
           
              
	}
        public function show_step3Action() {
                
                $paramPageView= new CutPayPageStorage();               
                $dataReturn=$this->returnParamsPage();                
                $paramPageView->set_partner($dataReturn['partner']);
                $paramPageView->set_enviroment($dataReturn['partnerEnv']);
                $paramPageView->set_novelty($dataReturn['new_wages'],$dataReturn['partnerDebug'] );
                $paramPageView->set_seo($dataReturn['seo']);
                $paramPageView->set_basket_info($dataReturn['basket']);
                $paramPageView->add_menu(4, $this->MenuSaite(), $dataReturn['partnerDebug']);
                $paramPageView->set_title($dataReturn['title']==''? 'Корзина покупателя' :$dataReturn['title']);               
                $paramPageView->add_menu(1,$this->MenuCategories(),$dataReturn['partnerDebug']);
                
                $smartyLoad=new Smarty;
		$smartyLoad->debugging = false;		
		$smartyLoad->template_dir='themes/'.$paramPageView->enviroment()->theme_path();
                
                if($_SESSION['many']<190)
                        header('Location: /cut');
                if(count($_SESSION['cutspr'])==0)
                        header('Location: /cut');	
                if(isset($_POST['delivery']))    
                {    
                    $_SESSION['dataUsers']['deliveryMain']=$_POST['delivery'];
                    $_SESSION['dataUsers']['infoDeliveryName']=$_POST[$_POST['delivery'].'_name'];
                    $_SESSION['dataUsers']['infoDeliveryPrice']=$_POST[$_POST['delivery'].'_price'];
                }
                   
               
                
                
                $cost=new Cost();
                $data=array();
                $data['sel']='POSTAL';
                if(isset($_SESSION['dataUsers']['prepay']))
                   $data['sel']=$_SESSION['dataUsers']['prepay'];

                $sSum=$_SESSION['many'] + $_SESSION['dataUsers']['infoDeliveryPrice'];

                $data['delivery']='';
                $data['tarif']='';
                if($_SESSION['dataUsers']['deliveryMain']=="POSTAL")
                {	
                        $data['delivery']=$_SESSION['dataUsers']['infoDeliveryPrice'];
                        $data['tarif']=self::calculatePostalTax($sSum);				
                        $data['many']=$sSum+$data['tarif'];
                }
                else
                        $data['many']=$sSum;




                $prepea=$_SESSION['dataUsers']['infoDeliveryPrice'];
                $s=($_SESSION['many']*10)/100;
                $data['manySt']=$prepea+ceil($_SESSION['many']-$s);
                
                $paramPageView->set_pay_default($data['sel']);
                $paramPageView->set_post($data['many']);
                $paramPageView->set_prepay($data['manySt']);
                $paramPageView->set_post_delivery($data['delivery']);
                $paramPageView->set_post_tarif($data['tarif']);
                $smartyLoad->assign("template_data",$paramPageView);
                $smartyLoad->display('cutshow_step3.tpl');

        }
       
         public function show_step4Action() {
		 
			
                $paramPageView= new CutConfirmationPageStorage();               
                $dataReturn=$this->returnParamsPage();                
                $paramPageView->set_partner($dataReturn['partner']);
                $paramPageView->set_enviroment($dataReturn['partnerEnv']);
                $paramPageView->set_novelty($dataReturn['new_wages'],$dataReturn['partnerDebug'] );
                $paramPageView->set_seo($dataReturn['seo']);
                $paramPageView->set_basket_info($dataReturn['basket']);
                $paramPageView->add_menu(4, $this->MenuSaite(), $dataReturn['partnerDebug']);
                $paramPageView->set_title($dataReturn['title']==''? 'Корзина покупателя' :$dataReturn['title']);               
                $paramPageView->add_menu(1,$this->MenuCategories(),$dataReturn['partnerDebug']);
                
                $smartyLoad=new Smarty;
		$smartyLoad->debugging = false;		
		$smartyLoad->template_dir='themes/'.$paramPageView->enviroment()->theme_path();
		 
                if($_SESSION['many']<190)
                        header('Location: /cut');
                if(count($_SESSION['cutspr'])==0)
                        header('Location: /cut');

                        $delivery='';
                        $tarif='';
                       // $cost = new Cost();
                        if(isset($_POST['prepay']))
                        {	$_SESSION['dataUsers']['prepay']=$_POST['prepay'];}


                        if($_SESSION['dataUsers']['prepay']=='POSTAL')
                        {
                                if($_SESSION['dataUsers']['deliveryMain']=='POSTAL')
                                {			
                                        $delivery=$_SESSION['dataUsers']['infoDeliveryPrice'];

                                        $sSum=$_SESSION['many'] + $_SESSION['dataUsers']['infoDeliveryPrice'];

                                        $tarif=self::calculatePostalTax($sSum);
                                        $_SESSION['dataUsers']['allSums']=$sSum+$tarif;					


                                }
                                else
                                {

                                                $sSum=$_SESSION['many'] + $_SESSION['dataUsers']['infoDeliveryPrice'];
                                                $_SESSION['dataUsers']['allSums']=	$sSum;

                                }
                        }
                        else
                        {			

                                        $sSum=$_SESSION['dataUsers']['infoDeliveryPrice'];							
                                        $s=($_SESSION['many']*10)/100;
                                        $ss=ceil(($_SESSION['many']-$s));
                                        $_SESSION['dataUsers']['allSums']=$ss+$sSum;


                        }


                       

                        $paramPageView->set_region($_SESSION['dataUsers']['obl']); 
                        $paramPageView->set_country($_SESSION['dataUsers']['country']);
                        $paramPageView->set_index($_SESSION['dataUsers']['indeks']);
                        $paramPageView->set_city($_SESSION['dataUsers']['city']);
                        $paramPageView->set_address($_SESSION['dataUsers']['adres']);
                       
                        $paramPageView->set_name($_SESSION['dataUsers']['name1']);
                        $paramPageView->set_lastname($_SESSION['dataUsers']['name3']);
                        $paramPageView->set_patronymic($_SESSION['dataUsers']['name2']);
                        $paramPageView->set_phone($_SESSION['dataUsers']['phone']);
                        $paramPageView->set_email($_SESSION['dataUsers']['email']);
                        $paramPageView->set_comments($_SESSION['dataUsers']['text']);
                        $paramPageView->set_delivery(new DeliveryStorage($_SESSION['dataUsers']['infoDeliveryName'],$_SESSION['dataUsers']['deliveryMain'],$delivery,''),'');
                        $paramPageView->set_pay($_SESSION['dataUsers']['prepay']);
                        $paramPageView->set_post_delivery($delivery);
                        $paramPageView->set_post_tarif($tarif);
                        $paramPageView->set_summ($_SESSION['dataUsers']['allSums']);
                        
                        $smartyLoad->assign("template_data",$paramPageView);
                        $smartyLoad->display('cutshow_stepFinish.tpl');
				
		
                
	}
	

	public function mailto($to_subjects,$the_times,$text) {
		$settings = Registry::getParam('user_settings');
		$go="MIME-Version: 1.0\r\n";
		$go.="Content-Type: text/xml; charset=utf-8 \r\n";
		$go.= "From: ".$settings['partnername']." <".$settings['milo_partner'].">\r\n";
		$go.= "Cc: ".$settings['milo_partner']."\r\n";
		$go.= "Bcc: ".$settings['milo_partner']."\r\n";
		@mail($to_subjects, $the_times, $text, $go);
	}

	public function ordersAction() {		
		
		
                
		
		
		if(count($_SESSION['cutspr'])==0)
                    header('Location: /cut');
			
                    $data=array();			
			
		
		
                    $db = new Database();
                    $cost = new Cost();
                    $settings = Registry::getParam('user_settings');

                    $fio=$_SESSION['dataUsers']['name3'].' '.$_SESSION['dataUsers']['name1'].' '.$_SESSION['dataUsers']['name2'];

                    $dates=time();	

                    $massivs=array();
                    $massivs['pat_id']=$settings['partnerid'];
                    $massivs['salt']=$settings['salt'];
                    $massivs['pat_name']=$settings['partnername'];
                    $massivs['data']=date("Y-m-d H:i:s");
                    $microtime = explode(" ",microtime());
                    $microsec = $microtime[0]*1000000;
                    $massivs['id_orders']=date("Ymd")."-".$settings['partnerid']."-".(date("His.").$microsec);
                    if(preg_match('/^[a-zA-Z-_0-9]+\.[a-z]{2,4}$/i', $_SESSION['from']))
                            $massivs['froms']=$_SESSION['from'];
                    else $massivs['froms']='';
                    $massivs['name3']=$_SESSION['dataUsers']['name3'];
                    $massivs['name1']=$_SESSION['dataUsers']['name1'];
                    $massivs['name2']=$_SESSION['dataUsers']['name2'];
                    $massivs['milos']=$_SESSION['dataUsers']['email'];
                    $data['mails']=$_SESSION['dataUsers']['email'];
                    $massivs['phons']=$_SESSION['dataUsers']['phone'];
                    $data['phones']=$_SESSION['dataUsers']['phone'];
                    $massivs['index']=$_SESSION['dataUsers']['indeks'];
                    $massivs['country']='RUSSIA';
                    $massivs['country']=$_SESSION['dataUsers']['country'];
                    $massivs['obl']=$_SESSION['dataUsers']['obl'];
                    $massivs['city']=$_SESSION['dataUsers']['city'];
                    $massivs['adres']=$_SESSION['dataUsers']['adres'];
                    $massivs['delivery']=$_SESSION['dataUsers']['deliveryMain'];

                    $massivs['delivery_sum']=$cost->delivery($_SESSION['dataUsers']['deliveryMain'],$_SESSION['amounts']);
                    if(isset($_SESSION['construct']) and count($_SESSION['construct'])>0)
                            $_SESSION['dataUsers']['prepay']='PREPAY';

                    $massivs['prepay']=$_SESSION['dataUsers']['prepay'];
                    $massivs['sum']=$_SESSION['many'];
                    $massivs['text']=$_SESSION['dataUsers']['text'];
                    $id_key = array_keys($_SESSION['cutspr']);
                    $i=0;
                    $massivs['orders']=array();
                    $massivs['id_key_count'] = count($id_key);
                    if($massivs['id_key_count']==0)
                         header('Location: /cut');
                    while($i<$massivs['id_key_count']) {
                            $id=explode('_',$id_key[$i]);		

                            $massivs['orders'][$i]['oldid']=$id[0];
                            $massivs['orders'][$i]['name']=$_SESSION['cutspr'][$id_key[$i]]['name_offers'];			
                            $massivs['orders'][$i]['model']=str_replace('@','_',$id[7]);			
                            $massivs['orders'][$i]['color']=$id[6];
                            $massivs['orders'][$i]['num']=$_SESSION['cutspr'][$id_key[$i]]['amount'];			
                            $massivs['orders'][$i]['price']=$_SESSION['cutspr'][$id_key[$i]]['price'];		


                            if(isset($_SESSION['cutspr'][$id_key[$i]]['hands'])) {			
                                    if($_SESSION['cutspr'][$id_key[$i]]['hands']==1)
                                    {	$massivs['orders'][$i]['hand']='long';

                                    }
                                    else $massivs['orders'][$i]['hand']='short';
                            }
                            else $massivs['orders'][$i]['hand']='';
                            if(isset($_SESSION['cutspr'][$id_key[$i]]['size']))
                            {	
                                    $name=str_replace('u043bu0435u0442','лет',$_SESSION['cutspr'][$id_key[$i]]['size']);
                                    $name=str_replace('u0433u043eu0434u0430','года',$name);
                                    $massivs['orders'][$i]['sizes']=$name;
                            }			
                            else $massivs['orders'][$i]['sizes']='';
                            $i++;
                    }




                    if(count($massivs['orders'])>0)                       
                    {
                        $xml_doc=$cost->createorders($massivs);

                        $answer=$cost->goorders($xml_doc);

                        $allParamZakaz=serialize($_SESSION['cutspr']);
                   
                        $arra=array('cutMain'=>$_SESSION['cutspr']);
                        $allParamZakaz=serialize($arra);
                    	


                        $answer=str_replace(' ','',$answer);
                        $data['answersXml']='';

                        if (($k = strstr($answer,"<ok>")) !== false && strstr(str_replace(" ","",$answer),"<ok>0</ok>") === false) {
                            if(preg_match('|<ok>(.*)</ok>|',$answer,$id_zakaza)) {
                                    $idichka=$id_zakaza[1];
                            }
                            $text_server= $idichka;
                            $result=1;
                        }
                        else 
                        {
                                $idichka = $dates;
                                $text_server=$idichka;

                                $result=0;
                                $title = "Не удалось отправить заказ $idichka";
                                $xml_doc= htmlentities($xml_doc.'Ответ сервера'.$answer);
                                
                                $this->mailto($settings['general_mails'],$title,$xml_doc);
                        }

                        if($settings['ansverServer']==1)
                                $data['answersXml']=$answer;

                    
                    
                        $summa_s_dost = $_SESSION['dataUsers']['allSums'];



                        $adresis=$_SESSION['dataUsers']['country'].' '.$_SESSION['dataUsers']['indeks'].', '.$_SESSION['dataUsers']['obl'].', '.$_SESSION['dataUsers']['city'].', '.$_SESSION['dataUsers']['adres'];
                        $adresis=htmlspecialchars($adresis);
                        $fio=htmlspecialchars($fio);
                        $adresis=str_replace('"','',$adresis);
                        $adresis=str_replace("'",'',$adresis);
                        $fio=str_replace("'",'',$fio);
                        $fio=str_replace('"','',$fio);

                        $_SESSION['dataUsers']['email']=str_replace("'",'',htmlspecialchars($_SESSION['dataUsers']['email']));
                        $_SESSION['dataUsers']['email']=str_replace('"','',htmlspecialchars($_SESSION['dataUsers']['email']));
                        $_SESSION['dataUsers']['text']=str_replace('"','',htmlspecialchars($_SESSION['dataUsers']['text']));
                        $_SESSION['dataUsers']['text']=str_replace("'",'',htmlspecialchars($_SESSION['dataUsers']['text']));
                        $_SESSION['dataUsers']['phone']=str_replace('"','',htmlspecialchars($_SESSION['dataUsers']['phone']));
                        $_SESSION['dataUsers']['phone']=str_replace("'",'',htmlspecialchars($_SESSION['dataUsers']['phone']));

                        $db->do_insert("insert into zakaz values(0,$idichka,'".$massivs['id_orders']."','$allParamZakaz','".
                                        htmlspecialchars($_SESSION['dataUsers']['text'])."','$adresis','".$_SESSION['dataUsers']['deliveryMain']."','".$_SESSION['dataUsers']['prepay']."','$fio','".$_SESSION['dataUsers']['phone'].
                                        "','".htmlspecialchars($_SESSION['dataUsers']['email'])."','$summa_s_dost','0','".$settings['partnername']."',0,$dates)");


                        if(isset($_SESSION['searching_info']))
                        {
                            if($_SESSION['searching_info']['idVisit']!=0)
                            {
                                $db->do_insert('update visits set zakaz='.$idichka.',count_zakaz='.$_SESSION['amounts'].' where id='.$_SESSION['searching_info']['idVisit']);
                            }
                        }

                        unset($_SESSION['cutspr']);		
                        unset($_SESSION['many']);
                        unset($_SESSION['amounts']);


                        $_SESSION['cutspr']=array();
                        $_SESSION['many']=0.00;
                        $_SESSION['amounts']=0;

                        $paramPageView= new CutOrderPageStorage();               
                        $dataReturn=$this->returnParamsPage();                
                        $paramPageView->set_partner($dataReturn['partner']);
                        $paramPageView->set_enviroment($dataReturn['partnerEnv']);
                        $paramPageView->set_novelty($dataReturn['new_wages'],$dataReturn['partnerDebug'] );
                        $paramPageView->set_seo($dataReturn['seo']);
                        $paramPageView->set_basket_info($dataReturn['basket']);
                        $paramPageView->add_menu(4, $this->MenuSaite(), $dataReturn['partnerDebug']);
                        $paramPageView->set_title($dataReturn['title']==''? 'Корзина покупателя' :$dataReturn['title']);               
                        $paramPageView->add_menu(1,$this->MenuCategories(),$dataReturn['partnerDebug']);

                        $smartyLoad=new Smarty;
                        $smartyLoad->debugging = false;		
                        $smartyLoad->template_dir='themes/'.$paramPageView->enviroment()->theme_path();


                        $paramPageView->set_answer($data['answersXml']);
                        $paramPageView->set_email($_SESSION['dataUsers']['email']);
                        $paramPageView->set_result($result);
                        $paramPageView->set_order($idichka);             

                        $smartyLoad->assign("template_data",$paramPageView);
                        $smartyLoad->display('result_order.tpl');
                        
			
            }
		else
                    header('Location: /cut');
		
	}

	public function delallAction() {
		unset($_SESSION['cutspr']);
		unset($_SESSION['many']);
		unset($_SESSION['amounts']);
		
		$_SESSION['cutspr']=array();
		$_SESSION['many']=0;
		$_SESSION['amounts']=0;
		return $this->showAction();
	}

	public function dels_onAction() {
		$this->params =Library::paramUri();
		$params = $this->params;
		$delid = urldecode($params['delid']);
		if(isset($_SESSION['cutspr'][$delid])) {
			$_SESSION['many']=$_SESSION['many']-($_SESSION['cutspr'][$delid]['price'] * $_SESSION['cutspr'][$delid]['amount']);
			$_SESSION['amounts']=$_SESSION['amounts']-$_SESSION['cutspr'][$delid]['amount'];
			unset($_SESSION['cutspr'][$delid]);
		}
		header("location:/cut");
		exit();
	}
	public function dels_constrAction() {
		$this->params =Library::paramUri();
		$params = $this->params;
		$delid = urldecode($params['delid']);
		if(isset($_SESSION['construct'][$delid])) {
			$_SESSION['many']=$_SESSION['many']-($_SESSION['construct'][$delid]['price'] * $_SESSION['construct'][$delid]['count']);
			$_SESSION['amounts']=$_SESSION['amounts']-$_SESSION['construct'][$delid]['count'];
			unset($_SESSION['construct'][$delid]);
		}
		header("location:/cut");
		exit();
	}

	public function bascetAction() {
		echo $this->cut_show();
		die();
	}
	
	
	public function ReturnStrinNormal($str){
	$str= iconv("UTF-8", "CP1251//IGNORE",$str);
	$str=iconv("CP1251", "UTF-8",$str);
	$arrayR=array('•',"'",'"');
	$str=str_replace($arrayR,'',$str);
	return $str;
	}
	
	public function ReturnTextDelivery()
	{
		
                
		$cost = new Cost();        
		
                $dataReturn=array();
                $path=dirname(__FILE__).'/../catalog/delivery_data.xml';
                if(file_exists($path))
                {                 
                   
                    $s=new DeliveryData($path);
                    $tempInfo=$s->data();
                    
                    for($i=0;$i<count($tempInfo);$i++)
                    {
                        $dataReturn[$i]=array();
                        $costArray=array();   
                        
                        for($a=1;$a<($tempInfo[$i]['amountprice']+1);$a++)
                        {
                            $typem=strtoupper($tempInfo[$i]['id']);
                            $costArray[$a]=new DeliveryStorage('',$typem , $cost->delivery($typem, $a),'' ,$a);
							  
                        }       
                        
                       
                       $dataReturn[$i]=new DeliveryInfo($tempInfo[$i]['name'], $tempInfo[$i]['id'],$costArray,$tempInfo[$i]['text']);			  
                        
                    }
                }
              
              return $dataReturn;        
               
		
	}
	
	public static function calculatePostalTax($sum)
        {
		$tempSum=ceil($sum*0.018);
                if($tempSum<35)
                    $tempSum=35;
                return $tempSum;             
        }
        public static function ReturnPoint($type)
        {         
            $return='';
            switch($type)
            {
               case 'MSKPOINT2':                 
                    $return='Москва (ул. Большая Серпуховская 31, корпус 6)';                                       
               break; 
               case 'POINTNSK':                 
                    $return='Новосибирск (ул.Маркса, 47)';                                       
               break;
               case 'POINTNSK2':                 
                    $return='Новосибирск (ул.Крылова, 7)';                                       
               break;
            }
            return $return;
        }
        
        public static function ReturnNameDelivery($type)
        {         
            $return='';
            switch($type)
            {
               case 'MSKPOINT2':                 
                    $return='Пункт выдачи';                                       
               break; 
               case 'POINTNSK':                 
                    $return='Пункт выдачи';                                       
               break;
               case 'POINTNSK2':                 
                    $return='Пункт выдачи';                                       
               break;
               case 'COURIER':                 
                    $return='Курьерская доставка «День в день»';                                       
               break;
               case 'COURIERSPB':                 
                    $return='Доставка курьером';                                       
               break;
               case 'COURIERNSK':                 
                    $return='Доставка курьером';                                       
               break;
               case 'POSTAL':                 
                    $return='Почта';                                       
               break;
            }
            return $return;
        }
        
        public function cutrenAction()
        {
            $data=array();
            $data['act']=0;
            if(isset($_POST))
            {
                $count=intval($_POST['count']);
                if($count>0 and $count<100)
                {                    
                    if(isset($_POST['key']))
                    {
                        $keyTemp=$_POST['key'];
                        $temp=  array_keys($_SESSION['cutspr']);
                        
                        if(isset($_SESSION['cutspr'][$temp[$keyTemp]]))
                        {
                            $key=$temp[$keyTemp];
                            $tempCount=$_SESSION['cutspr'][$key]['amount'];
                            $priceamount=$tempCount*$_SESSION['cutspr'][$key]['price'];
			    $_SESSION['cutspr'][$key]['amount']=$count;
                            $newsum=$_SESSION['cutspr'][$key]['price']*$count;
                            
			    $_SESSION['amounts']=($_SESSION['amounts']-$tempCount)+$count;
			    $_SESSION['many']=($_SESSION['many']-$priceamount)+$newsum;
                            $data['newsum_key']=$newsum;
                            $data['count']=$_SESSION['amounts'];
                            $data['many']=$_SESSION['many'];
                            $data['act']=1;
                        }    
                    }
                    
                }
                else
                    $data['error']='Количество - число большее 0 и меньше 100';
                    
            }
            die(json_encode($data));
            
        }
        public function returnTypeProduct()
	{
		$array=array();
		$db=new Database();
		foreach($_SESSION['cutspr'] as $key=>$val)
		{
			$pathName="";
			if(!isset($val['type']))
			{
				$ec=explode('_',$key);
				$t=$db->do_select('select path from sex where id='.$ec[5]);
				$pathName=$t[0]['path'];
			}
			else
				$pathName=$val['type'];
				
			if(isset($array[$pathName]))
				$array[$pathName]=$array[$pathName]+$val['amount'];
			else
				$array[$pathName]=$val['amount'];			
			
		}
		return $array;
	}
}


?>