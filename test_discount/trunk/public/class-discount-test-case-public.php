<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       honuselles@gmial.com
 * @since      1.0.0
 *
 * @package    Discount_Test_Case
 * @subpackage Discount_Test_Case/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Discount_Test_Case
 * @subpackage Discount_Test_Case/public
 * @author     test <honuselles@gmial.com>
 */
class Discount_Test_Case_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The options name to be used in this plugin
     *
     * @since    1.0.0
     * @access    private
     * @var    string $option_name Option name of this plugin
     */
    private string $option_name = 'discount_test';


    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of the plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Discount_Test_Case_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Discount_Test_Case_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/discount-test-case-public.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Discount_Test_Case_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Discount_Test_Case_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/discount-test-case-public.js', array('jquery'), $this->version, false);

    }

    function change_calculated_total($total, $cart)
    {
        $percentage = 10;

        return $total * (1 - ($percentage / 100));
    }

    public function change_price_regular_member($val)
    {
//        global $woocommerce;

        if (is_admin() && !defined('DOING_AJAX'))
            return;

        $percentage = 0;

        $visited = filter_input(INPUT_COOKIE, 'visited', FILTER_SANITIZE_NUMBER_INT);

        if ($leave)
            $percentage = get_option('discount_test_leave') / 100;
        elseif ($visited == '1')
            $percentage = get_option('discount_test_comeback') / 100;
        elseif (is_user_logged_in())
            $percentage = get_option('discount_test_registered') / 100;


        if ($percentage <= 0)
            return;
        $surcharge = $val->subtotal * $percentage;
        $val->add_fee(__('Скидка'), -$surcharge, true, '');

    }

    public function visit_site()
    {
//        if (!session_id())
//            @session_start();
//        $_SESSION['leave'] = false;


        $visited = filter_input(INPUT_COOKIE, 'visited', FILTER_SANITIZE_NUMBER_INT);
        if (empty($visited)) {
            setcookie("visited", "1", time() + 315360000);
        } else {
            wc_print_notice(__('всплывающее сообщение с предложением скидки в 3%.', 'woocommerce'), 'notice');

//            echo '            <!-- вынесу инлайн стили позже -->
//            <div style="display: block; position: absolute; top: 15vh; right: 15vh; width: 40vh;">
//                <p>всплывающее сообщение
//            (дизайн не важен) с предложением скидки в 3%</p>
//                <a id="leave" href="#">Получить</a>
//            </div>';
            setcookie("visited", "1", time() + 315360000);
        }
    }
}


