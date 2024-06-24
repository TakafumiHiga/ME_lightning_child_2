<?php
/**
 * Lightning Child theme functions
 *
 * @package lightning
 */

/************************************************
 * 独自CSSファイルの読み込み処理
 *
 * 主に CSS を SASS で 書きたい人用です。 素の CSS を直接書くなら style.css に記載してかまいません.
 */

// 独自のCSSファイル（assets/css/）を読み込む場合は true に変更してください.
$my_lightning_additional_css = false;

if ( $my_lightning_additional_css ) {
	// 公開画面側のCSSの読み込み.
	add_action(
		'wp_enqueue_scripts',
		function() {
			wp_enqueue_style(
				'my-lightning-custom',
				get_stylesheet_directory_uri() . '/assets/css/style.css',
				array( 'lightning-design-style' ),
				filemtime( dirname( __FILE__ ) . '/assets/css/style.css' )
			);
		}
	);
	// 編集画面側のCSSの読み込み.
	add_action(
		'enqueue_block_editor_assets',
		function() {
			wp_enqueue_style(
				'my-lightning-editor-custom',
				get_stylesheet_directory_uri() . '/assets/css/editor.css',
				array( 'wp-edit-blocks', 'lightning-gutenberg-editor' ),
				filemtime( dirname( __FILE__ ) . '/assets/css/editor.css' )
			);
		}
	);
}

/************************************************
 * 独自の処理を必要に応じて書き足します
 */

//画像へのリンクを削除
add_filter( 'the_content', 'attachment_image_link_remove_filter' );
 function attachment_image_link_remove_filter( $content ) { 
$content = 
preg_replace(
 array('{<a(.*?)(wp-att|wp-content\/uploads)[^>]*><img}', 
'{ wp-image-[0-9]*" /></a>}'), 
array('<img','" />'), 
$content
 );
 return $content; 
}

/************************************************
 * // アクションフック、カスタムフィールドの追加がある場合には下記のファイルを有効化し記載する
 */
//require_once get_stylesheet_directory() . '/inc/action-hook.php';
//require_once get_stylesheet_directory() . '/inc/cf.php';

//body classにurlのclassを付与
function pagename_class($classes = ''){
  if ( !(is_home() || is_front_page())) {
    $page = get_post();
    $classes[] = $page->post_name; //スラッグ名取得
  }
  return $classes;
}
add_filter('body_class', 'pagename_class');

/************************************************
 * CSS、JSファイルのの追加
 */
function my_for_top() {
	// 追加したいCSSのURL.
	$src_add = get_stylesheet_directory_uri().'/add.css';
	$src_contact = get_stylesheet_directory_uri() . '/contact-form.css';
	// 特定のCSSの後で読み込ませたい場合はそのハンドル名（指定がなければ空の array() でも可）.
	$deps = array();
	// 'all'、'screen'、'handheld'、'print' など 対象とするメディア.
	$media = 'all';
	// バージョン番号
	$version = '1.0.0'; 

	// スタイルの追加
	wp_enqueue_style( 'top-css', $src_add, $deps, $version, $media );
	wp_enqueue_style( 'form-css', $src_contact, $deps, $version, $media);
}
add_action('wp_enqueue_scripts', 'my_for_top');



/************************************************
 * フォーム用-飯田追加
 */
function wpcf7_autop_none() {
  return false;
}
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_none');

/************************************************
 * YubinBangoライブラリ
 */
wp_enqueue_script( 'yubinbango', 'https://yubinbango.github.io/yubinbango/yubinbango.js', array(), null, true );