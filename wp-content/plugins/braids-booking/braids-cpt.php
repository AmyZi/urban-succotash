<?php
/**
 * Plugin Name: BraidsInBorås Custom Post Types
 * Description: Services CPT for braiding salon
 * Version: 1.1
 */

function braids_register_cpts() {
  register_post_type('service', [
    'labels' => [
      'name'          => 'Services',
      'singular_name' => 'Service',
      'add_new_item'  => 'Add New Service',
    ],
    'public'              => true,
    'show_in_rest'        => true,
    'show_in_graphql'     => true,
    'graphql_single_name' => 'service',
    'graphql_plural_name' => 'services',
    'supports'            => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
    'menu_icon'           => 'dashicons-scissors',
    'has_archive'         => true,
    'rewrite'             => ['slug' => 'services'],
  ]);
}
add_action('init', 'braids_register_cpts');

function braids_register_meta() {
  $fields = [
    'price'          => 'integer',
    'category'       => 'string',
    'is_popular'     => 'boolean',
    'description_sv' => 'string',
  ];
  foreach ($fields as $key => $type) {
    register_post_meta('service', $key, [
      'show_in_rest'  => true,
      'single'        => true,
      'type'          => $type,
      'auth_callback' => fn() => current_user_can('edit_posts'),
    ]);
  }
}
add_action('init', 'braids_register_meta');

function braids_register_graphql_fields() {
  register_graphql_fields('Service', [
    'price' => [
      'type'    => 'Int',
      'resolve' => fn($post) => (int) get_post_meta($post->databaseId, 'price', true),
    ],
    'category' => [
      'type'    => 'String',
      'resolve' => fn($post) => (string) get_post_meta($post->databaseId, 'category', true),
    ],
    'isPopular' => [
      'type'    => 'Boolean',
      'resolve' => fn($post) => (bool) get_post_meta($post->databaseId, 'is_popular', true),
    ],
    'descriptionSv' => [
      'type'    => 'String',
      'resolve' => fn($post) => (string) get_post_meta($post->databaseId, 'description_sv', true),
    ],
  ]);
}
add_action('graphql_register_types', 'braids_register_graphql_fields');

// Allow JWT auth header
add_filter('allowed_http_origins', function($origins) {
    $origins[] = 'http://localhost:3000';
    $origins[] = 'https://braidsinboras.se';
    return $origins;
});