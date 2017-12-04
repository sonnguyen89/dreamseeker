<?php
/*
  Plugin Name: Dreamseeker Options
  Plugin URI: le5600.com
  Description: Dreamseeker Options panel
  Author: le5600.com
  Version: 1.0
  Author URI: 
 */


/* Global Settings */
global $wpdb;

/* Database prefix constant*/
define('CEDO_OPTIONS_MAIN_TABLE', $wpdb->prefix . 'dreamseeker_options');

/* path info */
$pathinfo = pathinfo(__FILE__);
define('CEDO_OPTIONS_MAIN_NAME', 'Dreamseeker Options');
define('CEDO_OPTIONS_PATH_FULL',   $pathinfo['dirname']); //full path
define('CEDO_OPTIONS_MAIN_FOLDER', basename($pathinfo['dirname'])); //folder name
define('CEDO_OPTIONS_MAIN_FILE', $pathinfo['basename']); //file name

/**
 * Main class file
 */
class  ThemeJung_cedo_options_main {
    
    function  __construct() {
        register_activation_hook(__FILE__, array(&$this, 'install'));
        //register_deactivation_hook( __FILE__, array(&$this, 'uninstall'));

        add_action('init', array(&$this, 'init'));
        add_action('admin_menu', array(&$this, 'admin_menu'));
    } 

    function install() {
        $wp_kyros_option_cdb = "CREATE TABLE " . CEDO_OPTIONS_MAIN_TABLE . "( id bigint(20) NOT NULL auto_increment, optionName varchar(200) NOT NULL, optionValue text NULL, PRIMARY KEY(id)) DEFAULT character set utf8";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        try {
            dbDelta($wp_kyros_option_cdb);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    function uninstall () {
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS ".CEDO_OPTIONS_MAIN_TABLE);
    }

    function init() {
        if (is_admin() && isset($_GET['page']) && $_GET['page'] == CEDO_OPTIONS_MAIN_FOLDER . "/" . CEDO_OPTIONS_MAIN_FILE) {
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox');
            wp_enqueue_style('thickbox');

            if (file_exists(ABSPATH . 'wp-content/plugins/' . CEDO_OPTIONS_MAIN_FOLDER . '/css/admin.css')) {
                wp_register_style('wp_cedo_options_admin_css', plugins_url('/css/admin.css', __FILE__), false, '1.0', 'all');
            }  
        }
    }

    function admin_menu() {
        wp_enqueue_style('wp_cedo_options_admin_css');
        add_menu_page('Dreamseeker Options', 'Dreamseeker Options', 'edit_dashboard', __FILE__, array(&$this, 'menu_admin'), plugins_url('images/logo/16px.png', __FILE__));
      
    }    
    function menu_admin() {
        include_once 'pages/settings.php';
    }
}

/** initialize the plugin **/
if (class_exists('ThemeJung_cedo_options_main'))  {
    new ThemeJung_cedo_options_main();
} else {
    exit ('class "Main" not found!');
}

/** Get and Set Options **/
function cedo_get_option($key){
    global $wpdb;
    return $wpdb->get_var("SELECT optionValue FROM ".CEDO_OPTIONS_MAIN_TABLE." WHERE optionName='".$key."'");
}

function cedo_set_option($key, $value) {
    global $wpdb;
    if (is_null($wpdb->get_var("SELECT id FROM " . CEDO_OPTIONS_MAIN_TABLE . " WHERE optionName='" . $key . "'"))) {
        return $wpdb->insert(CEDO_OPTIONS_MAIN_TABLE, array('optionName' => $key, 'optionValue' => $value));
    } else {
        return $wpdb->update(CEDO_OPTIONS_MAIN_TABLE, array('optionValue' => $value), array('optionName' => $key));
    }
}
