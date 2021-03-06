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

  //User message system output
  $strStatusMessage = '';

  //check to see if we need to add a channelID post
  if(isset($_GET['newchannelid'])){
    if($_GET['newchannelid'] != ''){
      //add the new channel ID
      //insert a new post video to CPT
      $yt_channelid = $_GET['newchannelid'];
      $yt_channelname = 'new channel post';
      $data=array(
        'post_title' =>  wp_strip_all_tags($yt_channelid),
        'post_content' => wp_strip_all_tags($yt_channelname),
        'post_status' => 'publish',
        'post_type' => 'yt-channel-id'
      );
      //insert this post into the DB
      $result = wp_insert_post($data);
    }
  }

  //check to see if channel ID is going to be deleted
  if(isset($_GET['existingchannelids'])){
    if(($_GET['existingchannelids']!=='')){
      //remove the channel
      $strDeletionChannel = explode(' ^?/^ ', $_GET['existingchannelids']);

      //delete the post channel id item
      wp_delete_post($strDeletionChannel[1], true);

      //set the status message
      $strStatusMessage = '<div class="alert alert-danger">You deleted this channel from the database! Would you like to remove the videos with this channel ID?<a href="'.$strDeletionChannel[0].'">Remove Videos</a></div>';
    }
  }



    if(isset($_GET['newchannelid'])){
      if($_GET['newchannelid'] != ''){
        $strStatusMessage = '<div class="alert alert-success">You have added a new channled! Would you like to import vidoes from this new channel? <a href="/wp-admin/admin.php?page=base-plugin%2Fyt-importer.php&action=import">Yes, Please</a></div>';
      }
    }
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<style>

.accordion-body{
  padding: 0;
}

#ytAPI .accordion-button:not(.collapsed){
  background-color:#FFF3CD;
}
#adSettings .accordion-button:not(.collapsed){
  background-color:#CFE2FF;
}

#scSettings .accordion-button:not(.collapsed){
  background-color:#D1E7DD;
}
</style>

