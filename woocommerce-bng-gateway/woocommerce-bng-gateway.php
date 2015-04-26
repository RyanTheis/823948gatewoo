<?php
/*
Plugin Name: BNG Payment Gateway (Emulator Integration) for WooCommerce
Plugin URI: http://www.bnggateway.com/
Description: Extends WooCommerce with a simple integration for the BNG Payment Gateway. For assistance with the BNG Gateway or this plugin feel free to contanct BNG at: http://www.bnggateway.com/contact/
Version: 1.0
Author: Ryan Theis - BNG Holdings, Inc.
Author URI: http://www.bnggateway.com/
*/
 
// Include the BNG Gateway Emulator Class and register the BNG Payment Gateway with WooCommerce
add_action( 'plugins_loaded', 'spyr_BNG_Gateway_Emulator_init', 0 );
function spyr_BNG_Gateway_Emulator_init() {
    // If the parent WC_Payment_Gateway class doesn't exist
    // it means WooCommerce is not installed on the site
    // so do nothing
    if ( ! class_exists( 'WC_Payment_Gateway' ) ) return;
     
    // If we made it this far, then include our Gateway Class
    include_once( 'woocommerce-bng.php' );
 
    // Now that we have successfully included our class,
    // Lets add it too WooCommerce
    add_filter( 'woocommerce_payment_gateways', 'spyr_add_BNG_Gateway_Emulator_gateway' );
    function spyr_add_BNG_Gateway_Emulator_gateway( $methods ) {
        $methods[] = 'SPYR_BNG_Gateway_Emulator';
        return $methods;
    }
}
 
// Add custom action links
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'spyr_BNG_Gateway_Emulator_action_links' );
function spyr_BNG_Gateway_Emulator_action_links( $links ) {
    $plugin_links = array(
        '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout' ) . '">' . __( 'Settings', 'spyr-bng-gateway-emulator' ) . '</a>',
    );
 
    // Merge our new link with the default ones
    return array_merge( $plugin_links, $links );   
}