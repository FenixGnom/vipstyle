<?
class uploadXml 
	{
		public static function upXml ($path,$pathUp,$first,$last)
			{
				if (!function_exists('curl_init')) 
					{
					if ($first==1)
						{
							$files=fopen('./catalog/xmlproduct.xml','w+');
							$res = fwrite($files,'');		
							fclose($files);
						}
						$fh=@fopen($path, "r");
						
						if($fh)
						{
							$files=fopen($pathUp,'a');
							while (! feof($fh))
							{				
								$line = fgets($fh, 4096);				
								$res = fwrite($files,$line);				
							}
							fclose($files);
							fclose($fh);
							die(json_encode(array('act'=>1)));	
						}
						else
							fclose($fh);
						self::insertErrorFileLog('Не удалось соединиться с сервером vsemayki.ru');
						die(json_encode(array('act'=>2)));
					}
				else
					{
						$toStoped=0;
                                                $ch = curl_init($path);
						curl_setopt($ch, CURLOPT_URL, $path);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);						
						curl_setopt($ch, CURLOPT_ENCODING, "");
						curl_setopt($ch, CURLOPT_RANGE, $first.'-'.$last);
						curl_setopt($ch, CURLOPT_FAILONERROR, 1);
						curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
						//$sizeFile=0;
						
						if ($first==1)
						{
                                                    $files=fopen('./catalog/xmlproduct.xml','w+');
                                                    $res = fwrite($files,'<');		
                                                    fclose($files);
                                                    curl_setopt($ch, CURLOPT_HEADER, 1);
                                                    $fh = curl_exec($ch);
                                                   
                                                    $tempFh=$fh;
                                                    $fh='';                                                    
                                                    $con=explode('?xml version=',$tempFh);							
                                                    $tempsize=explode('Content-Range: bytes 1-1000000/',$con[0]);
                                                    if(isset($tempsize[1]))
                                                    { 
                                                        $_SESSION['sizeFile']=ceil((intval($tempsize[1])/1000000)/4);
                                                        $_SESSION['procentGoo']=1;
                                                    
                                                    }
                                                    else
                                                        $toStoped=1;
                                                    unset($tempsize);							
                                                    $fh='?xml version='.$con[1];
                                                    unset($con);
							
						}
						else
						{	
                                                    $fh = curl_exec($ch);
                                                    $_SESSION['procentGoo']++;	
						}
						
						if ($ch)
							{
								if(strlen($fh)>0)
									{
										$files=fopen($pathUp,'a');
										$res = fwrite($files,$fh);
										fclose($files);
										$first+=1000000;
										$last+=1000000;
										curl_close($ch);
                                                                                if($toStoped==1)
                                                                                    die(json_encode(array('act'=>1)));
										if($_SESSION['procentGoo']<6)
											die(json_encode(array('first'=>$first,'last'=>$last,'f'=>$_SESSION['procentGoo'],'mem'=>memory_get_usage())));
										else{
											$_SESSION['procentGoo']=0;
											die(json_encode(array('first'=>$first,'last'=>$last,'procent'=>1,'mem'=>memory_get_usage())));
											}
									}
								else
									{
										curl_close($ch);
										die(json_encode(array('act'=>1)));
									}
							}
						else
							{
								curl_close($ch);
								self::insertErrorFileLog('Не удалось соединиться с сервером vsemayki.ru');
								die(json_encode(array('act'=>2)));
							}
					}		
			}
		
	}
?>