<div class="container" style="max-width:100%;">
  <?php
    //check if there is a status messge
    if ($strStatusMessage !== ''){    
      echo($strStatusMessage);
    } 
  ?>
  <h1>General Settings for Base Plugin Youtube</h1>
  <br>
  <hr>
  <!--<div class="row">
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
        </div><br>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>

      <div class="alert alert-primary">
        <h1 class="display-4">Advertiser settings</h1>
        <h3 class="">Setup the advertiser settings</h3>
        <hr>
        <form method="post" action="options.php">
          <?php
          settings_fields( 'basepluginadsettings' );
          do_settings_sections( 'basepluginadsettings' )
          ?>
          <div class="form-group">
              <label for="adskipseconds">Skip AD after X number of seconds</label>
              <input name="adskipseconds" type="number" value=<?php echo get_option('adskipseconds');?> class="form-control" id="adskipseconds">
          </div>
          <div class="form-group">
              <label for="advideo">Advertiser YouTube ID</label>
              <input type="text" name="advideo" value="<?php echo get_option( 'advideo' ); ?>" class="form-control" id="advideo" placeholder="example: pfwGRkG1Xwc"> 
          </div>
          <div class="form-group">         
              <label for="advideo">AD Title</label>
              <input type="text" name="adtitle" value="<?php echo get_option( 'adtitle' ); ?>" class="form-control" id="adtitle" placeholder=""> 
          </div>
          <div class="form-group">         
              <label for="advideo">AD Body Text</label>
              <input type="text" name="adbodytext" value="<?php echo get_option( 'adbodytext' ); ?>" class="form-control" id="adbodytext" placeholder=""> 
          </div>
          <div class="form-group">         
              <label for="advideo">Ad Button Text</label>
              <input type="text" name="adbuttontext" value="<?php echo get_option( 'adbuttontext' ); ?>" class="form-control" id="adbuttontext" placeholder=""> 
          </div>
          <br>
          <div class="form-group">
              <button type="submit" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Save Advertiser Settings</button>
          </div>
        </form>
      </div>
    </div>

    <div class="col">
      <div class="alert alert-success">
        <h1 class="display-4">ShortCode Information</h1>
        <h3 class="">To Output Videos simply use this shortcode: "[base-plugin-yt]"</h3>
        <hr>
        <form method="post" action="options.php">
          <?php
          settings_fields( 'basepluginshortcodesettings' );
          do_settings_sections( 'basepluginshortcodesettings' )
          ?>
          <div class="form-group">
              <label for="ypostcount">Number of Videos to show</label>
              <input name="ypostcount" type="number" value=<?php echo get_option('ypostcount');?> class="form-control" id="ypostcount">
          </div>
          <div class="form-group">         
              <label for="ytvidstyletype">Display Style</label>
              <select class="form-control" min="1" max="5" name="ytvidstyletype" id="ytvidstyletype">
                <option <?php if (get_option ('ytvidstyletype') == 'Image Left'){echo( 'selected');} ?>>Image Left</option>
                <option <?php if (get_option ('ytvidstyletype') == 'Image Center'){echo( 'selected');} ?>>Image Center</option>
                <option <?php if (get_option ('ytvidstyletype') == 'Image Right'){echo( 'selected');} ?>>Image Right</option>
              </select>
          </div>
          <br>
          <div class="form-group">
              <button type="submit" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Save Shortcode Changes</button>
          </div>
      </form>
    </div>
  </div> --> <!-- End Row -->

  <div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="ytAPI">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
        <h1 class="display-4">YouTube API Importer</h1>
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <div class="alert alert-warning">
        <!--<h1 class="display-4">YouTube API Importer</h1>-->
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
        </div><br>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
        <br>
        <hr>
        <br>
        <p style="font-size:20px;">Enter new Youtube Channel ID's below and re-import to add your videos to the database.</p>
        <form method ="get" action="">
          <input type="hidden" value="<?php echo($thecurrentpage); ?>" name="page"/>
          <div class="mb-3">
            <label for="newchannelid" class="form-label">New YouTube Channel ID</label>
            <input type="text" class="form-control" id="newchannelid" name="newchannelid" aria-describedby="newchannelidHelp">
            <div id="newchannelidHelp" class="form-text">Your Channel ID should look something like this: UCLr9nHPNpj7U3096nEo8Qfg</div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <hr>
      <form method="get" action="">
        <input type="hidden" value="<?php echo($thecurrentpage); ?>" name="page"/>
        <?php
        ?>
        <div class="form-group">
            <label for="existingchannelids">Example select</label>
            <select class="form-control" name="existingchannelids" id="existingchannelids">
           
            <?php
              //get all the channel ids
              $allchannelids = get_posts(array('post_type'=>'yt-channel-id', 'numberposts' => -1));
              
              //debug checking for channel ID Count
              //echo ('<option>'.count($allchannelids).'</option>');
              
              //check if there are any to display
              if(count($allchannelids) == 0){
                //nothing happens
                echo('<option>No Channel IDs</option>');
              }
              else{
                foreach ($allchannelids as $channelid){
                  echo('<option>'.$channelid -> post_title.' ^?/^ '.$channelid -> ID.'</option>');
                }
              }
            
            ?>  
            </select>
        </div>
        <br>
        <div class="form-group">
          <button type="submit" class="btn btn-danger" data-toggle="button" aria-pressed="false" autocomplete="off">Delete this channel</button>
        </div>
      </form>


      </div>      
    </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="adSettings">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        <h1 class="display-4">Advertiser settings</h1>
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <div class="alert alert-primary">
          <!--<h1 class="display-4">Advertiser settings</h1>-->
          <h3 class="">Setup the advertiser settings</h3>
          <hr>
          <form method="post" action="options.php">
            <?php
            settings_fields( 'basepluginadsettings' );
            do_settings_sections( 'basepluginadsettings' )
            ?>
            <div class="form-group">
                <label for="adskipseconds">Skip AD after X number of seconds</label>
                <input name="adskipseconds" type="number" value=<?php echo get_option('adskipseconds');?> class="form-control" id="adskipseconds">
            </div>
            <div class="form-group">
                <label for="advideo">Advertiser YouTube ID</label>
                <input type="text" name="advideo" value="<?php echo get_option( 'advideo' ); ?>" class="form-control" id="advideo" placeholder="example: pfwGRkG1Xwc"> 
            </div>
            <div class="form-group">         
                <label for="advideo">AD Title</label>
                <input type="text" name="adtitle" value="<?php echo get_option( 'adtitle' ); ?>" class="form-control" id="adtitle" placeholder=""> 
            </div>
            <div class="form-group">         
                <label for="advideo">AD Body Text</label>
                <input type="text" name="adbodytext" value="<?php echo get_option( 'adbodytext' ); ?>" class="form-control" id="adbodytext" placeholder=""> 
            </div>
            <div class="form-group">         
                <label for="advideo">Ad Button Text</label>
                <input type="text" name="adbuttontext" value="<?php echo get_option( 'adbuttontext' ); ?>" class="form-control" id="adbuttontext" placeholder=""> 
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Save Advertiser Settings</button>
            </div>
          </form>
        </div> 
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="scSettings">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        <h1 class="display-4">ShortCode Information</h1>
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <div class="alert alert-success">
          <!--<h1 class="display-4">ShortCode Information</h1>-->
          <h3 class="">To Output Videos simply use this shortcode: "[base-plugin-yt]"</h3>
          <hr>
          <form method="post" action="options.php">
            <?php
            settings_fields( 'basepluginshortcodesettings' );
            do_settings_sections( 'basepluginshortcodesettings' )
            ?>
            <div class="form-group">
                <label for="ypostcount">Number of Videos to show</label>
                <input name="ypostcount" type="number" value=<?php echo get_option('ypostcount');?> class="form-control" id="ypostcount">
            </div>
            <div class="form-group">         
                <label for="ytvidstyletype">Display Style</label>
                <select class="form-control" min="1" max="5" name="ytvidstyletype" id="ytvidstyletype">
                  <option <?php if (get_option ('ytvidstyletype') == 'Image Left'){echo( 'selected');} ?>>Image Left</option>
                  <option <?php if (get_option ('ytvidstyletype') == 'Image Center'){echo( 'selected');} ?>>Image Center</option>
                  <option <?php if (get_option ('ytvidstyletype') == 'Image Right'){echo( 'selected');} ?>>Image Right</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Save Shortcode Changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div> <!-- End Container -->