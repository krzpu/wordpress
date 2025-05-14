<?php
/**
* Get started notice
*/
add_action( 'wp_ajax_vr_gaming_dismissed_notice_handler', 'vr_gaming_ajax_notice_handler' );

function vr_gaming_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function vr_gaming_deprecated_hook_admin_notice() {
    if ( ! get_option('dismissed-get_started', FALSE ) ) { ?>
        <?php
        require_once get_template_directory() .'/core/includes/demo-import.php';
        $current_screen = get_current_screen();
			if ($current_screen->id !== 'appearance_page_vr-gaming-guide-page') {
         $vr_gaming_comments_theme = wp_get_theme(); ?>
			<div class="demo-importer-loader">
				<div class="loader-setup-wizard">
					<h2><?php echo esc_html('Importing...','vr-gaming'); ?></h2>
				</div> 
			</div>
        <div class="vr-gaming-notice-wrapper updated notice notice-get-started-class is-dismissible" data-notice="get_started">
		<div class="vr-gaming-notice">
			<div class="vr-gaming-notice-img">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/admin-logo.png'); ?>" alt="<?php esc_attr_e('logo', 'vr-gaming'); ?>">
			</div>
			<div class="vr-gaming-notice-content">
				<div class="vr-gaming-notice-heading"><?php esc_html_e('Thanks for installing ','vr-gaming'); ?><?php echo esc_html( $vr_gaming_comments_theme ); ?> <?php esc_html_e('Theme','vr-gaming'); ?></div>
				<div class="diplay-flex-btn">
					<a class="button button-primary" href="<?php echo esc_url(admin_url('themes.php?page=vr-gaming-guide-page')); ?>"><?php echo esc_html__('More Option','vr-gaming'); ?></a>
					<?php if(isset($_GET['import-demo']) && $_GET['import-demo'] == true){ ?>
			    		<a class="button button-success" href="<?php echo esc_url(home_url()); ?>" target="_blank"><?php echo esc_html__('Go to Homepage','vr-gaming'); ?></a> <span class="imp-success"><?php echo esc_html__('Imported Successfully','vr-gaming'); ?></span>
			    	<?php } else { ?>
					<form id="demo-importer-form" action="<?php echo esc_url(home_url()); ?>/wp-admin/themes.phps" method="POST">
			        	<input  type="submit" name="submit" value="<?php esc_attr_e('Demo Import','vr-gaming'); ?>" class="button button-primary">
			    	</form>
			    	<?php } ?>
				</div>
			</div>
		</div>
	</div>
    <?php }
	}
}
add_action( 'admin_notices', 'vr_gaming_deprecated_hook_admin_notice' );

add_action( 'admin_menu', 'vr_gaming_getting_started' );
function vr_gaming_getting_started() {
	add_theme_page( esc_html__('Get Started', 'vr-gaming'), esc_html__('Get Started', 'vr-gaming'), 'edit_theme_options', 'vr-gaming-guide-page', 'vr_gaming_test_guide');	
}

