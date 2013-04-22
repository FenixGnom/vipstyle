<?php
	class Library
	{
		public static function GenerateCaptcha ()
		{
			$code = '';
			for( $i=0; $i<6 ; $i++ )  {
				$code = $code . rand(0,9);
			}
			return $code;
		}

	   
            public static function uri_func()
	    {
                
                $uri= urldecode($_SERVER['REQUEST_URI']);
                $uri=str_replace('"','',$uri);
                $uri=str_replace("'","",$uri);
                $uri_par=explode('/',$uri);
                return $uri_par;
	    }

		public static function getParams()
		{
			$url = self::uri_func();
			unset($url[0]);
			$uri_params=array();
			if($url[1]!='')
			{

				if($url[1]=='cat')
				{

                    $uri_params['controller'] = 'catalog';
					$uri_params['action'] = 'showall';
					return $uri_params;

				}
				else
				{   if($url[1]=='product')
					{
                        $uri_params['controller'] = 'catalog';
						$uri_params['action'] = 'showone';
						return $uri_params;
					}
					else
					{
						if($url[1]=='new')
						{
							$uri_params['controller'] = 'catalog';
							$uri_params['action'] = 'shownew';
							return $uri_params;
						}
						else
						{
							if($url[1]=='search')
							{
                             	$uri_params['controller'] = 'search';
								$uri_params['action'] = 'show';
								return $uri_params;
							}
							else
							{
								if($url[1]=='docs')
								{
									$uri_params['controller'] = 'docs';									
									$uri_params['action'] = 'show';
									return $uri_params;
								}
								else
								{
									@$uri_params['controller'] = strtolower($url[1]);
									@$uri_params['action'] = strtolower($url[2]);
									if ($uri_params['action'] == '') $uri_params['action'] = 'index';

									$cs = Registry::getParam('controllers_settings');

									if (!file_exists($cs['dirName'] . $uri_params['controller'] . 'Controller.php')) {
										/*$uri_params['controller'] = 'error';
										$uri_params['action'] = 'index';
										return $uri_params;*/
										header('location:/error');
									} else {
										@eval ('include_once "' . $cs['dirName'] . $uri_params['controller'] . 'Controller.php";');
										@eval ('$curClass = new ' . $uri_params['controller'] . 'Controller(false);');
										if (!method_exists($curClass , $uri_params['action'] . 'Action')) {
											if($uri_params['controller']!='admin')
												header('location:/error');
											else
												header('location:/admin/error');
										}
									}
									return $uri_params;
								}
							}


						}

					}



				}

			} else {
				$uri_params['controller'] = 'index';
				$uri_params['action'] = 'index';
				return $uri_params;
			}
		}

		public static function paramUri()
		    {
                 $url = self::uri_func();
                 $params=array();
                 unset($url[0]);
                 if($url[1]=='cat')
                 {

                 	 $params['wages']=$url[2];                
						if(isset($url[3]))
						{
							if($url[3]!="subcat" and $url[3]!="page" and $url[3]!="model")
							header('Location: /error');
						}
				}
                 else
                 {  if($url[1]=='product')
	                 {

                 	    $params['wages']=$url[2];
	                 }

                 	else
                 	{
                        if($url[1]=='new')
                        {
                        	if(isset($url[2]))
                        	$params['page']=$url[3];
                        }
                        else
                        {
                        	if($url[1]=='docs' and $url[2]!='question')
							{
							
								$params['uri']=$url[2];
							}
							else
							{
								if($url[1]=='search')
								{
                                                                    if(isset($_POST['find']))
                                                                    {
                                                                            header('Location: /search/'.urlencode($_POST['find']));
                                                                    }
                                                                    else
                                                                    {
                                                                            $params['search_find']=$url[2];
                                                                    }
								}
							}
                        }



                 	}

                 }
                		unset($url[1]);
                 		unset($url[2]);
                 		 $i=3;

		                while($i<(count($url)+3))
		                 {

		                   @$url[$i+1]=str_replace('+','',$url[$i+1]);
		                   $url[$i+1]=str_replace('"','',$url[$i+1]);
		                   $url[$i+1]=str_replace("'",'',$url[$i+1]);

		                   $params[$url[$i]]=$url[$i+1];
		                   $i=$i+2;

		                 }

                 return $params;
			}
	}
 ?>