<?php
/**
 * Plugin Name: LH Disable BP Registration
 * Plugin URI: https://lhero.org/portfolio/lh-disable-bp-registration/
 * Description: Disable registration on your buddypress site or network
 * Version: 1.03
 * Author: Peter Shaw
 * Author URI: https://shawfactor.com
 * License: GPL
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (!class_exists('LH_Disable_bp_registration_plugin')) {


class LH_Disable_bp_registration_plugin {
    
private static $instance;

var $sign_up_url;


public function fix_signup_page($page ){
    
    //return wp_registration_url();
    
    //return bp_get_root_domain() . '/wp-login.php?action=register'; 
    
    return $this->sign_up_url;

    }




public function plugin_init(){
    
$this->sign_up_url = wp_registration_url();

remove_action( 'bp_init',    'bp_core_wpsignup_redirect' );
remove_action( 'bp_screens', 'bp_core_screen_signup' );

add_filter( 'bp_get_signup_page', array($this,'fix_signup_page'), 10, 1);
    
}

   /**
     * Gets an instance of our plugin.
     *
     * using the singleton pattern
     */
    public static function get_instance(){
        if (null === self::$instance) {
            self::$instance = new self();
        }
 
        return self::$instance;
    }
    


public function __construct() {
    
	 //run our hooks on plugins loaded to as we may need checks       
    add_action( 'plugins_loaded', array($this,'plugin_init'));



}


}

$lh_disable_bp_registration_instance = LH_Disable_bp_registration_plugin::get_instance();

}






?>