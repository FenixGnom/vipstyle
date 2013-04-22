<?php

	class View
	{		
		
		public function LoadProdImage ($id,$type='') {
			$firtType='';
			if($type!='')
				$firtType='_'.$type;
  			$path = 'http://static.vsemayki.ru/catalog_img/' . $id . '/main'.$firtType.'.png';  			
			
			return $path;
		}

		public function LoadProdImageFut ($id,$type,$color,$size,$ruk=0,$imfont=0) {
			if($size==70)
				$size=250;
			if($ruk==1)
				$type=$type.'-long';
			if($imfont!=0)				
				$path = 'http://static.vsemayki.ru/catalog_img/' . $id . '/'.$type.'/'.$color.'_'.$size.'.png';
			else	
				$path = 'http://static.vsemayki.ru/img_new/front/'.$type.'/'.$color.'_'.$size.'.png';
  			
			
   			return $path;
			
		}
		
		public function LoadProdImageFutBack($id,$type,$color,$size,$rukav=0,$showImgBack=0) {
			
			$pathTo='img/back';
			$inBack='';
			if($showImgBack==1)
			{	
				$pathTo='catalog_img/'.$id.'/back';	
				$inBack='back_';					
			}	
			if($rukav==0)			
				$pathOrig = 'http://static.vsemayki.ru/'.$pathTo.'/'.$type.'/'.$inBack.$color.'_'.$size.'.png';
			else
			{	
				
				switch($color)
				{
					case 'whitered':case 'whiteblue':
						$type=$type."_reglan";
					break;					
				}
				
				$pathOrig = 'http://static.vsemayki.ru/'.$pathTo.'/'.$type.'-long'.'/'.$inBack.$color.'_'.$size.'.png';
				}			
			
				return $pathOrig;
			}

		public function LoadResource ($id_resource,$fileName) {
			$pathType='';
			switch($id_resource)
			{
				case 'image':
					$pathType='images/';
				break;
				case 'styles':
					$pathType='styles/';
				break;
				case 'scripts':
					$pathType='scripts/';
				break;
				default :
					$pathType='scripts/';
				break;
			}
			$pathToResource = $this->resources .$pathType. $fileName;
			if (file_exists($pathToResource)) {
				return '/' . $pathToResource;			
			}
			else
				return;
			
		}
		public function HandShow($hand)
                {
                    $return='короткий';
                    if($hand==1)
                       $return='длинный';
                    return $return.' рукав';

                }

		public function ShowTypeOffer($name,$type)
		{
			switch($type)
			{
				case 'man':case 'woman':case 'mama':case 'child':case 'man_polo':
					$temp=str_replace('футболка','',mb_strtolower($name,'utf-8'));
					return 'Футболка '.$temp;
				break;
				case 'hat':
					$temp=str_replace('шапка','',mb_strtolower($name,'utf-8'));
					$temp=str_replace('бейсболка','',mb_strtolower($temp,'utf-8'));
					return 'Шапка '.$temp;
				break;
				case 'hoodie':
					$temp=str_replace('толстовка','',mb_strtolower($name,'utf-8'));
					return 'Толстовка '.$temp;
				break;
				case 'krujka':case 'mug_kant':case 'mug_twotone':case 'mug_mat':case 'mug_chameleon':
					$temp=str_replace('кружка','',mb_strtolower($name,'utf-8'));
					return 'Кружка '.$temp;
				break;
				case 'pantsman':case 'pantswoman':
					$temp=str_replace('трусы','',mb_strtolower($name,'utf-8'));
					return 'Трусы '.$temp;
				break;
				case 'pad':case 'pad2':
					$temp=str_replace('коврик','',mb_strtolower($name,'utf-8'));
					return 'Коврик '.$temp;
				break;
				case 'sign':
					$temp=str_replace('значок','',mb_strtolower($name,'utf-8'));
					return 'Значок '.$temp;
				break;
				case 'caps':
					$temp=str_replace('бейсболка','',mb_strtolower($name,'utf-8'));
					return 'Бейсболка '.$temp;
				break;
				case 'bag':
					$temp=str_replace('Сумка','',mb_strtolower($name,'utf-8'));
					return 'Сумка '.$temp;
				break;
				case 'shale':
					$temp=str_replace(array('Сланцы','сланцы'),'',mb_strtolower($name,'utf-8'));
					return 'Сланцы '.$temp;
				break;
                                case 'man_tshirt':
					$temp=str_replace('футболка','',mb_strtolower($name,'utf-8'));
					return 'Мужская майка '.$temp;
				break;
                                case 'woman_tshirt':
					$temp=str_replace('футболка','',mb_strtolower($name,'utf-8'));
					return 'Женская майка '.$temp;
				break;
                                case 'man_borcovka':
					$temp=str_replace('футболка','',mb_strtolower($name,'utf-8'));
					return 'Мужская майка '.$temp;
				break;
                                case 'manreglan':case 'manreglanlong':
					$temp=str_replace('футболка','',mb_strtolower($name,'utf-8'));
					return 'Футболка реглан '.$temp;
				break;
                                case 'woman_borcovka':
					$temp=str_replace('футболка','',mb_strtolower($name,'utf-8'));
					return 'Женская майка '.$temp;
				break;
                                case 'woman_borcovka':
					$temp=str_replace('футболка','',mb_strtolower($name,'utf-8'));
					return 'Женская майка '.$temp;
				break;
                                case 'keychain_opener':
                                        $arra=array('футболка','брелок круглый');
					$temp=str_replace($arra,'',mb_strtolower($name,'utf-8'));
					return 'Брелок - открывашка '.$temp;
				break;
                            
                                case 'magnet_55_55':
                                        $arra=array('футболка','брелок круглый');
					$temp=str_replace($arra,'',mb_strtolower($name,'utf-8'));
					return 'Магнит '.$temp;
				break;
				default:
					return $name;
				break;			
				
			}
		}
		public function Render ($includeFile,$vars = '')
		{
			$pathTpl = 'install/' . $includeFile;
			if (!file_exists($pathTpl)) {
				LOG::echoLog('Could not found template \'' . $pathTpl . '\' !!!');
				return;
			}
            ob_start ();

			include $pathTpl;

			$contents = ob_get_contents();
        	ob_end_clean();
	       	return $contents;
		}
	}

?>