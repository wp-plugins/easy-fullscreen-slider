<div class="wrap">
    <h2>Easy Fullscreen Slider</h2>
    <form method="post" action="options.php">
    <?php settings_fields( 'efs-settings-group' ); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Transition effect</th>
                <td>
                    <select name="efs-settings[transition_effect]">
                        <option <?php echo ($values['transition_effect'] == 1) ? 'selected="selected" ' : ''; ?> value="1">fade</option>
                        <option <?php echo ($values['transition_effect'] == 2) ? 'selected="selected" ' : ''; ?> value="2">slideTop</option>
                        <option <?php echo ($values['transition_effect'] == 3) ? 'selected="selected" ' : ''; ?> value="3">slideRight</option>
                        <option <?php echo ($values['transition_effect'] == 4) ? 'selected="selected" ' : ''; ?> value="4">slideBottom</option>
                        <option <?php echo ($values['transition_effect'] == 5) ? 'selected="selected" ' : ''; ?> value="5">slideLeft</option>
                        <option <?php echo ($values['transition_effect'] == 6) ? 'selected="selected" ' : ''; ?> value="6">carouselRight</option>
                        <option <?php echo ($values['transition_effect'] == 7) ? 'selected="selected" ' : ''; ?> value="7">carouselLeft</option>
                        <option <?php echo ($values['transition_effect'] == 0) ? 'selected="selected" ' : ''; ?> value="0">none</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Transition speed</th>
                <td>
                    <input type="text" name="efs-settings[transition_speed]" value="<?php echo ($values['transition_speed']=='')? '750' : $values['transition_speed']; ?>" />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Slide interval <span class="rdesc">(Time between slide changes in milliseconds.)</span></th>
                <td>
                    <input type="text" name="efs-settings[slide_interval]" value="<?php echo ($values['slide_interval'] == '')? '5000' : $values['slide_interval']; ?>" />
                </td>
            </tr>
             <tr valign="top">
                <th scope="row">Controlls</th>
                <td>
                    <select name="efs-settings[controlls]">
                        <option <?php echo ($values['controlls'] == 1) ? 'selected="selected" ' : ''; ?> value="1">Yes</option>
                        <option <?php echo ($values['controlls'] == 0) ? 'selected="selected" ' : ''; ?> value="0">No</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Autoplay</th>
                <td>
                    <select name="efs-settings[autoplay]">
                        <option <?php echo ($values['autoplay'] == 1) ? 'selected="selected" ' : ''; ?> value="1">Yes</option>
                        <option <?php echo ($values['autoplay'] == 0) ? 'selected="selected" ' : ''; ?> value="0">No</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Disable</th>
                <td>
                    <select name="efs-settings[disable]">
                        <option <?php echo ($values['disable'] == 1) ? 'selected="selected" ' : ''; ?> value="1">Yes</option>
                        <option <?php echo ($values['disable'] == 0) ? 'selected="selected" ' : ''; ?> value="0">No</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Progress bar</th>
                <td>
                    <select name="efs-settings[progress_bar]">
                        <option <?php echo ($values['progress_bar'] == 1) ? 'selected="selected" ' : ''; ?> value="1">Yes</option>
                        <option <?php echo ($values['progress_bar'] == 0) ? 'selected="selected" ' : ''; ?> value="0">No</option>
                    </select>
                </td>
             </tr>
            <tr valign="top">
               <th scope="row">Thumbnail navigation</th>
               <td>
                   <select name="efs-settings[thumbnail_navigation]">
                       <option <?php echo ($values['thumbnail_navigation'] == 1) ? 'selected="selected" ' : ''; ?> value="1">Yes</option>
                       <option <?php echo ($values['thumbnail_navigation'] == 0) ? 'selected="selected" ' : ''; ?> value="0">No</option>
                   </select>
               </td>
            </tr>
            <tr valign="middle">
                <th scope="row" id="uploadbutton"><input id="upload_images" type="button" class="button" value="Upload Images"/></th>
                <td>
                    <div id="images">
                    <?php
                    if($images!=''){
                        $i = 0;
                        foreach($images as $image){
                            echo '<div id="img'.$i.'" class="timg">';
                            echo '<img src="'.$image.'" alt="" /><input type="hidden" name="efs-images[]" value="'.$image.'" />';
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
        <?php submit_button(); ?>
    </form>
</div>