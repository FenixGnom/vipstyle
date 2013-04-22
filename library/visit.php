<?php
	class Visit
	{
				
		public $Array_Searching=array('yandex.ru'=>'text','google.ru'=>'q','google.com'=>'q','google.com.ua'=>'q','search.rambler.ru'=>'words','search.yahoo.com'=>'p','sm.aport.ru'=>'r','go.mail.ru'=>'q','search.yahoo.com'=>'p','test1.ru'=>'s');

		
		
		public function ParseUrl()
		{
			if(isset($_SERVER['HTTP_REFERER']))
			{	
				return parse_url($_SERVER['HTTP_REFERER']);
			}
			else
				return  array();
			
			
		}
		
		public function ReturnFromInfo()
		{
			$ArrayUser=array();
			$none=array();
			$ArrayUser=self::ParseUrl();
			if(count($ArrayUser) > 0 )
			{
				$itsHost=str_replace('www.','',$ArrayUser['host']);	
				if(!array_key_exists($itsHost,$this->Array_Searching))
					return  $none;			
				else
				{
					if($ArrayUser['query']=='')
						return  $none;
					else
					{
						parse_str($ArrayUser['query'], $wordsString);					
						if(isset($wordsString[$this->Array_Searching[$itsHost]]))
						{
							$ArrayUser['searchText']=$wordsString[$this->Array_Searching[$itsHost]];
							return $ArrayUser;
							
						}
						else
							return  $none;
					}
					
						
				}
			}
			
			
		}
		
	}
?>