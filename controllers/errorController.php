<?php
  include dirname(__FILE__).'/../library/template_model/model/static.page.php';  
  class errorController extends BaseController
  {
    public function indexAction ()
    {
                $code='404';
		$status='Not Found';			
		header("HTTP/1.0 $code $status");
		header("HTTP/1.1 $code $status");
		header("Status: $code $status");
                
                $paramPageView= new StaticPageStorage();               
                $dataReturn=$this->returnParamsPage();                
                $paramPageView->set_partner($dataReturn['partner']);
                $paramPageView->set_enviroment($dataReturn['partnerEnv']);
                $paramPageView->set_novelty($dataReturn['new_wages'],$dataReturn['partnerDebug'] );
                $paramPageView->set_seo($dataReturn['seo']);
                $paramPageView->set_basket_info($dataReturn['basket']);
                $paramPageView->add_menu(4, $this->MenuSaite(), $dataReturn['partnerDebug']);
                $paramPageView->set_title($dataReturn['title']==''? 'Ошибка 404' :$dataReturn['title']);               
                $paramPageView->add_menu(1,$this->MenuCategories(),$dataReturn['partnerDebug']);
                
                $smartyLoad=new Smarty;
		$smartyLoad->debugging = false;		
		$smartyLoad->template_dir='themes/'.$paramPageView->enviroment()->theme_path();
				
		$smartyLoad->assign("template_data",$paramPageView);
		$smartyLoad->display('404.tpl');		
		
    }

  }
?>