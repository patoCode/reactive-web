<?php
/**
 * Maintenance Services Theme Customizer
 *
 * @package Maintenance Services
 */
function maintenance_services_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'maintenance_services_custom_header_args', array(
		'default-text-color'     => '949494',
		'width'                  => 1600,
		'height'                 => 200,
		'wp-head-callback'       => 'maintenance_services_header_style',
 		'default-text-color' => false,
 		'header-text' => false,
	) ) );
}
add_action( 'after_setup_theme', 'maintenance_services_custom_header_setup' );
if ( ! function_exists( 'maintenance_services_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see maintenance_services_custom_header_setup().
 */
function maintenance_services_header_style() {
	$header_text_color = get_header_textcolor();
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() ) :
	?>
		.header {
			background: url(<?php echo esc_url(get_header_image()); ?>) no-repeat;
			background-position: center top;
			background-size:cover;
		}
	<?php endif; ?>	
	</style>
	<?php
}
endif; // maintenance_services_header_style 
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */ 
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function maintenance_services_customize_register( $wp_customize ) {
	//Add a class for titles
    class maintenance_services_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
			<h3 style="text-decoration: underline; color: #DA4141; text-transform: uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->add_setting('color_scheme',array(
			'default'	=> '#ff9a00',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => esc_html__('Color Scheme','maintenance-services'),			
			 'description'	=> esc_html__('More color options in PRO Version','maintenance-services'),	
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	// Slider Section		
	$wp_customize->add_section( 'slider_section', array(
            'title' => esc_html__('Slider Settings', 'maintenance-services'),
            'priority' => null,
            'description'	=> esc_html__('Featured Image Size Should be ( 1400 X 748 ) More slider settings available in PRO Version','maintenance-services'),		
        )
    );
	$wp_customize->add_setting('page-setting7',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'maintenance_services_sanitize_integer'
	));
	$wp_customize->add_control('page-setting7',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Select page for slide one:','maintenance-services'),
			'section'	=> 'slider_section'
	));	
	$wp_customize->add_setting('page-setting8',array(
			'default' => '0',
			'capability' => 'edit_theme_options',			
			'sanitize_callback'	=> 'maintenance_services_sanitize_integer'
	));
	$wp_customize->add_control('page-setting8',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Select page for slide two:','maintenance-services'),
			'section'	=> 'slider_section'
	));	
	$wp_customize->add_setting('page-setting9',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'maintenance_services_sanitize_integer'
	));
	$wp_customize->add_control('page-setting9',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Select page for slide three:','maintenance-services'),
			'section'	=> 'slider_section'
	));	
	//Slider hide
	$wp_customize->add_setting('hide_slides',array(
			'sanitize_callback' => 'maintenance_services_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_slides', array(
    	   'section'   => 'slider_section',    	 
		   'label'	=> esc_html__('Uncheck To Show Slider','maintenance-services'),
    	   'type'      => 'checkbox'
     )); // Slider Section		 
	 
	$wp_customize->add_section('header_top_bar',array(
			'title'	=> esc_html__('Header Information','maintenance-services'),				
			'description'	=> esc_html__('Add Information For Header Area','maintenance-services'),		
			'priority'		=> null
	));
	
	$wp_customize->add_setting('contact_no',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('contact_no',array(
			'label'	=> esc_html__('Add contact number here.','maintenance-services'),
			'section'	=> 'header_top_bar',
			'setting'	=> 'contact_no'
	));
	
	$wp_customize->add_setting('email_add',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('email_add',array(
			'label'	=> esc_html__('Add email address here.','maintenance-services'),
			'section'	=> 'header_top_bar',
			'setting'	=> 'email_add'
	));	
	
	$wp_customize->add_setting('contact_top_address',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('contact_top_address',array(
			'label'	=> esc_html__('Add address here line 1','maintenance-services'),
			'section'	=> 'header_top_bar',
			'setting'	=> 'contact_top_address'
	));	
	
	$wp_customize->add_setting('contact_top_address_two',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('contact_top_address_two',array(
			'label'	=> esc_html__('Add address here line 2','maintenance-services'),
			'section'	=> 'header_top_bar',
			'setting'	=> 'contact_top_address_two'
	));	
	
	//Hide Header Top Bar
	$wp_customize->add_setting('hide_header_topbar',array(
			'sanitize_callback' => 'maintenance_services_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_header_topbar', array(
    	   'section'   => 'header_top_bar',    	 
		   'label'	=> esc_html__('Uncheck To Show This Section','maintenance-services'),
    	   'type'      => 'checkbox'
     )); 	//Hide Header Top Bar	
	 
	 
	// Home Section 1
	$wp_customize->add_section('section_thumb_with_content', array(
		'title'	=> esc_html__('Home Section One','maintenance-services'),
		'description'	=> esc_html__('Select Page from the dropdown for section','maintenance-services'),
		'priority'	=> null
	));	
	
	$wp_customize->add_setting('section1_title',array(
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('section1_title',array(
			'label'	=> __('Add title for section title','maintenance-services'),
			'section'	=> 'section_thumb_with_content',
			'setting'	=> 'section1_title'
	));	
	
	$wp_customize->add_setting('sec-column-left1',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'maintenance_services_sanitize_integer',
		));
	$wp_customize->add_control(	'sec-column-left1',array('type' => 'dropdown-pages',
			'section' => 'section_thumb_with_content',
	));	
	
	$wp_customize->add_setting('sec-column-left2',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'maintenance_services_sanitize_integer',
		));
	$wp_customize->add_control(	'sec-column-left2',array('type' => 'dropdown-pages',
			'section' => 'section_thumb_with_content',
	));		
 	
	$wp_customize->add_setting('sec-column-left3',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'maintenance_services_sanitize_integer',
		));
	$wp_customize->add_control(	'sec-column-left3',array('type' => 'dropdown-pages',
			'section' => 'section_thumb_with_content',
	));		
 	
	//Hide Section 	
	$wp_customize->add_setting('hide_home_secwith_content',array(
			'sanitize_callback' => 'maintenance_services_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_home_secwith_content', array(
    	   'section'   => 'section_thumb_with_content',    	 
		   'label'	=> esc_html__('Uncheck To Show This Section','maintenance-services'),
    	   'type'      => 'checkbox'
     )); // Hide Section 			
	 
	 
	 
// Home Section 2
	$wp_customize->add_section('section_two', array(
		'title'	=> esc_html__('Home Section Two','maintenance-services'),
		'description'	=> esc_html__('Select Page from the dropdown','maintenance-services'),
		'priority'	=> null
	));	

	$wp_customize->add_setting('page-column1',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'maintenance_services_sanitize_integer',
		));
	$wp_customize->add_control(	'page-column1',array('type' => 'dropdown-pages',
			'section' => 'section_two',
	));	
	
	//Hide Section
	$wp_customize->add_setting('hide_sectiontwo',array(
			'sanitize_callback' => 'maintenance_services_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_sectiontwo', array(
    	   'section'   => 'section_two',    	 
		   'label'	=> esc_html__('Uncheck To Show This Section','maintenance-services'),
    	   'type'      => 'checkbox'
     )); //Hide Section	 	 

	// Home Section 3
	$wp_customize->add_section('hm_section_3', array(
		'title'	=> esc_html__('Home Section Three','maintenance-services'),
		'description'	=> esc_html__('Select Page from the dropdown for section','maintenance-services'),
		'priority'	=> null
	));	
	
	$wp_customize->add_setting('section3_title',array(
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('section3_title',array(
			'label'	=> __('Add title for section title','maintenance-services'),
			'section'	=> 'hm_section_3',
			'setting'	=> 'section3_title'
	));	
	
	$wp_customize->add_setting('third-column-left1',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'maintenance_services_sanitize_integer',
		));
	$wp_customize->add_control(	'third-column-left1',array('type' => 'dropdown-pages',
			'section' => 'hm_section_3',
	));	
	
	$wp_customize->add_setting('third-column-left2',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'maintenance_services_sanitize_integer',
		));
	$wp_customize->add_control(	'third-column-left2',array('type' => 'dropdown-pages',
			'section' => 'hm_section_3',
	));		
 	
	$wp_customize->add_setting('third-column-left3',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'maintenance_services_sanitize_integer',
		));
	$wp_customize->add_control(	'third-column-left3',array('type' => 'dropdown-pages',
			'section' => 'hm_section_3',
	));	
	
	$wp_customize->add_setting('third-column-left4',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'maintenance_services_sanitize_integer',
		));
	$wp_customize->add_control(	'third-column-left4',array('type' => 'dropdown-pages',
			'section' => 'hm_section_3',
	));		
 	
	//Hide Section 	
	$wp_customize->add_setting('hide_home_third_content',array(
			'sanitize_callback' => 'maintenance_services_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_home_third_content', array(
    	   'section'   => 'hm_section_3',    	 
		   'label'	=> esc_html__('Uncheck To Show This Section','maintenance-services'),
    	   'type'      => 'checkbox'
     )); // Hide Section 	
	 
// Home Section 4
	$wp_customize->add_section('section_four', array(
		'title'	=> esc_html__('Home Section Four','maintenance-services'),
		'description'	=> esc_html__('Select Page from the dropdown','maintenance-services'),
		'priority'	=> null
	));	

	$wp_customize->add_setting('sectionfour-column1',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'maintenance_services_sanitize_integer',
		));
	$wp_customize->add_control(	'sectionfour-column1',array('type' => 'dropdown-pages',
			'section' => 'section_four',
	));	
	
	$wp_customize->add_setting('section4_button_text',array(
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('section4_button_text',array(
			'label'	=> __('Add Button Text','maintenance-services'),
			'section'	=> 'section_four',
			'setting'	=> 'section4_button_text'
	));			
	
	$wp_customize->add_setting('section4_button_link',array(
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('section4_button_link',array(
			'label'	=> __('Add Button Link','maintenance-services'),
			'section'	=> 'section_four',
			'setting'	=> 'section4_button_link'
	));		
	
	//Hide Section
	$wp_customize->add_setting('hide_sectionfour',array(
			'sanitize_callback' => 'maintenance_services_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_sectionfour', array(
    	   'section'   => 'section_four',    	 
		   'label'	=> esc_html__('Uncheck To Show This Section','maintenance-services'),
    	   'type'      => 'checkbox'
     )); //Hide Section	
	 
	// Home Section 5
	$wp_customize->add_section('hm_section_5', array(
		'title'	=> esc_html__('Home Section Five','maintenance-services'),
		'description'	=> esc_html__('Select Page from the dropdown for section','maintenance-services'),
		'priority'	=> null
	));	
	
	$wp_customize->add_setting('section5_title',array(
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('section5_title',array(
			'label'	=> __('Add title for section title','maintenance-services'),
			'section'	=> 'hm_section_5',
			'setting'	=> 'section5_title'
	));	
	
	$wp_customize->add_setting('sectionfive-column1',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'maintenance_services_sanitize_integer',
		));
	$wp_customize->add_control(	'sectionfive-column1',array('type' => 'dropdown-pages',
			'section' => 'hm_section_5',
	));	
	
	$wp_customize->add_setting('sectionfive-column2',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'maintenance_services_sanitize_integer',
		));
	$wp_customize->add_control(	'sectionfive-column2',array('type' => 'dropdown-pages',
			'section' => 'hm_section_5',
	));		
 	
	$wp_customize->add_setting('sectionfive-column3',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'maintenance_services_sanitize_integer',
		));
	$wp_customize->add_control(	'sectionfive-column3',array('type' => 'dropdown-pages',
			'section' => 'hm_section_5',
	));	
	
	$wp_customize->add_setting('sectionfive-column4',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'maintenance_services_sanitize_integer',
		));
	$wp_customize->add_control(	'sectionfive-column4',array('type' => 'dropdown-pages',
			'section' => 'hm_section_5',
	));		
    
	$wp_customize->add_setting('sectionfive-column5',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'maintenance_services_sanitize_integer',
		));
	$wp_customize->add_control(	'sectionfive-column5',array('type' => 'dropdown-pages',
			'section' => 'hm_section_5',
	));	    
        
	$wp_customize->add_setting('sectionfive-column6',	array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback' => 'maintenance_services_sanitize_integer',
		));
	$wp_customize->add_control(	'sectionfive-column6',array('type' => 'dropdown-pages',
			'section' => 'hm_section_5',
	));	    
 	
	//Hide Section 	
	$wp_customize->add_setting('hide_home_five_content',array(
			'sanitize_callback' => 'maintenance_services_sanitize_checkbox',
			'default' => true,
	));	 
	$wp_customize->add_control( 'hide_home_five_content', array(
    	   'section'   => 'hm_section_5',    	 
		   'label'	=> esc_html__('Uncheck To Show This Section','maintenance-services'),
    	   'type'      => 'checkbox'
     )); // Hide Section	 	 		

	// Social Icons 
	$wp_customize->add_section('social_sec',array(
			'title'	=> esc_html__('Social Settings','maintenance-services'),				
			'description'	=> esc_html__('More social icon available in PRO Version','maintenance-services'),		
			'priority'		=> null
	));
	$wp_customize->add_setting('fb_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	$wp_customize->add_control('fb_link',array(
			'label'	=> esc_html__('Add Facebook link here','maintenance-services'),
			'section'	=> 'social_sec',
			'setting'	=> 'fb_link'
	));	
	$wp_customize->add_setting('twitt_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('twitt_link',array(
			'label'	=> esc_html__('Add Twitter link here','maintenance-services'),
			'section'	=> 'social_sec',
			'setting'	=> 'twitt_link'
	));
	$wp_customize->add_setting('youtube_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('youtube_link',array(
			'label'	=> esc_html__('Add Youtube link here','maintenance-services'),
			'section'	=> 'social_sec',
			'setting'	=> 'youtube_link'
	));	
	$wp_customize->add_setting('instagram_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('instagram_link',array(
			'label'	=> esc_html__('Add Instagram link here','maintenance-services'),
			'section'	=> 'social_sec',
			'setting'	=> 'instagram_link'
	));		
	$wp_customize->add_setting('linkedin_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('linkedin_link',array(
			'label'	=> esc_html__('Add Linkedin link here','maintenance-services'),
			'section'	=> 'social_sec',
			'setting'	=> 'linkedin_link'
	));	
	// Social Icons 
	
	// Footer Info Area
	$wp_customize->add_section('footer_info_area',array(
			'title'	=> __('Footer Info Area','maintenance-services'),
			'priority'	=> null,
	));
	
	$wp_customize->add_setting('address_title',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('address_title',array(
			'label'	=> __('Add Address Title','maintenance-services'),
			'section'	=> 'footer_info_area',
			'setting'	=> 'address_title'
	));	
    
	$wp_customize->add_setting('address',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('address',array(
			'label'	=> __('Add Address','maintenance-services'),
			'section'	=> 'footer_info_area',
			'setting'	=> 'address'
	));	  
    
	$wp_customize->add_setting('email_title',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('email_title',array(
			'label'	=> __('Add Email Title','maintenance-services'),
			'section'	=> 'footer_info_area',
			'setting'	=> 'email_title'
	));	
    
	$wp_customize->add_setting('email_address',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('email_address',array(
			'label'	=> __('Add Email Address','maintenance-services'),
			'section'	=> 'footer_info_area',
			'setting'	=> 'email_address'
	));
    
	$wp_customize->add_setting('phone_title',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('phone_title',array(
			'label'	=> __('Add Phone Title','maintenance-services'),
			'section'	=> 'footer_info_area',
			'setting'	=> 'phone_title'
	));	
    
	$wp_customize->add_setting('phone_number',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('phone_number',array(
			'label'	=> __('Add Phone Number','maintenance-services'),
			'section'	=> 'footer_info_area',
			'setting'	=> 'phone_number'
	));          
	
	$wp_customize->add_setting('hide_footer_info',array(
			'sanitize_callback' => 'maintenance_services_sanitize_checkbox',
			'default' => true,
	));	 

	$wp_customize->add_control( 'hide_footer_info', array(
    	   'section'   => 'footer_info_area',    	 
		   'label'	=> __('Uncheck To Show This Section','maintenance-services'),
    	   'type'      => 'checkbox'
     ));	
	 // Footer Info Area			
	
}
add_action( 'customize_register', 'maintenance_services_customize_register' );
//Integer
function maintenance_services_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}
function maintenance_services_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

//setting inline css.
function maintenance_services_custom_css() {
    wp_enqueue_style(
        'maintenance-services-custom-style',
        get_template_directory_uri() . '/css/maintenance-services-custom-style.css'
    );
        $color = get_theme_mod( 'color_scheme' ); //E.g. #e64d43
		$header_text_color = get_header_textcolor();
        $custom_css = "
					#sidebar ul li a:hover,
					.footerarea a:hover,
					.cols-3 ul li.current_page_item a,				
					.phone-no strong,					
					.left a:hover,
					.blog_lists h4 a:hover,
					.recent-post h6 a:hover,
					.recent-post a:hover,
					.design-by a,
					.fancy-title h2 span,
					.postmeta a:hover,
					.logo h2,
					.left-fitbox a:hover h3, .right-fitbox a:hover h3, .tagcloud a,
					.slide_info h2 span,
					.blocksbox:hover h3,
					.homefour_section_content h2 span,
					.section5-column:hover h3
					{ 
						 color: {$color} !important;
					}
					.pagination .nav-links span.current, .pagination .nav-links a:hover,
					#commentform input#submit:hover,
					.nivo-controlNav a.active,								
					.wpcf7 input[type='submit'],
					a.ReadMore,
					.section2button,
					input.search-submit,
					.slide_info .slide_more,
					.recent-post .morebtn:hover, .sitenav ul li a:hover, .sitenav ul li.current_page_item a, .sitenav ul li.menu-item-has-children.hover, .sitenav ul li.current-menu-parent a.parent,
					.social-icons a:hover,
					.homefour_section_content .button,
					.perf-thumb,
					.yellowdivide
					{ 
					   background-color: {$color} !important;
					}
					.titleborder span:after, .perf-thumb:before{border-bottom-color: {$color} !important;}
					.perf-thumb:after{border-top-color: {$color} !important;}
					.section5-column:hover .section5-column-inner{border-color: {$color} !important;}
				";
        wp_add_inline_style( 'maintenance-services-custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'maintenance_services_custom_css' );          
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function maintenance_services_customize_preview_js() {
	wp_enqueue_script( 'maintenance_services_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'maintenance_services_customize_preview_js' );