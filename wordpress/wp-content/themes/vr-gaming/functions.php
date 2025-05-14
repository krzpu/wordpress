<?php

/*-----------------------------------------------------------------------------------*/
/* Enqueue script and styles */
/*-----------------------------------------------------------------------------------*/

function vr_gaming_enqueue_google_fonts() {

	require_once get_theme_file_path( 'core/includes/wptt-webfont-loader.php' );

	wp_enqueue_style(
		'google-fonts-archivo',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&display=swap' ),
		array(),
		'1.0'
	);
	
}
add_action( 'wp_enqueue_scripts', 'vr_gaming_enqueue_google_fonts' );

if (!function_exists('vr_gaming_enqueue_scripts')) {

	function vr_gaming_enqueue_scripts() {

		wp_enqueue_style(
			'bootstrap-css',
			get_template_directory_uri() . '/css/bootstrap.css',
			array(),'4.5.0'
		);

		wp_enqueue_style(
			'fontawesome-css',
			get_template_directory_uri() . '/css/fontawesome-all.css',
			array(),'4.5.0'
		);

		wp_enqueue_style(
			'owl.carousel-css',
			get_template_directory_uri() . '/css/owl.carousel.css',
			array(),'2.3.4'
		);

		wp_enqueue_style('vr-gaming-style', get_stylesheet_uri(), array() );

		wp_enqueue_style('dashicons');

		wp_style_add_data('vr-gaming-style', 'rtl', 'replace');

		wp_enqueue_style(
			'vr-gaming-media-css',
			get_template_directory_uri() . '/css/media.css',
			array(),'2.3.4'
		);

		wp_enqueue_style(
			'vr-gaming-woocommerce-css',
			get_template_directory_uri() . '/css/woocommerce.css',
			array(),'2.3.4'
		);

		wp_enqueue_script(
			'vr-gaming-navigation',
			get_template_directory_uri() . '/js/navigation.js',
			FALSE,
			'1.0',
			TRUE
		);

		wp_enqueue_script(
			'owl.carousel-js',
			get_template_directory_uri() . '/js/owl.carousel.js',
			array('jquery'),
			'2.3.4',
			TRUE
		);

		wp_enqueue_script(
			'vr-gaming-script',
			get_template_directory_uri() . '/js/script.js',
			array('jquery'),
			'1.0',
			TRUE
		);

		if ( get_theme_mod( 'vr_gaming_animation_enabled', true ) ) {
		        wp_enqueue_script(
		            'vr-gaming-wow-script',
		            get_template_directory_uri() . '/js/wow.js',
		            array( 'jquery' ),
		            '1.0',
		            true
		        );

		        wp_enqueue_style(
		            'vr-gaming-animate',
		            get_template_directory_uri() . '/css/animate.css',
		            array(),
		            '4.1.1'
		        );
		    }

		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

		$vr_gaming_css = '';

		if ( get_header_image() ) :

			$vr_gaming_css .=  '
				header#site-navigation, .page-template-frontpage #site-navigation{
					background-image: url('.esc_url(get_header_image()).');
					-webkit-background-size: cover !important;
					-moz-background-size: cover !important;
					-o-background-size: cover !important;
					background-size: cover !important;
				}';

		endif;

		wp_add_inline_style( 'vr-gaming-style', $vr_gaming_css );

		// Theme Customize CSS.
		require get_template_directory(). '/core/includes/inline.php';
		wp_add_inline_style( 'vr-gaming-style',$vr_gaming_custom_css );

	}

	add_action( 'wp_enqueue_scripts', 'vr_gaming_enqueue_scripts' );
}

/*-----------------------------------------------------------------------------------*/
/* Setup theme */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('vr_gaming_after_setup_theme')) {

	function vr_gaming_after_setup_theme() {

		load_theme_textdomain( 'vr-gaming', get_stylesheet_directory() . '/languages' );
		if ( ! isset( $vr_gaming_content_width ) ) $vr_gaming_content_width = 900;

		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main Menu', 'vr-gaming' ),
		));

		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'align-wide' );
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support( 'wp-block-styles' );
		add_theme_support('post-thumbnails');
		add_theme_support( 'custom-background', array(
		  'default-color' => 'f3f3f3'
		));

		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 70,
		) );

		add_theme_support( 'custom-header', array(
			'header-text' => false,
			'width' => 1920,
			'height' => 100
		));

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

		add_editor_style( array( '/css/editor-style.css' ) );

		add_action( 'wp_ajax_ive-check-plugin-exists', 'check_plugin_exists' );
		add_action( 'wp_ajax_ive_install_and_activate_plugin', 'mep_install_and_activate_plugin' );
	}

	add_action( 'after_setup_theme', 'vr_gaming_after_setup_theme', 999 );

}

