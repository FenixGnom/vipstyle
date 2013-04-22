<?php
include dirname(__FILE__).'/../library/template_model/model/static.page.php';
class  docsController extends BaseController {
	public $params = null;

	function __construct ($check = true) {
		if (!$check) return;
		$this->params =Library::paramUri();
	}

	public function showAction()
	{
		
		$db = new Database();
                
		$uri=str_replace('.html','',htmlspecialchars($this->params['uri']));
		$data=array();
		$s=$db->do_select("select count(*) as cc from stat_content where url='".mysql_real_escape_string($uri)."'");
		
		
		if($s[0]['cc'] > 0)
		{
			$data['stat']=$db->do_select("select * from stat_content where url='".$uri."'");
                      
			$paramPageView=new StaticPageStorage();
                        $dataReturn=$this->returnParamsPage();

                        $paramPageView->set_partner($dataReturn['partner']);
                        $paramPageView->set_enviroment($dataReturn['partnerEnv']);
                        $paramPageView->set_novelty($dataReturn['new_wages'],$dataReturn['partnerDebug'] );
                        $paramPageView->set_seo($dataReturn['seo']);
                        $paramPageView->set_basket_info($dataReturn['basket']);
                        $paramPageView->add_menu(4, $this->MenuSaite(), $dataReturn['partnerDebug']);
                        $ur=array();
                        $ur[]=new MenuLinkStorage($data['stat'][0]['title'],'/docs/'.$this->params['uri']);
                        $paramPageView->add_menu(5,$ur,$dataReturn['partnerDebug']); 
                        $paramPageView->add_menu(1,$this->MenuCategories(),$dataReturn['partnerDebug']); 
                        $paramPageView->set_content($data['stat'][0]['text']);          
                       
                        
			
                        $paramPageView->set_title($dataReturn['title']==''? $data['stat'][0]['title'] :$dataReturn['title']);
                
                
                            
                      
                
                
                        $smartyLoad=new Smarty;
                        $smartyLoad->debugging = false;		
                        $smartyLoad->template_dir='themes/'.$paramPageView->enviroment()->theme_path();		
                        $smartyLoad->assign("template_data",$paramPageView);
			
			
			
			$smartyLoad->assign("template_data",$paramPageView);
			
			$smartyLoad->display('static_page.tpl');
						
			
		}
		else
		{
			header('Location:/error');
		}
	}	
}


?>
