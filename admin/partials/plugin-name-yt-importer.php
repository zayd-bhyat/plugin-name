<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin/partials
 */

//get the current page
 $thecurrentpage = $_GET['page'];

?>
<!--Styles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!--/Styles -->

<h1>General Settings for YouTube Test</h1><br><hr>
<div class="container" style="width:100%; text-align:center;">
  <div class="row alert-primary">
    <div class="col-sm">
      <h4>Click to import YouTube videos from channel</h4>
      <form method="get" action="">
        <input type="hidden" value="<?php echo($thecurrentpage); ?>" name="page"/>
        <input type="hidden" value="import" name="action"/>
        <button type="submit" class="btn btn-success btn-lg">Import</button>
      </form> 
    </div>
    <div class="col-sm">
      <h4>Renew/Update YouTube Videos</h4>
      <form method="get" action="">
        <input type="hidden" value="<?php echo($thecurrentpage); ?>" name="page"/>
        <input type="hidden" value="renew" name="action"/>
        <button type="submit" class="btn btn-warning btn-lg">Renew</button>
      </form>
    </div>
    <div class="col-sm">
      <h4>Delete All YouTube Videos</h4>
      <form>
        <input type="hidden" value="<?php echo($thecurrentpage); ?>" name="page"/>
        <input type="hidden" value="delete" name="action"/>
        <button type="submit" class="btn btn-danger btn-lg">Delete All</button>
      </form>
    </div>
  </div>
</div>
<?php

  //Store key to Variables
  //the action
  $theaction = '';
  
  //Bool for user import
  $blnImport = false;//Determine if user imported
  $blnDelete = false;//Detemine if user deleted
  //get the action

  if (isset($_GET['action'])){
    $theaction= $_GET['action'];
  }
  
  //=======================
  //=======================
  //Import Action start

  
  if($theaction == 'import'){

  $theyoutubekey = get_option('youtubeAPIKey');
  $thechannelid = get_option( 'youtubeChannelID');
  $arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
  );
  //Retrieve list of videos
  $videoList = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$thechannelid.'&maxResults='.'5'.'&key='.$theyoutubekey.'', false, stream_context_create($arrContextOptions)));

  //Sorth through items and output
  foreach($videoList->items as $item){
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
    $blnImport = true;
    ?>
      <img src ="<?php //get_post_meta($thenewpostID, 'imageresmed',true); ?>"/>
    <?php
    }//endif capture post
    ?>


    <!-- Loop videos and add to CPT -->

    <div>
      <h1><?php //echo $item->snippet->title;?></h1>
      <h3><?php //echo $item->snippet->description;?></h3>
      <img src="<?php // echo $item->snippet->thumbnails->medium->url;?>">
    </div>
    </br>
    </br
    <?php }//end for each

  }//end import if
  //end import
  //=======================
  //=======================

  //=======================
  //=======================
  //Delete Action start
  if($theaction == 'delete'){
    //delete all videos of CPT

    //get all the posts
    $allWPYTPost = get_posts(array('post_type'=>'plugin-name-ytvids'));
    //Loop through and de;ete all posts
    foreach($allWPYTPost as $eachYTpost){
      wp_delete_post($eachYTpost ->ID, true);
      $blnDelete = true;
    }
  }
  
  //Delete Action end
  //=======================
  //=======================
  
  //output results
  if($blnImport == true){
    ?>

    <br><br>
    <div class="alert alert-success" style="max-width:100%;">
      <h2>You have scuccessfully imported the Videos</h2>
    </div>
<?php
  }
  elseif($blnDelete == true){
  ?>
    <br><br>
    <div class="alert alert-danger" style="max-width:100%;">
      <h2>You have scuccessfully deleted the Videos</h2>
    </div>
  <?php
  }
  ?>