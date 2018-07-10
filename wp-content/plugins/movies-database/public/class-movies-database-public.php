<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://zorca.org
 * @since      1.0.0
 *
 * @package    Movies_Database
 * @subpackage Movies_Database/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Movies_Database
 * @subpackage Movies_Database/public
 * @author     Zorca <vs@zorca.org>
 */
class Movies_Database_Public {

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

    function add_movies_single_template($single_template) {

        global $post;

        if ($post->post_type == 'movies') {
            if ( $theme_file = locate_template( array ( 'single-movies.php' ) ) ) {
                $single_template = $theme_file;
            } else {
                $single_template = dirname( __FILE__ ) . '/templates/single-movies.php';
            }
        }

        return $single_template;
    }

    function add_movies_archive_template($archive_template) {

        global $post;

        if ($post->post_type == 'movies') {
            if ( $theme_file = locate_template( array ( 'archive-movies.php' ) ) ) {
                $archive_template = $theme_file;
            } else {
                $archive_template = dirname( __FILE__ ) . '/templates/archive-movies.php';
            }
        }

        return $archive_template;
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
		 * defined in Movies_Database_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Movies_Database_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/movies-database-public.css', array(), $this->version, 'all' );

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
		 * defined in Movies_Database_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Movies_Database_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/movies-database-public.js', array( 'jquery' ), $this->version, false );

	}

}