function mep_install_and_activate_plugin() {

	$post_plugin_details = $_POST['plugin_details'];
	$plugin_text_domain = $post_plugin_details['plugin_text_domain'];
	$plugin_main_file		=	$post_plugin_details['plugin_main_file'];
	$plugin_url					=	$post_plugin_details['plugin_url'];

	$plugin = array(
		'text_domain'	=> $plugin_text_domain,
		'path' 				=> $plugin_url,
		'install' 		=> $plugin_text_domain . '/' . $plugin_main_file
	);

	wp_cache_flush();

	$plugin_path = plugin_basename( trim( $plugin['install'] ) );


	$activate_plugin = activate_plugin( $plugin_path );

	if($activate_plugin) {

		echo $activate_plugin;

	} else {
		echo $activate_plugin;
	}

	$msg = 'installed';

	$response = array( 'status' => true, 'msg' => $msg );
	wp_send_json( $response );
	exit;
}

function check_plugin_exists() {
		$plugin_text_domain = $_POST['plugin_text_domain'];
		$main_plugin_file 	= $_POST['main_plugin_file'];
		$plugin_path = $plugin_text_domain . '/' . $main_plugin_file;

		$get_plugins					= get_plugins();
		$is_plugin_installed	= false;
		$activation_status 		= false;
		if ( isset( $get_plugins[$plugin_path] ) ) {
		$is_plugin_installed = true;

		$activation_status = is_plugin_active( $plugin_path );
		}
		wp_send_json_success(
		array(
		'install_status'  =>	$is_plugin_installed,
			'active_status'		=>	$activation_status,
			'plugin_path'			=>	$plugin_path,
			'plugin_slug'			=>	$plugin_text_domain
		)
		);
}

function vr_gaming_template_setup() {

require get_template_directory() .'/core/includes/customizer-notice/vr-gaming-customizer-notify.php';
require get_template_directory() .'/core/includes/theme-breadcrumb.php';
require get_template_directory() .'/core/includes/tgm.php';
require get_template_directory() .'/core/includes/customizer.php';
require get_template_directory() .'/core/includes/main.php';

}
add_action('after_setup_theme', 'vr_gaming_template_setup');

