<?php

/**
 * Инкапсулирует работу с XML-документами.
 * @author Dmitry Shevchenko
 * @version 1.0
 */

class XMLHelper
{
	/* Весь XML-документ */
	private $doc = NULL;
	/* Корневой элемент */
	private $rootElement = NULL;

	/**
	 * Конструктор. Загружает документ. Получает корневой элемент.
	 * @param xml Строка - XML данные.
	 * @throws IOException
	 */
	public function XMLHelper( $xml ) {
		//echo '<br>xml:<br>';
		//echo htmlspecialchars($xml);
		//echo '<br><br>';	
		$this->doc = new DOMDocument();
		$this->doc->loadXML ( $xml );
		/* Корневой элемент */
		$this->rootElement = $this->doc->documentElement;
	}

	/**
	 * Возвращает текстовое значение ноды по заданному имени.
	 * @param node Имя ноды
	 * @return Текстовое значение ноды.
	 * @see getNodeByName
	 */
	public function getNodeValue( $node ) {
		$sResult = "";
		$n = $this->getNodeByName( $node );
		if( isset($n) ) {
			if ( $n->hasChildNodes() ) $n = $n->firstChild;
			$sResult = $n->nodeValue;
		}
		return $sResult;
	}

	/**
	 * Возвращает HashMap ("имя ноды - значение") всех потомков по указаному пути.
	 * @param nodePath Путь к ноде. начиная с рута, пример env/result/params
	 * @return Список значений.
	 * @see getNodeByName
	 */
	public function getNodeValues( $nodePath ) {
		$hm = array();
		$xpath = new DOMXPath($this->doc);
		$entries = $xpath->query('//'.$nodePath);
		for ($i = 0; $i < $entries->length; $i++ ) {
			$nl = $entries->item($i);
			if ( $nl->hasChildNodes() ) {
				$tmp_data = array();
				for ($j = 0; $j < $nl->childNodes->length; $j++ ) {
					$tmp_data[$nl->childNodes->item($j)->nodeName] = $nl->childNodes->item($j)->nodeValue;
				}
				$hm[] = $tmp_data;
			} else {
				$hm[][$entries->item($i)->nodeName] = $entries->item($i)->nodeValue;
			}

		}

		/*$i = 0;
		$node = NULL;
		$hm = array();
		$buf = split('/', $nodePath);
		if ( count($buf) );
		foreach($buf as $i) {
			$node = $this->getNodeByName( $i );
		}

		if( $node != NULL ) {
			$nl = $node->childNodes;
			for ($i=0; $i<$ln->length; $i++) {
				$n = $nl->item($i);
				$nodeName = $n->nodeName;
				$nodeValue = $n->firstChild->nodeValue;
				$hm[ $nodeName ] = $nodeValue;
			}
		}*/
		return $hm;
	}
	
	public function getNodesAttributes( $node_name ) {
		$hm = array();
		$entries = $this->rootElement->getElementsByTagName( $node_name );
		for ($i=0; $i<$entries->length; $i++) {
			$hm[ $entries->item($i)->attributes->getNamedItem("name")->textContent ] = $entries->item($i)->attributes->getNamedItem("value")->textContent;
		}
		return $hm;
	}
	
	public function getNodesAttributesID( $node_name ) {
		$hm = array();
		$entries = $this->rootElement->getElementsByTagName( $node_name );
		for ($i=0; $i<$entries->length; $i++) {
			$hm[ $i ] = $entries->item($i)->attributes->getNamedItem("ID")->textContent;
		}
		return $hm;
	}

	public function getHashValue( $hash, $search_key, $search_value, $req_key )
	{
		$return_value = NULL;
		foreach($hash as $hash_i) {
			if ( isset ($hash_i[ $search_key ]) && $hash_i[ $search_key ] === $search_value ) {
				if ( isset ( $hash_i[ $req_key ] ) ) {
					$return_value = $hash_i[ $req_key ];
					break;
				}
			}
		}
		return $return_value;
	}

	/**
	 * Возвращает строковое значение атрибута.
	 * @param node Имя ноды
	 * @param attr Имя атрибута
	 * @return Значение атрибута
	 * @see getNodeByName
	 */
	public function getStringAttrValue( $node, $attr ) {
		$sResult = "";
		$el = $this->getNodeByName($node);
		if ( $el != NULL ) {
			$sResult = $el->getAttribute( $attr );
		}
		return $sResult;
	}

	/**
	 * Возвращает целочислинное значение атрибута
	 * @param node Имя ноды
	 * @param attr Имя атрибута
	 * @return Значение атрибута
	 * @see getStringAttrValue
	 */
	public function getIntAttrValue( $node, $attr ) {
		$iResult = 0;
		$sValue = $this->getStringAttrValue( $node, $attr );
		if ( strlen($sValue) !=0 ) {
			$iResult = (int) $sValue;
		}
		return $iResult;
	}

	/**
	 * Закрытая функция. Возвращает ноду документа по имени.
	 * @param nodeName Имя ноды.
	 * @return Нода XML документа
	 */
	 
	 public function getNodeAttributeByTagName ($nodeName,$nodeIndex,$nodeAttr) {
		return $this->doc->getElementsByTagName($nodeName)->item($nodeIndex)->getAttributeNode($nodeAttr)->value;
	}
	 
	private function getNodeByName( $nodeName ) {
		$n = NULL;
		$nl = $this->doc->getElementsByTagName( $nodeName );
		if( $nl != NULL && $nl->length > 0 ) {
			$n = $nl->item(0);
		}
		return $n;
	}
	
    /** TODO Проверить поведения в PHP, не тестировалась
     * Возвращает HashMap ("индекс действия (indexPrefix+номер)- HTML или XML ответ действия") из результата запроса.
     *
     * @return Список значений.
     */
    public function getPageActionResults($indexPrefix){
        $nl = $this->rootElement->getElementsByTagName("action"); // nodelist
        $resultMap = array(); 
        if (($nl != null) && ($nl->childNodes->length > 0)) {
            $resultMap = array();
            for($i=0; $i<$nl->childNodes->length ; $i++){
                try{
                    $node = $nl->item(i);
                    $nodeAttrs = $node->getAttributes();
                    $actionIndexNode = $nodeAttrs->getNamedItem("index");
                    $actionIndex = $indexPrefix.$actionIndexNode->getNodeValue();
                    $actionData = "";
                    $childNode = $node->getFirstChild();
                    if($childNode instanceof CDATASection){
                        $actionData = $childNode->getData();
                    }
                    $resultMap->put(actionIndex, actionData);
                }catch( Exception $e ){
                    echo "Failed to parse compound page response: " + $e;
                }
            }
        }

        return $resultMap;
    }

};