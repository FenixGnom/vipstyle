<?php
include dirname(__FILE__).'/../library/template_model/model/feetback.page.php';
class  FeedbackController extends BaseController {
	public $params = null;

	function __construct ($check = true) {
		if (!$check) return;
		$this->params =Library::paramUri();
	}

	

	public function mailto($the_times,$text) {
			
		
		$the_times=iconv('utf-8','cp1251',$the_times);
		$settings = Registry::getParam('user_settings');
		$go="MIME-Version: 1.0\r\n";
		$go.="Content-Type: text/html; charset=utf-8 \r\n";
		$go.= "From: ".iconv('utf-8','cp1251',$settings['partnername'])." <".iconv('utf-8','cp1251',$settings['milo_partner']).">\r\n";
		$go.= "Cc: ".iconv('utf-8','cp1251',$settings['milo_partner'])."\r\n";
		$go.= "Bcc: ".iconv('utf-8','cp1251',$settings['milo_partner'])."\r\n";
		
		@mail($settings['general_mails'], $the_times, $text, $go);	
		
	}

	public function indexAction () {
		
		$data=array();
		
		$data['error']=array();
		if(isset($_POST['go_mail'])) {
		
			$s=$_POST;
			
			$name=substr(htmlspecialchars(str_replace(array('"',"'"),"",$_POST['name'])),0,30);			 
						
			
			
			
			$milo=strip_tags($_POST['email']);
			
			$txt= htmlspecialchars(str_replace(array('"',"'"),"",$_POST['quest']));
			
			
			
			If(md5($_POST['check_num'])!=$_SESSION['captcha']) 
				$data['error']['captcha']='Неправильно введен код';
						
			
			
			
			if(trim($name)=="")
				$data['error']['name']='Введите Ваше имя';
				
			if (!preg_match("|^([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is", strtolower($milo)))
				$data['error']['email']='Введён некорректный email';
			
			if(trim($txt==""))
				$data['error']['quest']='Введите текст сообщения';
			
			
			if(count($data['error'])==0)
			{
				$text="<strong>Вопрос от </strong>: ".$name."<br/>
				<strong>Электронный адрес:</strong> ".$milo."<br/>
				<strong>Вопрос:</strong> <br/>".$txt."";
						$the_times='Вопрос от '.$name;
						$this->mailto($the_times,$text);
						$s=array('name'=>'','email'=>'','quest'=>'');
						unset($_POST);
						$data['ok']="<div align=center>Ваше сообщение успешно отправлено!</div> ";
			}
			else
			{
				$s=array('name'=>$name,'email'=>$milo,'quest'=>$txt);
			}
						
				
			
		}
		else
			$s=array('name'=>'','email'=>'','quest'=>'');
		
		
		
		$this->create_form ($data,$s);
		
		
			
		
	}

	public function create_form ($array,$data) {
		
		$code = Library::GenerateCaptcha();
		$_SESSION['captcha']=md5($code);
		                   
                
                $paramPageView=new FeedbackPageStorage();
                $dataReturn=$this->returnParamsPage();

                $paramPageView->set_partner($dataReturn['partner']);
                $paramPageView->set_enviroment($dataReturn['partnerEnv']);
                $paramPageView->set_novelty($dataReturn['new_wages'],$dataReturn['partnerDebug'] );
                $paramPageView->set_seo($dataReturn['seo']);
                $paramPageView->set_basket_info($dataReturn['basket']);
                $paramPageView->add_menu(4, $this->MenuSaite(), $dataReturn['partnerDebug']); 
                $paramPageView->add_menu(1,$this->MenuCategories(),$dataReturn['partnerDebug']); 
                $paramPageView->set_title($dataReturn['title']==''? 'Обратная связь' :$dataReturn['title']);
                
                
                
                
		if(isset($array['error']['name']))
                    $paramPageView->set_error_name ($array['error']['name']);
                if(isset($array['error']['email']))
                    $paramPageView->set_error_email ($array['error']['email']);
		if(isset($array['error']['quest']))
                    $paramPageView->set_error_message ($array['error']['quest']);
                if(isset($array['error']['captcha']))
                    $paramPageView->set_error_captcha ($array['error']['captcha']);
                $result=false;
		if(isset($array['ok']))
                    $result=true;
			$paramPageView->set_result ($result);
                
                $paramPageView->set_data_name($data['name']);        
		$paramPageView->set_data_email($data['email']);
                $paramPageView->set_data_message($data['quest']);
                $paramPageView->set_data_captcha(base64_encode($code));
                
              
		$smartyLoad=new Smarty;
		$smartyLoad->debugging = false;		
		$smartyLoad->template_dir='themes/'.$paramPageView->enviroment()->theme_path();	
		
		$smartyLoad->assign("template_data",$paramPageView);
		
		$smartyLoad->display('feetback.tpl');	
		
		
	}
	
	
	
}


?>
