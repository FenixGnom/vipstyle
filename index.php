<?php	
session_start();
date_default_timezone_set('Europe/Moscow');

include 'library/includes.php';



if(!isset($_SESSION['cutspr'])) {
	$_SESSION['cutspr']=array();
	$_SESSION['many']=0.00;
	$_SESSION['amounts']=0;
}


if (!isset($_SESSION['from']) && isset($_SERVER["HTTP_REFERER"])) {
	$_SESSION['from'] = htmlspecialchars($_SERVER["HTTP_REFERER"]);
}

if(!isset($_SESSION['searching_info']))
{
	$visit=new Visit();
	
	$arrausImReferer=$visit->ReturnFromInfo();
	if(count($arrausImReferer)!=0)
	{	
		$myDb=new Database();		
		$textSearch=urldecode($arrausImReferer['searchText']);
		
		
		
		$myDb->do_insert("insert into visits values(0,".time().",'".$textSearch."',0,0,'".$arrausImReferer['host']."','".$_SERVER['REQUEST_URI']."','".session_id()."')");
		
		$last=$myDb->do_select("select id from visits order by id desc limit 1");
		$nums=$myDb->do_select("select count(id) as cc from phrases where phrases ='".$textSearch."'");
		if($nums[0]['cc'] == 0)
			$myDb->do_insert("insert into phrases values(0,'".$textSearch."',1)");
		else
			{
				$nums=$myDb->do_select("select  id,counts from phrases where phrases ='".$textSearch."'");
				$newcount=0;
				$newcount=$nums[0]['counts']+1;
				$myDb->do_insert("update  phrases  set counts='".$newcount."' where id=".$nums[0]['id']);
				
			}
		$_SESSION['searching_info']['idVisit']=$last[0]['id'];	
	}
	
}



$par_url= Library::getParams();

$content = ClassLoader::Load($par_url['controller']);
$front = new Front($content);

header("Content-Type: text/html; charset=utf-8");


echo $front->dispatch($par_url['action']);


?>