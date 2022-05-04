<?php
/**
 * @package Auto Generate Navigation
 * @version 1.0
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
Version: 1.0
Author URI: https://www.emperinter.info
*/




function get_file(){
	echo '
		<link rel="stylesheet" href="'.$url.'/wp-content/plugins/Auto Generate Navigation/autoc.css">
		<script src="'.$url.'/wp-content/plugins/Auto Generate Navigation/autoc.min.js" async="async"></script>
	';
}

//		CDN Resource Host
//      https://yaohaixiao.github.io/autocjs/css/autoc.css
//      https://cdn.jsdelivr.net/gh/yaohaixiao/autocjs@2.0.1/src/css/autoc.css
//      https://cdn.jsdelivr.net/gh/yaohaixiao/autocjs/dist/autoc.min.js
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
	add_filter('wp_head', 'get_file');
	add_filter('wp_footer', 'addJs');
	add_filter('the_content', 'addIDBeforeContent');
}

if(!is_admin() and !is_category() and !is_archive()){ 
	add();
}
