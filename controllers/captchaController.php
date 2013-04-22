<?php
	header("Content-type: image/jpeg");
	
	class Captcha
	{
		private $config_max_digits = null;
		private $config_back_image = null;
		private $config_font = null;
		private $config_code_color = null;
		private $noautomationcode = null;
		
		function __construct ($config_back_image = './num.jpg', $config_font = 100, $config_code_color = 'FFFFFF',$config_max_digits = 6,$noautomationcode = '')
		{			
		
			$this->config_max_digits = $config_max_digits;
			$this->config_back_image = $config_back_image;
			$this->config_font = $config_font;
			$this->config_code_color = $config_code_color;
			$this->noautomationcode = $noautomationcode;
		}
		
		public function GenerateCode ()
		{
			if (strlen($this->noautomationcode)==$this->config_max_digits) {
				$_SESSION["code"] = $this->noautomationcode;
				return $_SESSION["code"]; }
		
			for($i=0; $i<$this->config_max_digits;$i++) 
			{
				$this->noautomationcode = $this->noautomationcode.rand(0,9);
			}
			$_SESSION["code"] = $this->noautomationcode;
			return $_SESSION["code"];
		}

		public function PrintCaptcha()
		{
			if (strlen($this->noautomationcode)<1)
			{
				$this->noautomationcode = $this->GenerateCode();
			}
			
			$img_path = $this->config_back_image;
			$img = ImageCreateFromJpeg($img_path);
			$img_size = getimagesize($img_path);

			$fw = imagefontwidth ( $this->config_font );
			$fh = imagefontheight ( $this->config_font );

			$x = ($img_size[0] - strlen($this->noautomationcode) * $fw )/2;
			$y = ($img_size[1] - $fh) / 2;

			$color = imagecolorallocate($img,
			hexdec(substr($this->config_code_color,0,2)),
			hexdec(substr($this->config_code_color,2,2)),
			hexdec(substr($this->config_code_color,4,2)));

			imagestring ( $img, $this->config_font, $x, $y, $this->noautomationcode, $color);
			
			imagejpeg($img);
		}
	}
	
	$cp = new Captcha ();
	$cp->PrintCaptcha ();
?>