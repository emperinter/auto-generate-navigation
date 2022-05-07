<?php
/*
 * Plugin Name:       Auto Generate Navigation 
 * Plugin URI:        https://github.com/emperinter/auto-generate-navigation
 * Description:       A plugin which can generate a navigation catalogue on your WordPress post!（文章目录生成器！）
 * Version:           1.2
 * Requires at least: 4.6
 * Requires PHP:      5.6
 * Author:            emperinter
 * Author URI:        https://www.emperinter.info/about/
 * License:           GNU General Public License v2.0
 * License URI:       https://github.com/emperinter/auto-generate-navigation/blob/master/LICENSE
 * Update URI:        https://github.com/emperinter/auto-generate-navigation
 */

/**
 * @package Auto Generate Navigation
 * @version 1.2
 * 
 *  From: https://github.com/yaohaixiao/autocjs
 *  License： MIT License 
 * 
 */
//CDN Resource Host
//https://yaohaixiao.github.io/autocjs/css/autoc.css
//https://cdn.jsdelivr.net/gh/yaohaixiao/autocjs@2.0.1/src/css/autoc.css
//https://cdn.jsdelivr.net/gh/yaohaixiao/autocjs/dist/autoc.min.js

function auto_generate_navigate_styles() {
	wp_register_style('plugin_stylesheet_css', plugins_url('autoc.css', __FILE__));
	wp_enqueue_style('plugin_stylesheet_css');
	wp_register_script('plugin_stylesheet_js', plugins_url('autoc.min.js', __FILE__));
	wp_enqueue_script('plugin_stylesheet_js');
}

add_action( 'wp_enqueue_scripts', 'auto_generate_navigate_styles' );  


function auto_generate_navigate_js(){
	echo"
		<script>
			let navigation = new AutocJs({
				article: '#AgnArticle',
				selector: 'h1,h2,h3,h4,h5,h6',
				title: 'Navigation',
				position: 'outside',
				anchorURL: '',
				anchorAt: 'front',
				isGenerateOutline: true,
				isGenerateOutlineChapterCode: false,
				isGenerateHeadingChapterCode: false,
				isGenerateHeadingAnchor: false
			});

			navigation.reload({
				position: 'outside',
				isGenerateHeadingChapterCode: false
			})
		</script>
	";
}


function auto_generate_navigate_add_content_id($content){
	return '<div id="AgnArticle">' . $content . '</div>';
}

function auto_generate_navigate_add(){	
	add_filter('wp_footer', 'auto_generate_navigate_js');
	add_filter('the_content', 'auto_generate_navigate_add_content_id');
}

if(!is_admin() and !is_category() and !is_archive()){ 
	auto_generate_navigate_add();
}
