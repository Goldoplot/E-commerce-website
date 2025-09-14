<?php

// includes/config.php - global config

// site infos
define('SITE_NAME', 'MyStore E-commerce');
define('SITE_TAGLINE', 'No Quality but lot of love and sweat');
define('SITE_EMAIL', 'contact@mystore.com');
define('SITE_PHONE', '+0123456789');

// paths and urls
define('BASE_URL', 'http://localhost/mystore/');
define('ADMIN_URL', BASE_URL . 'admin_area/');
define('USERS_URL', BASE_URL . 'users_area/');

// includes paths
define('BASE_PATH', './');
define('USERS_PATH', './users_area/');
define('ADMIN_PATH', './admin_area/');
define('ASSETS_PATH', './assets/');
define('IMAGES_PATH', './assets/images/');

// page config
// default page configuration
$default_page_config = [
    'page_title' => SITE_NAME,
    'brand_name' => SITE_NAME,
    'store_title' => SITE_NAME,
    'store_subtitle' => SITE_TAGLINE,
    'show_dropdown' => true,
    'call_cart_function' => false,
    'brands_title' => 'Brands',
    'categories_title' => 'Categories',
    'css_path' => BASE_PATH,
    'home_path' => BASE_PATH,
    'users_path' => USERS_PATH
];

// functions to manage page config

/**
 * Configure les variables de page en fusionnant avec les valeurs par défaut
 * @param array $page_config Configuration spécifique à la page
 * @return array Configuration finale
 */
function setup_page_config($page_config = [])
{
    global $default_page_config;
    $config = array_merge($default_page_config, $page_config);

    // let variables available globally
    foreach ($config as $key => $value) {
        $GLOBALS[$key] = $value;
    }

    return $config;
}

/**
 * Affiche le titre de la page avec le nom du site
 * @param string $page_title Titre de la page
 * @return string Titre formaté
 */
function get_page_title($page_title = '')
{
    return $page_title ? $page_title . ' - ' . SITE_NAME : SITE_NAME;
}

/**
 * Génère l'URL complète à partir d'un chemin relatif
 * @param string $path Chemin relatif
 * @return string URL complète
 */
function get_url($path = '')
{
    return BASE_URL . ltrim($path, './');
}

// specific configurations for existing pages

// predefined configurations for specific pages
$page_configs = [
    'index.php' => [
        'page_title' => 'Homepqge',
        'brand_name' => 'Demo Store',
        'store_title' => 'My Potential E-commerce',
        'store_subtitle' => 'Practice is the key to learn',
    ],

    'display_all.php' => [
        'page_title' => 'All Products',
        'brand_name' => 'My Portfolio Store',
        'store_title' => 'My Potential E-commerce',
        'store_subtitle' => 'Practice is the key to learn',
        'call_cart_function' => true
    ],

    'product_details.php' => [
        'page_title' => 'Product Details',
        'brand_name' => 'Demo Store',
        'store_title' => 'My Potential E-commerce',
        'store_subtitle' => 'Practice is the key to learn',
        'call_cart_function' => true
    ]
];

/**
 * automatic setup for current page based on its filename
 */
function auto_setup_page()
{
    global $page_configs;
    $current_file = basename($_SERVER['PHP_SELF']);

    $config = isset($page_configs[$current_file])
        ? $page_configs[$current_file]
        : [];

    return setup_page_config($config);
}
