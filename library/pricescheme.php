<?php
/**
 * Price scheme management class
 */
class priceScheme
{
    private $xml;
    private $amount_placeholder;
    private $summ_placeholder;
    private $type_placeholder;
    /**
     * CONSTRUCTOR
     * @param string $xml
     * @param string $amount_placeholder
     * @param string $summ_placeholder
     * @param string $type_placeholder
     */
    public function __construct( $xml, $amount_placeholder, $summ_placeholder, $type_placeholder )
    {
        // Realizing composition
        $data = file_get_contents( $xml );
        $this->xml = new simpleXmlElement( $data );
        $this->amount_placeholder = $amount_placeholder;
        $this->summ_placeholder   = $summ_placeholder;
        $this->type_placeholder   = $type_placeholder;
        
    }
    /**
     * Generates delivery scheme PHP code
     * To execute it - use eval() system function
     * @param string $default_condition Extra actions if no any type
     * of delivery detected
     */
    public function generateDeliveryScheme( $default_condition = false )
    {
        $result_html = "
    	switch({$this->type_placeholder}) {
        ";
        foreach ( $this->xml as $delivery )
        {
            $delivery_name = strtoupper( $delivery->getName() );
            $result_html .= "case '{$delivery_name}':";
            foreach ( $delivery as $tariff )
            {
                // Flag is TRUE if current amount is maximum amount
                $max_tariff_flag = false;
                $amount = 1;
                $price = (string) $tariff;
                foreach( $tariff->attributes() as $key => $val )
                {
                    if ( $key=="max" && $val=="true") $max_tariff_flag = true;
                    if ( $key=="amount" ) $amount = $val;
                }
                $sign = ( $max_tariff_flag ) ? '>=' : '==';
                {
                    $result_html .= "if ( {$this->amount_placeholder} {$sign} {$amount}) {$this->summ_placeholder} = {$price};\r\n";
                }
            }
            $result_html .= "break;";
        }
        if ( $default_condition )
        {
            $result_html .= "default: {$default_condition} break;";
        }
        $result_html .= "}";
        return $result_html;
    }
}
?>