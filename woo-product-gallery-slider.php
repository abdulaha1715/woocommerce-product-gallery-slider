<?php
/**
 * Plugin Name:       Woo Product Gallery Slider
 * Plugin URI:        https://example.com/
 * Description:       This plugin for woocommerce allows you add a carousel in woocommerce default Gallery section.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Abdulaha Islam
 * Author URI:        https://www.linkedin.com/in/abdulaha-islam/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       woo-product-gallery-slider
 * Domain Path:       /languages
 */


/**
 * If this file is called directly, then abort execution.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 * Load plugin textdomain.
 */
function ab_woo_load_textdomain() {
    load_plugin_textdomain( 'woo-product-gallery-slider', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

add_action('init', 'ab_woo_load_textdomain');


// register javascript and css on initialization
function ab_woo_register_script() {

    wp_register_style( 'slick-theme-css', plugins_url('/assets/css/slick-theme.css', __FILE__), false, '1.5.0', 'all');
    wp_register_style( 'slick-min-css', plugins_url('/assets/css/slick.min.css', __FILE__), false, '1.5.0', 'all');
    wp_register_style( 'font-awesome-css', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css', false, '4.7.0', 'all');
    wp_register_style( 'bootstrap-css', plugins_url('/assets/css/bootstrap.min.css', __FILE__), false, '4.1.3', 'all');
    wp_register_style( 'fancybox-css', plugins_url('/assets/css/fancybox.min.css', __FILE__), false, '1.0.0', 'all');

    wp_register_style( 'ab-woo-style-css', plugins_url('/assets/css/style.css', __FILE__), false, '1.0.0', 'all');


    wp_register_script( 'popper-js', plugins_url('/assets/js/popper.min.js', __FILE__), array('jquery'), '1.12.9' );
    wp_register_script( 'bootstrap-js', plugins_url('/assets/js/bootstrap.min.js', __FILE__), array('jquery'), '4.0.0' );
    wp_register_script( 'slick-min-js', plugins_url('/assets/js/slick.min.js', __FILE__), array('jquery'), '1.5.0' );
    wp_register_script( 'fancybox-js', plugins_url('/assets/js/fancybox.min.js', __FILE__), array('jquery'), '1.0.0' );
    
    wp_register_script( 'app-js', plugins_url('/assets/js/app.js', __FILE__), array('jquery'), '1.0.0' );
}

add_action('init', 'ab_woo_register_script');


// use the registered javascript and css above
function ab_woo_enqueue_style(){
    wp_enqueue_style('slick-theme-css');
    wp_enqueue_style('slick-min-css');
    // wp_enqueue_style('font-awesome-css');
    // wp_enqueue_style('bootstrap-css');
    wp_enqueue_style('fancybox-css');
    wp_enqueue_style('ab-woo-style-css');

    // wp_enqueue_script( 'popper-js' );
    // wp_enqueue_script( 'bootstrap-js' );;
    wp_enqueue_script( 'slick-min-js' );
    wp_enqueue_script( 'fancybox-js' );
    wp_enqueue_script( 'app-js' );
}

add_action('wp_enqueue_scripts', 'ab_woo_enqueue_style');



/**
 *  Remove single product default images
 */

function ab_woo_woocommerce_loaded(){
    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
    remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
}

add_action('woocommerce_loaded', 'ab_woo_woocommerce_loaded');


/**
 * Woocommerce single product thumbnail
 * Woocommerce single product gallery slider 
 */ 

function abnipes_ulla_woocommerce_show_product_images() {
    global $product;
    ?>
    <div class="woocommerce-product-gallery images">
        <div class="anmipes-woocommerce-product-gallery">
            <?php
            $image_ids = $product->get_gallery_image_ids();
            if (!empty($image_ids)) : ?>

                <div class="video-icon">
                    <a class="video-link" data-fancybox="" href="https://www.youtube.com/embed/g3-VxLQO7do?autoplay=1">
                        <i class="fa fa-play play-icon" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="anmipes-product-big-image">

                    <?php foreach ($image_ids as $image_id) : ?>
                        <div class="anmipes-single-gallery-img">
                            <img src="<?php echo wp_get_attachment_image_url($image_id, 'large'); ?>" alt="">
                            <a data-fancybox="images" href="<?php echo wp_get_attachment_image_url($image_id, 'large'); ?>" class="product-popup">
                                <div class="hover-icon"><i class="fa fa-plus"></i></div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="anmipes-thumb_imges">
                    <?php foreach ($image_ids as $image_id) : ?>
                        <div class="anmipes-single-gallery-thumb">
                            <img src="<?php echo wp_get_attachment_image_url($image_id, 'thumbnail'); ?>" alt="">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : the_post_thumbnail('large'); endif; ?>
        </div>
    </div>
<?php
}
add_action('woocommerce_before_single_product_summary', 'abnipes_ulla_woocommerce_show_product_images', 20);







