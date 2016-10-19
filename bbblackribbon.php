<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * Plugin Name: BillBuild Black Ribbon
 * Plugin URI: http://www.billbuild-studio.com
 * Description: This is a plugin that insert black ribbon to your site
 * Version: 1.0.0
 * Author: dekkeng
 * Author URI: http://www.billbuild-studio.com
 * License: GPL2
 */
define( 'BB_PLUGIN_DIR', plugin_dir_path(__FILE__)  );

// Plugin definitions
define('BB_PLUGIN_NAME', 'wp-black-ribbon');
define('BB_SLUG', 'bbblackribbon-id');
define('BB_OPT_NAME', 'bbblackribbonAdminOptions');
define('BB_ACTION_ACTIVATE', 'activate_bbblackribbon/bbblackribbon.php');
define('BB_LANG_TAG', 'bbblackribbon');
define('BB_MENU_SLUG', 'bbblackribbon_menu_id');
define('BB_UPD_SETTINGS', 'update_bbblackribbonSettings');

// Options from the Settings pannel
define('BB_OPT_LOCATION', 'bb_opt_location');
define('BB_OPT_IMAGE', 'bb_opt_image');

// This plugin declarations
define('BB_IMG_TOP_LEFT', 'blackribbon-top-left.png');
define('BB_IMG_TOP_RIGHT', 'blackribbon-top-right.png');
define('BB_IMG_BOTTOM_LEFT', 'blackribbon-bottom-left.png');
define('BB_IMG_BOTTOM_RIGHT', 'blackribbon-bottom-right.png');

function bb_load_plugin_textdomain() {
    load_plugin_textdomain( BB_LANG_TAG, FALSE, basename( dirname( __FILE__ ) ) . '/lang/' );
}
add_action( 'plugins_loaded', 'bb_load_plugin_textdomain' );

if (!class_exists("bbblackribbon")) {

    class bbblackribbon
    {
		var $adminOptionsName = BB_OPT_NAME;

        /**
         * Constructor
         */
        function bbblackribbon()
        {
            
        }
		function show_ribbon() {
			global $wpdb;
			$theOptions = get_option($this->adminOptionsName);
			?>
			<style>
			  div#BBBlackRibbon {
				  position: fixed;
				  z-index: 99999;
			  }

			  div#BBBlackRibbon img {
				  width: 130px;
				  height: 130px;
			  }
			</style>
			<div id='BBBlackRibbon' style='
			<?php
				switch($theOptions[BB_OPT_LOCATION]) {
					case 'bl': 
						$image = BB_IMG_BOTTOM_LEFT;
						echo 'bottom: 0px; left: 0px;';
					break;
					case 'br': 
						$image = BB_IMG_BOTTOM_RIGHT;
						echo 'bottom: 0px; right: 0px;';
					break;
					case 'tr': 
						$image = BB_IMG_TOP_RIGHT;
						echo 'top: 0px; right: 0px;';
					break;
					case 'tl': 
					default:
						$image = BB_IMG_TOP_LEFT;
						echo 'top: 0px; left: 0px;';
					break;
				}
			?>
			'>
				<img src="<?php echo plugins_url(BB_PLUGIN_NAME).'/images/'.$image; ?>" />
			</div>
			<?php
		}
		function getAdminOptions() 
		{
			$theOptions = array(
					BB_OPT_IMAGE => BB_IMG_TOP_LEFT,
					BB_OPT_LOCATION => 'tl',
				);
			$theOptions = get_option($this->adminOptionsName);
			if (!empty($theOptions))
			{
				foreach ($theOptions as $key => $option)
					$theOptions[$key] = $option;
			}
			update_option($this->adminOptionsName, $theOptions);
			return $theOptions;
		}
		function init() 
		{
			$this->getAdminOptions();
		}
		function printAdminPage() {
			$options = $this->getAdminOptions();
			if (isset($_POST[BB_UPD_SETTINGS])) {
				if (isset($_POST[BB_OPT_IMAGE])) {
					$options[BB_OPT_IMAGE] = $_POST[BB_OPT_IMAGE];
				}
				if (isset($_POST[BB_OPT_LOCATION])) {
					$options[BB_OPT_LOCATION] = $_POST[BB_OPT_LOCATION];
				}
				update_option($this->adminOptionsName, $options);
				print '<div class="updated"><p><strong>';
				_e("Settings updated", BB_LANG_TAG);
				print '</strong></p></div>';
			   
			}
			include('admin_settings.php'); // HTML form include
		}
	}
}
if (class_exists("bbblackribbon"))
{
    $inst_bbblackribbon = new bbblackribbon();
}
if (isset($inst_bbblackribbon))
{
    add_action('wp_footer', array(&$inst_bbblackribbon, 'show_ribbon'), 1);
    add_action(BB_ACTION_ACTIVATE,  array(&$inst_bbblackribbon, 'init'));
}

// Add command in menu Admin Settings
if (!function_exists("bbblackribbon_menu")) 
{
    function bbblackribbon_menu() {
        global $inst_bbblackribbon;
        if (!isset($inst_bbblackribbon)) {
            return;
        }
        if (function_exists('add_options_page')) 
        {
            add_options_page(__('WP Black Ribbon', BB_LANG_TAG), __('WP Black Ribbon', BB_LANG_TAG), 'manage_options', BB_MENU_SLUG, array(&$inst_bbblackribbon, 'printAdminPage'));
        }
    }
	add_action('admin_menu', 'bbblackribbon_menu');
}

// Add Settings command to plugin
if (!function_exists('bbblackribbon_action_links')) {
	add_filter( 'plugin_action_links_'.plugin_basename( __FILE__  ), 'bbblackribbon_action_links',  10, 2);
	function bbblackribbon_action_links( $links, $file ) {
		$links[] = '<a href="'.admin_url('options-general.php?page='.BB_MENU_SLUG).'">' . __('Settings') .'</a>';
		return $links;
	}
}
