<?php
/**
 * @package Auto Generate Navigation
 * @version 1.1
 */

/*
Plugin Name: Auto Generate Navigation | (自动生成导航)
Plugin URI: https://github.com/emperinter/auto-generate-navigation
Description: A plugin which can generate a navigation on your post!
Author: emperiter
Version: 1.1
Author URI: https://www.emperinter.info
*/

function get_cdn_file(){
    echo '
        <link href="https://cdn.jsdelivr.net/gh/yaohaixiao/outline.js/outline.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/gh/yaohaixiao/outline.js/outline.min.js"></script>
    ';
}

// 本地
// function get_local_file() {
// 	wp_register_style('plugin_stylesheet_css', plugins_url('outline.min.css', __FILE__));
// 	wp_enqueue_style('plugin_stylesheet_css');
// 	wp_register_script('plugin_stylesheet_js', plugins_url('outline.min.js', __FILE__));
// 	wp_enqueue_script('plugin_stylesheet_js');
// }


function addJs() {
    // Get the hasToolbar option from WordPress and convert it to a boolean
    
    $showCodeValue = (int) get_option('auto_generate_navigation_show_code');
    $showCode = $showCodeValue === 1 ? 'true' : 'false';
	
	$animationCurrentValue = (int) get_option('auto_generate_navigation_animation_current');
    $animationCurrent = $animationCurrentValue === 1 ? 'true' : 'false';
	
    $hasToolbarValue = (int) get_option('auto_generate_navigation_animation_has_toolbar');
    $hasToolbar = $hasToolbarValue === 1 ? 'true' : 'false';

    echo "
        <script>
          (function(){
            const defaults = Outline.DEFAULTS;
            let outline;
            
            defaults.selector = '" . esc_attr(get_option('auto_generate_navigation_selector')) . "';
            defaults.position = '" . esc_attr(get_option('auto_generate_navigation_position')) . "';
            defaults.stickyHeight = ". esc_attr(get_option('auto_generate_navigation_sticky_height')) . ";
            defaults.parentElement = '" . esc_attr(get_option('auto_generate_navigation_parent_element')) . "';
            defaults.articleElement = '" . esc_attr(get_option('auto_generate_navigation_article_element')) . "';
            defaults.placement = '" . esc_attr(get_option('auto_generate_navigation_placement')) . "';
            defaults.showCode = " . ($showCode === 'true' ? 'true' : 'false') . ";
            defaults.animationCurrent = " . ($animationCurrent === 'true' ? 'true' : 'false') . ";			
            defaults.hasToolbar = " . ($hasToolbar === 'true' ? 'true' : 'false') . ";
            defaults.homepage = '" . esc_attr(get_option('auto_generate_navigation_homepage')) . "';
            defaults.git = '" . esc_attr(get_option('auto_generate_navigation_git')) . "';
            
            outline = new Outline(defaults);
          })();
        </script>
    ";
}


function auto_generate_navigation_menu() {
    add_options_page(
        'Auto Generate Navigation Settings',
        'Auto Generate Navigation',
        'manage_options',
        'auto_generate_navigation_settings',
        'auto_generate_navigation_settings_page'
    );
}

// Display the settings page
function auto_generate_navigation_settings_page() {
    // Save settings
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verify the nonce
        if (!wp_verify_nonce($_POST['auto_generate_navigation_nonce'], 'auto_generate_navigation_nonce')) {
           wp_die('Nonce verification failed.');
        }

        // Handle form submission and save settings
		$article_element = isset($_POST['articleElement']) ? sanitize_text_field($_POST['articleElement']) : '#article';
        $selector = isset($_POST['selector']) ? sanitize_text_field($_POST['selector']) : 'h1,h2,h3,h4,h5';
        $position = isset($_POST['position']) ? sanitize_text_field($_POST['position']) : 'relative';
        $title = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : 'Title';
        $scroll_element = isset($_POST['scrollElement']) ? sanitize_text_field($_POST['scrollElement']) : 'html,body';
        $parent_element = isset($_POST['parentElement']) ? sanitize_text_field($_POST['parentElement']) : '#aside';
        $placement = isset($_POST['placement']) ? sanitize_text_field($_POST['placement']) : 'ltr';
        $sticky_height = isset($_POST['stickyHeight']) && is_numeric($_POST['stickyHeight']) ? sanitize_text_field($_POST['stickyHeight']) : 86;
        $show_code = isset($_POST['showCode']) ? true : false;
        $animation_current = isset($_POST['animationCurrent']) ? true : false;
        $has_toolbar = isset($_POST['hasToolbar']) ? true : false;
      	// $anchor_url = isset($_POST['anchorURL']) && filter_var($_POST['anchorURL'], FILTER_VALIDATE_URL) ?sanitize_text_field($_POST['anchorURL']) : '';
        $homepage = isset($_POST['homepage']) ? sanitize_text_field($_POST['homepage']) : '/';
        $git = isset($_POST['git']) ? sanitize_text_field($_POST['git']) : 'https://github.com/emperinter/auto-generate-navigation';
		
		
		update_option('auto_generate_navigation_article_element', $article_element);
        update_option('auto_generate_navigation_selector', $selector);
        update_option('auto_generate_navigation_position', $position);
        update_option('auto_generate_navigation_title', $title);
        update_option('auto_generate_navigation_scroll_element', $scroll_element);
        update_option('auto_generate_navigation_parent_element', $parent_element);
        update_option('auto_generate_navigation_placement', $placement);
        update_option('auto_generate_navigation_sticky_height', $sticky_height);
        update_option('auto_generate_navigation_show_code', $show_code);
        update_option('auto_generate_navigation_animation_current', $animation_current);
        update_option('auto_generate_navigation_animation_has_toolbar', $has_toolbar);
     	// update_option('auto_generate_navigation_anchor_url', $anchor_url);
        update_option('auto_generate_navigation_homepage', $homepage);
        update_option('auto_generate_navigation_git', $git);

        echo '<div class="notice notice-success"><p>Settings saved.</p></div>';
    }

    // Display the settings form
    include_once 'settings-form.php';
}

// Add the menu
add_action('admin_menu', 'auto_generate_navigation_menu');

function add(){    
    add_filter('wp_head', 'get_file');
    add_filter('wp_footer', 'addJs');
}

if (!is_admin() && !is_category() && !is_archive()) { 
    add();
}
?>