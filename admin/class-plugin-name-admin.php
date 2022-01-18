<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 * @author     Your Name <email@example.com>
 */
class Plugin_Name_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//default style loaded site wide
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/plugin-name-admin.css', array(), $this->version, 'all' );
		//wp_enqueue_style( 'bootstrap.css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//default script loaded site wide
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/plugin-name-admin.js', array( 'jquery' ), $this->version, false );
		//wp_enqueue_script( 'bootstarp.js', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add custom menu
	 *
	 * @since    1.0.0
	 */

	public function my_admin_menu(){
		//global
		
		//main menu
		$page_title='Base-Plugin Settings Page';
		$menu_title='Base-Plugin Settings';
		$capability='manage_options';
		$menu_slug='base-plugin/mainsettings.php';
		$function=array($this,'base_plugin_admin_page');
		$icon_url='dashicons-tickets';
		$position=250;

		//submenu 
		$sub_page_title='Sub Level Page Title';
		$sub_menu_title='Sub Level Menu Title';
		
		$sub_menu_slug='base-plugin/importer.php';
		$sub_function=array($this,'base_plugin_admin_sub_page');
		

		add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
		//add_menu_page( $page_title:string, $menu_title:string, $capability:string, $menu_slug:string, $function:callable, $icon_url:string, $position:integer|null );
		add_submenu_page( $menu_slug, $sub_page_title, $sub_menu_title, $capability, $sub_menu_slug, $sub_function);
		//add_submenu_page( $parent_slug:string, $page_title:string, $menu_title:string, $capability:string, $menu_slug:string, $function:callable, $position:integer|null )
	}


	public function enqueue_admin_css(){
		error_log('bs_enqueue_styles ran');
		error_log('style path is: ' . plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css');

		wp_enqueue_style( 'admin_bootstrap_css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
	}


	public function enqueue_admin_js(){
		wp_enqueue_script( 'admin_bootstarp_js', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
	}


	public function base_plugin_admin_page(){
		//return views
		require_once 'partials/plugin-name-admin-display.php';
	}

	public function base_plugin_admin_sub_page(){
		require_once 'partials/plugin-name-admin-submenu-display.php';
	}

	/**
	 * Register custom settings
	 *
	 * @since    1.0.0
	 */
	//Old Genral Settings 
	 public function register_base_plugin_general_settings(){
		 //register all settings for general settings

		 register_setting('baseplugincustomsettings','theemail');
		 register_setting('baseplugincustomsettings','thedays');
		 register_setting('baseplugincustomsettings','themultiselect');
	 }

	/**
	 * Register YouTube API Key settings
	 *
	 * @since    1.0.0
	 */
	 public function register_base_plugin_yt_settings(){
		register_setting( 'basepluginytsetting', 'youtubeAPIKey' );
		register_setting( 'basepluginytsetting', 'youtubeChannelID' );
	 }

	//this function creates CPT for videos
	public function custom_youtube_api(){
		/*
		*Create a function to create the CPT
		*/

		$labels = array(
			'name'                => _x( 'YouTube Videos', 'Post Type General Name'),
			'singular_name'       => _x( 'YouTube Video', 'Post Type Singular Name'),
			'menu_name'           => __( 'YouTube Video'),
			'parent_item_colon'   => __( 'Parent Video'),
			'all_items'           => __( 'All Videos'),
			'view_item'           => __( 'View Videos'),
			'add_new_item'        => __( 'Add New YouTube Video'),
			'add_new'             => __( 'Add New'),
			'edit_item'           => __( 'Edit'),
			'update_item'         => __( 'Update'),
			'search_items'        => __( 'Search'),
			'not_found'           => __( 'Not Found'),
			'not_found_in_trash'  => __( 'Not found in Trash'),
		);
		 
	// Set other options for Custom Post Type
		 
		$args = array(
			'label'               => __( 'plugin-name-vids'),
			'description'         => __( 'YouTube Videos from our Channel'),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( 'genres' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/ 
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => false,
			'show_in_menu'        => false,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => false,
			'has_archive'         => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest' => false,
	 
		);
		 
		// Registering your Custom Post Type
		register_post_type( 'plugin-name-ytvids', $args );
	}

}



	