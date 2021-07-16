<?php
/**
 * Register menus
 *
 * @package Aquila
 */

namespace AQUILA_THEME\Inc;

use AQUILA_THEME\Inc\Traits\Singleton;

class Menus {
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
    add_action( 'init', [$this, 'register_menus'] );

  }

  public function register_menus()
  {
    register_nav_menus(
      [
        'aquila-header-menu' => esc_html__( 'Header Menu', 'aquila' ),
        'aquila-footer-menu' => esc_html__( 'Footer Menu', 'aquila' )
      ]
    );
  }

  public function get_menu_id($location)
  {
    $locations = get_nav_menu_locations();
    $menu_id = $locations[$location];
    return !empty($menu_id) ? $menu_id : '';
  }

  public function get_child_menu_items( $menu_array, $parent_id )
  {
    return array_filter($menu_array, function($menu) use($parent_id){
        return intval($menu->menu_item_parent) === $parent_id;
      }
    );
  }

}