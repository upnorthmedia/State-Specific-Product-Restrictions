<?php
/*
Plugin Name: State Specific Product Restrictions
Description: Blocks orders for specific products to certain states based on a customer's shipping address at checkout.
Version: 1.2
Author: upnorthmedia
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add a settings page to configure restricted products and states.
add_action( 'admin_menu', 'wcsr_add_admin_menu' );
add_action( 'admin_init', 'wcsr_settings_init' );

function wcsr_add_admin_menu() {
    add_options_page( 'State Restrictions', 'State Restrictions', 'manage_options', 'state_restrictions', 'wcsr_options_page' );
}

function wcsr_settings_init() {
    register_setting( 'pluginPage', 'wcsr_settings', 'wcsr_sanitize_settings' );

    add_settings_section(
        'wcsr_pluginPage_section',
        __( 'Configure State Restrictions', 'wordpress' ),
        'wcsr_settings_section_callback',
        'pluginPage'
    );

    add_settings_field(
        'wcsr_restricted_products',
        __( 'Restricted Products', 'wordpress' ),
        'wcsr_restricted_products_render',
        'pluginPage',
        'wcsr_pluginPage_section'
    );

    add_settings_field(
        'wcsr_restricted_states',
        __( 'Restricted States', 'wordpress' ),
        'wcsr_restricted_states_render',
        'pluginPage',
        'wcsr_pluginPage_section'
    );
}

function wcsr_sanitize_settings($settings) {
    $settings['wcsr_restricted_products'] = sanitize_text_field($settings['wcsr_restricted_products']);
    $settings['wcsr_restricted_states'] = sanitize_text_field($settings['wcsr_restricted_states']);
    return $settings;
}

function wcsr_restricted_products_render() {
    $options = get_option( 'wcsr_settings' );
    ?>
    <input type='text' name='wcsr_settings[wcsr_restricted_products]' value='<?php echo esc_attr($options['wcsr_restricted_products']); ?>'>
    <p>Enter product IDs separated by commas.</p>
    <?php
}

function wcsr_restricted_states_render() {
    $options = get_option( 'wcsr_settings' );
    ?>
    <input type='text' name='wcsr_settings[wcsr_restricted_states]' value='<?php echo esc_attr($options['wcsr_restricted_states']); ?>'>
    <p>Enter state codes separated by commas (e.g., CA, NY, TX).</p>
    <?php
}

function wcsr_settings_section_callback() {
    echo esc_html__( 'Specify the products and the states where they are restricted.', 'wordpress' );
}

function wcsr_options_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>
    <form action='options.php' method='post'>
        <?php
        settings_fields( 'pluginPage' );
        do_settings_sections( 'pluginPage' );
        submit_button();
        ?>
    </form>
    <?php
}

// Validate the shipping address during checkout.
add_action( 'woocommerce_checkout_process', 'wcsr_validate_shipping_address' );

function wcsr_validate_shipping_address() {
    $options = get_option( 'wcsr_settings' );
    $restricted_products = isset($options['wcsr_restricted_products']) ? $options['wcsr_restricted_products'] : '';
    $restricted_states = isset($options['wcsr_restricted_states']) ? $options['wcsr_restricted_states'] : '';

    if ( ! $restricted_products || ! $restricted_states ) {
        return;
    }

    $restricted_products = array_map( 'trim', explode( ',', $restricted_products ) );
    $restricted_states = array_map( 'trim', explode( ',', $restricted_states ) );

    $shipping_state = WC()->customer->get_shipping_state();
    $cart_items = WC()->cart->get_cart();

    foreach ( $cart_items as $cart_item ) {
        $product_id = $cart_item['product_id'];
        if ( in_array( $product_id, $restricted_products ) && in_array( $shipping_state, $restricted_states ) ) {
            wc_add_notice( __( 'Sorry, one or more items in your cart cannot be shipped to your state.' ), 'error' );
            break;
        }
    }
}
?>