<?php
/**
 * Plugin Name: GMB Posts Bridge
 * Plugin URI: https://github.com/dguardia/gmb-posts-bridge-fresh
 * Description: A clean, simple WordPress plugin for managing Google My Business posts with modern UI and customer API key override functionality.
 * Version: 1.0.0
 * Author: Your Name
 * License: GPL v2 or later
 * Text Domain: gmb-posts-bridge
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('GMB_POSTS_BRIDGE_VERSION', '1.0.0');
define('GMB_POSTS_BRIDGE_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('GMB_POSTS_BRIDGE_PLUGIN_URL', plugin_dir_url(__FILE__));

class GMBPostsBridge {
    
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        add_action('wp_ajax_gmb_save_settings', array($this, 'save_settings'));
        add_action('wp_ajax_gmb_test_connection', array($this, 'test_connection'));
    }
    
    public function init() {
        // Initialize plugin
        load_plugin_textdomain('gmb-posts-bridge', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }
    
    public function add_admin_menu() {
        add_menu_page(
            'GMB Posts Bridge',
            'GMB Posts',
            'manage_options',
            'gmb-posts-bridge',
            array($this, 'admin_page'),
            'dashicons-megaphone',
            30
        );
    }
    
    public function enqueue_admin_scripts($hook) {
        if ($hook !== 'toplevel_page_gmb-posts-bridge') {
            return;
        }
        
        // Enqueue Tailwind CSS from CDN
        wp_enqueue_style(
            'tailwindcss',
            'https://cdn.tailwindcss.com',
            array(),
            GMB_POSTS_BRIDGE_VERSION
        );
        
        // Enqueue custom admin styles
        wp_enqueue_style(
            'gmb-admin-styles',
            GMB_POSTS_BRIDGE_PLUGIN_URL . 'assets/admin.css',
            array(),
            GMB_POSTS_BRIDGE_VERSION
        );
        
        // Enqueue admin JavaScript
        wp_enqueue_script(
            'gmb-admin-script',
            GMB_POSTS_BRIDGE_PLUGIN_URL . 'assets/admin.js',
            array('jquery'),
            GMB_POSTS_BRIDGE_VERSION,
            true
        );
        
        // Localize script for AJAX
        wp_localize_script('gmb-admin-script', 'gmb_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('gmb_nonce')
        ));
    }
    
    public function admin_page() {
        include_once GMB_POSTS_BRIDGE_PLUGIN_DIR . 'admin/admin-ui.php';
    }
    
    public function save_settings() {
        check_ajax_referer('gmb_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }
        
        $settings = array(
            'api_key' => sanitize_text_field($_POST['api_key'] ?? ''),
            'client_id' => sanitize_text_field($_POST['client_id'] ?? ''),
            'client_secret' => sanitize_text_field($_POST['client_secret'] ?? ''),
            'location_id' => sanitize_text_field($_POST['location_id'] ?? ''),
            'allow_customer_override' => isset($_POST['allow_customer_override']) ? 1 : 0
        );
        
        update_option('gmb_posts_bridge_settings', $settings);
        
        wp_send_json_success('Settings saved successfully!');
    }
    
    public function test_connection() {
        check_ajax_referer('gmb_nonce', 'nonce');
        
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }
        
        // Simple connection test (placeholder)
        $settings = get_option('gmb_posts_bridge_settings', array());
        
        if (empty($settings['api_key']) || empty($settings['client_id'])) {
            wp_send_json_error('Please configure your API credentials first.');
        }
        
        // In a real implementation, this would test the actual GMB API connection
        wp_send_json_success('Connection test successful! (This is a placeholder - implement actual GMB API test)');
    }
    
    public static function get_settings() {
        return get_option('gmb_posts_bridge_settings', array(
            'api_key' => '',
            'client_id' => '',
            'client_secret' => '',
            'location_id' => '',
            'allow_customer_override' => 0
        ));
    }
}

// Initialize the plugin
new GMBPostsBridge();

// Activation hook
register_activation_hook(__FILE__, 'gmb_posts_bridge_activate');
function gmb_posts_bridge_activate() {
    // Create default settings
    if (!get_option('gmb_posts_bridge_settings')) {
        add_option('gmb_posts_bridge_settings', array(
            'api_key' => '',
            'client_id' => '',
            'client_secret' => '',
            'location_id' => '',
            'allow_customer_override' => 0
        ));
    }
}

// Deactivation hook
register_deactivation_hook(__FILE__, 'gmb_posts_bridge_deactivate');
function gmb_posts_bridge_deactivate() {
    // Clean up if needed
}