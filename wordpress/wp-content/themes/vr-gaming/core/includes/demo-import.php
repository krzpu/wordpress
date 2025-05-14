<?php
if (isset($_GET['import-demo']) && $_GET['import-demo'] == true) {
    class VRGamingDemoImporter {

        public function vr_gaming_customizer_primary_menu() {
            // Create Primary Menu
            $vr_gaming_themename = 'VR Gaming'; // Define the theme name
            $vr_gaming_menuname = $vr_gaming_themename . 'Main Menus';
            $vr_gaming_bpmenulocation = 'main-menu';
            $vr_gaming_menu_exists = wp_get_nav_menu_object($vr_gaming_menuname);

            if (!$vr_gaming_menu_exists) {
                $vr_gaming_menu_id = wp_create_nav_menu($vr_gaming_menuname);

                wp_update_nav_menu_item($vr_gaming_menu_id, 0, array(
                    'menu-item-title' => __('Home', 'vr-gaming'),
                    'menu-item-classes' => 'home',
                    'menu-item-url' => home_url('/'),
                    'menu-item-status' => 'publish',
                ));

                wp_update_nav_menu_item($vr_gaming_menu_id, 0, array(
                    'menu-item-title' => __('Shop', 'vr-gaming'),
                    'menu-item-classes' => 'shop',
                    'menu-item-url' => get_permalink(get_page_id_by_title('Shop')),
                    'menu-item-status' => 'publish',
                ));

                wp_update_nav_menu_item($vr_gaming_menu_id, 0, array(
                    'menu-item-title' => __('Products', 'vr-gaming'),
                    'menu-item-classes' => 'products',
                    'menu-item-url' => get_permalink(get_page_id_by_title('Products')),
                    'menu-item-status' => 'publish',
                ));

                wp_update_nav_menu_item($vr_gaming_menu_id, 0, array(
                    'menu-item-title' => __('Blog', 'vr-gaming'),
                    'menu-item-classes' => 'blog',
                    'menu-item-url' => get_permalink(get_page_id_by_title('Blog')),
                    'menu-item-status' => 'publish',
                ));

                wp_update_nav_menu_item($vr_gaming_menu_id, 0, array(
                    'menu-item-title' => __('Page', 'vr-gaming'),
                    'menu-item-classes' => 'page',
                    'menu-item-url' => get_permalink(get_page_id_by_title('Page')),
                    'menu-item-status' => 'publish',
                ));

                if (!has_nav_menu($vr_gaming_bpmenulocation)) {
                    $locations = get_theme_mod('nav_menu_locations');
                    $locations[$vr_gaming_bpmenulocation] = $vr_gaming_menu_id;
                    set_theme_mod('nav_menu_locations', $locations);
                }
            }
        }

        public function setup_widgets() {

        $vr_gaming_home_id='';
        $vr_gaming_home_content = '';
        $vr_gaming_home_title = 'Home';
        $vr_gaming_home = array(
            'post_type' => 'page',
            'post_title' => $vr_gaming_home_title,
            'post_content' => $vr_gaming_home_content,
            'post_status' => 'publish',
            'post_author' => 1,
            'post_slug' => 'home'
        );
        $vr_gaming_home_id = wp_insert_post($vr_gaming_home);

        add_post_meta( $vr_gaming_home_id, '_wp_page_template', 'frontpage.php' );

        update_option( 'page_on_front', $vr_gaming_home_id );
        update_option( 'show_on_front', 'page' );

                        // Create a Posts Page
            $vr_gaming_blog_title = 'Shop';
            $vr_gaming_blog_check = get_page_id_by_title($vr_gaming_blog_title);

            if ($vr_gaming_blog_check == 1) {
                $vr_gaming_blog = array(
                    'post_type' => 'page',
                    'post_title' => $vr_gaming_blog_title,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_name' => 'shop',
                    'post_content' => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."',
                );
                $vr_gaming_blog_id = wp_insert_post($vr_gaming_blog);

                if (!is_wp_error($vr_gaming_blog_id)) {
                    // update_option('page_for_posts', $vr_gaming_blog_id);
                }
            }

                        // Create a Posts Page
            $vr_gaming_blog_title = 'Products';
            $vr_gaming_blog_check = get_page_id_by_title($vr_gaming_blog_title);

            if ($vr_gaming_blog_check  == 1) {
                $vr_gaming_blog = array(
                    'post_type' => 'page',
                    'post_title' => $vr_gaming_blog_title,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_name' => 'products',
                    'post_content' => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."',
                );
                $vr_gaming_blog_id = wp_insert_post($vr_gaming_blog);

                if (!is_wp_error($vr_gaming_blog_id)) {
                    // update_option('page_for_posts', $vr_gaming_blog_id);
                }
            }

                         // Create a Posts Page
            $vr_gaming_blog_title = 'Blog';
            $vr_gaming_blog_check = get_page_id_by_title($vr_gaming_blog_title);

            if ($vr_gaming_blog_check  == 1) {
                $vr_gaming_blog = array(
                    'post_type' => 'page',
                    'post_title' => $vr_gaming_blog_title,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_name' => 'blog',
                    'post_content' => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."',
                );
                $vr_gaming_blog_id = wp_insert_post($vr_gaming_blog);

                if (!is_wp_error($vr_gaming_blog_id)) {
                    // update_option('page_for_posts', $vr_gaming_blog_id);
                }
            }

                         // Create a Posts Page
            $vr_gaming_blog_title = 'Page';
            $vr_gaming_blog_check = get_page_id_by_title($vr_gaming_blog_title);

            if ($vr_gaming_blog_check  == 1) {
                $vr_gaming_blog = array(
                    'post_type' => 'page',
                    'post_title' => $vr_gaming_blog_title,
                    'post_status' => 'publish',
                    'post_author' => 1,
                    'post_name' => 'page',
                    'post_content' => '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."',
                );
                $vr_gaming_blog_id = wp_insert_post($vr_gaming_blog);

                if (!is_wp_error($vr_gaming_blog_id)) {
                    // update_option('page_for_posts', $vr_gaming_blog_id);
                }
            }

		//---Header--//

		set_theme_mod( 'vr_gaming_search_box_enable', true);

		//-----Slider-----//

		set_theme_mod( 'vr_gaming_blog_box_enable', true);

		set_theme_mod( 'vr_gaming_blog_slide_number', '3' );
		$vr_gaming_latest_post_category = wp_create_category('Slider Post');
			set_theme_mod( 'vr_gaming_blog_slide_category', 'Slider Post' ); 

		for($i=1; $i<=3; $i++) {

			$title =   'Now Get Your Awesome VR Here';
			$content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam';

			// Create post object
			$vr_gaming_my_post = array(
				'post_title'    => wp_strip_all_tags( $title ),
				'post_content'  => $content,
				'post_status'   => 'publish',
				'post_type'     => 'post',
				'post_category' => array($vr_gaming_latest_post_category) 
			);

			// Insert the post into the database
			$vr_gaming_post_id = wp_insert_post( $vr_gaming_my_post );

			$vr_gaming_image_url = get_template_directory_uri().'/assets/images/slider'.$i.'.png';

			$vr_gaming_image_name= 'slider'.$i.'.png';
			$vr_gaming_upload_dir       = wp_upload_dir(); 
			// Set upload folder
			$vr_gaming_image_data       = file_get_contents($vr_gaming_image_url); 
			 
			// Get image data
			$vr_gaming_unique_file_name = wp_unique_filename( $vr_gaming_upload_dir['path'], $vr_gaming_image_name ); 
			// Generate unique name
			$filename= basename( $vr_gaming_unique_file_name ); 
			// Create image file name
			// Check folder permission and define file location
			if( wp_mkdir_p( $vr_gaming_upload_dir['path'] ) ) {
				$file = $vr_gaming_upload_dir['path'] . '/' . $filename;
			} else {
				$file = $vr_gaming_upload_dir['basedir'] . '/' . $filename;
			}

			if ( ! function_exists( 'WP_Filesystem' ) ) {
                    require_once( ABSPATH . 'wp-admin/includes/file.php' );
                }
                
                WP_Filesystem();
                global $wp_filesystem;
                
                if ( ! $wp_filesystem->put_contents( $file, $vr_gaming_image_data, FS_CHMOD_FILE ) ) {
                    wp_die( 'Error saving file!' );
                }
			$vr_gaming_wp_filetype = wp_check_filetype( $filename, null );
			$vr_gaming_attachment = array(
				'post_mime_type' => $vr_gaming_wp_filetype['type'],
				'post_title'     => sanitize_file_name( $filename ),
				'post_content'   => '',
				'post_type'     => 'post',
				'post_status'    => 'inherit'
			);
			$vr_gaming_attach_id = wp_insert_attachment( $vr_gaming_attachment, $file, $vr_gaming_post_id );
			require_once(ABSPATH . 'wp-admin/includes/image.php');
			$vr_gaming_attach_data = wp_generate_attachment_metadata( $vr_gaming_attach_id, $file );
				wp_update_attachment_metadata( $vr_gaming_attach_id, $vr_gaming_attach_data );
				set_post_thumbnail( $vr_gaming_post_id, $vr_gaming_attach_id );
		}

		//-----Products-----//
		set_theme_mod( 'vr_gaming_products_section_enable', true);

		set_theme_mod( 'vr_gaming_products_short_heading', 'Awesome Product');

		set_theme_mod( 'vr_gaming_products_main_heading', 'Awesome Product That You Never Seen');

		set_theme_mod( 'vr_gaming_products_per_page', '8' );

	    wp_insert_term(
      		'awesome-product', // the term
      		'product_cat', // the taxonomy
      			array(
		          	'description'=> '',
		          	'slug' => 'awesome-product',
		          	'term_id'=>12,
		          	'term_taxonomy_id'=>34,
          		)
      		);

          	set_theme_mod( 'vr_gaming_products_category', 'Awesome Product' );
          	if ( class_exists( 'WooCommerce' ) ) {

				$featured_product=array('Gear VR Box', 'PlayStation VR Virtual Real...', 'Gear VR Virtual Reality hea...', 'Gear VR Oculus Rift Virtual...', 'Gear VR Box', 'PlayStation VR Virtual Real...', 'Gear VR Virtual Reality hea...', 'Gear VR Oculus Rift Virtual...');
	            for($i=1;$i<=8;$i++) {


	            $title =$featured_product[$i-1];
	            $content = 'Lorem Ipsum simply Te obtinuit ut adepto satis somno. Aliisque institoribus iter deliciae vivet vita. Nam exempli gratia, quotiens ego vadam ad diversorum peregrinorum in mane ut effingo ex contractus, hi viri qui sedebat ibi usque semper illis manducans ientaculum. Solum cum bulla ut debui; EGO youd adepto a macula proiciendi.';

	            // Create post object
	            $my_post = array(
		            'post_title'    => wp_strip_all_tags( $title ),
		            'post_content'  => $content,
		            'post_status'   => 'publish',
		            'post_type'     => 'product',
	            );

	            // Insert the post into the database
	            $post_id = wp_insert_post( $my_post );
	            // Gets term object from Tree in the database.
	            $term = get_term_by('name', 'awesome-product', 'product_cat');
	            wp_set_object_terms($post_id, $term->term_id, 'product_cat');

	            update_post_meta( $post_id, '_price', '$50' );
	            update_post_meta( $post_id, '_sale_price', "$50" );
	            update_post_meta( $post_id, '_regular_price', "$100" );

	            $image_url = get_template_directory_uri().'/assets/images/image'.$i.'.png';
	            $image_name= 'image'.$i.'.png';
	            $upload_dir       = wp_upload_dir();
	            // Set upload folder
	            $image_data= file_get_contents($image_url);
	            // Get image data
	            $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name );
	            // Generate unique name
	            $filename= basename( $unique_file_name );
	            // Create image file name

	            // Check folder permission and define file location
	            if( wp_mkdir_p( $upload_dir['path'] ) ) {
	            	$file = $upload_dir['path'] . '/' . $filename;
	            } else {
	           		$file = $upload_dir['basedir'] . '/' . $filename;
            }

            // Create the image  file on the server
            			if ( ! function_exists( 'WP_Filesystem' ) ) {
                    require_once( ABSPATH . 'wp-admin/includes/file.php' );
                }
                
                WP_Filesystem();
                global $wp_filesystem;
                
                if ( ! $wp_filesystem->put_contents( $file, $image_data, FS_CHMOD_FILE ) ) {
                    wp_die( 'Error saving file!' );
                }

            // Check image file type
            $wp_filetype = wp_check_filetype( $filename, null );

            // Set attachment data
            $attachment = array(
	            'post_mime_type' => $wp_filetype['type'],
	            'post_title'     => sanitize_file_name( $filename ),
	            'post_content'   => '',
	            'post_type'     => 'product',
	            'post_status'    => 'inherit'
            );
            // Create the attachment
            $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
            // Include image.php
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            // Define attachment metadata
            $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
            // Assign metadata to attachment
            wp_update_attachment_metadata( $attach_id, $attach_data );
            // And finally assign featured image to post
            set_post_thumbnail( $post_id, $attach_id );
          	}
        }
	    }
    }
	// Instantiate the class and call its methods
    $demo_importer = new VRGamingDemoImporter();
    $demo_importer->setup_widgets();
    $demo_importer->vr_gaming_customizer_primary_menu();
	}
?>