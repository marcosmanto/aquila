<?php
/**
 * Bootstraps the theme
 *
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class AQUILA_THEME {
  use Singleton;

  protected function __construct()
  {
    // load classes
    Assets::get_instance();
		Menus::get_instance();
		Meta_Boxes::get_instance();
		Sidebars::get_instance();
		Block_Patterns::get_instance();

    $this->setup_hooks();
  }

  protected function setup_hooks()
  {
    /**
     * Actions
     */
    add_action('after_setup_theme', [$this, 'setup_theme']);
  }

  public function setup_theme()
  {
    add_theme_support('title-tag');

		add_theme_support(
			'custom-logo',
			[
				'header-text' => [
					'site-title',
					'site-description',
				],
				'height'      => 100,
				'width'       => 400,
				'flex-height' => true,
				'flex-width'  => true,
			]
		);

		add_theme_support(
			'custom-background',
			[
				'default-color' => 'ffff00',
				'default-image' => '',
				'default-repeat' => 'no-repeat',
			]
		);

		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

		add_image_size( 'featured-thumbnail', 350, 233, true);

    add_theme_support( 'customize-selective-refresh-widgets' );

    add_theme_support( 'automatic-feed-links' );

		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			]
		);

    add_theme_support( 'wp-block-styles' );

		add_theme_support('align-wide');

		add_theme_support( 'editor-styles' );

		add_editor_style( 'assets/build/css/editor.css' );

		// Remove the core block patterns
		remove_theme_support( 'core-block-patterns' );

		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 1200;
		}

  }

}