load_template( trailingslashit( get_template_directory() ) . '/core/includes/class-upgrade-pro.php' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue theme logo style */
/*-----------------------------------------------------------------------------------*/
function vr_gaming_logo_resizer() {

    $vr_gaming_theme_logo_size_css = '';
    $vr_gaming_logo_resizer = get_theme_mod('vr_gaming_logo_resizer');

	$vr_gaming_theme_logo_size_css = '
		.custom-logo{
			height: '.esc_attr($vr_gaming_logo_resizer).'px !important;
			width: '.esc_attr($vr_gaming_logo_resizer).'px !important;
		}
	';
    wp_add_inline_style( 'vr-gaming-style',$vr_gaming_theme_logo_size_css );

}
add_action( 'wp_enqueue_scripts', 'vr_gaming_logo_resizer' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue Global color style */
/*-----------------------------------------------------------------------------------*/
function vr_gaming_global_color() {

    $vr_gaming_theme_color_css = '';
    $vr_gaming_copyright_bg = get_theme_mod('vr_gaming_copyright_bg');
    $vr_gaming_global_color_1 = get_theme_mod('vr_gaming_global_color_1');

	$vr_gaming_theme_color_css = '
    .copyright {
		background: '.esc_attr($vr_gaming_copyright_bg).';
	}
	p.slider-button a,.scroll-up a,.slider button.active span,#main-menu ul.children, #main-menu ul.sub-menu,.sidebar-area h4.title, .sidebar-area h1.wp-block-heading, .sidebar-area h2.wp-block-heading, .sidebar-area h3.wp-block-heading, .sidebar-area h4.wp-block-heading, .sidebar-area h5.wp-block-heading, .sidebar-area h6.wp-block-heading, .sidebar-area .wp-block-search__label,.searchform input[type=submit], .sidebar-area .wp-block-search__button,.comment-respond input#submit,.comment-reply a,.pagination .nav-links a:hover, .pagination .nav-links a:focus, .pagination .nav-links span.current, .vr-gaming-pagination span.current, .vr-gaming-pagination span.current:hover, .vr-gaming-pagination span.current:focus, .vr-gaming-pagination a span:hover, .vr-gaming-pagination a span:focus,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce a.added_to_cart,nav.woocommerce-MyAccount-navigation ul li,.sidebar-area .tagcloud a,.wp-block-woocommerce-cart .wc-block-cart__submit-button, .wc-block-components-checkout-place-order-button, .wc-block-components-totals-coupon__button,.triangle35b:nth-child(1),.triangle35b:nth-child(3) {
		background: '.esc_attr($vr_gaming_global_color_1).';
	}
	.product-details h4 a,h4.short-heading,#main-menu a:hover, #main-menu ul li a:hover, #main-menu li:hover > a, #main-menu a:focus, #main-menu ul li a:focus, #main-menu li.focus > a, #main-menu li:focus > a, #main-menu ul li.current-menu-item > a, #main-menu ul li.current_page_item > a, #main-menu ul li.current-menu-parent > a, #main-menu ul li.current_page_ancestor > a, #main-menu ul li.current-menu-ancestor > a,.bread_crumb span,.post-meta i,a:hover,.post-single a, .page-single a, .sidebar-area .textwidget a, .comment-content a, .woocommerce-product-details__short-description a, #tab-description a, .extra-home-content a,.bread_crumb a:hover,.woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price {
		color: '.esc_attr($vr_gaming_global_color_1).';
	}
	.slider button.owl-dot span{
		border-color: '.esc_attr($vr_gaming_global_color_1).';
	}
	@media screen and (min-width : 320px) and (max-width : 767px) {
		.page-template-frontpage #site-navigation,#site-navigation{
  			background: '.esc_attr($vr_gaming_global_color_1).';
  		}
	}
	@media (max-width: 782px) {
		.page-template-frontpage #site-navigation,#site-navigation{
  			background: '.esc_attr($vr_gaming_global_color_1).';
  		}
	}
	@media screen and (min-width: 1024px) and (max-width: 1199px) {
		.page-template-frontpage #site-navigation,#site-navigation{
  			background: '.esc_attr($vr_gaming_global_color_1).';
  		}
	}
	';
    wp_add_inline_style( 'vr-gaming-style',$vr_gaming_theme_color_css );
    wp_add_inline_style( 'vr-gaming-woocommerce-css',$vr_gaming_theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'vr_gaming_global_color' );

/*-----------------------------------------------------------------------------------*/
/* Get post comments */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('vr_gaming_comment')) :
    /**
     * Template for comments and pingbacks.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     */
    function vr_gaming_comment($comment, $args, $depth){

        if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) : ?>

            <li id="comment-<?php comment_ID(); ?>" <?php comment_class('media'); ?>>
            <div class="comment-body">
                <?php esc_html_e('Pingback:', 'vr-gaming');
                comment_author_link(); ?><?php edit_comment_link(__('Edit', 'vr-gaming'), '<span class="edit-link">', '</span>'); ?>
            </div>

        <?php else : ?>

        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body media mb-4">
                <a class="pull-left" href="#">
                    <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>
                </a>
                <div class="media-body">
                    <div class="media-body-wrap card">
                        <div class="card-header">
                            <h5 class="mt-0"><?php /* translators: %s: author */ printf('<cite class="fn">%s</cite>', get_comment_author_link() ); ?></h5>
                            <div class="comment-meta">
							    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							        <time datetime="<?php comment_time( 'c' ); ?>">
							            <?php printf(
							                esc_html__( '%1$s at %2$s', 'vr-gaming' ),
							                esc_html( get_comment_date() ), esc_html( get_comment_time() ) ); ?>
							        </time>
							    </a>
							    <?php
							    edit_comment_link(esc_html__( 'Edit', 'vr-gaming' ),'<span class="edit-link">','</span>');?>
							</div>
                        </div>

                        <?php if ('0' == $comment->comment_approved) : ?>
                            <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'vr-gaming'); ?></p>
                        <?php endif; ?>

                        <div class="comment-content card-block">
                            <?php comment_text(); ?>
                        </div>

                        <?php comment_reply_link(
                            array_merge(
                                $args, array(
                                    'add_below' => 'div-comment',
                                    'depth' => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before' => '<footer class="reply comment-reply card-footer">',
                                    'after' => '</footer><!-- .reply -->'
                                )
                            )
                        ); ?>
                    </div>
                </div>
            </article>

            <?php
        endif;
    }
