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
    add_action( 'wp_enqueue_scripts', [$this, 'register_styles'] );
    add_action('wp_enqueue_scripts', [$this, 'register_scripts']);

  }

  public function register_styles() {
    // Register Styles
    wp_register_style( 'style', get_stylesheet_uri(), [], filemtime( AQUILA_DIR_PATH . '/style.css' ) );
    wp_register_style( 'bootstrap', AQUILA_DIR_URI . '/assets/src/library/css/bootstrap.min.css', [], false );
    // Enqueue Styles
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('style');
  }

  public function register_scripts(){
    // Register Scripts
    wp_register_script('main', AQUILA_BUILD_JS_URI . '/main.js', ['jquery'], filemtime(AQUILA_BUILD_JS_DIR_PATH . '/main.js'), true);
    wp_register_script('bootstrap', AQUILA_DIR_URI . '/assets/src/library/js/bootstrap.min.js', ['jquery'], false, true);
    // Enqueue Scripts
    wp_enqueue_script('main');
    wp_enqueue_script('bootstrap');
  }

}