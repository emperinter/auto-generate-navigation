<?php
/**
 * @package Auto Generate Navigation
 * @version 1.1
 * 
 *  From: https://github.com/yaohaixiao/autocjs
 *  License： MIT License 
 * 
 */

/*
Plugin Name: Auto Generate Navigation 
Plugin URI: https://github.com/emperinter/Auto-Generate-Navigation
Description: A plugin which can generate a navigation catalogue on your WordPress post!（文章目录生成器！）
Author: emperinter
Version: 1.1
Author URI: https://www.emperinter.info
*/

//		CDN Resource Host
//      https://yaohaixiao.github.io/autocjs/css/autoc.css
//      https://cdn.jsdelivr.net/gh/yaohaixiao/autocjs@2.0.1/src/css/autoc.css
//      https://cdn.jsdelivr.net/gh/yaohaixiao/autocjs/dist/autoc.min.js


function add_styles() {
	wp_register_style('plugin_stylesheet_css', plugins_url('autoc.css', __FILE__));
	wp_enqueue_style('plugin_stylesheet_css');
	wp_register_script('plugin_stylesheet_js', plugins_url('autoc.min.js', __FILE__));
	wp_enqueue_script('plugin_stylesheet_js');
}

add_action( 'wp_enqueue_scripts', 'add_styles' );  


function addJs(){
	echo"
		<script>
			let navigation = new AutocJs({
				article: '#AgnArticle',
				selector: 'h1,h2,h3,h4,h5,h6',
				title: '文章目录导航',
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


function addIDBeforeContent($content){
	return '<div id="AgnArticle">' . $content . '</div>';
}

function add(){	
	add_filter('wp_footer', 'addJs');
	add_filter('the_content', 'addIDBeforeContent');
}

if(!is_admin() and !is_category() and !is_archive()){ 
	add();
}
