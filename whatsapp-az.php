<?php
/**
 * Plugin Name: WhatsApp AZ Button
 * Plugin URI: https://example.com
 * Description: A floating WhatsApp button with a customizable number.
 * Version: 1.0
 * Author: ~ayaz.K
 * Author URI: https://example.com
 * License: GPL2
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('WHATSAPP_AZ_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WHATSAPP_AZ_PLUGIN_URL', plugin_dir_url(__FILE__));

// Add menu for plugin settings
function whatsapp_az_add_menu() {
    add_options_page('WhatsApp AZ Settings', 'WhatsApp AZ', 'manage_options', 'whatsapp-az', 'whatsapp_az_settings_page');
}
add_action('admin_menu', 'whatsapp_az_add_menu');

// Register settings
function whatsapp_az_register_settings() {
    register_setting('whatsapp_az_settings_group', 'whatsapp_az_number');
}
add_action('admin_init', 'whatsapp_az_register_settings');

// Plugin settings page
function whatsapp_az_settings_page() {
    ?>
    <div class="wrap">
        <h2>WhatsApp AZ Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('whatsapp_az_settings_group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">WhatsApp Number (Include Country Code)</th>
                    <td><input type="text" name="whatsapp_az_number" value="<?php echo esc_attr(get_option('whatsapp_az_number', '+919810420969')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Enqueue styles and scripts
function whatsapp_az_enqueue_assets() {
    wp_enqueue_style('whatsapp-az-style', WHATSAPP_AZ_PLUGIN_URL . 'whatsapp-az.css');
}
add_action('wp_enqueue_scripts', 'whatsapp_az_enqueue_assets');

// Add WhatsApp button to footer
function whatsapp_az_add_button() {
    $whatsapp_number = esc_attr(get_option('whatsapp_az_number', '999603223'));
    ?>
    <div id="whatsapp">
        <a href="https://wa.me/<?php echo $whatsapp_number; ?>?text=I%20am%20interested%20in%20your%20products" target="_blank" title="WhatsApp">
            <div id="whatsappMain"></div>
        </a>
    </div>
    <?php
}
add_action('wp_footer', 'whatsapp_az_add_button');

// Add styles
function whatsapp_az_add_styles() {
    ?>
    <style>
        #whatsapp {
            position: fixed;
            left: 30px;
            bottom: 50px;
            width: 70px;
            height: 70px;
            cursor: pointer;
            opacity: 1;
            z-index: 99990;
        }

        #whatsapp #whatsappMain {
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0);
            width: 70px;
            height: 70px;
            color: #40c351;
            z-index: 9;
            animation: zcwmini2 1.5s ease-out infinite;
            position: relative;
        }

        #whatsapp #whatsappMain:before {
            content: "";
            position: absolute;
            width: 65%;
            height: 65%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-image: url('<?php echo WHATSAPP_AZ_PLUGIN_URL; ?>images/WhatsApp.svg');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: contain;
            animation: zcwphone2 1.5s linear infinite;
        }

        @keyframes zcwphone2 {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            25% { transform: translate(-50%, -50%) rotate(30deg); }
            50% { transform: translate(-50%, -50%) rotate(0deg); }
            75% { transform: translate(-50%, -50%) rotate(-30deg); }
            100% { transform: translate(-50%, -50%) rotate(0deg); }
        }

        @keyframes zcwmini2 {
            0% { box-shadow: 0 0 8px 6px rgba(64, 195, 81, 0.5), 0 0 0 0 rgba(0,0,0,0), 0 0 0 0 rgba(64, 195, 81, 0.5); }
            10% { box-shadow: 0 0 8px 6px, 0 0 12px 10px rgba(0,0,0,0), 0 0 12px 14px; }
            100% { box-shadow: 0 0 8px 6px rgba(64, 195, 81, 0), 0 0 0 40px rgba(0,0,0,0), 0 0 0 40px rgba(64, 195, 81, 0); }
        }
    </style>
    <?php
}
add_action('wp_head', 'whatsapp_az_add_styles');