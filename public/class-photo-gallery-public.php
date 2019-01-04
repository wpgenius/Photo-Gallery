<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       wpgenius.in
 * @since      1.0.0
 *
 * @package    Photo_Gallery
 * @subpackage Photo_Gallery/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Photo_Gallery
 * @subpackage Photo_Gallery/public
 * @author     Team WPGenius <deepak@wpgenius.in>
 */
class Photo_Gallery_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Photo_Gallery_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Photo_Gallery_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/photo-gallery-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Photo_Gallery_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Photo_Gallery_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/photo-gallery-public.js', array( 'jquery' ), $this->version, false );

	}
    
    
    function load_photo_template($template) {
    global $post;

    if ( $post->post_type == 'photo-gallery'){
        /* This is a "photo-gallery" post 
         * AND a 'single movie template' is not found on 
         * theme or child theme directories, so load it 
         * from our plugin directory
         */
        return plugin_dir_path( __FILE__ ) . "single-photo-gallery.php";
    }

    return $template;
}


}
