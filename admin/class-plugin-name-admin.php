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
		
		//main menu variables
		$page_title='Base-Plugin Settings Page';
		$menu_title='Base-Plugin Settings';
		$capability='manage_options';
		$menu_slug='base-plugin/mainsettings.php';
		$function=array($this,'base_plugin_admin_page');
		$icon_url='dashicons-tickets';
		$position=250;

		//submenu variables
		$sub_page_title='Sub Level Page Title';
		$sub_menu_title='Sub Level Menu Title';
		
		$sub_menu_slug='base-plugin/importer.php';
		$sub_function=array($this,'base_plugin_admin_sub_page');

		$sub_bl=array( $this ,'base_plugin_blank_page');


		

		add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
		//add_menu_page( $page_title:string, $menu_title:string, $capability:string, $menu_slug:string, $function:callable, $icon_url:string, $position:integer|null );
		add_submenu_page( $menu_slug, $sub_page_title, $sub_menu_title, $capability, $sub_menu_slug, $sub_function);
		//add_submenu_page( $parent_slug:string, $page_title:string, $menu_title:string, $capability:string, $menu_slug:string, $function:callable, $position:integer|null )
		
		//blank page menu
		add_submenu_page($menu_slug,'Base-Plugin Blank page','Base-Plugin Blank page','manage_options','base-plugin/blank-page.php', $sub_bl);

		//importer menu
		add_submenu_page($menu_slug,'Base-Plugin Youtube Importer','Base-Plugin Youtube Importer','manage_options','base-plugin/yt-importer.php', array($this,'base_plugin_yt_importer_page'));

	}


	public function enqueue_admin_css(){
		//error_log('bs_enqueue_styles ran');
		//error_log('style path is: ' . plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css');

		//wp_enqueue_style( 'admin_bootstrap_css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
	}


	public function enqueue_admin_js(){
		//wp_enqueue_script( 'admin_bootstarp_js', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
	}


	public function base_plugin_admin_page(){
		//return views
		require_once 'partials/plugin-name-admin-display.php';
	}

	public function base_plugin_admin_sub_page(){
		require_once 'partials/plugin-name-admin-submenu-display.php';
	}

	public function base_plugin_blank_page(){
		require_once 'partials/plugin-name-second-sub-page.php';
	}

	public function base_plugin_yt_importer_page(){
		require_once 'partials/plugin-name-yt-importer.php';
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

	 public function register_base_plugin_shortcode_settings(){
		register_setting( 'basepluginshortcodesettings', 'ypostcount' );
		register_setting( 'basepluginshortcodesettings', 'ytvidstyletype' );
	 }

	/**
	 * Register Advertiser settings
	 *
	 * @since    1.0.0
	 */
	 public function register_base_plugin_advertiser_settings(){
		register_setting( 'basepluginadsettings', 'advideo' );
		register_setting( 'basepluginadsettings', 'adtitle' );
		register_setting( 'basepluginadsettings', 'adbodytext' );
		register_setting( 'basepluginadsettings', 'adbuttontext' );
		register_setting( 'basepluginadsettings', 'adskipseconds' );
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
		//changes made
		register_post_type( 'plugin-name-ytvids', $args );
	}

	public function ytvidupdate(){
		//Get all the video posts
		$allWPYTPost = get_posts(array('post_type'=>'plugin-name-ytvids', 'numberposts' => 2500, 'order' => 'ASC'));
		$compvids = '';
		
		//Check if there are videos to update
		if (count($allWPYTPost) ==0 ){
			//echo('<h2>There are no videos please click import first</h2>');
		}
		
		else{

			//There are videos cycle through videos
			foreach($allWPYTPost as $YTPost){
			
				if($YTPost -> videoID -> videoId == ''){
					//This is not a vdeo
				} 
				else{
					//This is a video
					$compvids = ',' .$compvids .$YTPost -> videoID -> videoId . ',';
				}
			}//end foreach

			//echo($compvids);//List Video ID string
			//Call new videos and compare

			$theyoutubekey = get_option('youtubeAPIKey');
			$thechannelid = get_option( 'youtubeChannelID');
			$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
			);
			//Retrieve list of videos
			$videoList = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$thechannelid.'&maxResults='.'6'.'&key='.$theyoutubekey.'', false, stream_context_create($arrContextOptions)));

			//Sort through and add new videos
			foreach($videoList -> items as $item){
			//check if we have video
			$videoexists = strpos($compvids, $item->id->videoId);

			//check to see if video exists
			if($videoexists > 0){
				//found
				//echo('found'.$videoexists.'<br>');//Print Video ID
			}

			else{
				
				//add video because not found
				$yt_title=$item->snippet->title;
				$yt_description=$item->snippet->description;
				//insert a new post video to CPT
				$data=array(
				'post_title' =>  wp_strip_all_tags($yt_title),
				'post_description' => wp_strip_all_tags($yt_description),
				'post_category' => array('uncategorized'),
				'tags_input' => array(1),
				'post_status' => 'publish',
				'post_type' => 'plugin-name-ytvids'
				);

				//insert this post into the DB and retrive the ID
				$result = wp_insert_post($data);

				//capture ID of post
				if($result && ! is_wp_error($result)){
					$thenewpostID = $result;

					//add YT meta data
					add_post_meta($thenewpostID,'videoID',$item->id);
					add_post_meta($thenewpostID,'publishedAt',$item->snippet->publishedAt);
					add_post_meta($thenewpostID,'channelId',$item->snippet->channelId);
					add_post_meta($thenewpostID,'yt_title',$item->snippet->title);
					add_post_meta($thenewpostID,'yt_description',$item->snippet->description);
					add_post_meta( $thenewpostID, 'imageresmed', $item->snippet->thumbnails->medium->url);
					add_post_meta( $thenewpostID, 'imagereshigh', $item->snippet->thumbnails->high->url);
					//echo('<img src="'. get_post_meta( $thenewpostID, 'imageresmed',true ).'"/>');
					
					//Set Import True
					//$blnRenew = true;
				}
			}
		}
		}	

	}

}



	