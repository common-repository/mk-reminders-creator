<?php
    /*
    Plugin Name: MK Reminders Creator
    Plugin URI: /mk-reminders-creator
    Description: Basic and Simple Reminders Creator
    Version: 1.0
    Author: Adem Mert Kocakaya
    Author URI: http://www.pigasoft.com
    License: GNU
    */
    
        if ( ! defined( 'ABSPATH' ) ) exit; 
    
        add_action('admin_menu', 'mk_reminders_creator');
        
            function mk_reminders_creator() {
                add_menu_page('MK Reminders Creator', 'MK Reminders Creator', 'manage_options', 'mk-reminders-creator', 'mk_reminders_creator_plugin', plugin_dir_url(__FILE__) .'mk-reminders-icon.png');
            }
 
            function mk_reminders_creator_plugin() {
                
	        wp_enqueue_style( 'mk_reminders_custom_styles', plugins_url( 'assets/css/style.css', __FILE__ ), '', '1.0' );
	        wp_enqueue_style( 'bootstrap_styles', plugins_url( 'assets/css/bootstrap.min.css', __FILE__ ), '', '1.0' ); ?>
            
                <html>
                    <head>
                        <meta name="author" content="Adem Mert Kocakaya">
                        <meta name="description" content="Pigasoft - MK Reminders Creator">
                        <meta http-equiv="content" content-type="text/html; charset=iso-8859-9">
                        <title>MK Reminders Creator - Pigasoft INC.</title>
                    </head>
                    <body>
                        <? include (plugin_dir_path(__FILE__) . 'includes/admin.php');  ?>
                    </body>
                </html>
                
<?php } ?>