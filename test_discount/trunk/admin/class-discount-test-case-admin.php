<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       honuselles@gmial.com
 * @since      1.0.0
 *
 * @package    Discount_Test_Case
 * @subpackage Discount_Test_Case/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Discount_Test_Case
 * @subpackage Discount_Test_Case/admin
 * @author     test <honuselles@gmial.com>
 */
class Discount_Test_Case_Admin
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
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/discount-test-case-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/discount-test-case-admin.js', array('jquery'), $this->version, false);

    }

    /**
     * Add an options page under the Settings submenu
     *
     * @since  1.0.0
     */
    public function add_options_page()
    {

        $this->plugin_screen_hook_suffix = add_options_page(
            __('Discount test settings', 'discount-test-case'),
            __('Discount test', 'discount-test-case'),
            'manage_options',
            $this->plugin_name,
            array($this, 'display_options_page')
        );

    }

    /**
     * Render the options page for plugin
     *
     * @since  1.0.0
     */
    public function display_options_page()
    {
        include_once 'partials/discount-test-case-admin-display.php';
    }


    /**
     * Register all related settings of this plugin
     *
     * @since  1.0.0
     */
    public function register_setting()
    {
        // Add a General section
        add_settings_section(
            $this->option_name . '_general',
            __('General', 'discount-test-case'),
            array($this, $this->option_name . '_general_cb'),
            $this->plugin_name
        );

        add_settings_field(
            $this->option_name . '_leave',
            __('On leave', 'discount-test-case'),
            array($this, $this->option_name . '_leave_cb'),
            $this->plugin_name,
            $this->option_name . '_general',
            array('label_for' => $this->option_name . '_leave')
        );
        add_settings_field(
            $this->option_name . '_comeback',
            __('On come back', 'discount-test-case'),
            array($this, $this->option_name . '_comeback_cb'),
            $this->plugin_name,
            $this->option_name . '_general',
            array('label_for' => $this->option_name . '_comeback')
        );
        add_settings_field(
            $this->option_name . '_registered',
            __('On come back', 'discount-test-case'),
            array($this, $this->option_name . '_registered_cb'),
            $this->plugin_name,
            $this->option_name . '_general',
            array('label_for' => $this->option_name . '_registered')
        );

        register_setting($this->plugin_name, $this->option_name . '_registered', 'intval');
        register_setting($this->plugin_name, $this->option_name . '_comeback', 'intval');
        register_setting($this->plugin_name, $this->option_name . '_leave', 'intval');

    }

    /**
     * Render the text for the general section
     *
     * @since  1.0.0
     */
    public function discount_test_general_cb()
    {
        echo '<p>' . __('Please change the settings accordingly.', 'discount-test-case') . '</p>';
    }

    /**
     * Render _leave input for this plugin
     *
     * @since  1.0.0
     */
    public function discount_test_leave_cb()
    {
        $val = get_option($this->option_name . '_leave');
        echo '<input type="text" name="' . $this->option_name . '_leave' . '" id="' . $this->option_name . '_leave' . '" value="' . $val . '"> ' . __('%', 'discount-test-case');
    }

    /**
     * Render _comeback input for this plugin
     *
     * @since  1.0.0
     */
    public function discount_test_comeback_cb()
    {
        $val = get_option($this->option_name . '_comeback');
        echo '<input type="text" name="' . $this->option_name . '_comeback' . '" id="' . $this->option_name . '_comeback' . '" value="' . $val . '"> ' . __('%', 'discount-test-case');
    }

    /**
     * Render _registered input for this plugin
     *
     * @since  1.0.0
     */
    public function discount_test_registered_cb()
    {
        $val = get_option($this->option_name . '_registered');
        echo '<input type="text" name="' . $this->option_name . '_registered' . '" id="' . $this->option_name . '_registered' . '" value="' . $val . '"> ' . __('%', 'discount-test-case');
    }
}
