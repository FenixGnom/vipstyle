<?php
include dirname(__FILE__).'/../library/template_model/model/category.page.php';
class PopularController extends BaseController {

	public $params = null;
	public $tplSettings=null;
	public $ur;
	public $db;

	function __construct ($check = true) {
		if (!$check) return;
		$this->params = Library::paramUri();
		$this->tplSettings = Registry::getParam('tpl_settings');
		$this->ur = Library::getParams();
		$this->db=new Database();
	}


	public function indexAction () {
		$params = $this->params;
		$data = array();
                $paramPageView=new CategoryPageStorage();
		$dataReturn=$this->returnParamsPage();
                
                $paramPageView->set_partner($dataReturn['partner']);
                $paramPageView->set_enviroment($dataReturn['partnerEnv']);
                $paramPageView->set_novelty($dataReturn['new_wages'],$dataReturn['partnerDebug'] );
                $paramPageView->set_seo($dataReturn['seo']);
                $paramPageView->set_basket_info($dataReturn['basket']);
                $paramPageView->add_menu(4, $this->MenuSaite(), $dataReturn['partnerDebug']);    
		
                $settings = Registry::getParam('user_settings');
                
		
		$count = $settings['prodperpage'];
		$page = 0;
		$_SESSION['catMenu']='popular';

		$page=0;
		if (isset($params['page']) and is_numeric($params['page']))
				$page = $params['page'] - 1;





		$start=$page*$count;

		$query = "SELECT offerss.id
				 AS oldid, offerss.name, relation_type.price AS price, sex.path
				FROM offerss, relation_type, sex
				WHERE sex.id = relation_type.type
				AND relation_type.id_offers = offerss.id group by offerss.id order by offerss.id_offer limit $start,$count";

		$all_count_offers = 50;
		$data['offers'] = $this->db->do_select($query);



		$Paging = new PaginatorStorage(Paging::MakePaging($all_count_offers,$count,$page+1,'/popular/index'),ceil($all_count_offers/$count));
		$nameCat='Лучшие продажи';
		
                $Offers=$this->ReturnObjectOffers($data['offers']);
		
		
                
                $paramPageView->set_offers($Offers,$dataReturn['partnerDebug']);
                $paramPageView->set_title($dataReturn['title']==''? $nameCat :$dataReturn['title']);
                
                
                $paramPageView->add_menu(1,$this->MenuCategories(),$dataReturn['partnerDebug']);               
                $paramPageView->set_category_desc(''); 
                $paramPageView->set_category_name($nameCat); 
               
		$paramPageView->set_pagginator($Paging);
                $smartyLoad=new Smarty;
		$smartyLoad->debugging = false;		
		$smartyLoad->template_dir='themes/'.$paramPageView->enviroment()->theme_path();	
		
		$smartyLoad->assign("template_data",$paramPageView);
		
		$smartyLoad->display('index.tpl');
		

		
	}



}


?>