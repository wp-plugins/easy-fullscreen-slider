<?php
if(!class_exists('EasyFullscreenSliderSettings')){
    class EasyFullscreenSliderSettings
    {
        /**
        * Construct the settings object
        */
        public function __construct(){
            // register actions
            add_action('admin_init', array(&$this, 'admin_init'));
            add_action('admin_menu', array(&$this, 'add_menu'));
        }
        public function admin_init(){
            register_setting('efs-settings-group', 'efs-settings');
            register_setting('efs-settings-group', 'efs-images');
        } 
        /**
        * Creating page menu item
        */
        public function add_menu(){
            add_options_page('Easy Fullscreen Slider  - Settings',
                'Easy Fullscreen Slider', 'manage_options',
                'easy-fullscreen-slider', array(&$this, 'efs_settings_page'));
        }
        /**
         * Display settings form
         */
        public function efs_settings_page(){
            if(function_exists( 'wp_enqueue_media' )){
                wp_enqueue_media();
            }
            else{
                wp_enqueue_style('thickbox');
                wp_enqueue_script('media-upload');
                wp_enqueue_script('thickbox');
            }
            wp_enqueue_script('jquery-ui-sortable');
            wp_register_script('efslideradmin', plugins_url('assets/js/efslideradmin.js', __FILE__), array('jquery', 'media-upload', 'thickbox'));
            wp_enqueue_script('efslideradmin');
            wp_register_style( 'efslideradmin', plugins_url('assets/css/efslideradmin.css', __FILE__));
            wp_enqueue_style('efslideradmin');
            $values = get_option('efs-settings');
            $images = get_option('efs-images');
            
            require_once(plugin_dir_path( __FILE__ ).'templates/settings_page.php');
        }
    }
}
