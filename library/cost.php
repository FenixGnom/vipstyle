<?php
require "library/pricescheme.php";

class Cost {
	public function delivery($type,$amount){
		// price scheme class object creation
		$extra_condition = '$summa_dost = 480 + 30 * $amount;';
		$scheme = new priceScheme( "catalog/xml_delivery.xml", '$amount', '$summa_dost', '$type' );
		$scheme_code = $scheme->generateDeliveryScheme( $extra_condition );
                
		eval( $scheme_code );
		return @$summa_dost;
	}

	public function createorders($mas) {
		ob_start();
		include $_SERVER['DOCUMENT_ROOT']."/xml_orders.php";
		$strem = ob_get_clean();
		return $strem;
	}

	public function goorders($data) {
		$settings = Registry::getParam('globalUrl');
		$response = "";
		$conn = @fsockopen ($settings['urlfororders'], $settings['portfororders'],$errno, $errstr, 10);
		if(!$conn) {
			$response = "<error></error>";
			return $response;
		}
		$headers =
				"POST /" . $settings['pagefororders'] . "?version=3.3&platform=shop-3 HTTP/1.0\r\n" .
				"Host: " . $settings['urlfororders'] . "\r\n" .
				"Connection: close\r\n" .
				"User-Agent: Client site\r\n" .
				"Content-Type: text/xml\r\n" .
				"Content-Length: " . strlen($data) . "\r\n\r\n";
		fputs($conn, "$headers");
		fputs($conn, $data);
		while(!feof($conn)) $response .= fgets($conn, 1024);
		fclose($conn);
		return $response;
	}
}

?>