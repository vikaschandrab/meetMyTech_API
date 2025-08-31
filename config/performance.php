<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Performance Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for performance optimizations
    | that can be applied to the application.
    |
    */

    'cache' => [
        'views' => env('CACHE_VIEWS', true),
        'config' => env('CACHE_CONFIG', true),
        'routes' => env('CACHE_ROUTES', true),
        'profile_data' => env('CACHE_PROFILE_DATA', true),
        'blog_data' => env('CACHE_BLOG_DATA', true),
        'ttl' => env('CACHE_TTL', 3600), // 1 hour default
    ],

    'optimization' => [
        'lazy_loading' => env('LAZY_LOADING_ENABLED', true),
        'image_optimization' => env('IMAGE_OPTIMIZATION', true),
        'css_minification' => env('CSS_MINIFICATION', true),
        'js_minification' => env('JS_MINIFICATION', true),
        'gzip_compression' => env('GZIP_COMPRESSION', true),
    ],

    'database' => [
        'query_cache' => env('QUERY_CACHE_ENABLED', true),
        'eager_loading' => env('EAGER_LOADING_ENABLED', true),
        'index_optimization' => env('INDEX_OPTIMIZATION', true),
        'connection_pooling' => env('DB_CONNECTION_POOLING', false),
    ],

    'monitoring' => [
        'performance_logging' => env('PERFORMANCE_LOGGING', false),
        'slow_query_logging' => env('SLOW_QUERY_LOGGING', false),
        'memory_monitoring' => env('MEMORY_MONITORING', false),
    ],
];
