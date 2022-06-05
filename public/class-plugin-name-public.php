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
			$allWPYTPost = get_posts(array('post_type'=>'plugin-name-ytvids', 'numberposts' => 2500, 'order' => 'ASC'));

			//New var for more videos
			$numvids = count($allWPYTPost);//How many videos we have
			$eachSix = 0 ;//Start another 6 more videos
			$newGrid = 1;// Keeps track of grid's output to page
			$newFirst = true;//Tells us if first item in grid

			//check how many videos we have
			if($numvids <= 6){		
			?>
			<div class="grid-container">
			<?php
			//Loop through and list all posts
				foreach($allWPYTPost as $eachYTpost){
					?>
					<div class="grid-item">
						
						<p style="font-size:18px;"><?php  echo($eachYTpost -> yt_title); ?> </p>
						<p><?php  //echo($eachYTpost -> videoID -> videoId); ?> </p>
						<p><?php  //echo($eachYTpost -> publishedAt); ?> </p>
						<a target="_blank" href="<?php echo('http://localhost:8000/watch-vid/?vid='.$eachYTpost -> videoID -> videoId .'&oid='.$eachYTpost->ID ); ?>"><img src=" <?php echo($eachYTpost -> imageresmed);?>"/></a>
						
					</div>
					<?php
					
				}
			}
			else{
				?>
				<!-- Output JS -->
				<!--Load Jquery-->
				<script src="https://code.jquery.com/jquery-3.6.0.min.js"integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script>
				
				<script>
					var vidCount = 2;
					function showMoreVids(){
						try{
							$("#gridvid" +vidCount).fadeIn();
						}
						catch{

						}
						//increase counter
						vidCount = vidCount + 1;
					}
					
				</script>
	

				<?php
				//We have more than 6 videos
				foreach($allWPYTPost as $eachYTpost){
					//this is new set so create hidden container
					if($eachSix == 0){
						if($newFirst == true){
							//this is first grid output so show it
							echo('<div class="grid-container">');
							$newFirst = false;
						}
						else {
							echo('<div class="grid-container" style="display:none" id="gridvid'.$newGrid.'">');	
						}
					}

					//build grid as normal
					echo('<div class="grid-item">');
					echo('<p style="font-size:18px;">'.$eachYTpost -> yt_title.'</p>');
					echo('<a target="_blank" href="http://localhost:8000/watch-vid/?vid='.$eachYTpost -> videoID -> videoId .'&oid='.$eachYTpost->ID.'"><img src="'.$eachYTpost -> imageresmed.'"/></a>');
					echo('</div>');

					//update the eachsix
					$eachSix +=1;

					//check for eachsix equal to 6
					if($eachSix == 6){
						//Create new container
						echo('</div>');
						$eachSix = 0;
						$newGrid += 1;
					}
				}
				echo('</div>');
			}
			if($numvids <=6){
				//do nothing
			}
			else{
				echo('<br><center><button type="button" onclick = "showMoreVids()" class="btn btn-primary">Load more Videos</button></center>');
			}
			?> 
		<?php
	}

	public function baseplugindisplaybox(){
		//set vid ID
		$thevid = '';
		$thepostid='';
		

		//check for issset
		if (isset($_GET['vid'])){
			$thevid = $_GET['vid'];
			$thepostid =$_GET['oid'];
		}

		if ($thevid == ''){
			return '<pre><h1>No video to display</h1></pre>';
		}
		else{
			//display vidoe in box
			$thetitle=(get_post_meta($thepostid, 'yt_title',true));
			?>
				<!--Load Jquery-->
				<script src="https://code.jquery.com/jquery-3.6.0.min.js"integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script>
				
				<!-- Load subscribe Button -->
				<script src="https://apis.google.com/js/platform.js"></script>
				<pre><div class="g-ytsubscribe" data-channel="UC_x5XG1OV2P6uZZ5FSM9Ttw" data-layout="default" data-count="default"></div></pre>

				<script type="text/javascript">
					var theseconds = <?php echo get_option('adskipseconds'). '000'; ?>;
					jQuery(function($){
						//Set Ad Fade Out
						setTimeout(function(){
							$('#topvid').fadeIn();
						},15000);

						setTimeout(function(){
							$('#adunit').fadeOut();
							$('#advid').attr("src", "about:blank");
						},15100);

						setTimeout(function(){
							$('#skip').fadeIn();
						},theseconds);
					});

					//Skip Ad button
					function skipper(){
						$('#topvid').fadeIn();
						$('#adunit').fadeOut();
						$('#advid').attr("src", "about:blank");
					}

					</script>
				
			<?php
				//Ad Video variables
				$adVideoID = get_option('advideo');
				$adVideoTitle = get_option('adtitle');
				$adVideoBody = get_option('adbodytext');
				$adVideoButton = get_option('adbuttontext');

				//Ad Video
				$theplayer = '<div id="adunit">';
				$theplayer .='<h3>'.$adVideoTitle.'</h3>';
				$theplayer .= '<div class="grid-container" style="grid-template-columns: 2fr 1fr;">';
				$theplayer .= '<div class="grid-item">';
				$theplayer .= '<pre><iframe width="560" height="315" id="advid" src="https://www.youtube.com/embed/'.$adVideoID.'?autoplay=1&rel=0&mute=1&controls=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></pre>';
				$theplayer .= '</div>';
				$theplayer .= '<div class="grid-item">';
				$theplayer .= '<p>'.$adVideoBody.'</p>';
				$theplayer .= '<a href="#" target="_blank"><button type="button">'.$adVideoButton.'</button></a>';
				$theplayer .= '<br><br><br>';
				$theplayer .= '<button id="skip" type="button" onClick="skipper()" style="display:none;">Skip Ad</button>';
				$theplayer .= '</div>';
				$theplayer .= '</div>';
				$theplayer .= '</div>';

				//Main Video
				$theplayer .='<div id="topvid" style="display:none;">';
				$theplayer .= '<h3>'.$thetitle.'</h3>';
				$theplayer .= '<pre><iframe width="560" height="315" src="https://www.youtube.com/embed/'.($thevid).'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></pre>';
				$theplayer .='</div>';

				//Other Videos
				//Loop through and list all posts
			
				$theplayer .='<hr>';
				$theplayer .='<h4>Check out the most recent videos</h4>';
				
				$allWPYTPost = get_posts(array('post_type'=>'plugin-name-ytvids', 'numberposts' => 4, 'order' => 'ASC'));
				$theplayer .='<div class="grid-container">';

				$i =0;//Keeps track of videos output
					foreach($allWPYTPost as $eachYTpost){
						//check if video is current video
						if($eachYTpost -> ID == $thepostid){
							//Do nothing
						}
						else{
							if($i >= 3){ //If already 3 posts
								//do nothing
							}
							else{// Output all videos
								$theplayer .='<div class="grid-item">';
								$theplayer .='<p style="font-size:16px;">' .$eachYTpost -> yt_title.'</p>';
								$theplayer .='<a href="http://localhost:8000/watch-vid/?vid='.$eachYTpost -> videoID -> videoId .'&oid='.$eachYTpost->ID.'"><img src="'.$eachYTpost -> imageresmed.'"/></a>';
								$theplayer .='</div>';
								$i++;//Increase Vid Counter
							}
						}
					}
					
					$theplayer .='</div>';
			
			return $theplayer;
		}
	
	
	}

}