

<?php
/**
 * Plugin Name: WhatsApp AZ Button
 * Plugin URI: https://azcreations.in/whatsapp-az
 * Description: A floating WhatsApp button with animation.
 * Version: 1.0
 * Author: ~ayaz.K
 * Author URI: https://azcreations.in
 * License: GPL2
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function whatsapp_az_enqueue_styles() {
    wp_register_style('whatsapp-az-style', false);
    wp_enqueue_style('whatsapp-az-style');
    
    $custom_css = "
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
            border-radius: 50% !important;
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
            background-image: url('" . plugin_dir_url(__FILE__) . "/images/whatsapp.png');
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
            0% { box-shadow: 0 0 8px 6px rgba(64, 195, 81, 0.5); }
            100% { box-shadow: 0 0 8px 6px rgba(64, 195, 81, 0); }
        }
    ";
    wp_add_inline_style('whatsapp-az-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'whatsapp_az_enqueue_styles');

function whatsapp_az_button() {
    echo '<div id="whatsapp">
            <a href="https://wa.me/+918888888888?text=I am interested in Your Products" target="_blank" title="Whatsapp">
                <div id="whatsappMain"></div>
            </a>
          </div>';
}
add_action('wp_footer', 'whatsapp_az_button');
?>