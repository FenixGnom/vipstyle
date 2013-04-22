<?php
	header("Content-type: image/jpeg");

	class Captcha
	{
		private $config_max_digits = null;
		private $config_back_image = null;
		private $config_font = null;
		private $config_code_color = null;
		private $noautomationcode = null;

		function __construct ()
		{
			$this->config_max_digits = 6;
			$this->config_back_image = '../num.jpg';
			$this->config_font = 100;
			$this->config_code_color = 'FFFFFF';
		}

		public function GenerateCode ()
		{
			if (isset ($_SESSION['code']) and strlen($_SESSION["code"]) == $this->config_max_digits) {
				$this->noautomationcode = $_SESSION["code"];
				return $_SESSION["code"]; }

			for($i=0; $i<$this->config_max_digits;$i++)
			{
				$this->noautomationcode = $this->noautomationcode.rand(0,9);
			}
			$_SESSION["code"] = $this->noautomationcode;
			return $_SESSION["code"];
		}

		public function PrintCaptcha($text)
		{
			$this->noautomationcode = $text;
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

	if (isset($_GET['code']) and $_GET['code'] != ''){		$cp = new Captcha ();
		$cp->PrintCaptcha (base64_decode($_GET['code']));	}
?>