<?php
include dirname(__FILE__).'/../library/template_model/model/search.page.php';
class searchController extends BaseController {
	function __construct ($check = true) {
		if (!$check) return;
		$this->params = Library::paramUri();
		$this->tplSettings = Registry::getParam('tpl_settings');
	}

	public function showAction () {
		
		$data = array();
		
		$params=$this->params;
		
		$db = new Database();
		
                $paramPageView=new SearchPageStorage();
		$dataReturn=$this->returnParamsPage();
                
                $paramPageView->set_partner($dataReturn['partner']);
                $paramPageView->set_enviroment($dataReturn['partnerEnv']);
                $paramPageView->set_novelty($dataReturn['new_wages'],$dataReturn['partnerDebug'] );
                $paramPageView->set_seo($dataReturn['seo']);
                $paramPageView->set_basket_info($dataReturn['basket']);
                $paramPageView->add_menu(4, $this->MenuSaite(), $dataReturn['partnerDebug']);    
		
                $settings = Registry::getParam('user_settings');
                
                
                
		
		$count_all = $settings['prodperpage'];
		$search_str="";
		if (isset($params['search_find'])) $search_str = urldecode($params['search_find']);
		
		$search_str=str_replace('ищете что-то?','',$search_str);
                $search_str=str_replace('поиск по названию','',$search_str);
		$search_str=  mysql_real_escape_string($search_str);
		if(isset($search_str) and $search_str != '') {
			$search_str=str_replace('"','',$search_str);
			
			$search_str=str_replace("'","",$search_str);
			$search_str=stripcslashes($search_str);
			$search_str=strip_tags($search_str);
			$_SESSION['searchingText']=$search_str;
			
			$data['error_search']='';
			$page=0;
			if (isset($params['page'])) {
				if(is_numeric($params['page']) and $params['page']>0)
					$page = $params['page'] - 1;
				else {
					$view = new View($data);
					return $view->Render('404.phtml');
				}
			} 
                        
                       
                        $start = $page * $count_all;
                        $settings = Registry::getParam('user_settings');
                        switch($settings['showmode'])
                        {
                            case 0:
                                 $coun ="select count(distinct(offerss.id)) as amount FROM offerss WHERE offerss.id=relation_category.id_offers and offerss.name LIKE '%".$search_str."%'";   
                                 $query = "select offerss.*,offerss.id as oldid,rt.type,rt.color,rt.hand,rt.price,rc.id_cat,rc.id_sub,sex.path FROM offerss,relation_category rc,relation_type rt,categories,sex WHERE offerss.id=rt.id_offers and offerss.id=rc.id_offers and offerss.name LIKE '%".$search_str."%' and categories.id=rc.id_cat and sex.id=rt.type GROUP by id limit ".$start.", ".$count_all."";
                            break;
                            case 1: case 2:
                                  $coun ="select count(distinct(offerss.id)) as amount FROM offerss,relation_category,categories,subcategories WHERE offerss.id=relation_category.id_offers and offerss.name LIKE '%".$search_str."%' and offerss.allowed!='F' and categories.allowed!='F' and categories.id=relation_category.id_cat and subcategories.id=relation_category.id_sub and subcategories.allowed!='F'";     
                                  $query = "select offerss.*,offerss.id as oldid,rt.type,rt.color,rt.hand,rt.price,rc.id_cat,rc.id_sub,sex.path FROM offerss,relation_category rc,relation_type rt,categories,sex,subcategories WHERE offerss.id=rt.id_offers and offerss.id=rc.id_offers and offerss.name LIKE '%".$search_str."%' and offerss.allowed!='F' and categories.allowed!='F' and categories.id=rc.id_cat and sex.id=rt.type and subcategories.id=rc.id_sub and subcategories.allowed!='F' GROUP by id limit ".$start.", ".$count_all."";  
                            break; 
                           
                            
                        }
                       
			$count=$db->do_select($coun);
                        $offers=$db->do_select($query);                       
                        $Paging = new PaginatorStorage(Paging::MakePaging($count[0]['amount'],$count_all,$page+1,'/search/'.urlencode($search_str)),ceil($count[0]['amount']/$count_all));
		}		
		else
                {
                    $offers=array();
                    $Paging=new PaginatorStorage(array(),0);
                }
                
                
		$Offers=$this->ReturnObjectOffers($offers);
		$nameCat='Результат поиска';
		
                
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