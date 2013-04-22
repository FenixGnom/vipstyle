<?php
error_reporting(-1);
function myError($type, $message, $file, $line)
{
    static $titles = array(
        E_WARNING           => 'Предупреждение',
        E_NOTICE            => 'Уведомление',
        E_USER_ERROR        => 'Ошибка, определенная пользователем',
        E_USER_WARNING      => 'Предупреждение, определенное пользователем',
        E_USER_NOTICE       => 'Уведомление, определенное пользователем',
        E_STRICT            => 'Проблема совместимости в коде',
        E_RECOVERABLE_ERROR => 'Поправимая ошибка'
    );

    $s='<span style="font-size:13px;font-weight:bold;" >' . $titles[$type] . '</span> Источник:  ' . basename($file) . ', строка ' . $line . '.<br> <span style="margin-left:35px;">Обновление данных не удалось завершить корректно.<span style="display:none;">('.$message.')</span></span> ';
	
	$str=$titles[$type] . '.<br/> Источник:  ' . basename($file) . ', строка ' . $line .'<br/>Сообщение:'.$message;
	$path=dirname(__FILE__).'/../error';
	$name='/error_'.$_SESSION['lastUpdateId'].'.dat';
	if(file_exists($path)){
			if(!is_writable($path))
				chmod($path,0777);
	}
	else
		mkdir($path,0777);
	file_put_contents($path.$name,$str);
	
    die(json_encode(array('act'=>5,'error'=>$s)));
	
}
set_error_handler('myError');

?>