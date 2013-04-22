<?php
	
	class Order
	{
		public static function Start ()
		{
			if(self::startConnect())
			{
				$sql=mysql_query('select * from zakaz where log_zakaza!="a:0:{}"');
				while($res=mysql_fetch_assoc($sql))
				{
					$info=unserialize($res['log_zakaza']);					
					$newAr=self::RefStruct($info);
					if($newAr)
					{
						mysql_query('update zakaz set log_zakaza="'.mysql_real_escape_string(serialize($newAr)).'" where id='.$res['id']);
						
					}
				}
			}
			
		}
		
		public static function RefStruct($data)
		{
			$arrayReturn=array();
			if(self::startConnect())
			{
				$key=array_keys($data);
				$i=0;
				$sc=count($key);
				while($i<$sc)
				{
					$tempAr=array();
					$id=explode('_',$key[$i]);
					if(count($id)==6)
					{
						$name=@mysql_fetch_assoc(mysql_query('select name from offers where oldid='.$id[1].' limit 1'));
						if($name['name']=="")
						{
							
							$name=@mysql_fetch_assoc(mysql_query('select name from offers where oldid='.($id[1]+100000).' limit 1'));
						}
						$color=@mysql_fetch_assoc(mysql_query('select abriv from color where id='.$id[4]));
						$sex=@mysql_fetch_assoc(mysql_query('select path from sex where id='.$id[5]));
						$newKey=$key[$i].'_'.$color['abriv'].'_'.$sex['path'].'_1_0';
						$data[$key[$i]]['name_offers']=$name['name'];
						$tempAr=$data[$key[$i]];					
						$arrayReturn[$newKey]=$tempAr;
					}					
					$i++;
				}
				return $arrayReturn;	
			}
			return 0;
			
		}
		public static function startConnect()
		{
			$db_settings = Registry::getParam('db_settings');
			$db_settings['charset'] = "utf8";			
			$s=mysql_connect($db_settings['host'],$db_settings['user'],$db_settings['password']);
			if($s)
			{
				if(mysql_select_db($db_settings['name']))
				{
					mysql_query("SET NAMES '".$db_settings['charset']."'");
					return 1;
				}
			}
			return 0;
		}
	    
	}
 ?>