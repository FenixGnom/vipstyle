<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 17:03:20
         compiled from "themes/partner7/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:552545024517535187b3689-56879014%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b5cd1686b0a992319e41e62bd2b947226745e54' => 
    array (
      0 => 'themes/partner7/footer.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '552545024517535187b3689-56879014',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'template_data' => 0,
    'menuUser' => 0,
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5175351888e177_65129847',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5175351888e177_65129847')) {function content_5175351888e177_65129847($_smarty_tpl) {?>
</div>    
    <!-- START of FOOTER -->
 <div style="width: 100%;
  position: absolute;
  bottom: 0;
 ">   
     <div class="page-bottom-wrapper">	
            
    </div>
    <!-- END of PAGE-BOTTOM -->
    <div class="footer-wrapper">
    		
            <div id="footer" class="clearfix">
            
            		<!--<div class="column double">
                    		<a href="index.html"><img src="images/footer-logo.png" alt="Bonfire" /></a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pretium nisi id sapien cursus eu lobortis libero imperdiet. Aliquam erat volutpat. Pellentesque lacus urna, pellentesque non vehicula ac, adipiscing scelerisque eros. Mauris id tortor vitae velit auctor convallis nec non metus. Praesent eget dictum mauris. Sed vitae lorem et magna lacinia ultricies et non purus. </p>
                    </div>
                    
                    <div class="column">
                    		<h3>Links</h3>
                            <ul>
                            		<li><a href="#">About Us</a></li>
                                    <li><a href="#">Delivery Information</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Terms &amp; Conditions</a></li>
									<li><a href="#">Site Map</a></li>
									<li><a href="#">Contact Us</a></li>
                            </ul>
                    </div>
                    
                    <div class="column">
                    		<h3>MY ACCOUNT</h3>
                            <ul>
                            		<li><a href="#">My Account</a></li>
                                    <li><a href="#">Order History</a></li>
                                    <li><a href="#">Wish List</a></li>
                                    <li><a href="#">Newsletter</a></li>
									<li><a href="#">Returns</a></li>									
							</ul>
                    </div>
                    
                    <div class="column last">
                    		<h3>EXTRAS</h3>
                            <ul>
                            		<li><a href="#">Brands</a></li>
                                    <li><a href="#">Gift Vouchers</a></li>
                                    <li><a href="#">Affiliates</a></li>
                                    <li><a href="#">Specials</a></li>
                            </ul>
                    </div>!-->
                   <div class="column">     
                        <?php $_smarty_tpl->tpl_vars['rows'] = new Smarty_variable(0, null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['menuUser'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menuUser']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['template_data']->value->menu(4); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menuUser']->key => $_smarty_tpl->tpl_vars['menuUser']->value){
$_smarty_tpl->tpl_vars['menuUser']->_loop = true;
?>      		
                            <a  href="<?php echo $_smarty_tpl->tpl_vars['menuUser']->value->url();?>
"<?php if ($_smarty_tpl->tpl_vars['menuUser']->value->is_target()){?> target="_blank" <?php }?> ><?php echo $_smarty_tpl->tpl_vars['menuUser']->value->name();?>
</a> 
                            <?php if ($_smarty_tpl->tpl_vars['rows']->value!=count($_smarty_tpl->tpl_vars['template_data']->value->menu(4))-1){?>
                            |
                            <?php }?>
                            <?php $_smarty_tpl->tpl_vars['rows'] = new Smarty_variable($_smarty_tpl->tpl_vars['rows']->value+1, null, 0);?>	
                        <?php } ?>
                  </div>
            </div><!-- end of #footer -->
            
    </div>
    <!-- END of FOOTER -->
    
    
    <!-- START of COPYRIGHTS-WRAPPER -->
    <div class="copyright-wrapper">
    
    		<div id="copyrights" class="clearfix">
            		<p class="left"><?php echo $_smarty_tpl->tpl_vars['template_data']->value->partner()->shop_name();?>
 &copy;
                        Контакты:<?php if ($_smarty_tpl->tpl_vars['template_data']->value->partner()->contact_icq()!=''){?>ICQ:
                        <?php echo $_smarty_tpl->tpl_vars['template_data']->value->partner()->contact_icq();?>
<?php }?>	
                        <?php if ($_smarty_tpl->tpl_vars['template_data']->value->partner()->contact_email()!=''){?>email:
                        <a href="mailto:<?php echo $_smarty_tpl->tpl_vars['template_data']->value->partner()->contact_email();?>
"><?php echo $_smarty_tpl->tpl_vars['template_data']->value->partner()->contact_email();?>
</a><?php }?>
	 <?php if ($_smarty_tpl->tpl_vars['template_data']->value->partner()->contact_phone()!=''){?>	
		Телефон: <?php echo $_smarty_tpl->tpl_vars['template_data']->value->partner()->contact_phone();?>

     <?php }?>
     <a href="/feedback">Обратная связь</a></p>
            </div><!-- end of #copyrights -->
    
    </div>
    </div>
    <!-- END of COPYRIGHTS-WRAPPER -->
    
	<!-- jQuery -->
	
    
    <!-- jQuery Easing -->
	<script type="text/javascript" src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
js/jquery.easing.1.3.js"></script>
	
    <!-- jQuery Selectbox Script to custom style form select boxes -->
    <script type="text/javascript" src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
js/jquery.selectBox.js"></script>
    
    <!-- jQuery Cycle Plugin for home page slider-->
    <script type="text/javascript" src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
js/jquery.cycle.all.js"></script>
    
    <!-- jQuery Tabs and Accordion Script -->
    <script type="text/javascript" src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
js/tabs-accordian.js"></script>
    
    <!-- jQuery Coud Zoom Plugin for Product Page Image Zoom Effect-->
     <script type="text/JavaScript" src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
js/cloud-zoom.1.0.2.js"></script>
    
    <!-- jQuery Animate Color Plugin for Hover Color Animation for Links-->
    <script type="text/javascript" src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
js/jquery.animate-colors-min.js"></script>           
    
    <!-- jQuery Form and Validation Plugin for Contact form validation and ajax submition -->
    <script type="text/javascript" src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
js/jquery.form.js"></script>
    <script type="text/javascript" src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
js/jquery.validate.js"></script>    	
	
    <!-- script file to add your own JavaScript -->
	<script type="text/javascript" src="/themes/<?php echo $_smarty_tpl->tpl_vars['template_data']->value->enviroment()->theme_path();?>
js/script.js"></script>
</body>
</html><?php }} ?>