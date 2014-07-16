<table class="form-table">
    <tr valign="top">
        <th scope="row">Transition effect</th>
        <td>
            <select name="transition_effect">
                <option <?php echo ($values['transition_effect'] == 1) ? 'selected="selected" ' : ''; ?> value="1">fade<?php echo ($default_values['transition_effect'] == 1) ? ' (default)' : ''; ?></option>
                <option <?php echo ($values['transition_effect'] == 2) ? 'selected="selected" ' : ''; ?> value="2">slideTop<?php echo ($default_values['transition_effect'] == 2) ? ' (default)' : ''; ?></option>
                <option <?php echo ($values['transition_effect'] == 3) ? 'selected="selected" ' : ''; ?> value="3">slideRight<?php echo ($default_values['transition_effect'] == 3) ? ' (default)' : ''; ?></option>
                <option <?php echo ($values['transition_effect'] == 4) ? 'selected="selected" ' : ''; ?> value="4">slideBottom<?php echo ($default_values['transition_effect'] == 4) ? ' (default)' : ''; ?></option>
                <option <?php echo ($values['transition_effect'] == 5) ? 'selected="selected" ' : ''; ?> value="5">slideLeft<?php echo ($default_values['transition_effect'] == 5) ? ' (default)' : ''; ?></option>
                <option <?php echo ($values['transition_effect'] == 6) ? 'selected="selected" ' : ''; ?> value="6">carouselRight<?php echo ($default_values['transition_effect'] == 6) ? ' (default)' : ''; ?></option>
                <option <?php echo ($values['transition_effect'] == 7) ? 'selected="selected" ' : ''; ?> value="7">carouselLeft<?php echo ($default_values['transition_effect'] == 7) ? ' (default)' : ''; ?></option>
                <option <?php echo ($values['transition_effect'] == 0) ? 'selected="selected" ' : ''; ?> value="0">none<?php echo ($default_values['transition_effect'] == 0) ? ' (default)' : ''; ?></option>
            </select>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row">Transition speed</th>
        <td>
            <input type="text" name="transition_speed" value="<?php echo ($values['transition_speed'] == '') ? $default_values['transition_speed'] : $values['transition_speed']; ?>" />
        </td>
    </tr>
    <tr valign="top">
        <th scope="row">Slide interval <span class="rdesc">(Time between slide changes in milliseconds.)</span></th>
        <td>
            <input type="text" name="slide_interval" value="<?php echo ($values['slide_interval'] == '') ? $default_values['slide_interval'] : $values['slide_interval']; ?>" />
        </td>
    </tr>
     <tr valign="top">
        <th scope="row">Controlls</th>
        <td>
            <select name="controlls">
                <option <?php echo ($values['controlls'] == 1) ? 'selected="selected" ' : ''; ?> value="1">Yes<?php echo ($default_values['controlls'] == 1) ? ' (default)' : ''; ?></option>
                <option <?php echo ($values['controlls'] == 0) ? 'selected="selected" ' : ''; ?> value="0">No<?php echo ($default_values['controlls'] == 0) ? ' (default)' : ''; ?></option>
            </select>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row">Autoplay</th>
        <td>
            <select name="autoplay">
                <option <?php echo ($values['autoplay'] == 1) ? 'selected="selected" ' : ''; ?> value="1">Yes<?php echo ($default_values['autoplay'] == 1) ? ' (default)' : ''; ?></option>
                <option <?php echo ($values['autoplay'] == 0) ? 'selected="selected" ' : ''; ?> value="0">No<?php echo ($default_values['autoplay'] == 0) ? ' (default)' : ''; ?></option>
            </select>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row">Disable</th>
        <td>
            <select name="disable">
                <option <?php echo ($values['disable'] == 1) ? 'selected="selected" ' : ''; ?> value="1">Yes<?php echo ($default_values['disable'] == 1) ? ' (default)' : ''; ?></option>
                <option <?php echo ($values['disable'] == 0) ? 'selected="selected" ' : ''; ?> value="0">No<?php echo ($default_values['disable'] == 0) ? ' (default)' : ''; ?></option>
            </select>
        </td>
    </tr>
    <tr valign="top">
       <th scope="row">Progress bar</th>
       <td>
           <select name="progress_bar">
               <option <?php echo ($values['progress_bar'] == 1) ? 'selected="selected" ' : ''; ?> value="1">Yes<?php echo ($default_values['progress_bar'] == 1) ? ' (default)' : ''; ?></option>
               <option <?php echo ($values['progress_bar'] == 0) ? 'selected="selected" ' : ''; ?> value="0">No<?php echo ($default_values['progress_bar'] == 0) ? ' (default)' : ''; ?></option>
           </select>
       </td>
    </tr>
    <tr valign="top">
       <th scope="row">Thumbnail navigation</th>
       <td>
           <select name="thumbnail_navigation">
               <option <?php echo ($values['thumbnail_navigation'] == 1) ? 'selected="selected" ' : ''; ?> value="1">Yes<?php echo ($default_values['thumbnail_navigation'] == 1) ? ' (default)' : ''; ?></option>
               <option <?php echo ($values['thumbnail_navigation'] == 0) ? 'selected="selected" ' : ''; ?> value="0">No<?php echo ($default_values['thumbnail_navigation'] == 0) ? ' (default)' : ''; ?></option>
           </select>
       </td>
    </tr>
    <tr valign="middle">
        <th scope="row" id="uploadbutton" style="vertical-align: middle;"><input id="upload_images" type="button" class="button" value="Upload Images"/></th>
        <td>
            <div id="images">
            <?php
            $images = $values['images'];
            $i = 0;
            if($images != ''){
                foreach($images as $image){
                    echo '<div id="img'.$i.'" class="timg">';
                    echo '<img style="width:100px;height:100px;float:left;margin-right:5px;" src="'.$image.'" alt="" /><input type="hidden" name="efs-images[]" value="'.$image.'" />';  
                    echo '<div id="'.$i.'" class="dlink"></div>';
                    echo '</div>';
                    $i++;
                }
            }
            ?>
            </div>
        </td>
    </tr>
</table>
