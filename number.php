<?php

	$config_max_digits = 6;
	$config_back_image = 'num.jpg';
	$config_font = 100;
	$config_code_color = 'FFFFFF';
	
	
	header("Content-type: image/jpeg");
	$noautomationcode = base64_decode ($_GET['code']);
	
	$img_path = $config_back_image;
	$img = ImageCreateFromJpeg($img_path);
	$img_size = getimagesize($img_path);

	$fw = imagefontwidth ( $config_font );
	$fh = imagefontheight ( $config_font );

	$x = ($img_size[0] - strlen($noautomationcode) * $fw )/2;
	$y = ($img_size[1] - $fh) / 2;

	$color = imagecolorallocate($img,
	hexdec(substr($config_code_color,0,2)),
	hexdec(substr($config_code_color,2,2)),
	hexdec(substr($config_code_color,4,2)));

	imagestring ( $img, $config_font, $x, $y, $noautomationcode, $color);

	imagejpeg($img);
?>