endif; // ends check for vr_gaming_comment()

if (!function_exists('vr_gaming_widgets_init')) {

	function vr_gaming_widgets_init() {

		register_sidebar(array(

			'name' => esc_html__('Sidebar','vr-gaming'),
			'id'   => 'vr-gaming-sidebar',
			'description'   => esc_html__('This sidebar will be shown next to the content.', 'vr-gaming'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

		register_sidebar(array(

			'name' => esc_html__('Sidebar 2','vr-gaming'),
			'id'   => 'vr-gaming-sidebar-2',
			'description'   => esc_html__('This sidebar will be shown next to the content.', 'vr-gaming'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

		register_sidebar(array(

			'name' => esc_html__('Sidebar 3','vr-gaming'),
			'id'   => 'vr-gaming-sidebar-3',
			'description'   => esc_html__('This sidebar will be shown next to the content.', 'vr-gaming'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

		register_sidebar(array(

			'name' => esc_html__('Footer Sidebar','vr-gaming'),
			'id'   => 'vr-gaming-footer-sidebar',
			'description'   => esc_html__('This sidebar will be shown next at the bottom of your content.', 'vr-gaming'),
			'before_widget' => '<div id="%1$s" class="col-lg-3 col-md-3 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

	}

	add_action( 'widgets_init', 'vr_gaming_widgets_init' );

}

function vr_gaming_get_categories_select() {
	$teh_cats = get_categories();
	$results = array();
	$count = count($teh_cats);
	for ($i=0; $i < $count; $i++) {
	if (isset($teh_cats[$i]))
  		$results[$teh_cats[$i]->slug] = $teh_cats[$i]->name;
	else
  		$count++;
	}
	return $results;
}

function vr_gaming_sanitize_select( $input, $setting ) {
	// Ensure input is a slug
	$input = sanitize_key( $input );

	// Get list of choices from the control
	// associated with the setting
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it;
	// otherwise, return the default
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'vr_gaming_loop_columns');
if (!function_exists('vr_gaming_loop_columns')) {
	function vr_gaming_loop_columns() {
		$vr_gaming_columns = get_theme_mod( 'vr_gaming_per_columns', 3 );
		return $vr_gaming_columns;
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'vr_gaming_per_page', 20 );
function vr_gaming_per_page( $vr_gaming_cols ) {
  	$vr_gaming_cols = get_theme_mod( 'vr_gaming_product_per_page', 9 );
	return $vr_gaming_cols;
}

// Add filter to modify the number of related products
add_filter( 'woocommerce_output_related_products_args', 'vr_gaming_products_args' );
function vr_gaming_products_args( $args ) {
    $args['posts_per_page'] = get_theme_mod( 'custom_related_products_number', 6 );
    $args['columns'] = get_theme_mod( 'custom_related_products_number_per_row', 3 );
    return $args;
}

add_action('after_switch_theme', 'vr_gaming_setup_options');
function vr_gaming_setup_options () {
    update_option('dismissed-get_started', FALSE );
}

add_filter( 'woocommerce_prevent_automatic_wizard_redirect', '__return_true' );

//add animation class
if ( class_exists( 'WooCommerce' ) ) { 
	add_filter('post_class', function($vr_gaming, $class, $product_id) {
	    if( is_shop() || is_product_category() ){
	        
	        $vr_gaming = array_merge(['wow','zoomIn'], $vr_gaming);
	    }
	    return $vr_gaming;
	},10,3);
}

function get_page_id_by_title($pagename){

    $args = array(
        'post_type' => 'page',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'title' => $pagename
    );
    $query = new WP_Query( $args );

    $page_id = '1';
    if (isset($query->post->ID)) {
        $page_id = $query->post->ID;
    }

    return $page_id;
}

add_action( 'customize_register', 'vr_gaming_remove_setting', 20 );
function vr_gaming_remove_setting( $wp_customize ) {
    // Check if the setting or control exists before removing
    if ( $wp_customize->get_setting( 'header_textcolor' ) ) {
        $wp_customize->remove_setting( 'header_textcolor' );
    }

    if ( $wp_customize->get_control( 'header_textcolor' ) ) {
        $wp_customize->remove_control( 'header_textcolor' );
    }
}

// edit link option
if (!function_exists('vr_gaming_edit_link')) :

    function vr_gaming_edit_link($view = 'default')
    {
        global $post;
            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'vr-gaming'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link"><i class="fas fa-edit"></i>',
                '</span>'
            );

    }
endif;