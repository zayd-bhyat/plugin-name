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
<div class="container" style="max-width:100%;">
  <div class="row">
    <div class="col">
      <div class="alert alert-warning">
        <h1 class="display-4">YouTube API Importer</h1>
        <p class="lead">Use this section to save your API key and channel ID for video imports.</p>
        <hr class="my-4">
        <p>Need a YouTube Key generated? They're free! Get one here.</p>
        <form method="post" action="options.php">
        <?php
        settings_fields( 'basepluginytsetting' );
        do_settings_sections( 'basepluginytsetting' )
        ?>
        <div class="form-group">
          <label for="youtubeAPIKey">YouTube API Key</label>
          <input name="youtubeAPIKey" value="<?php echo get_option( 'youtubeAPIKey' ); ?>" type="text" class="form-control" id="youtubeapikey" placeholder="Your YouTube API Key">
        </div>
        <div class="form-group">
          <label for="youtubeChannelID">Your YouTube Channel ID:</label>
          <input type="text" name="youtubeChannelID" value="<?php echo get_option( 'youtubeChannelID' ); ?>" class="form-control" id="youtubeChannelID" placeholder="YouTube Channel ID">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>

<?php
//Store key to Variables
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
  ?>

  <div>
    <h1><?php echo $item->snippet->title;?></h1>
    <h3><?php echo $item->snippet->description;?></h3>
    <img src="<?php echo $item->snippet->thumbnails->medium->url;?>">
  </div>
  </br>
  </br>
<?php
}
?>