function vr_gaming_admin_enqueue_scripts() {
	wp_enqueue_style( 'vr-gaming-admin-style', esc_url( get_template_directory_uri() ).'/css/main.css' );
	wp_enqueue_script( 'vr-gaming-admin-script', get_template_directory_uri() . '/js/vr-gaming-admin-script.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'vr-gaming-demo-script', get_template_directory_uri() . '/js/demo-script.js', array( 'jquery' ), '', true );
	wp_localize_script( 'vr-gaming-demo-script', 'vr_gaming_demo_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
}
add_action( 'admin_enqueue_scripts', 'vr_gaming_admin_enqueue_scripts' );


if ( ! defined( 'VR_GAMING_DOCS_FREE' ) ) {
define('VR_GAMING_DOCS_FREE',__('https://demo.misbahwp.com/docs/vr-gaming-free-docs/','vr-gaming'));
}
 if ( ! defined( 'VR_GAMING_DOCS_PRO' ) ) {
define('VR_GAMING_DOCS_PRO',__('https://demo.misbahwp.com/docs/vr-gaming-pro-docs/','vr-gaming'));
}
if ( ! defined( 'VR_GAMING_BUY_NOW' ) ) {
define('VR_GAMING_BUY_NOW',__('https://www.misbahwp.com/products/vr-gaming-wordpress-theme','vr-gaming'));
}
if ( ! defined( 'VR_GAMING_SUPPORT_FREE' ) ) {
define('VR_GAMING_SUPPORT_FREE',__('https://wordpress.org/support/theme/vr-gaming','vr-gaming'));
}
if ( ! defined( 'VR_GAMING_REVIEW_FREE' ) ) {
define('VR_GAMING_REVIEW_FREE',__('https://wordpress.org/support/theme/vr-gaming/reviews/#new-post','vr-gaming'));
}
if ( ! defined( 'VR_GAMING_DEMO_PRO' ) ) {
define('VR_GAMING_DEMO_PRO',__('https://demo.misbahwp.com/vr-gaming/','vr-gaming'));
}
if( ! defined( 'VR_GAMING_THEME_BUNDLE' ) ) {
define('VR_GAMING_THEME_BUNDLE',__('https://www.misbahwp.com/products/wordpress-bundle','vr-gaming'));
}

function vr_gaming_test_guide() { 
	$vr_gaming_theme = wp_get_theme();
	require_once get_template_directory() .'/core/includes/demo-import.php';
	?>
	<div class="wrap" id="main-page">
		<div id="lefty">
			<div id="admin_links">
				<a href="<?php echo esc_url( VR_GAMING_DOCS_FREE ); ?>" target="_blank" class="blue-button-1"><?php esc_html_e( 'Documentation', 'vr-gaming' ) ?></a>
				<a href="<?php echo esc_url( admin_url('customize.php') ); ?>" id="customizer" target="_blank"><?php esc_html_e( 'Customize', 'vr-gaming' ); ?> </a>
				<a class="blue-button-1" href="<?php echo esc_url( VR_GAMING_SUPPORT_FREE ); ?>" target="_blank" class="btn3"><?php esc_html_e( 'Support', 'vr-gaming' ) ?></a>
				<a class="blue-button-2" href="<?php echo esc_url( VR_GAMING_REVIEW_FREE ); ?>" target="_blank" class="btn4"><?php esc_html_e( 'Review', 'vr-gaming' ) ?></a>
			</div>
			<div id="description">
				<h3><?php esc_html_e('Welcome! Thank you for choosing ','vr-gaming'); ?><?php echo esc_html( $vr_gaming_theme ); ?>  <span><?php esc_html_e('Version: ', 'vr-gaming'); ?><?php echo esc_html($vr_gaming_theme['Version']);?></span></h3>
				<div class="demo-import-box">
					<div class="demo-importer-loader">
						<div class="loader-setup-wizard">
							<h2><?php echo esc_html('Importing...','vr-gaming'); ?></h2>
						</div> 
					</div>
					<h4><?php echo esc_html__('Import homepage demo in just one click.','vr-gaming'); ?></h4>
					<?php if(isset($_GET['import-demo']) && $_GET['import-demo'] == true){ ?>
			    		<span class="imp-success"><?php echo esc_html__('Imported Successfully','vr-gaming'); ?></span>  <a class="button button-success" href="<?php echo esc_url(home_url()); ?>" target="_blank"><?php echo esc_html__('Go to Homepage','vr-gaming'); ?></a>
			    	<?php } else { ?>
					<form id="demo-importer-form" action="<?php echo esc_url(home_url()); ?>/wp-admin/themes.phps" method="POST">
			        	<input  type="submit" name="submit" value="<?php esc_attr_e('Demo Import','vr-gaming'); ?>" class="button button-primary">
			    	</form>
			    	<?php } ?>
				</div>
				<img class="img_responsive" style="width: 100%;" src="<?php echo esc_url( $vr_gaming_theme->get_screenshot() ); ?>" />
				<div id="description-insidee">
					<?php
						$vr_gaming_theme = wp_get_theme();
						echo wp_kses_post( apply_filters( 'misbah_theme_description', esc_html( $vr_gaming_theme->get( 'Description' ) ) ) );
					?>
				</div>
			</div>
		</div>

		<div id="righty">
			<div class="volleyball-postboxx">
				<h3 class="hndle"><?php esc_html_e( 'Upgrade to Premium', 'vr-gaming' ); ?></h3>
				<div class="volleyball-insidee">
					<p><?php esc_html_e('Discover upgraded pro features with premium version click to upgrade.','vr-gaming'); ?></p>
					<div id="admin_pro_links">
						<a class="blue-button-2" href="<?php echo esc_url( VR_GAMING_BUY_NOW ); ?>" target="_blank"><?php esc_html_e( 'Go Pro', 'vr-gaming' ); ?></a>
						<a class="blue-button-1" href="<?php echo esc_url( VR_GAMING_DEMO_PRO ); ?>" target="_blank"><?php esc_html_e( 'Live Demo', 'vr-gaming' ) ?></a>
						<a class="blue-button-2" href="<?php echo esc_url( VR_GAMING_DOCS_PRO ); ?>" target="_blank"><?php esc_html_e( 'Pro Docs', 'vr-gaming' ) ?></a>
					</div>
				</div>

				<h3 class="hndle bundle"><?php esc_html_e( 'Go For Theme Bundle', 'vr-gaming' ); ?></h3>
				<div class="insidee theme-bundle">
					<p class="offer"><?php esc_html_e('Get 80+ Perfect WordPress Theme In A Single Package at just $89."','vr-gaming'); ?></p>
					<p class="coupon"><?php esc_html_e('Get Our Theme Pack of 80+ WordPress Themes At 15% Off','vr-gaming'); ?><span class="coupon-code"><?php esc_html_e('"Bundleup15"','vr-gaming'); ?></span></p>
					<div id="admin_pro_linkss">
						<a class="blue-button-1" href="<?php echo esc_url( VR_GAMING_THEME_BUNDLE ); ?>" target="_blank"><?php esc_html_e( 'Theme Bundle', 'vr-gaming' ) ?></a>
					</div>
				</div>
				<div class="d-table">
			    <ul class="d-column">
			      <li class="feature"><?php esc_html_e('Features','vr-gaming'); ?></li>
			      <li class="free"><?php esc_html_e('Pro','vr-gaming'); ?></li>
			      <li class="plus"><?php esc_html_e('Free','vr-gaming'); ?></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('24hrs Priority Support','vr-gaming'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('LearnPress Campatiblity','vr-gaming'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Kirki Framework','vr-gaming'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Posttype','vr-gaming'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('One Click Demo Import','vr-gaming'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Section Reordering','vr-gaming'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Enable / Disable Option','vr-gaming'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Multiple Sections','vr-gaming'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Color Pallete','vr-gaming'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Widgets','vr-gaming'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-yes"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Page Templates','vr-gaming'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Advance Typography','vr-gaming'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
			    <ul class="d-row">
			      <li class="points"><?php esc_html_e('Section Background Image / Color ','vr-gaming'); ?></li>
			      <li class="right"><span class="dashicons dashicons-yes"></span></li>
			      <li class="wrong"><span class="dashicons dashicons-no"></span></li>
			    </ul>
	  		</div>
			</div>
		</div>
	</div>
<?php } ?>