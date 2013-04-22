<?php echo '<?xml version="1.0" encoding="utf-8" ?>';?>
<order>
  <partner>
    <info>
      <code><?php echo $mas['pat_id'];?></code>
      <salt><?php echo $mas['salt'];?></salt>
      <site><?php echo $_SERVER['HTTP_HOST'];?></site>
    </info>
    <orderinfo>
      <datetime><?php echo $mas['data'];?></datetime>
      <num><?php echo $mas['id_orders'];?></num>
      <referer><?php echo $mas['froms'];?></referer>
    </orderinfo>
  </partner>
  <header>
    <client>
      <family><?php echo $mas['name3'];?></family>
      <name><?php echo $mas['name1'];?></name>
      <patronymic><?php echo $mas['name2'];?></patronymic>
      <email><?php echo $mas['milos'];?></email>
      <tel><?php echo $mas['phons'];?></tel>
      <icq></icq>
      <skype></skype>
    </client>
    <address>
      <index><?php echo $mas['index'];?></index>
      <country><?php echo $mas['country'];?></country>
      <region><?php echo $mas['obl'];?></region>
      <city><?php echo $mas['city'];?></city>
      <addr><?php echo $mas['adres'];?></addr>
    </address>
    <delivery>
      <type><?php echo $mas['delivery'];?></type>
      <price><?php echo $mas['delivery_sum'];?></price>
    </delivery>
    <payment>
      <type><?php echo $mas['prepay'];?></type>
      <sum><?php echo $mas['sum'];?></sum>
    </payment>
    <comment><?php echo $mas['text'];?></comment>
  </header>

  <products>
	<?php for($i=0;$i<$mas['id_key_count'];$i++):?>
    <product>
      <quantity><?php echo $mas['orders'][$i]["num"];?></quantity>
      <price><?php echo $mas['orders'][$i]["price"];?></price>
	  <?if(isset($mas['orders'][$i]['zakazIn']) and $mas['orders'][$i]['zakazIn']==1):?>
				<is_orders>1</is_orders>
			<?else :?>
				<is_orders>0</is_orders>
			<?endif;?>
      <material>
        <type>standart</type>
        <properties>			
          <size><?php echo $mas['orders'][$i]["sizes"];?></size>
          <color><?php echo $mas['orders'][$i]["color"];?></color>
          <model><?php echo $mas ['orders'][$i]["model"];?></model>
          <hand><?php echo $mas['orders'][$i]["hand"];?></hand>
        </properties>
      </material>
      <fronttheme>
        <name><?php echo $mas['orders'][$i]["name"];?></name>
        <themeid><?php echo $mas['orders'][$i]["oldid"];?></themeid>
      </fronttheme>
    </product>
	 <?php  endfor;?>
  </products>
</order>
