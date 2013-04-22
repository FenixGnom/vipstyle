<?php
    class DeliveryData
    {
        private $xml;
        
        public function __construct($xml)
        {          
            $data = file_get_contents( $xml );
            $this->xml = new simpleXmlElement($data,LIBXML_NOCDATA);

        }
        
        public function data()
        {
            $data=array();
            $i=0;
            foreach ($this->xml as $t)
            {
                $param=$t->attributes();
                $id=(string)$param['id'];
                $name=(string)$t->name;
                $text=(string)$t->text;
                $data[$i]=array();
                $data[$i]['id']=$id;
                $data[$i]['name']=$name;
                $data[$i]['text']=$text;
                $data[$i]['amountprice']=(int)$param['amountprice'];
                $i++;     
                
            }
            
            return $data;
            
        }
    }
?>
