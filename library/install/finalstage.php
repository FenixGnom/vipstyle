<?php

/**
 * install_finalStage
 * 
 * install_finalStage. Final installation stage.
 * 
 * @author Kornushkin Aleksei kornushkin@gmail.com
 */
	class install_finalStage extends install_stage
	{
	  public function check()
	  {
	      
	  }
	  
	  public function getForm()
	  {
	      $this->getFormData();
	  }
	  
	  public function getFormData()
	  {
	     $this->changeConfig();
	     return $this->stageName.'.phtml';
	  }
	  
	  private function changeConfig()
	  {
	    $f=fopen('config.php','r');
	    $config_text = fread( $f, 5000 );
	    $config_text = preg_replace("/DB_Host = \'.*\'/", "DB_Host = '".$_SESSION['db_host']."'", $config_text);
	    $config_text = preg_replace("/DB_Name = \'.*\'/", "DB_Name = '".$_SESSION['db_dbname']."'", $config_text);
	    $config_text = preg_replace("/DB_UserName = \'.*\'/", "DB_UserName = '".$_SESSION['db_user']."'", $config_text);
	    $config_text = preg_replace("/DB_Password = \'.*\'/", "DB_Password = '".$_SESSION['db_pwd']."'", $config_text);
	    $config_text = preg_replace("/PartnerID = \'.*\'/", "PartnerID = '".$_SESSION['partner_ref']."'", $config_text);
	    $config_text = preg_replace("/PartnerSalt = \'.*\'/", "PartnerSalt = '".$_SESSION['partner_salt']."'", $config_text);
	    
		fclose($f);
		$f=fopen('config.php','wb');
		fwrite($f,$config_text);
		fclose($f);
		self::createtables();
		
	  }
	  
	  private function createtables() {		
		$connect = @mysql_connect( @$_SESSION['db_host'], @$_SESSION['db_user'], @$_SESSION['db_pwd']);
		if($connect)
		{
			$database = @mysql_select_db( @$_SESSION['db_dbname'], $connect );
			if($database){
			mysql_query("CREATE TABLE IF NOT EXISTS `categories` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `name` varchar(255) DEFAULT NULL,
						  `new` char(1) DEFAULT NULL,
						  `allowed` char(1) DEFAULT NULL,
						  PRIMARY KEY (`id`),
						  INDEX `new` (`new`),
						  INDEX `allowed` (`allowed`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

						mysql_query("CREATE TABLE IF NOT EXISTS `color` (
						  `id` int(11) NOT NULL auto_increment,
						  `name` varchar(255) collate utf8_general_ci NOT NULL,
						  `abriv` varchar(255) collate utf8_general_ci NOT NULL,
						  PRIMARY KEY  (`id`),
						  INDEX `abriv` (`abriv`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");



						mysql_query ("CREATE TABLE IF NOT EXISTS `seo` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `uri` varchar(255) NOT NULL,
						  `title` text NOT NULL,
						  `keywords` text NOT NULL,
						  `description` text NOT NULL,
						  PRIMARY KEY (`id`),
						  INDEX `uri` (`uri`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;");

						mysql_query ("CREATE TABLE IF NOT EXISTS `description_cat` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `id_cat` int(11) NOT NULL,
						  `desc` text COLLATE utf8_general_ci NOT NULL,
						  PRIMARY KEY (`id`),
						  INDEX `id_cat` (`id_cat`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");

						mysql_query ("CREATE TABLE IF NOT EXISTS `description_offers` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `id_offers` int(11) NOT NULL,
						  `desc` text COLLATE utf8_general_ci NOT NULL,
						  PRIMARY KEY (`id`),
						INDEX `id_offers` (`id_offers`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");

						mysql_query ("CREATE TABLE IF NOT EXISTS `description_subcat` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `id_subcat` varchar(50) NOT NULL,
						  `id_cat` int(11) NOT NULL,
						  `desc` text COLLATE utf8_general_ci NOT NULL,
						  PRIMARY KEY (`id`),
						  INDEX `id_subcat` (`id_subcat`),
						  INDEX `id_cat` (`id_cat`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

						
						mysql_query ("CREATE TABLE IF NOT EXISTS `obnovka` (
						  `id` int(11) NOT NULL auto_increment,
						  `data` varchar(255) collate utf8_general_ci NOT NULL,
						  `kolvo` varchar(255) collate utf8_general_ci NOT NULL,
						  `times` varchar(255) collate utf8_general_ci NOT NULL,
						  PRIMARY KEY  (`id`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

						mysql_query ("CREATE TABLE IF NOT EXISTS `offerss` (
									`id` int(20) NOT NULL,
									`name` varchar(255) NOT NULL,
									  `front` int(1) NOT NULL,
									  `back` int(1) NOT NULL,
									  `allowed` varchar(5) NOT NULL,
									  `id_offer` INT( 20 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,
									  INDEX `oldidid` (`id`),
									  INDEX `allowed` (`allowed`)
									) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
						
						mysql_query("CREATE TABLE IF NOT EXISTS `relation_category` (
									  `id_offers` int(20) NOT NULL,
									  `id_cat` int(20) NOT NULL,
									  `id_sub` varchar(255) NOT NULL,
									  INDEX `subcategoryid` (`id_cat`),
									  INDEX `categoryid` (`id_sub`),
									  INDEX `oldid` (`id_offers`)
									) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
									
						mysql_query("CREATE TABLE IF NOT EXISTS `relation_type` (
									  `id_offers` int(20) NOT NULL,
									  `type` varchar(255) NOT NULL,
									  `color` varchar(255) NOT NULL,
									  `hand` int(2) NOT NULL,
									  `price` int(20) NOT NULL,
									  INDEX `sexid` (`type`),
									  INDEX `colors` (`color`),
									  INDEX `rukav` (`hand`),
									  INDEX `oldid` (`id_offers`)
									) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
						
						mysql_query("CREATE TABLE IF NOT EXISTS `relation_type_size` (
									  `id_type` varchar(255) NOT NULL,
									  `size` varchar(255) NOT NULL,
									  `color` int(5) NOT NULL
									) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
						
						mysql_query("CREATE TABLE IF NOT EXISTS `update_temp_new` (
				  `id` int(20) NOT NULL,
				  `name` varchar(20) NOT NULL,
				  `id_updating` int(20) NOT NULL,
				  `allowed` varchar(10) not null,
				  INDEX `id` (`id`)
				)ENGINE=MyISAM DEFAULT CHARSET=utf8;
									");




						mysql_query ("CREATE TABLE IF NOT EXISTS `sex` (
						  `id` int(11) NOT NULL auto_increment,
						  `name` varchar(255) collate utf8_general_ci NOT NULL,
						  `path` varchar(255) collate utf8_general_ci NOT NULL,
						  `name_z` varchar(255) collate utf8_general_ci default NULL,
						  `tpl_name` varchar(255) collate utf8_general_ci NOT NULL,
						  `name_alls` varchar(255) collate utf8_general_ci NOT NULL,
						  `params` text NOT NULL,
						  `double` int(2) default '1',
						  PRIMARY KEY  (`id`),
						  INDEX `path` (`path`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;");

						mysql_query ("CREATE TABLE IF NOT EXISTS `stat_content` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`title` text NOT NULL,
						`text` mediumtext NOT NULL,
						`keywords` text NOT NULL,
						`url` varchar(255) NOT NULL,
						`froms` tinyint(1) NOT NULL,
						`menu` smallint(1) NOT NULL DEFAULT '0',
						`start` tinyint(1) NOT NULL DEFAULT '0',
						`search_query` varchar(255) NULL,
						PRIMARY KEY (`id`),
						INDEX `url` (`url`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8");

						mysql_query ("CREATE TABLE IF NOT EXISTS `menu_stat` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`url` varchar(255) NOT NULL,
						`title` varchar(255) NOT NULL,
						`stat_id` int(11) NOT NULL,
						`position` int(11) NOT NULL,
						`target` tinyint(1) NOT NULL DEFAULT '0',
						PRIMARY KEY (`id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8");			






						mysql_query ("CREATE TABLE IF NOT EXISTS `subcategories` (
						  `id` varchar(50) NOT NULL,
						  `name` varchar(255) DEFAULT NULL,
						  `parentcategoryid` int(11) NOT NULL DEFAULT 0,
						  `allowed` char(1) DEFAULT NULL,
						  PRIMARY KEY (`id`,`parentcategoryid`),
						  KEY `allowed` (`allowed`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8;");


						mysql_query ("CREATE TABLE IF NOT EXISTS `zakaz` (
							  `id` int(11) NOT NULL auto_increment,
							  `id_zakaz` int(11) NOT NULL,
							  `id_zakaz_partner` varchar(255) collate utf8_general_ci NOT NULL,
							  `log_zakaza` text collate utf8_general_ci NOT NULL,
							  `info` text collate utf8_general_ci NOT NULL,
							  `adres` varchar(255) collate utf8_general_ci NOT NULL,
							  `dostavka` varchar(255) collate utf8_general_ci NOT NULL,
							  `oplata` varchar(255) collate utf8_general_ci NOT NULL,
							  `fio` varchar(255) collate utf8_general_ci NOT NULL,
							  `tel` varchar(255) collate utf8_general_ci NOT NULL,
							  `email` varchar(255) collate utf8_general_ci NOT NULL,
							  `summasdost` varchar(255) collate utf8_general_ci NOT NULL,
							  `rassilka` tinyint(2) NOT NULL default '0',
							  `partners` varchar(255) collate utf8_general_ci NOT NULL,
							  `status` smallint(2) NOT NULL,
							  `data` int(11) NOT NULL,
							  PRIMARY KEY  (`id`)
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");
							
							mysql_query ("CREATE TABLE IF NOT EXISTS `phrases` (
											  `id` int(11) NOT NULL AUTO_INCREMENT,
											  `phrases` text CHARACTER SET utf8 NOT NULL,
											  `counts` int(11) NOT NULL,
											  PRIMARY KEY (`id`)
											) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");
							
							mysql_query ("CREATE TABLE IF NOT EXISTS `visits` (
										  `id` int(11) NOT NULL AUTO_INCREMENT,
										  `data` int(11) NOT NULL,
										  `phrases` text CHARACTER SET utf8 NOT NULL,
										  `zakaz` int(11) NOT NULL,
										  `count_zakaz` int(11) NOT NULL DEFAULT '0',
										  `system_search` varchar(255) CHARACTER SET utf8 NOT NULL,
										  `main_page` varchar(255) CHARACTER SET utf8 NOT NULL,
										  `session_id` varchar(255) CHARACTER SET utf8 NOT NULL,
										  PRIMARY KEY (`id`)
										) ENGINE=MyISAM  DEFAULT CHARSET=utf8  ;");
							mysql_query("CREATE TABLE IF NOT EXISTS `version` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `version` varchar(255) CHARACTER SET utf8 NOT NULL,
						  `active` int(2) NOT NULL,
						  PRIMARY KEY (`id`),
						  INDEX `version` (`version`),
						  INDEX `active` (`active`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");						

						mysql_query("insert into version set version='3.3',active=1");

						mysql_query("CREATE TABLE IF NOT EXISTS `update_temp` (
						`oldid` int(11) DEFAULT NULL,
						`name` varchar(255) DEFAULT NULL,
						`sexid` int(11) DEFAULT NULL,
						`colors` int(11) DEFAULT NULL,
						`price` varchar(255) DEFAULT NULL,
						`subcategoryid` varchar(20) NOT NULL DEFAULT '',
						`categoryid` int(11) DEFAULT NULL,
						`rukav` int(2) NOT NULL DEFAULT '0',
						`id_updating` int(11) NOT NULL,
						KEY `oldid` (`oldid`),					  
						KEY `subcategoryid` (`subcategoryid`),
						KEY `categoryid` (`categoryid`),
						KEY `sexid` (`sexid`),
						KEY `colors` (`colors`),
						KEY `rukav` (`rukav`),
						KEY `id_updating` (`id_updating`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

						mysql_query("CREATE TABLE IF NOT EXISTS `offers_version` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `type` smallint(2) NOT NULL DEFAULT '1',
						  `artcl` int(11) NOT NULL,
						  `version` int(11) NOT NULL,
						  `info` text NOT NULL,
						  `name` varchar(255) NOT NULL,
						  `type_action` tinyint(3) NOT NULL DEFAULT '1',
						  `counts` int(11) NOT NULL,
						  PRIMARY KEY (`id`),
						  KEY `artcl` (`artcl`),
						  KEY `type` (`type`),
						  KEY `name` (`name`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8");

						mysql_query("CREATE TABLE IF NOT EXISTS `update_info` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`date` int(11) NOT NULL,
						`status` tinyint(3) NOT NULL DEFAULT '0',
						PRIMARY KEY (`id`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8");	
						mysql_query("CREATE TABLE IF NOT EXISTS `update_date_xml` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`date_xml` varchar(255) NOT NULL,
						`date` int(11) NOT NULL,
						`url` varchar(255) NOT NULL,						
						PRIMARY KEY (`id`),
						KEY `date_xml` (`date_xml`),
						KEY `url` (`url`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8");		
						
						
			}
			}
		}
		
	}
?>