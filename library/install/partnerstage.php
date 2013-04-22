<?php

/**
 * install_partnerStage
 * 
 * install_partnerStage. Partner installation stage.
 * 
 * @author Kornushkin Aleksei kornushkin@gmail.com
 */
	class install_partnerStage extends install_stage
	{
	  public function check() {
	      
		$cost = new cost();
		$data=array();
		$dates=time();
		$massivs=array();
		$massivs['pat_id']=@$_POST['ref'];
		$massivs['salt']=@$_POST['salt'];
		$massivs['pat_name']='Testing';
		$massivs['data']=date("Y-m-d H:i:s");
		$microtime = explode(" ",microtime());
		$microsec = $microtime[0]*1000000;
		$massivs['id_orders']=date("Ymd")."-".@$_POST['ref']."-".(date("His.").$microsec);
		$massivs['froms']='';
		$massivs['name3']='test';
		$massivs['name1']='test';
		$massivs['name2']='test';
		$massivs['milos']='test@test.ru';
		$massivs['phons']='test';
		$massivs['index']='test';
		$massivs['country']='RUSSIA';
		$massivs['obl']='test';
		$massivs['city']='test';
		$massivs['adres']='test';
		$massivs['delivery']='POSTAL';
		$massivs['delivery_sum']=20;
		$massivs['prepay']='POSTAL';
		$massivs['sum']= 45;
		$massivs['text']='test';
		$massivs['id_key_count'] = 1;
		$massivs['orders']['0'] = array(
		    'oldid' => '129540',
          	'name'  => 'Значок Trollface. Problem? Проблемы?',
          	'model' => 'sign',
          	'color' => 'white',
          	'num'   => '1',
          	'price' => '25',
          	'hand'  => 'short',
          	'sizes' => '25mm',
		);
		
		$xml_doc=$cost->createorders($massivs);
		$answer=$cost->goorders($xml_doc);
		$err_code = '';
		preg_match( "/<error>(.*)<\/error>/", $answer, $err_code );
		$err_code = @substr($err_code[1], 0, 20);
		
	    if ( $err_code )
	    {
    		switch ( $err_code )
    		{
    		    case "Invalid partner code":
    		        return "Вы ввели неверный партнерский Ref код. Узнать правильные значения Вы можете в своем личном кабинете партнерской системы.";
    		        break;
    		    case "Invalid partner hash":
    		        return "Вы ввели неверный партнерский Salt код. Узнать правильные значения Вы можете в своем личном кабинете партнерской системы.";
    		        break;
    		    default:
    		        return "Неизвестная ошибка. Свяжитесь с нами по ICQ: <strong>".$this->config['contacts']['icq']."</strong>, либо по email: <strong>".$this->config['contacts']['email']."</strong>.";
    		}
	    }
        
	    //If everything OK - saving partner parameters in registry
	    $partner_params = array(
	          'partner_ref'   => @$_POST['ref'],
    	      'partner_salt'  => @$_POST['salt'],
	    );
	    install_installRegistry::saveArray( $partner_params );
	    install_installRegistry::setParam( 'stage_name',  'final');
	    $this->stageName = 'final';
	    return false;
	  }
	  
	  public function getFormData() {}
	}
?>