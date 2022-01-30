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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<div class="container" style="max-width:100%;">
  <h1>General Settings for Base Plugin Youtube</h1><br><hr>
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
        </div><br>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
    <div class="col">
      <div class="alert alert-success">
        <h1 class="display-4">ShortCode Information</h1>
        <h3 class="">To Output Videos simply use this shortcode: "[base-plugin-yt]"</h3>
        <hr>
        <form>
        <div class="form-group">
            <label for="ypostcount">Number of Videos to show</label>
            <input type="number" min="1" max="20" value="10" class="form-control" id="ypostcount">
        </div>
        <div class="form-group">         
            <label for="ytvidstyletype">Display Style</label>
            <select class="form-control" name="ytvidstyletype" id="ytvidstyletype">
            <option>Image Left</option>
            <option>Image Center</option>
            <option>Image Right</option>
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
</div>