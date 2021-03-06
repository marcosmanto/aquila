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
    add_action('enqueue_block_assets', [$this, 'enqueue_editor_assets']);
  }

  public function register_styles() {
    // Register Styles
    wp_register_style( 'bootstrap', AQUILA_DIR_URI . '/assets/src/library/css/bootstrap.min.css', [], false, 'all' );
    wp_register_style( 'slick-css', AQUILA_BUILD_LIB_URI . '/css/slick.css', [], false, 'all' );
		wp_register_style( 'slick-theme-css', AQUILA_BUILD_LIB_URI . '/css/slick-theme.css', ['slick-css'], false, 'all' );
    wp_register_style('main', AQUILA_BUILD_CSS_URI . '/main.css', ['bootstrap'], filemtime(AQUILA_BUILD_CSS_DIR_PATH . '/main.css'), false, 'all');
    // wp_register_style( 'fonts', AQUILA_DIR_URI . '/assets/src/library/fonts/fonts.css', [], false, 'all');

    // Enqueue Styles
		/* Admin CSS */
		wp_enqueue_style('editor-sidebar', AQUILA_BUILD_CSS_URI . '/editor-sidebar.css' );
    wp_enqueue_style('bootstrap');
		wp_enqueue_style( 'slick-css' );
		wp_enqueue_style( 'slick-theme-css' );
    // wp_enqueue_style('fonts');
    wp_enqueue_style('main');
  }

  public function register_admin_styles() {
		/* Admin CSS */
		wp_enqueue_style('editor-sidebar', AQUILA_BUILD_CSS_URI . '/editor-sidebar.css' );
  }

  public function register_scripts(){
    // Register Scripts
    wp_register_script( 'slick-js', AQUILA_BUILD_LIB_URI . '/js/slick.min.js', ['jquery'], false, true );
    wp_register_script('main', AQUILA_BUILD_JS_URI . '/main.js', ['jquery'], filemtime(AQUILA_BUILD_JS_DIR_PATH . '/main.js'), true);
    wp_register_script('bootstrap', AQUILA_DIR_URI . '/assets/src/library/js/bootstrap.min.js', ['jquery'], false, true);
    // Enqueue Scripts
    wp_enqueue_script('bootstrap');
    wp_enqueue_script( 'slick-js' );
    wp_enqueue_script('main');
  }

  public function enqueue_editor_assets() {
    $asset_config_file = sprintf('%s/assets.php', AQUILA_BUILD_PATH);

    if( ! file_exists( $asset_config_file  )) {
      return;
    }

    $asset_config = require_once $asset_config_file;

    if ( empty( $asset_config['js/editor.js'] ) ) {
      return;
    }

    $editor_asset = $asset_config['js/editor.js'];
    $js_dependencies = (!empty($editor_asset['dependencies'])) ? $editor_asset['dependencies'] : [];
    $version = (!empty($editor_asset['version'])) ? $editor_asset['version'] : filemtime($asset_config_file);

    // Theme Gutenberg block JS.
    if ( is_admin() ) {
      wp_enqueue_script(
        'aquila-block-js',
        AQUILA_BUILD_JS_URI . '/blocks.js',
        $js_dependencies,
        $version,
        true
      );
    }

    // Theme Gutenberg blocks CSS
    $css_dependencies = [
      'wp-block-library-theme',
      'wp-block-library'
    ];

    wp_enqueue_style(
      'aquila-blocks-css',
      AQUILA_BUILD_CSS_URI . '/blocks.css',
      $css_dependencies,
      filemtime(AQUILA_BUILD_CSS_DIR_PATH . '/blocks.css'),
      'all'
    );

  }

  public function dequeue_assets() {
    //Remove Gutenberg Block Library CSS from loading on the frontend
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wp-block-style');
  }

}