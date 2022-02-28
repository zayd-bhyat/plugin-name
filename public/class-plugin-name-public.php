<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public
 * @author     Your Name <email@example.com>
 */
class Plugin_Name_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/plugin-name-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/plugin-name-public.js', array( 'jquery' ), $this->version, false );
	}

	//first hellow world shortcode
	public function hello_world() {
		//get the general settings options
		$userdays = get_option('thedays' );
		$multi = get_option( 'themultiselect' );
		$email = get_option('theeamil');
		

		//different message based on day
		if($userdays == '1'){
			return 'Day Number: ' .$userdays. ' Multiselect Day: ' .get_option( 'themultiselect' );
		}elseif($userdays == '2'){
			return 'Day Number: ' .$userdays. ' Multiselect Day: ' .get_option( 'themultiselect' );
		}
		elseif($userdays == '3'){
			return 'Day Number: ' .$userdays. ' Multiselect Day: ' .get_option( 'themultiselect' );
		}
		elseif($userdays == '4'){
			return 'Day Number: ' .$userdays. ' Multiselect Day: ' .get_option( 'themultiselect' );
		}
		elseif($userdays == '5'){
			return 'Day Number: ' .$userdays. ' Multiselect Day: ' .get_option( 'themultiselect' );
		}
		else{
			return 'There was an error please check settings';
		}
	}

	//output video shortcode function
	public function basepluginytshortcode() {
		
			//delete all videos of CPT
		
			//get all the posts
			$postcount = (get_option('ypostcount'));
			$allWPYTPost = get_posts(array('post_type'=>'plugin-name-ytvids', 'numberposts' => $postcount));
			?>
			<div class="grid-container">
			<?php
			//Loop through and de;ete all posts
			foreach($allWPYTPost as $eachYTpost){
				?>
				<div class="grid-item">
					<p style="font-size:18px;"><?php  echo($eachYTpost -> yt_title); ?> </p>
					<p><?php  //echo($eachYTpost -> videoID -> videoId); ?> </p>
					<p><?php  //echo($eachYTpost -> publishedAt); ?> </p>
					<a target="_blank" href="<?php echo('http://localhost:8000/watch-vid/?vid='.$eachYTpost -> videoID -> videoId); ?>"><img src=" <?php echo($eachYTpost -> imageresmed);?>"/></a>
				</div>
				<?php
			}
		?> 
		</div>
		<?php
	}
}