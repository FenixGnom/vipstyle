<?php
	
	class Description
	{
		public static function Start ()
		{
			if(self::startConnect())
			{
				
                                if(mysql_query("select count(*) from offers"))
                                {
                                    $sql=mysql_query('select * from description_offers');
                                    while($res=mysql_fetch_assoc($sql))
                                    {
                                            $cc=self::SelectCount($res['id_offers']);					

                                            if($cc==0)
                                            {
                                                    $newId=$res['id_offers']+100000;
                                                    $Newcc=self::SelectCount($newId);						
                                                    if($Newcc>0)
                                                    {
                                                            mysql_query('update description_offers set id_offers='.$newId.' where id_offers='.$res['id_offers']);

                                                    }
                                            }

                                    }
                                }                                
			}
			
		}
		
		public static function SelectCount($id)
		{			
			if(self::startConnect())
			{	
				$s=mysql_fetch_assoc(mysql_query('select count(*) as cc from offers where oldid='.$id));
				return $s['cc'];
			}
			
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