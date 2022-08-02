<?php
//about theme info
add_action( 'admin_menu', 'maintenance_services_abouttheme' );
function maintenance_services_abouttheme() {    	
	add_theme_page( esc_html__('About Theme', 'maintenance-services'), esc_html__('About Theme', 'maintenance-services'), 'edit_theme_options', 'maintenance_services_guide', 'maintenance_services_mostrar_guide');   
} 
//guidline for about theme
function maintenance_services_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<div class="wrapper-info">
	<div class="col-left">
   		   <div class="col-left-area">
			  <?php esc_attr_e('Theme Information', 'maintenance-services'); ?>
		   </div>
          <p><?php esc_html_e('SKT Maintenance Services WordPress theme useful for IT Solutions, Infrastructure, software cleaning, junk removal, renovation, interior, cleaning, computer, digital, repair, handyman, plumbing, electrician, carpenter, construction works. Servicing, car garage, auto. It is multipurpose template and comes with a ready to import Elementor template plugin as add on which allows to import 150+ design templates for making use in home and other inner pages. Use it to create any type of business, personal, blog and eCommerce website. It is fast, flexible, simple and fully customizable. WooCommerce ready designs.','maintenance-services'); ?></p>
		  <a href="<?php echo esc_url(MAINTENANCE_SERVICES_SKTTHEMES_PRO_THEME_URL); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	<div class="col-right">			
			<div class="centerbold">
				<hr />
				<a href="<?php echo esc_url(MAINTENANCE_SERVICES_SKTTHEMES_LIVE_DEMO); ?>" target="_blank"><?php esc_html_e('Live Demo', 'maintenance-services'); ?></a> | 
				<a href="<?php echo esc_url(MAINTENANCE_SERVICES_SKTTHEMES_PRO_THEME_URL); ?>"><?php esc_html_e('Buy Pro', 'maintenance-services'); ?></a> | 
				<a href="<?php echo esc_url(MAINTENANCE_SERVICES_SKTTHEMES_THEME_DOC); ?>" target="_blank"><?php esc_html_e('Documentation', 'maintenance-services'); ?></a>
                <div class="space5"></div>
				<hr />                
                <a href="<?php echo esc_url(MAINTENANCE_SERVICES_SKTTHEMES_THEMES); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>