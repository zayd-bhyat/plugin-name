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
?>

<h1>General Settings for YouTube Test</h1><br><hr>
<?php
//Store key to Variables
/*
$theyoutubekey = get_option('youtubeAPIKey');
$thechannelid = get_option( 'youtubeChannelID');
$arrContextOptions=array(
  "ssl"=>array(
      "verify_peer"=>false,
      "verify_peer_name"=>false,
  ),
);
//Retrieve list of videos
//$videoList = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$thechannelid.'&maxResults='.'1'.'&key='.$theyoutubekey.'', false, stream_context_create($arrContextOptions)));

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
  echo('<img src="'. get_post_meta( $thenewpostID, 'imageresmed',true ).'"/>');
?>
  <img src ="<?php get_post_meta($thenewpostID, 'imageresmed',true); ?>"/>
<?php
 }
?>


  <!-- Loop videos and add to CPT -->

  <!--<div>
    <h1>// echo $item->snippet->title;?></h1>
    <h3>// echo $item->snippet->description;?></h3>
    <img src="// echo $item->snippet->thumbnails->medium->url;?>">
  </div>
  </br>
  </br>-->
  <?php} */

  
  ?>