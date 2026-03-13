<?php
/**
 * Plugin Name: Braids CPT
 * Description: Custom post type and fields for BraidsInBorås services
 * Version: 1.2
 */

if (!defined('ABSPATH')) exit;

// ── Register Service CPT ──────────────────────────────────────────────────────
add_action('init', function () {
    register_post_type('service', [
        'labels' => [
            'name'          => 'Services',
            'singular_name' => 'Service',
            'add_new_item'  => 'Add New Service',
            'edit_item'     => 'Edit Service',
        ],
        'public'              => true,
        'show_in_rest'        => true,
        'show_in_graphql'     => true,
        'graphql_single_name' => 'service',
        'graphql_plural_name' => 'services',
        'supports'            => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'menu_icon'           => 'dashicons-scissors',
    ]);
});

// ── Register Meta Fields ──────────────────────────────────────────────────────
add_action('init', function () {
    $fields = [
        'price' => [
            'type'         => 'integer',
            'description'  => 'Service price in SEK',
            'single'       => true,
            'show_in_rest' => true,
            'default'      => 0,
        ],
        'category' => [
            'type'         => 'string',
            'description'  => 'Service category',
            'single'       => true,
            'show_in_rest' => true,
            'default'      => '',
        ],
        'is_popular' => [
            'type'         => 'boolean',
            'description'  => 'Featured service',
            'single'       => true,
            'show_in_rest' => true,
            'default'      => false,
        ],
        'description_sv' => [
            'type'         => 'string',
            'description'  => 'Swedish description',
            'single'       => true,
            'show_in_rest' => true,
            'default'      => '',
        ],
        'available' => [
            'type'         => 'boolean',
            'description'  => 'Whether service is accepting bookings',
            'single'       => true,
            'show_in_rest' => true,
            'default'      => true,
        ],
    ];

    foreach ($fields as $key => $args) {
        register_post_meta('service', $key, $args);
    }
});

// ── Expose Fields to WPGraphQL ────────────────────────────────────────────────
add_action('graphql_register_types', function () {
    register_graphql_fields('Service', [
        'price' => [
            'type'        => 'Int',
            'description' => 'Service price in SEK',
            'resolve'     => fn($post) => (int) get_post_meta($post->databaseId, 'price', true),
        ],
        'category' => [
            'type'        => 'String',
            'description' => 'Service category',
            'resolve'     => fn($post) => get_post_meta($post->databaseId, 'category', true),
        ],
        'isPopular' => [
            'type'        => 'Boolean',
            'description' => 'Featured service flag',
            'resolve'     => fn($post) => (bool) get_post_meta($post->databaseId, 'is_popular', true),
        ],
        'descriptionSv' => [
            'type'        => 'String',
            'description' => 'Swedish description',
            'resolve'     => fn($post) => get_post_meta($post->databaseId, 'description_sv', true),
        ],
        'available' => [
            'type'        => 'Boolean',
            'description' => 'Whether service is accepting bookings',
            'resolve'     => function($post) {
                $val = get_post_meta($post->databaseId, 'available', true);
                // Default to true if not set
                return $val === '' ? true : (bool) $val;
            },
        ],
    ]);
});

// ── Allow CORS ────────────────────────────────────────────────────────────────
add_filter('allowed_http_origins', function ($origins) {
    $origins[] = 'http://localhost:3000';
    $origins[] = 'https://braidsinboras.se';
    $origins[] = 'https://braidsinboras.vercel.app';
    return $origins;
});