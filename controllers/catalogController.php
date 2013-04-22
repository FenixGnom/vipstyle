<?php
include dirname(__FILE__).'/../library/template_model/model/category.page.php';
include dirname(__FILE__).'/../library/template_model/model/product.page.php';

class CatalogController extends BaseController {

	public $params = null;
	public $tplSettings=null;
	public $ur;

	function __construct ($check = true) {
		if (!$check) return;
		$this->params = Library::paramUri();
		$this->tplSettings = Registry::getParam('tpl_settings');
		$this->ur = Library::getParams();
	}


	public function shownewAction () {

		$params = $this->params;
		$db = new Database();
		
                
		$paramPageView=new CategoryPageStorage();
		$dataReturn=$this->returnParamsPage();
                
                $paramPageView->set_partner($dataReturn['partner']);
                $paramPageView->set_enviroment($dataReturn['partnerEnv']);
                $paramPageView->set_novelty($dataReturn['new_wages'],$dataReturn['partnerDebug'] );
                $paramPageView->set_seo($dataReturn['seo']);
                $paramPageView->set_basket_info($dataReturn['basket']);
                $paramPageView->add_menu(4, $this->MenuSaite(), $dataReturn['partnerDebug']);    
		
                $settings = Registry::getParam('user_settings');
                
               
                
                
                
		$count =(int) $settings['prodperpage'];
		$page = 0;
		if (isset($params['page'])) {
			if(is_numeric($params['page']) )
				$page = $params['page'] - 1;
			else {
				header('Location: /error');
			}
		}
		
		$start = $page * $count;


		switch ($settings['showmode']){
			case 0:
				$sqlMode='select * from offerss order by id desc LIMIT '.$start.','.$count;
				$all_count_offers_query='select count(*) as cc from offerss ';
				break;
			case 1:
				$sqlMode='SELECT offerss. *
						  FROM offerss, relation_category, categories
                          WHERE relation_category.id_offers = offerss.id
                          AND categories.id = relation_category.id_cat
                          AND categories.allowed != "F"
                          AND offerss.allowed != "F"
						  group by relation_category.id_offers
						  order by relation_category.id_offers desc  limit
						  '.$start.','.$count;
				$all_count_offers_query='SELECT count( DISTINCT (
											relation_category.id_offers
											) ) AS cc
						  FROM offerss, relation_category, categories
                          WHERE relation_category.id_offers = offerss.id
                          AND categories.id = relation_category.id_cat
                          AND categories.allowed != "F"
                          AND offerss.allowed != "F" ';
            break;
			case 2:
			$sqlMode="SELECT offerss. *
						  FROM offerss, relation_category, categories
                          WHERE relation_category.id_offers = offerss.id
                          AND categories.id = relation_category.id_cat
                          AND categories.allowed in ('','T')
                          AND offerss.allowed in ('','T')
						  group by relation_category.id_offers
						  order by relation_category.id_offers desc limit
						  ".$start.",".$count;
			$all_count_offers_query	="SELECT count( DISTINCT (
											relation_category.id_offers
											) ) AS cc
						  FROM offerss, relation_category, categories
                          WHERE relation_category.id_offers = offerss.id
                          AND categories.id = relation_category.id_cat
                          AND categories.allowed in ('','T')
                          AND offerss.allowed in ('','T')";
			break;

		}


		$query = "select o.id as oldid, o.name, o.id_offer, rt.price, sex.path
					from (".$sqlMode.") o, relation_type rt, sex
					where sex.id = rt.type
					and rt.id_offers = o.id group by rt.id_offers ";




		$all_count_offers = $db->cachedQuery($all_count_offers_query,'catalog');
		



		$Offers= $this->ReturnObjectOffers($db->cachedQuery($query));


		unset($db);

		$Paging = new PaginatorStorage(Paging::MakePaging($all_count_offers[0]['cc'],$count,$page+1,'/new'),ceil($all_count_offers[0]['cc']/$count));
		$nameCat='Новинки';
		
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

	 public function showfutAction(){
            $db = new Database();
	    $paramPageView=new CategoryPageStorage();
            $dataReturn=$this->returnParamsPage();

            $paramPageView->set_partner($dataReturn['partner']);
            $paramPageView->set_enviroment($dataReturn['partnerEnv']);
            $paramPageView->set_novelty($dataReturn['new_wages'],$dataReturn['partnerDebug'] );
            $paramPageView->set_seo($dataReturn['seo']);
            $paramPageView->set_basket_info($dataReturn['basket']);
            $paramPageView->add_menu(4, $this->MenuSaite(), $dataReturn['partnerDebug']);    
            
            $settings = Registry::getParam('user_settings');    
            $_SESSION['modelIn']='';
             
            
            
            
            
            
            
            
            
            $s=$db->do_select("select id from sex where path in ('manshort','womanshort','man_polo','mama')");
            $arrayType=array();
            for($i=0;$i<count($s);$i++){
                $arrayType[$i]=$s[$i]['id'];
            }

           
            $count = (int)$settings['prodperpage'];
            $page=1;
            if(isset($this->params['page']) and is_numeric($this->params['page']))
                    $page=$this->params['page'];
            $start = ($page-1) * $count;
            $query = "SELECT offerss.*,offerss.id as oldid,rt.type,rt.color,rt.hand,rt.price,rc.id_cat,rc.id_sub,sex.path FROM offerss,relation_type rt,relation_category rc,sex where offerss.id=rc.id_offers and offerss.id=rt.id_offers and rt.type in (".implode(',',$arrayType).") and  offerss.allowed!='F' and rt.hand=0 and sex.id= rt.type group by offerss.id order by id asc LIMIT $start,$count";

            $nameCat='Футболки';
			$Offers = $this->ReturnObjectOffers($db->cachedQuery($query));
            $all=$db->do_select("SELECT distinct(count(*)) as cc FROM offerss,relation_type r where offerss.id=r.id_offers and r.type in (".implode(',',$arrayType).") and  offerss.allowed!='F' and r.hand=0");
            
            
            
            $Paging = new PaginatorStorage(Paging::MakePaging($all[0]['cc'],$count,$page,'/catalog/showfut'),ceil($all[0]['cc']/$count));			
            
            
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

	public function showallAction() {
            
            
                
		$params = $this->params;
		$_SESSION['thisCat']=0;
                
                
                
		$paramPageView=new CategoryPageStorage();
		$dataReturn=$this->returnParamsPage();
                
                $paramPageView->set_partner($dataReturn['partner']);
                $paramPageView->set_enviroment($dataReturn['partnerEnv']);
                $paramPageView->set_novelty($dataReturn['new_wages'],$dataReturn['partnerDebug'] );
                $paramPageView->set_seo($dataReturn['seo']);
                $paramPageView->set_basket_info($dataReturn['basket']);
                $paramPageView->add_menu(4, $this->MenuSaite(), $dataReturn['partnerDebug']);               
                
		$ur=$this->ur;
		$db = new Database();
		$data = array();
		$intHodie=0;
		$_SESSION['thisCat']=0;
		$CurrCategory='';
                $_SESSION['modelIn']='';
		if(isset($params['wages']) and $params['wages']=='hoodie')
		{
			$typeM=$db->do_select('select id from sex where path="hoodie"');
			$params['wages']=$typeM[0]['id'];
			$intHodie=1;
			$CurrCategory='hoodie';
                        $_SESSION['modelIn']='hoodie';
		}

		$selectModel='';
                
                if(isset($params['model']))
		{
			$_SESSION['modelIn']=$params['model'];
                        switch(htmlspecialchars($params['model']))
			{
				case 'krujka':

					$typeM=$db->do_select('select id from sex where path in ("mug_kant","mug_twotone","mug_mat","krujka")');

					$tempC=count($typeM);

					if($tempC>1)
					{
						$tempArray=array();
						for($s=0;$s<$tempC;$s++)
						{
							$tempArray[$s]=$typeM[$s]['id'];
						}
						$selectModel=$tempArray;
					}
					else
						$selectModel=$typeM[0]['id'];

				break;
				case 'pants':

					$typeM=$db->do_select('select id from sex where path in ("pantsman","pantswoman")');

					$tempC=count($typeM);
					if($tempC>1)
					{
						$tempArray=array();
						for($s=0;$s<$tempC;$s++)
						{
							$tempArray[$s]=$typeM[$s]['id'];
						}
						$selectModel=$tempArray;
					}
					else
						$selectModel=$typeM[0]['id'];
				break;
				case 'caps':

					$typeM=$db->do_select('select id from sex where path in ("caps","hat")');

					$tempC=count($typeM);
					if($tempC>1)
					{
						$tempArray=array();
						for($s=0;$s<$tempC;$s++)
						{
							$tempArray[$s]=$typeM[$s]['id'];
						}
						$selectModel=$tempArray;
					}
					else
						$selectModel=$typeM[0]['id'];
				break;
				case 'bag':
					$typeM=$db->do_select('select id from sex where path ="bag"');
					$selectModel=$typeM[0]['id'];
				break;
				case 'pad':
					$typeM=$db->do_select('select id from sex where path in ("pad","pad2")');
					$tempC=count($typeM);
					if($tempC>1)
					{
						$tempArray=array();
						for($s=0;$s<$tempC;$s++)
						{
							$tempArray[$s]=$typeM[$s]['id'];
						}
						$selectModel=$tempArray;
					}
					else
						$selectModel=$typeM[0]['id'];
				break;
				case 'sign':
					$typeM=$db->do_select('select id from sex where path ="sign"');
					$selectModel=$typeM[0]['id'];
				break;
				case 'shale':
					$typeM=$db->do_select('select id from sex where path ="shale"');
					$selectModel=$typeM[0]['id'];
				break;
				default:
					$selectModel='';
				break;

			}
			$_SESSION['modelCatalog']=$params['model'];

		}
		else
                    unset ($_SESSION['modelCatalog']);


		$settings = Registry::getParam('user_settings');
		$DescCats='';
		if(isset($params['wages'])) {
			if(!is_numeric($params['wages']) || $params['wages']<0) {
				header('Location: /error');
			} else {
				$_SESSION['thisCat']=$params['wages'];
				$categoryid = $params['wages'];
				$CurrCategory=$categoryid;
				$descript=$db->do_select('select * from description_cat where id_cat='.$categoryid);
				//echo 'select * from description_cat where id_cat='.$categoryid;
				if(count($descript)!=0) $DescCats=$descript[0]['desc'];
			}
		}
		else{ $categoryid =$settings['catindex'];$CurrCategory=$settings['catindex'];}
		
		
		
		
		if ($ur['controller']=='index') {
			$info_doc=$db->do_select('select text from stat_content where start=1');
			$data['doc_info']=@stripslashes($info_doc[0]['text']);
		}
		else $data['doc_info']='';
		$subcat_q = '';
		$subcatgory = @$params['subcat'];
		if (isset($params['page'])) {
			if(is_numeric($params['page']) and $params['page']>0 ) $page = $params['page'] - 1;
			else {
				header('Location: /error');
			}
		} else $page = 0;
		$count = (int)$settings['prodperpage'];
		$start = $page * $count;
		switch ($settings['showmode']){
			case 0:
				$clauseShowCat="id_cat=".$categoryid;
				$clauseSubcat="";
				$clauseShowSubcat="";
				$clauseShowOffers="";
				$clauseTableCat="";
				$clauseTableSubcat="";
				$clauseTableOffers="";
				break;
			case 1:
				$clauseShowCat="c.id=rc.id_cat AND c.allowed in('','T')";
				$clauseSubcat="\n	AND sc.id=rc.id_sub AND sc.parentcategoryid=rc.id_cat";
				$clauseShowSubcat=" AND sc.allowed in('','T')";
				$clauseShowOffers="\n	AND i.allowed in('','T')";
				$clauseTableCat=",categories c";
				$clauseTableSubcat=",subcategories sc";
				$clauseTableOffers="";
				break;
			case 2:
				$clauseShowCat="c.id=rc.id_cat AND c.allowed in('','T')";
				$clauseSubcat="\n	AND sc.id=rc.id_sub AND sc.parentcategoryid=rc.id_cat";
				$clauseShowSubcat=" AND sc.allowed in('','T')";
				$clauseShowOffers="\n	AND i.allowed in('','T')";
				$clauseTableCat=",categories c";
				$clauseTableSubcat=",subcategories sc";
				$clauseTableOffers="";
		}
		$subcatTable = '';

		if (isset($params['subcat']) ) {
			$subcatgory = $params['subcat'];
			$subcat_q = "AND rc.id_sub='$subcatgory'";
			$subcatTable = $clauseTableSubcat;
			$data['subs_in_cat_page']=$params['subcat'];
			$descript=$db->do_select("select * from description_subcat where id_subcat='$subcatgory' and id_cat=".$categoryid);
			if(count($descript)!=0) $DescCats=$descript[0]['desc'];
		}
		else $data['subs_in_cat_page']='';
		$data['isNamed']='';
		/////////
                $sqlModel='';
		if($categoryid!=0) {
			if($intHodie!=1)
			{
				

				if($selectModel!='')
				{
					if(is_array($selectModel))
						$sqlModel=' and rt.type in ('.implode(',',$selectModel).')';
					else
						$sqlModel=' and rt.type='.$selectModel;

				}

				$query_cat = "select * from categories where id='$categoryid'";
				$data['curr_category'] = $db->do_select($query_cat);
				$nameCat=$data['curr_category'][0]['name'];
				$query = "SELECT i.id as oldid,i.name,rt.price,sex.path from relation_category rc,relation_type rt,offerss i $clauseTableCat $clauseTableSubcat $clauseTableOffers".
						",sex \n	WHERE i.id=rt.id_offers and i.id=rc.id_offers ".($clauseShowCat ? " \n	AND $clauseShowCat" : "")." $subcat_q".
						" $clauseSubcat $clauseShowSubcat $clauseShowOffers".
						"\n	".$sqlModel." and rc.id_cat=".$categoryid." and sex.id=rt.type GROUP BY i.id ORDER BY i.id desc limit $start,$count";



			}
			else
			{
				$nameCat = 'Толстовки';
				$data['curr_category'][0]['id'] = 'hoodie';
				$query = "SELECT i.id as oldid,i.name,rt.price,sex.path from relation_category rc,relation_type rt,offerss i $clauseTableCat $clauseTableSubcat $clauseTableOffers".
						",sex \n	WHERE i.id=rt.id_offers and i.id=rc.id_offers ".($clauseShowCat ? " \n	AND $clauseShowCat" : "")." $subcat_q".
						" $clauseSubcat $clauseShowSubcat $clauseShowOffers".
						"\n	".$sqlModel."  and rt.type=".$typeM[0]['id']." and sex.id=rt.type GROUP BY i.id ORDER BY i.id desc limit $start,$count";	
				$data['isNamed']='hoodie';
			}
		} else {
			$query = "select offerss. * , offerss.id as oldid, rc.type, rc.color, rc.hand, rc.price price, rt.id_cat, rt.id_sub, sex.path from relation_type rc, offerss, categories, relation_category rt, sex
			where offerss.id = rt.id_offers and offerss.id = rc.id_offers and sex.id = rc.type and offerss.allowed != 'f' and categories.allowed != 'f' and categories.id = rt.id_cat group by offerss.id order by offerss.id_offer asc  limit $start,$count";
			$nameCat='';
			$DescCats='';
			if(!isset($params['wages'])){
				$nameCat = 'Популярные товары';
				$descript=$db->do_select("select * from description_cat where id_cat=0");
				if(count($descript)!=0) $DescCats = $descript[0]['desc'];

			}
		}

		$Offers = $this->ReturnObjectOffers($db->cachedQuery($query));


		$subcat_lnk='';
		$category_lnk = '';
		$ActiveSubkat='';
		if($categoryid!=0) {
			if($intHodie==1){
				$subcat_lnk='';
				$category_lnk='/hoodie';
				$query = "SELECT count(*) AS all_count FROM relation_type,offerss where relation_type.id_offers=offerss.id and relation_type.type=".$typeM[0]['id'];
				
				//$df=$db->cachedQuery($query,'catalog');
				$df=$db->do_select($query);
				
				$all_count_offers = $df[0]['all_count'];


			}
			else{
				$category_lnk = '/'.$categoryid;

				if ($subcatgory!=''){ $subcat_lnk='/subcat/'.$subcatgory;$ActiveSubkat=$subcatgory;}
				else $subcat_lnk='';
				$query = "SELECT count(*) AS all_count FROM offerss i,relation_category rc $clauseTableOffers".
						"\n	WHERE rc.id_offers=i.id and rc.id_cat=$categoryid $subcat_q $clauseShowOffers GROUP BY i.id";
				$all_count_offers = count($db->do_select($query));

			}

		}
		else
		{
			$all_count_offers=$count;
		}



			$urlTo='/cat'.$category_lnk.''.$subcat_lnk;
			$LinkToSubcat='';
			if($selectModel!="")
			{	$urlTo.='/model/'.$params['model'];
				$LinkToSubcat='/model/'.$params['model'];
			}
                        
			$Paging = new PaginatorStorage(Paging::MakePaging($all_count_offers,$count,$page+1,$urlTo),ceil($all_count_offers/$count),$dataReturn['partnerDebug']);
			$query = "select id,name from subcategories sc WHERE parentcategoryid='$categoryid' $clauseShowSubcat and sc.id!='0' and sc.name not in('Все','все')";
			
                        $Subcategories=array();			
                        $SubcategoriesTemp = $db->cachedQuery($query);
                        $countSubcat=count($SubcategoriesTemp);
                        if($countSubcat>0)
                        {
                            $curent=false;
                            if(!isset($params['subcat']))
                              $curent=true;  
                            $Subcategories[0]=new MenuLinkStorage('Все', '/cat/'.$categoryid.$LinkToSubcat,$curent );

                            for($i=0;$i<$countSubcat;$i++)
                            {
                                $SubTemp=$SubcategoriesTemp[$i];

                                unset($SubcategoriesTemp[$i]);
                                $SubTemp['url']='/cat/'.$categoryid.'/subcat/'.$SubTemp['id'].$LinkToSubcat;
                                $SubTemp['curent']=false;
                                if($SubTemp['id']==$ActiveSubkat)
                                    $SubTemp['curent']=true; 
                                $Subcategories[$i+1]=new MenuLinkStorage($SubTemp['name'], $SubTemp['url'], $SubTemp['curent']);
                                unset($SubTemp);
                            }
                        }
		
                $paramPageView->set_offers($Offers,$dataReturn['partnerDebug']);
                $paramPageView->set_title($dataReturn['title']==''? $nameCat :$dataReturn['title']);
                
                $paramPageView->add_menu(2,$Subcategories,$dataReturn['partnerDebug']);
                $paramPageView->add_menu(1,$this->MenuCategories(),$dataReturn['partnerDebug']);               
                $paramPageView->set_category_desc($DescCats); 
                $paramPageView->set_category_name($nameCat);         
		$paramPageView->set_pagginator($Paging);
                
               
                $smartyLoad=new Smarty;
		$smartyLoad->debugging = false;
		
		$smartyLoad->template_dir='themes/'.$paramPageView->enviroment()->theme_path();	
		
		$smartyLoad->assign("template_data",$paramPageView);
		$smartyLoad->display('index.tpl');
		


	}


	public function showoneAction () {

		$params = $this->params;
		
		$db = new Database();
		$_SESSION['thisCat']=0;
                
        $redirect = array(
		    "man" => "manshort",
		    "woman" => "womanshort",
		    "man-long" => "manlong",
		    "woman-long" => "womanlong"
		);

		if (array_key_exists($params["model"], $redirect))
		{
		    header("Location: /product/" . (int) $params["wages"] . "/model/" . $redirect[$params["model"]],
			    true, 301);

		    return;
		}
                
		$paramPageView=new ProductPageStorage();
		$dataReturn=$this->returnParamsPage();
                
                $paramPageView->set_partner($dataReturn['partner']);
                $paramPageView->set_enviroment($dataReturn['partnerEnv']);
                $paramPageView->set_novelty($dataReturn['new_wages'],$dataReturn['partnerDebug'] );
                $paramPageView->set_seo($dataReturn['seo']);
                $paramPageView->set_basket_info($dataReturn['basket']);
                $paramPageView->add_menu(4, $this->MenuSaite(), $dataReturn['partnerDebug']);           
		
                $settings = Registry::getParam('user_settings');
                //$showmode = Registry::getParam('tpl_settings');
              
                
                
                
		
		$product_id = intval($params['wages']);

		$scnormal=$db->do_select('select count(*) as cc from offerss where id='.$product_id);
		
		$RefererSearching=false;
		if(isset($_SERVER['HTTP_REFERER']))
		{
                    $temPref=explode('/',str_replace('http://','',$_SERVER['HTTP_REFERER']));
                    if($temPref[1]=='search')
                    {
                        $_SESSION['thisCat']=0;
                        $RefererSearching=true;
                    }
		}

		if($scnormal[0]['cc']==0)
		{
                    if($product_id<100000)
                    {
                        $scnormal=$db->do_select('select count(*) as cc from offerss where id='.($product_id+100000));
                        if($scnormal[0]['cc']==0)
                        {
                                header('Location: /error');
                        }
                        else
                        {
                                $urlMod='/product/'.($product_id+100000);
                                if(isset($this->params['model']) and $this->params['model']!='')
                                        $urlMod.='/model/'.$this->params['model'];
                                        //die($urlMod);
                                        header("HTTP/1.1 301 Moved Permanently");
                                    header("Location: ".$urlMod);
                        }
                    }
                    else
                        header('Location: /error');
			
		}
                
                
		if(isset($_SESSION['thisCat']) and $_SESSION['thisCat']!=0)
		{
			$sm=$db->do_select('select count(*) as cc from offerss,relation_category where offerss.id=relation_category.id_offers and offerss.id='.$product_id.' and relation_category.id_cat='.$_SESSION['thisCat']);
			
                        if($sm[0]['cc']==0)
				$_SESSION['thisCat']=0;
		}
                


		
		if(isset($this->params['model']) and $this->params['model']=='hoodie')
                    $_SESSION['thisCat']=0;
		
		
		$thisCatId=$_SESSION['thisCat'];

		if($_SESSION['thisCat']==0)
		{
			$s=$db->do_select('select id_cat as categoryid from relation_category,offerss,categories where offerss.id=relation_category.id_offers and offerss.id='.$product_id.' and categories.allowed !="F" and categories.id=relation_category.id_cat limit 1');

			$thisCatId=$s[0]['categoryid'];

		}
                

		switch ($settings['showmode']){
			case 0:
				$clauseShowCat="";
				$clauseShowSubcat="and rc.id_cat=".$thisCatId ;
				$clauseShowOffers="";
				$clauseTableSubcat="";
				$clauseTableOffers="";
				break;
			case 1:case 2:
				$clauseShowCat="\n	AND c.allowed in('','T')";
				$clauseShowSubcat="\n	AND sc.id=rc.id_sub AND sc.parentcategoryid=rc.id_cat and rc.id_cat=".$thisCatId." AND sc.allowed in('','T')";
				$clauseShowOffers="\n	AND i.allowed in('','T')";
				$clauseTableSubcat=",subcategories sc";
				$clauseTableOffers="";
				break;
		}	

		if(!is_numeric($params['wages']) || $params['wages']<0) {
			header('Location: /error');
		} else {
                        
                    
                    
			$sql = "SELECT i.*,rt.type as sexid,rt.color,rt.hand,rt.price,rc.id_cat as categoryid,rc.id_sub as subcategoryid,c.name as catname from offerss i,relation_category rc,relation_type rt, categories c $clauseTableSubcat $clauseTableOffers ".
					"\n	WHERE i.id=rt.id_offers and i.id=rc.id_offers and i.id='$product_id' AND c.id=rc.id_cat $clauseShowCat $clauseShowSubcat $clauseShowOffers";

			$Offers = $db->do_select($sql);
                        if(count($Offers)==0)
                            header('Location: /error');
                        
			$linkTemp='';
                        if(isset($_SESSION['modelCatalog']))
				$linkTemp='/model/'.$_SESSION['modelCatalog'];    
                        
                        $category=new MenuLinkStorage($Offers[0]['catname'], '/cat/'.$Offers[0]['categoryid'].$linkTemp);
                        
                        $Sub_cat=null;
			if($Offers[0]['subcategoryid']!='0') {
                            $Sub_cat_name=$db->do_select("select name from subcategories where id='".$Offers[0]['subcategoryid']."'");
                            $Sub_cat= new MenuLinkStorage($Sub_cat_name[0]['name'], '/cat/'.$Offers[0]['categoryid'].'/subcat/'.$Offers[0]['subcategoryid'].$linkTemp);

                            unset($Sub_cat_name);
			}
			
			if(isset($this->params['model']) )
			{
				
				$typeM=$db->do_select('select id from sex where path="'.htmlspecialchars($this->params['model']).'"');
				
				if($typeM)
					$sexid=$typeM[0]['id'];

			}
			else
			{
				$sexid=$Offers[0]['sexid'];

			}
                        
                       
			$this->params =array('wages'=>$Offers[0]['id'],'sex'=>$sexid,'catid'=>$thisCatId);
                        $offersPage=$this->showsexAction(); 
                        $paramPageView->set_product_id($product_id);
                        $paramPageView->set_enviroment($dataReturn['partnerEnv']);
                        $paramPageView->set_product_name($this->NameOffersFromType($offersPage['product'][0]['name'],$offersPage['product'][0]['typepath']));
                        $paramPageView->set_category($category);
                        $paramPageView->set_subcategory($Sub_cat);
                        $color=$this->showimgsmall($offersPage['product'][0]['oldid'],$offersPage['product'][0]['hand'],$offersPage['product'][0]['type']);
                        $paramPageView->set_color($color,$dataReturn['partnerDebug']);
                        $paramPageView->set_front($offersPage['product'][0]['front']);
                        $paramPageView->set_back($offersPage['product'][0]['back']);
                        $paramPageView->set_model($offersPage['models'], $dataReturn['partnerDebug']);
                        $paramPageView->set_color_default($offersPage['color_default']);
                        $paramPageView->set_model_default($offersPage['model_default']);
                        $paramPageView->set_size($offersPage['sizes'],$dataReturn['partnerDebug']);
                        if(count($offersPage['sizes'])>0)                       
                            $paramPageView->set_size_default($offersPage['size_default']);
                        
                        $paramPageView->set_other_offers($offersPage['other'], $dataReturn['partnerDebug']);
                        $paramPageView->set_serch_flag($RefererSearching);
                        $paramPageView->set_img_url($offersPage['imagesFace']);
                        $paramPageView->set_imgback_url($offersPage['imagesBack']);
                        $paramPageView->set_imgbig_url($offersPage['imagesFaceBig']);
                        $paramPageView->set_imgbackbig_url($offersPage['imagesBackBig']);                        
                        $paramPageView->set_title($dataReturn['title']==''? $Offers[0]['name'] :$dataReturn['title']);
                        $paramPageView->set_description($offersPage['description']);
                        $paramPageView->set_is_hand($offersPage['product'][0]['issetLong']);
                        $paramPageView->add_menu(1,$this->MenuCategories(),$dataReturn['partnerDebug']); 
                        
                        $paramPageView->set_price($offersPage['product'][0]['price']);
                        
                          
                        
                        
			$smartyLoad=new Smarty;
			$smartyLoad->debugging = false;
			
			$smartyLoad->template_dir='themes/'.$paramPageView->enviroment()->theme_path();		
			
			$smartyLoad->assign("template_data",$paramPageView);			
			$smartyLoad->display('product.tpl');                   
                        
                       
			
		}
	}

	public function OtherOffers($oldid, $t = 'manshort')
    {
		$db = new Database();

		switch ($t)
		{
		    case 'manshort':
			$type = array('"manshort"', '"manlong"', '"man_polo"', '"womanshort"', '"mama"', '"womanlong"', '"child"', '"hoodie"', '"man_tshirt"', '"woman_borcovka"');
			break;
		    case 'man_tshirt':
			$type = array('"manshort"', '"manlong"', '"man_polo"', '"womanshort"', '"mama"', '"womanlong"', '"child"', '"hoodie"', '"man_tshirt"', '"woman_borcovka"');
			break;
		    case 'man_polo':
			$type = array('"manshort"', '"manlong"', '"man_polo"', '"womanshort"', '"mama"', '"womanlong"', '"child"', '"hoodie"', '"man_tshirt"', '"woman_borcovka"');
			break;
		    case 'hoodie':
			$type = array('"manshort"', '"manlong"', '"man_polo"', '"womanshort"', '"mama"', '"womanlong"', '"child"', '"hoodie"', '"man_tshirt"', '"woman_borcovka"');
			break;
		    case 'womanshort':
			$type = array('"manshort"', '"manlong"', '"man_polo"', '"womanshort"', '"mama"', '"womanlong"', '"child"', '"hoodie"', '"man_tshirt"', '"woman_borcovka"');
			break;
		    case 'woman_borcovka':
			$type = array('"manshort"', '"manlong"', '"man_polo"', '"womanshort"', '"mama"', '"womanlong"', '"child"', '"hoodie"', '"man_tshirt"', '"woman_borcovka"');
			break;
		    case 'mama':
			$type = array('"manshort"', '"manlong"', '"man_polo"', '"womanshort"', '"mama"', '"womanlong"', '"child"', '"hoodie"', '"man_tshirt"', '"woman_borcovka"');
			break;
		    case 'womanlong':
			$type = array('"manshort"', '"manlong"', '"man_polo"', '"womanshort"', '"mama"', '"womanlong"', '"child"', '"hoodie"', '"man_tshirt"', '"woman_borcovka"');
			break;
		    case 'child':
			$type = array('"manshort"', '"manlong"', '"man_polo"', '"womanshort"', '"mama"', '"womanlong"', '"child"', '"hoodie"', '"man_tshirt"', '"woman_borcovka"');
			break;
		    case 'krujka':
			$type = array('"krujka"', '"mug_kant"', '"mug_twotone"', '"mug_mat"');
			break;
		    case 'mug_kant':
			$type = array('"krujka"', '"mug_kant"', '"mug_twotone"', '"mug_mat"');
			break;
		    case 'mug_twotone':
			$type = array('"krujka"', '"mug_kant"', '"mug_twotone"', '"mug_mat"');
			break;
		    case 'mug_mat':
			$type = array('"krujka"', '"mug_kant"', '"mug_twotone"', '"mug_mat"');
			break;
		    case 'caps':
			$type = array('"caps"');
			break;
		    case 'pantsman':
			$type = array('"pantsman"', '"pantswoman"');
			break;
		    case 'pantswoman':
			$type = array('"pantsman"', '"pantswoman"');
			break;
		    case 'pad':
			$type = array('"pad"', '"pad2"');
			break;
		    case 'pad2':
			$type = array('"pad"', '"pad2"');
			break;
		    case 'sign':
			$type = array('"sign"');
			break;
		    case 'bag':
			$type = array('"bag"');
			break;
		    case 'hat':
			$type = array('"hat"');
			break;

		    case 'shale':
			$type = array('"shale"');
			break;
		    default:
			$type = array('"manshort"', '"manlong"', '"man_polo"', '"womanshort"', '"mama"', '"womanlong"', '"child"', '"hoodie"', '"man_tshirt"', '"woman_borcovka"');
			break;
		}


		$type[] = '"' . $t . '"';
		$s = $db->do_select('select distinct(relation_type.type) as type,sex.path from sex,relation_type where sex.path not in (' . implode(',',
				$type) . ') and relation_type.id_offers=' . $oldid . ' and relation_type.type = sex.id');


		$cc = count($s);
		if ($cc == 0)
		    return array();

		$limits = $cc;
		if ($cc > 3)
		    $limits = 3;

		srand((float) microtime() * 10000000);
		if ($limits > 1)
		    $rand_keys = array_rand($s, $limits);
		else
		    $rand_keys = array('0');

		$arrayType = array();
		foreach ($rand_keys as $val)
		{
		    $arrayType[] = $s[$val]['type'];
		}



		$OtherOffers = $db->do_select('SELECT offerss.name,offerss.id as oldid,sex.path,relation_type.price as price FROM offerss,sex,relation_type where offerss.id=relation_type.id_offers and sex.id=relation_type.type AND relation_type.type IN(' . implode(',',
				$arrayType) . ') and offerss.id=' . $oldid . ' GROUP BY relation_type.type  limit 0,3');

		return $OtherOffers;
    }

	public function showsexAction () {

		$params = $this->params;
		$db = new Database();
		$ArrayReturn = array();	
                
		
		
		$params['wages']=intval($params['wages']);


		if(!isset($params['sex']) or (int)$params['sex']<1 || !is_numeric($params['sex'])){

			header('Location: /error');
		}
		$product_id = $params['wages'];
		if(isset($this->params['catid']))
			$_SESSION['catidOne']=$this->params['catid'];
                /*
                 * выбор всех доступных моделей для данного макета
                 * 
                 */
		
                $models=$this->ReturnModel($product_id);
                
                $ArrayReturn['models']=array();
                $modCount=count($models);
                for($i=0;$i<$modCount;$i++)
                {
                    $mTemp=$models[$i];
                    $ArrayReturn['models'][$i]=new ModelsStorage($mTemp['id'],$mTemp['name']);
                    unset($models[$i]);
                }

		$long='(rt.hand=0 or rt.hand=2)';
		$slong=0;
		if(isset($this->params['long']) and $this->params['long']==1)
		{	$long='rt.hand>0';
			$slong=1;
		}
                
		$typeSql='';
		$typeSql2='';
		$isType='';
		if(isset($params['sex'])){
			$typeSql=' and rt.type ='.$params['sex'];
			$typeSql2=' and relation_type.type='.$params['sex'];
			$isType='AND sex.id ='.$params['sex'];
		}
                $sqlColor='';
             
                $colorSklad=$this->returnColorForType($params['sex'],$slong);
                if(count($colorSklad)>0)
                   $sqlColor=' and rt.color in ('.implode(',',$colorSklad).')'; 
              
		$sql = "SELECT offerss.id as oldid,offerss.name,offerss.front,offerss.back,rt.type,rt.color,rt.hand ,rt.price as price,rc.id_cat as categoryid,rc.id_sub,  sex.params as paramsis, sex.name AS typnames,
			sex.path AS typepath,sex.double,  color.abriv AS colorpath, color.name AS colorname
			FROM offerss, sex, color,relation_type rt,relation_category rc
			WHERE offerss.id=rc.id_offers and offerss.id=rt.id_offers and offerss.id ='$product_id' ".$typeSql." ".$isType." AND rt.color = color.id and rc.id_cat=".$_SESSION['catidOne']." and ".$long."  ".$sqlColor." group by rt.color limit 1";

		
                $ArrayReturn['product'] = $db->do_select($sql);
              
                $descript=$db->do_select("select * from description_offers where id_offers='$product_id'");
               
                $ArrayReturn['description']=(count($descript)>0 ? $descript[0]['desc'] :'');

		if(count($ArrayReturn['product'])==0){

			$sql = "SELECT offerss.id as oldid,offerss.name,offerss.front,offerss.back,rt.type,rt.color,rt.hand,rt.price as price,rc.id_cat as categoryid,rc.id_sub,  sex.params as paramsis, sex.name AS typnames,
			sex.path AS typepath,sex.double,  color.abriv AS colorpath, color.name AS colorname
			FROM offerss, sex, color,relation_type rt,relation_category rc
			WHERE offerss.id=rc.id_offers and offerss.id=rt.id_offers and offerss.id ='$product_id' ".$typeSql."
				AND sex.id =rt.type AND rt.color = color.id  and ".$long." ".$sqlColor." group by rt.color limit 1";

			$ArrayReturn['product'] = $db->do_select($sql);
			$_SESSION['catidOne']=$ArrayReturn['product'][0]['categoryid'];
		}
                
                $ArrayReturn['model_default']=new ModelsStorage($ArrayReturn['product'][0]['type'], $ArrayReturn['product'][0]['typnames'], $ArrayReturn['product'][0]['typepath'],$ArrayReturn['product'][0]['double']);
               
                $ArrayReturn['color_default']=new ColorStorage ($ArrayReturn['product'][0]['color'], $ArrayReturn['product'][0]['hand'], $ArrayReturn['product'][0]['front'],$ArrayReturn['product'][0]['back'],$ArrayReturn['product'][0]['colorpath'],$ArrayReturn['product'][0]['typepath'],$ArrayReturn['product'][0]['colorname']);
                
        $tempLongs = $ArrayReturn['product'][0]['typepath'];
		if (isset($this->params['long']) and $this->params['long'] == 1)
		{
		    $tempLongs.='long';
		    if ($ArrayReturn['product'][0]['colorpath'] == "whitered" or $ArrayReturn['product'][0]['colorpath'] == "whiteblue" and $ArrayReturn['product'][0]['typepath'] == "manshort")
			$ArrayReturn['product'][0]['price'] = $ArrayReturn['product'][0]['price'] + 160;
		    else
			$ArrayReturn['product'][0]['price'] = $ArrayReturn['product'][0]['price'] + 50;
		}
                $ArrayReturn['size_default']='';
                
		$ArrayReturn['sizes']=array();
		if($ArrayReturn['product'][0]['paramsis']!="")
		{

			$b=$db->do_select('select size from relation_type_size where id_type="'.$tempLongs.'" and color="'.$ArrayReturn['product'][0]['color'].'" and size!="" and status=1 group by size');
                        
			if(count($b)>0)
			{	
                            $ArrayReturn['sizes']=self::NormSort($b,$tempLongs.'_'.$ArrayReturn['product'][0]['colorpath']);
                            $ArrayReturn['size_default']=$ArrayReturn['sizes'][0];
                        }
			
		}


		$ArrayReturn['product'][0]['issetLong']=1;
		$hand=$db->do_select('select count(*) as longcount from offerss,relation_type,relation_category where offerss.id=relation_category.id_offers and offerss.id=relation_type.id_offers and relation_type.hand=1 and offerss.id='.$product_id.' '.$typeSql2.' and relation_category.id_cat='.$_SESSION['catidOne']);
		if($hand[0]['longcount']==0)
                    $ArrayReturn['product'][0]['issetLong']=0;	
		
		$settings = Registry::getParam('user_settings');

		if ($settings['showOther'] == 0)
			$ArrayReturn['other']=array();
		else
			$ArrayReturn['other']=$this->ReturnObjectOffers ($this->OtherOffers($ArrayReturn['product'][0]['oldid'],$ArrayReturn['product'][0]['typepath']));
		
		
		$Views=new View;
		$ArrayReturn['imagesFace']= $Views->LoadProdImageFut ($ArrayReturn['product'][0]['oldid'],$ArrayReturn['product'][0]['typepath'],$ArrayReturn['product'][0]['colorpath'],'250',$ArrayReturn['product'][0]['hand'],$ArrayReturn['product'][0]['front']);


		$ArrayReturn['imagesFaceBig']=$Views->LoadProdImageFut ($ArrayReturn['product'][0]['oldid'],$ArrayReturn['product'][0]['typepath'],$ArrayReturn['product'][0]['colorpath'],'500',$ArrayReturn['product'][0]['hand'],$ArrayReturn['product'][0]['front']) ;

		$ArrayReturn['imagesBack']='';

		$ArrayReturn['imagesBackBig']='';

		if($ArrayReturn['product'][0]['double']==1){
			$ArrayReturn['imagesBack']=$Views->LoadProdImageFutBack ($ArrayReturn['product'][0]['oldid'],$ArrayReturn['product'][0]['typepath'],$ArrayReturn['product'][0]['colorpath'],'250',$ArrayReturn['product'][0]['hand'],$ArrayReturn['product'][0]['back']);

			$ArrayReturn['imagesBackBig']=$Views->LoadProdImageFutBack ($ArrayReturn['product'][0]['oldid'],$ArrayReturn['product'][0]['typepath'],$ArrayReturn['product'][0]['colorpath'],'500',$ArrayReturn['product'][0]['hand'],$ArrayReturn['product'][0]['back']);
		}
		
		
		
                
                if(isset($_SERVER['HTTP_X_REQUESTED_WITH']))
                {   
                    $linkTemp='';
                    if(isset($_SESSION['modelCatalog']))
						$linkTemp='/model/'.$_SESSION['modelCatalog'];    
					
					$view=new View();
					
					$catname=$db->do_select('select name from categories where id='.$ArrayReturn['product'][0]['categoryid']);
					
					
					
                    $category=new MenuLinkStorage($catname[0]['name'], '/cat/'.$ArrayReturn['product'][0]['categoryid'].$linkTemp);
                        
                    $Sub_cat=null;
					if($ArrayReturn['product'][0]['id_sub']!='0') {
                            $Sub_cat_name=$db->do_select("select name from subcategories where id='".$ArrayReturn['product'][0]['id_sub']."'");
                            $Sub_cat= new MenuLinkStorage($Sub_cat_name[0]['name'], '/cat/'.$ArrayReturn['product'][0]['categoryid'].'/subcat/'.$ArrayReturn['product'][0]['id_sub'].$linkTemp);

                            unset($Sub_cat_name);
					}
					
					
					$paramPageView=new ProductPageStorage();
                    $user_settings = Registry::getParam('user_settings'); 
                    $dataReturn=$this->returnParamsPage();
                   
                    $paramPageView->set_product_id($ArrayReturn['product'][0]['oldid']);
                    $paramPageView->set_product_name($this->NameOffersFromType($ArrayReturn['product'][0]['name'],$ArrayReturn['product'][0]['typepath']));
                    $paramPageView->set_price($ArrayReturn['product'][0]['price']);
                    
                    $color=$this->showimgsmall($ArrayReturn['product'][0]['oldid'],$ArrayReturn['product'][0]['hand'],$ArrayReturn['product'][0]['type']);
                    $paramPageView->set_color($color,$user_settings['ansverServer']);
					$paramPageView->set_category($category);
                    $paramPageView->set_subcategory($Sub_cat);
                    $paramPageView->set_model($ArrayReturn['models'], $user_settings['ansverServer']);
                    $paramPageView->set_color_default($ArrayReturn['color_default']);
                    $paramPageView->set_model_default($ArrayReturn['model_default']);                        
                    $paramPageView->set_size($ArrayReturn['sizes'],$user_settings['ansverServer']);
                    $paramPageView->set_other_offers($ArrayReturn['other'], $user_settings['ansverServer']);
                    $paramPageView->set_front($ArrayReturn['product'][0]['front']);
                    $paramPageView->set_back($ArrayReturn['product'][0]['back']);
                    $paramPageView->set_img_url($ArrayReturn['imagesFace']);
                    $paramPageView->set_imgback_url($ArrayReturn['imagesBack']);
                    $paramPageView->set_imgbig_url($ArrayReturn['imagesFaceBig']);
                    $paramPageView->set_imgbackbig_url($ArrayReturn['imagesBackBig']); 
                    $paramPageView->set_is_hand($ArrayReturn['product'][0]['issetLong']);
                    $paramPageView->set_description($ArrayReturn['description']);
                    if($ArrayReturn['size_default']!='')
                        $paramPageView->set_size_default($ArrayReturn['size_default']);
                    
	
		
                    $smartyLoad=new Smarty;
                    $smartyLoad->debugging = true;
                    $showmode = Registry::getParam('tpl_settings');
                    $paramPageView->set_enviroment($dataReturn['partnerEnv']);	
					
                    $smartyLoad->template_dir='themes/'.$showmode['source'];	
                    $smartyLoad->assign("template_data",$paramPageView);		
                    unset($ArrayReturn);
                    $smartyLoad->display('product_show.tpl');
                }
                else                
                    return $ArrayReturn;
                    
                   
                
		
		

	}


	public function img_loaderAction() {
		$params = $this->params;
		if(!isset($params['typeload'])){

			$l_img=explode('_',$params['im']);
			$l_img[1]=str_replace('@','_',$l_img[1]);
			if(isset($params['long']))
				$l_img[1]=$l_img[1].'-long';
			$view = new View();
			$img_path_s = $view->LoadProdImageFut($l_img[0],$l_img[1],$l_img[2],250);
			$path_500 = $view->LoadProdImageFut($l_img[0],$l_img[1],$l_img[2],500);
			$htm= "<a href=\"javascript:open_window('" . $path_500 . "','',500,500)\">";
			$htm.= '<img src="' . $img_path_s  . '" />';
			$htm.="</a>";
			die($htm);
		}
		else{

			$db = new Database();
			$l_img=explode('_',$params['im']);
			$data=array();
			$view = new View();
					$l_img[1]=str_replace('@','_',$l_img[1]);
					$long=0;
			if(isset($params['long']))
			{
				$long=1;
			}

			$sql='select offerss.front,offerss.back,sex.double,relation_type.price as price from offerss,sex,relation_type where offerss.id=relation_type.id_offers and offerss.id='.$l_img[0].' and sex.id=relation_type.type and sex.id='.$this->params['sex'].' limit 1';


			$sG=$db->do_select($sql);

			$data['double']=$sG[0]['double'];
			$data['images']['show']['inside']=$view->LoadProdImageFut($l_img[0],$l_img[1],$l_img[2],250,$long,$sG[0]['front']);
			$data['images']['show']['big']=$view->LoadProdImageFut($l_img[0],$l_img[1],$l_img[2],500,$long,$sG[0]['front']);

			if($sG[0]['double']==1)
			{
				$data['images']['back']['inside']=$view->LoadProdImageFutBack($l_img[0],$l_img[1],$l_img[2],250,$long,$sG[0]['back']);
				$data['images']['back']['big']=$view->LoadProdImageFutBack($l_img[0],$l_img[1],$l_img[2],500,$long,$sG[0]['back']);
			}

			$tempsType=$l_img[1];
                        if($long==1)
                        {
                                $data['price']=$sG[0]['price']+50;
                                $tempsType=$l_img[1].'-long';
                        }
                        else
                                $data['price']=$sG[0]['price'];
			
			$scColors=$db->do_select('select id,name from color where abriv="'.$l_img[2].'"');
			$b=$db->do_select('select size from relation_type_size where id_type="'.$l_img[1].'" and color="'.$scColors[0]['id'].'" and size!="" and status=1 group by size');
			$data['sizes']=array();
			if(count($b)>0)
			{


				$sTemp=self::NormSort($b,false);
				//var_dump($sTemp);
				$data['sizes']=$sTemp;
			}
                        $data['color_name']=$scColors[0]['name'];
                        $data['color_abriv']=$l_img[2];

			die(json_encode($data));
		}
	}

	public function showimgsmall($idWages,$rukav,$type) {
	
		
		$db = new Database();
		$data = array();
                $sqlColor='';
             
                $colorSklad=$this->returnColorForType($type,$rukav);
                if(count($colorSklad)>0)
                   $sqlColor=' and relation_type.color in ('.implode(',',$colorSklad).')'; 
                
              
		if($rukav==0)
		{	$data['imgs']=$db->do_select('SELECT color.abriv,color.name as colorname, relation_type.color,offerss.id, sex.path as sex_name,relation_type.price,offerss.front,offerss.back,relation_type.hand
				FROM color, offerss, sex, relation_type, relation_category  WHERE offerss.id=relation_category.id_offers and offerss.id=relation_type.id_offers and offerss.id ='.$idWages.' AND color.id = relation_type.color
					AND relation_type.type ='.$type.' and (relation_type.hand=0 or relation_type.hand=2) AND sex.id ='.$type.' and relation_category.id_cat='.$_SESSION['catidOne']." ".$sqlColor." group by relation_type.color");

		}
		else {
			$data['imgs']=$db->do_select('SELECT color.abriv,color.name as colorname, relation_type.color, offerss.id,sex.path as sex_name,relation_type.price,offerss.front,offerss.back,relation_type.hand
				FROM color, offerss, sex, relation_type, relation_category
				WHERE offerss.id=relation_category.id_offers and offerss.id=relation_type.id_offers and offerss.id ='.$idWages.' AND color.id = relation_type.color  AND relation_type.type ='.$type.'
					AND sex.id ='.$type.' and relation_type.hand>0 and relation_category.id_cat='.$_SESSION['catidOne']." ".$sqlColor." group by relation_type.color");


		}
                $countC=count($data['imgs']);
                $colors=array();
                for($i=0;$i<$countC;$i++)
                {
                  $temp=$data['imgs'][$i];
                  $colors[$i]=new ColorStorage($idWages, $rukav, $temp['front'], $temp['back'], $temp['abriv'], $temp['sex_name'],$temp['colorname']);
                  unset($data['imgs'][$i]);
                  
                }
                
               
		return $colors;
		
		


	}

	public function insertcutAction() {

		if(!isset($_POST['sizes']) and isset($_POST['size']))                    
			$_POST['sizes']=$_POST['size'];



		if(is_numeric($_POST['num'])) {
			if($_POST['num']<0){
				$data=array();
				$data['act']=0;
				$data['error']='Количество должно быть числом больше нуля';
				die(json_encode($data));
			}
			if($_POST['num']>99){
				$data=array();
				$data['act']=0;
				$data['error']='Количество должно быть числом не большим 100';
				die(json_encode($data));
			}

			$tempNum=floatval($_POST['num'])-intval($_POST['num']);

			if($tempNum>0)
			{
				$data=array();
				$data['act']=0;
				$data['error']='Количество должно быть целым числом';
				die(json_encode($data));
			}
			$_POST['num']=(int)$_POST['num'];
			if($_POST['num']>999)
			{
				$data=array();
				$data['act']=0;
				$data['error']='Количество должно быть меньше 1000';
				die(json_encode($data));
			}
			if($_POST['num']!=0) {
				$db = new Database();
				$data = array();
				$data['error']='';
				$data['cart_shows']=$db->do_select('select offerss.id,offerss.name, offerss.front, offerss.back,rt.type as sexid,rt.color as colors,rt.hand as rukav,rt.price as price,rc.id_cat,rc.id_sub,color.name as colorname,color.abriv as abrivcolor,sex.name as snames,sex.path as sexpath
					from offerss,color,sex,relation_type rt,relation_category rc where offerss.id=rc.id_offers and color.abriv="'.$_POST['color'].'" and  sex.path="'.$_POST['sexname'].'" and offerss.id=rt.id_offers and offerss.id='.$_POST['id'].' and color.id=rt.color and sex.id=rt.type');

				$_POST['pricesis']= $data['cart_shows'][0]['price'];

				
                                if(isset($_POST['hand']) and $_POST['hand']==1)
                                {
                                        $_POST['pricesis']=$_POST['pricesis']+50;
                                }
				
				if($data['cart_shows'][0]['sexpath']=='sign')
				{
					switch($_POST['sizes'])
					{
						case '25mm':
						$_POST['pricesis']=$_POST['pricesis'];
						break;
						case '37mm':
						$_POST['pricesis']=$_POST['pricesis']+2;
						break;
						case '56mm':
						$_POST['pricesis']=$_POST['pricesis']+6;
						break;
					}
				}

				if(count($data['cart_shows'])>0) {
					$id_s=$_POST['id'].'_'.$data['cart_shows'][0]['id'].'_';
					if(isset($_POST['hand'])) {
						$id_s.=$_POST['hand'].'_';
						if($_POST['hand']==0) $data['rukav']='короткий';
						else $data['rukav']='длинный';
					}
					else $id_s.='_';
					if(isset($_POST['sizes'])) {
						$id_s.=str_replace(' ','',$_POST['sizes']).'_';
						$data['size']=$_POST['sizes'];
					}
					else $id_s.='_';
					$id_s.=$data['cart_shows'][0]['colors'].'_';
					$id_s.=$data['cart_shows'][0]['sexid'];
					$id_s.="_".$data['cart_shows'][0]['abrivcolor'];
					$id_s.="_".str_replace('_','@',$data['cart_shows'][0]['sexpath']);
					$id_s.="_".$data['cart_shows'][0]['front'];
					$id_s.="_".$data['cart_shows'][0]['back'];
				}
				$data['kols']=$_POST['num'];

				if(!isset($_SESSION['cutspr'][$id_s])) {
					if(isset($_POST['hand']))
						$_SESSION['cutspr'][$id_s]['hands']=$_POST['hand'];
					if(isset($_POST['sizes']))
					$_SESSION['cutspr'][$id_s]['size']=$_POST['sizes'];
					$_SESSION['cutspr'][$id_s]['name_offers']=str_replace("'",'`',$data['cart_shows'][0]['name']);
					$_SESSION['cutspr'][$id_s]['amount']=$_POST['num'];
					$_SESSION['cutspr'][$id_s]['price']=$_POST['pricesis'];
					$_SESSION['amounts']=$_SESSION['amounts']+$_POST['num'];
					$_SESSION['many']=$_SESSION['many']+($_POST['pricesis'] * $_POST['num']);
					$data['error']='';
				}
				else {
					if(isset($_SESSION['cutspr'][$id_s]['size'])) {
						if($_SESSION['cutspr'][$id_s]['size']==$_POST['sizes']) {
							$siz=1;
						}
					}else $siz=1;
					if(isset($_SESSION['cutspr'][$id_s]['hands'])) {
						if($_SESSION['cutspr'][$id_s]['hands']==$_POST['hand']) {
							$han=1;
						}
					}
					else $han=1;
					if($siz==1 and $han==1) {
						$_SESSION['cutspr'][$id_s]['amount']=$_SESSION['cutspr'][$id_s]['amount']+$_POST['num'];
						$_SESSION['amounts']=$_SESSION['amounts']+$_POST['num'];
						$_SESSION['many']=$_SESSION['many']+($_POST['pricesis'] * $_POST['num']);
						$_SESSION['cutspr'][$id_s]['price']=$_POST['pricesis'];
					} else {
						if(isset($_POST['hand']))
							$_SESSION['cutspr'][$id_s]['hands']=$_POST['hand'];
						if(isset($_POST['size']))
							$_SESSION['cutspr'][$id_s]['size']=$_POST['sizes'];
						$_SESSION['cutspr'][$id_s]['amount']=$_POST['num'];
						$_SESSION['cutspr'][$id_s]['price']=$_POST['pricesis'];
						$_SESSION['amounts']=$_SESSION['amounts']+$_POST['num'];
						$_SESSION['many']=$_SESSION['many']+($_POST['pricesis'] * $_POST['num']);

						$data['error']='';
					}
				}
				$data['allcount']=$_SESSION['amounts'];
				$data['summa']=$_SESSION['many'];


			}
			else {
				$data=array();
				$data['act']=0;
				$data['error']='Количество товаров не должно равняться 0';

			}
		}
		else {
			$data=array();
			$data['act']=0;
			$data['error']='Количество должно быть числом';


		}

		/*$view = new View($data);
		return $view->Render('cutsmall.phtml');*/
		die(json_encode($data));
	}
	public function NormSort($array,$obj=true)
        {

             $arrayReturn=array();
            $arrayTempKeys=array();
            $arrayTempSort=array();
			
			$replace=array('????','???');
			$replaceRe=array('года','лет');
            for($i=0;$i<count($array);$i++)
            {
				$array[$i]['size']=str_replace($replace,$replaceRe,$array[$i]['size']);
                if(isset($array[$i]['size']))
                {
                    if(preg_match('/\([0-9-]+(.*?)\)/i',$array[$i]['size'],$s))
                    {
                        
                        $id=str_replace(array('(',')'),'',$s[0]);
                        $arrayTempKeys[intval($id)]=$array[$i]['size'];
                        $arrayTempSort[$i]=intval($id);
                    }
                    else{
                        if($obj)
                        $arrayReturn[$i]=new SizesStorage($array[$i]['size']);
                        else
                        $arrayReturn[$i]=$array[$i]['size'];
                    }

                }
                else
                {
                    if(preg_match('/\([0-9-]+\)/i',$array[$i],$s))
                    {
                    $id=str_replace(array('(',')'),'',$s[0]);
                    $arrayTempKeys[intval($id)]=$array[$i];
                    $arrayTempSort[$i]=intval($id);
                    }
                    else
                    {
                        if($obj)
                        $arrayReturn[$i]=new SizesStorage($array[$i]['size']);
                        else
                        $arrayReturn[$i]=$array[$i]['size'];
                    }
                }
            }
			
            $counT=count($arrayTempSort);
            if($counT>0)
            {
                sort($arrayTempSort);
                for($i=0;$i<$counT;$i++)
                {
                    if($obj)
                    $arrayReturn[$i]=new SizesStorage(str_replace($replace,$replaceRe,$arrayTempKeys[$arrayTempSort[$i]])); 
                    else
                    $arrayReturn[$i]=$arrayTempKeys[$arrayTempSort[$i]];  
                    unset($arrayTempKeys[$arrayTempSort[$i]]);
                    unset($arrayTempSort[$i]);
                }
            }


            return $arrayReturn;
       }
       function returnColorForType($typeId,$long=0)
       {
           $db=new Database();
           $stype=$db->do_select('select path from sex where id='.$typeId);
           $type=$stype[0]['path'];
           if($long>0)
              $type.='-long';
           $color=$db->do_select('select distinct color from relation_type_size where id_type="'.$type.'" and status=1');
           $array=array();
           
           $count=count($color);
           if($color>0)
           {
               for($i=0;$i<$count;$i++)
               {
                  $array[$i]= $color[$i]['color'];
               }
           }
          
           return $array;
           
       }
       function ReturnModel($id)
       {
           $db=new Database();
          
           //
              $arraySort=array(
               'manshort'=>1,
               'man_tshirt'=>2,
               'man_borcovka'=>3,
               'manreglan'=>4,
               'manreglanlong'=>5,
               'man_polo'=>6,   
               'hoodie'=>7,
               'womanshort'=>8,
               'mama'=>9,
               'woman_borcovka'=>10,
               'woman_tshirt'=>11,
               'child'=>12,
               'caps'=>13,
               'hat'=>14,
               'pantsman'=>15,
               'pantswoman'=>16,
               'krujka'=>17,
               'mug_kant'=>18,
               'mug_twotone'=>19,
               'mug_chameleon'=>20,
               'mug_mat'=>21,
               'mug_thermos'=>22,
               'thermos'=>23
               );
           
           $array_sortTemp=array();
           $array_sortIdel=array();
          
           

           $modPath=$db->do_select("SELECT sex.path 
                                FROM `offerss` , sex,relation_type, relation_category
                                WHERE offerss.id=relation_category.id_offers and offerss.id=relation_type.id_offers
                                and offerss.id =$id AND sex.id = relation_type.type
                                and relation_category.id_cat=".$_SESSION['catidOne']." 
                                GROUP BY relation_type.type ORDER BY relation_type.type");
           $sc =count($modPath);
           for($i=0;$i<$sc;$i++)
           {
               
               if(isset($arraySort[$modPath[$i]['path']]))
               {
                   $index=$arraySort[$modPath[$i]['path']];                   
                   $array_sortIdel[$index]="'".$modPath[$i]['path']."'";  
               }
               else
                  $array_sortTemp[]="'".$modPath[$i]['path']."'";
                   
                 
           }
           ksort($array_sortIdel);
           $arraySortIn=array();
           if(count($array_sortTemp)>0)
               $arraySortIn= array_merge ($array_sortIdel,$array_sortTemp);
           else
               $arraySortIn=$array_sortIdel;
           
           $sqlIn=implode(',',$arraySortIn);
           //
           $mod=$db->do_select("SELECT sex.*, relation_type.type as sexid 
                                FROM `offerss` , sex,relation_type, relation_category
                                WHERE offerss.id=relation_category.id_offers and offerss.id=relation_type.id_offers
                                and offerss.id =$id AND sex.id = relation_type.type
                                and relation_category.id_cat=".$_SESSION['catidOne']." 
                                GROUP BY relation_type.type ORDER BY FIELD(sex.path,".$sqlIn.")");
          
           $return=array();
           $s=count($mod);
           for($i=0;$i<$s;$i++)
           {
               $temp=$this->selectCountOffers($id,$mod[$i]['sexid']);
               if($temp)
                 $return[]= $mod[$i]; 
           }
           return $return;
          
       }
       function selectCountOffers($id,$typeId)
       {
           
           $db=new Database();
           $sql='';
           $color=$this->returnColorForType($typeId);
           if(count($color)>0)
               $sql=' and relation_type.color in ('.implode(',',$color).')';
           $d=$db->do_select('select count(*) as cc from relation_type where relation_type.id_offers='.$id.' and relation_type.type='.$typeId.' '.$sql);
           if($d[0]['cc'] == 0)
               return false;
           return true;
       }

}


?>