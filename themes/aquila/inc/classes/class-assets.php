<?php
/**
 * Enqueue theme assets
 *
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Assets {
  use Singleton;

  protected function __construct()
  {
    $this->setup_hooks();
  }

  protected function setup_hooks()
  {

    /**
     * Actions
     */
    //add_action('wp_enqueue_scripts', [$this, 'dequeue_assets']);
    add_action( 'wp_enqueue_scripts', [$this, 'register_styles'] );
    add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
    add_action('admin_enqueue_scripts', [$this, 'register_admin_styles']);
  }

  public function register_styles() {
    // Register Styles
    wp_register_style( 'bootstrap', AQUILA_DIR_URI . '/assets/src/library/css/bootstrap.min.css', [], false, 'all' );
    wp_register_style('main', AQUILA_BUILD_CSS_URI . '/main.css', ['bootstrap'], filemtime(AQUILA_BUILD_CSS_DIR_PATH . '/main.css'), false, 'all');
    // wp_register_style( 'fonts', AQUILA_DIR_URI . '/assets/src/library/fonts/fonts.css', [], false, 'all');

    // Enqueue Styles
		/* Admin CSS */
		wp_enqueue_style('editor-sidebar', AQUILA_BUILD_CSS_URI . '/editor-sidebar.css' );
    wp_enqueue_style('bootstrap');
    // wp_enqueue_style('fonts');
    wp_enqueue_style('main');
  }

  public function register_admin_styles() {
		/* Admin CSS */
		wp_enqueue_style('editor-sidebar', AQUILA_BUILD_CSS_URI . '/editor-sidebar.css' );
  }

  public function register_scripts(){
    // Register Scripts
    wp_register_script('main', AQUILA_BUILD_JS_URI . '/main.js', ['jquery'], filemtime(AQUILA_BUILD_JS_DIR_PATH . '/main.js'), true);
    wp_register_script('bootstrap', AQUILA_DIR_URI . '/assets/src/library/js/bootstrap.min.js', ['jquery'], false, true);
    // Enqueue Scripts
    wp_enqueue_script('main');
    wp_enqueue_script('bootstrap');
  }

  public function dequeue_assets() {
    //Remove Gutenberg Block Library CSS from loading on the frontend
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wp-block-style');
  }

}