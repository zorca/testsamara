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

    public function print_banner() {
        echo "<img src='data:image/png;base64,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'>";
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
