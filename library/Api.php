<?php
set_include_path (dirname(__FILE__).'/');
include '/Zend/Json.php';

class ApiDelivery {	
		
	public function __construct($urls,$key) {
			 $this->url=$urls;
			 $this->keySecret=$key;
			
	}
	
	public function concatUrl($Data,$datatype="xml")
	{
		
		return $this->url.$Data.'?appsecret='.$this->keySecret.'&datatype='.$datatype;
	}
	
	public function returnTypeDelivery($data,$typeAnswer="json") {
	    
		$uri=self::concatUrl('list',$typeAnswer);
		
		if($typeAnswer=="json")
		{
			if($str=self::sendQuery($uri,$data))
			{	 
				$arrayReturn=Zend_Json::decode($str);				
				return $arrayReturn['response']['content']['deliverytypes']['deliverytype'];
			}
			else
				return array();
		}			
		else		
			return self::returnTypeXMLDelivery($uri,$data);
				
	
	}

	public function returnInfoForDelivery($data,$typeAnswer="json") {
		
		$uri=self::concatUrl('info',$typeAnswer);
		if($typeAnswer=="json")
		{
			if($str=self::sendQuery($uri,$data))
				return Zend_Json::decode($str);
			else
				return array();
		}	
		else
			return self::returnInfoXMLForDelivery($uri,$data);
			
	}
	
	public function returnTypeXMLDelivery($uri,$data) {	
		
		
		$typexml = self::sendQuery($uri,$data);
		
		try {
			$xml = new SimpleXMLElement($typexml);
		    } 
		catch (Exception $exc) 
			{
			 return array();
			}
		$i=0;
		foreach ($xml->xpath('//deliverytype') as $item_cut ) 
			{
			$infotype[$i]=array();
			$infotype[$i]['name'] = (string)$item_cut->name;
			$infotype[$i]['price'] = (string)$item_cut->price;
			$infotype[$i]['description'] = (string)$item_cut->description;
			$infotype[$i]['type'] = (string)$item_cut->type;
			$attrname = (string)$item_cut->group['name'];
			$infotype[$i]['name_type'] = $attrname;
			$s['min']=(string)$item_cut->duration['min'];
			$s['max']=(string)$item_cut->duration['max'];
			$infotype[$i]['min'] = $s['min'];
			$infotype[$i]['max'] = $s['max'];
			$i++;    
			
			}
		
		return $infotype;
			
	}
	
	public function returnInfoXMLForDelivery($uri,$data) {
		
		
		$typexml = self::sendQuery($uri,$data);
		
		try {
			$xml = new SimpleXMLElement($typexml);
		    } 
		catch (Exception $exc) 
			{
				return array();
			}
		foreach ($xml->xpath('//content') as $item_cut ) 
			{
			$infotype = (string)$item_cut->info;
			}
		//$infotype = trim($infotype);
		return $infotype;
			
	}
	
	/*public function returnAllXMLDelivery() {
		
		$this->url='http://vk2.vsemayki.ru/answer/amswerall';
		
		$typexml = file_get_contents($this->url);
		try {
			$xml = new SimpleXMLElement($typexml);
		    } 
		catch (Exception $exc) 
			{
			echo 'Error: '.$exc->getMessage().' <br />in '.$exc->getFile().' on line '.$exc->getLine().'<br /><br />';
			exit();
			}
		$i=0;
		foreach ($xml->xpath('//deliverytype') as $item_cut ) 
			{
			$infotype[$i]=array();
			$infotype[$i]['name'] = (string)$item_cut->name;
			$infotype[$i]['price'] = (string)$item_cut->price;
			$infotype[$i]['description'] = (string)$item_cut->description;
			$infotype[$i]['type'] = (string)$item_cut->type;
			$attrname = (string)$item_cut->group['name'];
			$infotype[$i]['name_type'] = $attrname;
			$s['min']=(string)$item_cut->duration['min'];
			$s['max']=(string)$item_cut->duration['max'];
			$infotype[$i]['min'] = $s['min'];
			$infotype[$i]['max'] = $s['max'];
			$i++;    
			
			}
		
		return $infotype;
			
	}*/
	
	public function sendQuery($uri,$data)
    {		
	
			$agent="Mozilla/5.0 (Windows NT 5.1; rv:7.0.1) Gecko/20100101 Firefox/7.0.1";
			$xml="<?xml version='1.0' encoding='utf-8'?>\r\n";
			$xml.="<request>\r\n";
			if(isset($data['city']))
				$xml.="<city>".$data['city']."</city>\r\n";
			if(isset($data['products']) and count($data['products'])>0)
			{
				$xml.="<products>\r\n";
				foreach($data['products'] as $key=>$val)
					$xml.="<product type='".$key."' count='".$val."'/>\r\n";
				$xml.="</products>\r\n";
			}
			$xml.="</request>";
			
				
			$header  = "POST HTTP/1.0 \r\n";
			$header .= "Content-type: application/xml\r\n";
			$header .= "Content-length: ".strlen( $xml ) . "\r\n\n";
			
			//$uri='http://vk2.vsemayki.ru/api/a';
			$ch = curl_init( $uri );
			curl_setopt($ch, CURLOPT_URL, $uri);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER,$header);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_ENCODING, "");
			curl_setopt($ch, CURLOPT_USERAGENT, $agent);
			curl_setopt($ch, CURLOPT_TIMEOUT, 20);
			curl_setopt($ch, CURLOPT_FAILONERROR, 1);
			curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);	 

			$content = curl_exec( $ch );
			$err     = curl_errno( $ch );
			$errmsg  = curl_error( $ch );
		   
			curl_close( $ch );		
			if(!$err)
				return $content;
			else
				return false;
			
	}
	
       
    
	
	

}

?>