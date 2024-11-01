<?php
/**
* Plugin Name: Woocommerce Minimum Order Limit
* Plugin URI: http://www.getjuicy.co.uk/plugins/woocommerce-minimum-order-limit
* Description: Set a minimum order limit for your store
* Version: 1.0 
* Author: getJuicy
* Author URI: http://getjuicy.co.uk
*/

//Don't call the file directly
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );


//Min Order Amount
add_action( 'woocommerce_checkout_process', 'wc_minimum_order_amount' );
add_action( 'woocommerce_before_cart' , 'wc_minimum_order_amount' );
 
function wc_minimum_order_amount() {
    // Set this variable to specify a minimum order value
    

    $isOn = get_option("minOrderOn");

    if ($isOn == 1) {

    $minOrder = get_option("minOrder");
    $minimum = $minOrder;

    if ( WC()->cart->total < $minimum ) {

        if( is_cart() ) {

            wc_print_notice( 
                sprintf( 'You must have an order with a minimum of %s to place your order, your current order total is %s.' , 
                    wc_price( $minimum ), 
                    wc_price( WC()->cart->total )
                ), 'error' 
            );

        } else {

            wc_add_notice( 
                sprintf( 'You must have an order with a minimum of %s to place your order, your current order total is %s.' , 
                    wc_price( $minimum ), 
                    wc_price( WC()->cart->total )
                ), 'error' 
            );

        }
    }


    }


   

}


//Hook into admin menu and run the function to add a new page
add_action('admin_menu', 'min_order_admin_actions');    

//Include the admin php file
function min_order_admin() {
    include('min_order_admin.php');
}


//Here is where we add the menu page and the menu item entry. The first option ‘Simple Order Notification’ is the title of our options page. The second parameter ‘Simple Order Notification’ is the label for our admin panel. The third parameter determines which users can see the option by limiting access to certain users with certain capabilities. ‘Simple Order Notification’ is the slug which is used to identify the menu. The final parameter ‘simple_order_notification_admin’ is the name of the function we want to call when the option is selected, this allows us to add code to output HTML to our page. In this case we just include the admin php file
function min_order_admin_actions() 
{
	add_menu_page(
        "Min Order Admin",
        "Min Order Admin",
        'administrator', 
        "min-order-admin", 
        "min_order_admin"
        );

 
}
 




