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

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

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

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="container-md">
    <h1>Base Plugin<span class="badge bg-secondary">Settings</span></h1>

    <form method="post" action="options.php">
    <?php
    settings_fields('baseplugincustomsettings');
    do_settings_sections('baseplugincustomsettigns');
    ?>
        <div class="form-group">
            <label for="exampleFormControlInput1">Email address</label>
            <input type="email" name="theemail" value="<?php echo get_option('theemail'); ?>" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <?php $selectedoption = get_option('thedays'); ?>
            <label for="exampleFormControlSelect1">Example select</label>
            <select class="form-control" name="thedays" id="exampleFormControlSelect1">
            <option <?php if($selectedoption == '1'){echo "selected";} ?> >1</option>
            <option <?php if($selectedoption == '2'){echo "selected";} ?> >2</option>
            <option <?php if($selectedoption == '3'){echo "selected";} ?> >3</option>
            <option <?php if($selectedoption == '4'){echo "selected";} ?> >4</option>
            <option <?php if($selectedoption == '5'){echo "selected";} ?> >5</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Example multiple select</label>
            <select multiple class="form-control" name="themultiselect" id="exampleFormControlSelect2">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Example textarea</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Submit Settings</button>
        </div>
    </form>
</div>