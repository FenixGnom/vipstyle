<?php /* Smarty version Smarty-3.1.11, created on 2013-04-22 17:03:36
         compiled from "themes/partner7/product.tpl" */ ?>
<?php /*%%SmartyHeaderCode:157339079351753528455596-37466321%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '48e6deb2dba18496058e42071f645e503a8d75ad' => 
    array (
      0 => 'themes/partner7/product.tpl',
      1 => 1350913594,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157339079351753528455596-37466321',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_517535284a10b0_25052869',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517535284a10b0_25052869')) {function content_517535284a10b0_25052869($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <!-- END of BOTTOM -->
    
    <div class="container">
            
            
            
            
            
            <!-- START of INNER-CONTAINER -->
            <div class="inner-container clearfix" id="inThisLoaders7">
            
            		<div id="product" class="clearfix">
                            <?php echo $_smarty_tpl->getSubTemplate ('product_show.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                            
                        </div>
                        <?php echo $_smarty_tpl->getSubTemplate ('rightblock.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

            </div>
            <!-- END of INNER-CONTAINER -->
            
            <!-- START of RELATED PRODUCTS -->
            
            <!-- END of LATEST PRODUCTS -->
    		
    
    </div><!-- end of .container -->
    
    
	<!-- START of PAGE-BOTTOM -->
    <?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>