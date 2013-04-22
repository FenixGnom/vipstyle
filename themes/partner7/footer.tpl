
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
                        {assign var=rows value=0}
                        {foreach from=$template_data->menu(4) item=menuUser}      		
                            <a  href="{$menuUser->url()}"{if $menuUser->is_target()} target="_blank" {/if} >{$menuUser->name()}</a> 
                            {if $rows!=count($template_data->menu(4))-1}
                            |
                            {/if}
                            {$rows=$rows+1}	
                        {/foreach}
                  </div>
            </div><!-- end of #footer -->
            
    </div>
    <!-- END of FOOTER -->
    
    
    <!-- START of COPYRIGHTS-WRAPPER -->
    <div class="copyright-wrapper">
    
    		<div id="copyrights" class="clearfix">
            		<p class="left">{$template_data->partner()->shop_name()} &copy;
                        Контакты:{if $template_data->partner()->contact_icq() != ""}ICQ:
                        {$template_data->partner()->contact_icq()}{/if}	
                        {if $template_data->partner()->contact_email() !=""}email:
                        <a href="mailto:{$template_data->partner()->contact_email()}">{$template_data->partner()->contact_email()}</a>{/if}
	 {if $template_data->partner()->contact_phone() !=""}	
		Телефон: {$template_data->partner()->contact_phone()}
     {/if}
     <a href="/feedback">Обратная связь</a></p>
            </div><!-- end of #copyrights -->
    
    </div>
    </div>
    <!-- END of COPYRIGHTS-WRAPPER -->
    
	<!-- jQuery -->
	
    
    <!-- jQuery Easing -->
	<script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}js/jquery.easing.1.3.js"></script>
	
    <!-- jQuery Selectbox Script to custom style form select boxes -->
    <script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}js/jquery.selectBox.js"></script>
    
    <!-- jQuery Cycle Plugin for home page slider-->
    <script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}js/jquery.cycle.all.js"></script>
    
    <!-- jQuery Tabs and Accordion Script -->
    <script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}js/tabs-accordian.js"></script>
    
    <!-- jQuery Coud Zoom Plugin for Product Page Image Zoom Effect-->
     <script type="text/JavaScript" src="/themes/{$template_data->enviroment()->theme_path()}js/cloud-zoom.1.0.2.js"></script>
    
    <!-- jQuery Animate Color Plugin for Hover Color Animation for Links-->
    <script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}js/jquery.animate-colors-min.js"></script>           
    
    <!-- jQuery Form and Validation Plugin for Contact form validation and ajax submition -->
    <script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}js/jquery.form.js"></script>
    <script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}js/jquery.validate.js"></script>    	
	
    <!-- script file to add your own JavaScript -->
	<script type="text/javascript" src="/themes/{$template_data->enviroment()->theme_path()}js/script.js"></script>
</body>
</html>