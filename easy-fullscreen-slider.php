<?php
/**
 * Plugin Name: Easy Fullscreen Slider
 * Plugin URI: 
 * Description: 
 * Version: 1.1.1
 * Author: Kamil Ruchała
 * Author URI: 
 * License: GPL2
 */


/*
    Copyright 2014  Kamil Ruchała  (email : sar3ven112@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if(!class_exists('EasyFullscreenSlider')){
    class EasyFullscreenSlider
    {
        // name of plugin
        private $plugin;
        
        // efslider settings for post
        private $settings;
        
        /**
        * Construct plugins
        */
        public function __construct(){
            $this->plugin = plugin_dir_url(__FILE__);
            // settings
            require_once(plugin_dir_path( __FILE__ ).'/settings.php');
            $EasySliderSettings = new EasyFullscreenSliderSettings();
            
            // post settings
            require_once(plugin_dir_path( __FILE__ ).'/settings_post.php');
            $EasySliderPostSetings = new EasyFullscreenSliderPostSettings();
            
            // add slider
            $this->_add_slider();
            
            // add filter action links
            add_filter('plugin_action_links_'.plugin_basename(__FILE__), array( $this, 'plugin_settings_link' ));
        }
        /**
        * Activate the plugin
        */
        public function activate(){
            //add default settings
            $default_values = get_option('efs-settings');
            $default_images = get_option('efs-images');
            if(!isset($default_values)){ 
                update_option('efs-settings', array(
                    'transition_effect' => 1,
                    'controlls' => 0,
                    'autoplay' => 1,
                    'disable' => 1,
                    'transition_speed' => 750,
                    'slide_interval' => 5000,
                    'progress_bar' => 0,
                    'thumbnail_navigation' => 0
                ));
            }
            if(!isset($default_images)){
                update_option('efs-images', array());
            }
        }
        /**
        * Deactivate the plugin
        */
        public function deactivate(){
            
        }
        /**
        * Add slider
        */
        public function _add_slider(){   
            add_action('wp_enqueue_scripts', array($this, 'add_scripts'));
            add_action('wp_head', array($this, 'add_supersized_settings'));
            add_action('wp_footer', array($this, 'display_slider'));
        }
        /**
        * Add necessary scripts in header
        */
        public function add_scripts(){
            // Check configuration for current post and compare with deflault settings
            $values = get_post_meta(get_the_ID(), 'efslider', true);
            $default_values = get_option('efs-settings');
            $default_images = get_option('efs-images');
            echo count($values['images']);
            if($values){
                $this->settings = array(
                    'transition_effect' => (isset($values['transition_effect'])) ? $values['transition_effect'] : $default_values['transition_effect'],
                    'transition_speed' => (is_numeric($values['transition_speed']) || isset($values['transition_speed'])) ? $values['transition_speed'] : $default_values['transition_speed'],
                    'controlls' => (isset($values['controlls'])) ? $values['controlls'] : $default_values['controlls'],
                    'autoplay' => (isset($values['autoplay'])) ? $values['autoplay'] : $default_values['autoplay'],
                    'disable' => (isset($values['disable'])) ? $values['disable'] : $default_values['disable'],
                    'images' => (isset($values['images']) && count($values['images'])>0) ? $values['images'] : $default_images,
                    'slide_interval' => (isset($values['slide_interval'])) ? $values['slide_interval'] : $default_values['slide_interval'],
                    'progress_bar' => (isset($values['progress_bar'])) ? $values['progress_bar'] : $default_values['progress_bar'],
                    'thumbnail_navigation' => (isset($values['thumbnail_navigation'])) ? $values['thumbnail_navigation'] : $default_values['thumbnail_navigation']
                );
            }
            else{
                $this->settings = array(
                    'transition_effect' => $default_values['transition_effect'],
                    'transition_speed' => $default_values['transition_speed'],
                    'controlls' => $default_values['controlls'],
                    'autoplay' => $default_values['autoplay'],
                    'disable' => $default_values['disable'],
                    'images' => $default_images,
                    'slide_interval' => $default_values['slide_interval'],
                    'progress_bar' => $default_values['progress_bar'],
                    'thumbnail_navigation' => $default_values['thumbnail_navigation']
                );
            }
            // check disable option
            if($this->settings['disable'] != '1' && $this->settings['images'] != ''){
                
                //set default values for empty options
                $this->settings['autoplay'] = ($this->settings['autoplay'] == '') ? '1' : $this->settings['autoplay'];
                $this->settings['transition_effect'] = ($this->settings['transition_effect'] == '') ? '1' : $this->settings['transition_effect'];
                $this->settings['transition_speed'] = ($this->settings['transition_speed'] == '') ? '750' : $this->settings['transition_speed'];
                $this->settings['slide_interval'] = ($this->settings['slide_interval'] == '') ? '5000' : $this->settings['slide_interval'];


                wp_enqueue_script('jquery');

                wp_register_script('jqueryeasing', plugins_url('assets/js/jquery.easing.min.js', __FILE__), array('jquery'));
                wp_enqueue_script('jqueryeasing');

                wp_register_script('supersized', plugins_url('assets/js/supersized.3.2.7.min.js', __FILE__), array('jquery'));
                wp_enqueue_script('supersized');

                wp_register_style( 'supersized', plugins_url('assets/css/supersized.css', __FILE__));
                wp_enqueue_style('supersized');

                wp_register_style( 'supersizedshutter', plugins_url('assets/css/supersized.shutter.css', __FILE__));
                wp_enqueue_style('supersizedshutter');

                //wp_register_script('sfslider', plugins_url('assets/js/sfslider.js', __FILE__), array('supersized'));

                wp_register_script('supersizedshutter', plugins_url('assets/js/supersized.shutter.min.js', __FILE__), array('supersized'));
                wp_localize_script('supersizedshutter', 'plugin_directory', $this->plugin.'assets/');
                wp_enqueue_script('supersizedshutter');
            }
            
        }
        /**
        * Add supersized settings script in header
        */
        public function add_supersized_settings(){
            // check disable option
            if($this->settings['disable'] != '1' && $this->settings['images'] != ''){
                $i=1;
                $img = '';
                $count = count($this->settings['images']);
                foreach($this->settings['images'] as $image){
                    if($i != $count)
                        $img .= "{image:'".$image."'},";
                    else
                        $img .= "{image:'".$image."'}";
                    $i++;
                }
                ?>
                <script type="text/javascript">
                    jQuery(function($){
                        $.supersized({
                            transition:<?php echo $this->settings['transition_effect']; ?>,
                            transition_speed:<?php echo $this->settings['transition_speed']; ?>,
                            autoplay: <?php echo $this->settings['autoplay']; ?>,
                            slide_interval: <?php echo $this->settings['slide_interval']; ?>,
                            slide_links:'blank',
                            slides:[			
                                    <?php echo $img; ?>
                                   ]

                        });
                    });
                </script>
                <?php
            }
        }
        /**
        * Add slider controlls
        */
        public function display_slider(){
            // check disable option
            if($this->settings['disable'] != '1' && $this->settings['images'] != ''){
                ?>
                <?php if(count($this->settings['images'])>1){ ?>
                <?php if($this->settings['thumbnail_navigation']){ ?>
                <div id="prevthumb"></div>
                <div id="nextthumb"></div>
                <?php } ?>
                
                <?php if($this->settings['controlls']){ ?>
                <!--Arrow Navigation-->
                <a id="prevslide" class="load-item"></a>
                <a id="nextslide" class="load-item"></a>
                <?php } ?>

                <?php if($this->settings['thumbnail_navigation']){ ?>
                <div id="thumb-tray" class="load-item">
                    <div id="thumb-back"></div>
                    <div id="thumb-forward"></div>
                </div>
                <?php } ?>

                <?php if($this->settings['progress_bar']){ ?>
                <!--Time Bar-->
                <div id="progress-back" class="load-item">
                    <div id="progress-bar"></div>
                </div>
                <?php } ?>

                <?php if($this->settings['thumbnail_navigation']){ ?>
                <!--Control Bar-->
                <div id="controls-wrapper" class="load-item">
                    <div id="controls">

                        <a id="play-button"><img id="pauseplay" src="<?php echo $this->plugin;?>assets/img/pause.png"/></a>

                        <!--Slide counter-->
                        <div id="slidecounter">
                            <span class="slidenumber"></span> / <span class="totalslides"></span>
                        </div>

                        <!--Slide captions displayed here-->
                        <div id="slidecaption"></div>

                        <!--Thumb Tray button-->
                        <a id="tray-button"><img id="tray-arrow" src="<?php echo $this->plugin ?>assets/img/button-tray-up.png"/></a>

                        <!--Navigation-->
                        <ul id="slide-list"></ul>

                    </div>
                </div>
            <?php
                    } 
                }
            }
        }
        // Add the settings link to the plugins page
	function plugin_settings_link($links){
            $settings_link = '<a href="options-general.php?page=easy-fullscreen-slider">Settings</a>';
            array_unshift($links, $settings_link);
            return $links;
	}
        /**
        * Uninstall the plugin
        */
        public function uninstall(){
            if (!defined('WP_UNINSTALL_PLUGIN')) 
                exit();
            // check if options exist and delete them
            if(get_option('efs-settings-group') != false){
                delete_option('efs-settings-group');
            }
        }
    }
}
if(class_exists('EasyFullscreenSlider')){
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('EasyFullscreenSlider', 'activate'));
    register_deactivation_hook(__FILE__, array('EasyFullscreenSlider', 'deactivate'));
    register_uninstall_hook(__FILE__, array('EasyFullscreenSlider', 'uninstall'));

    $EasySlider = new EasyFullscreenSlider();
}
