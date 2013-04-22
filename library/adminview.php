<?php

	class AdminView
	{
		public $tplDir = null;
		public $resources = null;
		public $vars = null;

		function __construct ($vars = array())
		{
			$this->vars = $vars;
			$usersSettings = Registry::getParam('tpl_settings');
			$this->resources = array();
			$this->tplDir = 'admin_tpl';
			$this->resources['image'] = $this->tplDir.'/images/';			
			$this->resources['styles'] = $this->tplDir.'/styles/';
			$this->resources['scripts'] = $this->tplDir.'/scripts/';
			
		}

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
			$pathToResource = $this->resources[$id_resource] . $fileName;
			if (!file_exists($pathToResource)) {
				LOG::echoLog ('Could not found resource \'' . $pathToResource . '\' (resource type \'' . $id_resource . '\')');
				return;
			}
			return '/' . $pathToResource;
		}
		public function issetFile($url){
			if(@file_get_contents($url))
				return true;
			return false;	
		}

		public function Render ($includeFile,$vars='')
		{
			$pathTpl = $this->tplDir .'/'. $includeFile;
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