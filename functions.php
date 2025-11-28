<?php
// 1. 基本機能のサポート
add_theme_support( 'title-tag' ); // <title>タグの自動生成
add_theme_support( 'post-thumbnails' ); // アイキャッチ画像
add_theme_support( 'automatic-feed-links' ); // RSSフィード

/* * タイトル出力のカスタマイズ
 * title-tagサポートがあれば基本不要ですが、
 * 以前のこだわりの表示形式があれば残しておいてOKです。
 */
function hamburger_title( $title ) {
    if ( is_front_page() ) {
        $title = get_bloginfo( 'name', 'display' );
    } elseif ( is_singular() ) {
        $title = single_post_title( '', false );
    }
    return $title;
}
add_filter( 'pre_get_document_title', 'hamburger_title' );


// 2. CSSとJSの読み込み
function my_enqueue_files(){
    // WordPress付属のjQueryを読み込む（推奨）
    wp_enqueue_script('jquery');

    // デザイン用CSS (cssフォルダ内)
    wp_enqueue_style( 'main-style', get_theme_file_uri('/css/style.css'), array(), '1.0.0' );

    // JSファイル (jsフォルダ内)
    // 依存関係に 'jquery' を指定し、footerで読み込む(true)
    wp_enqueue_script( 'main-script', get_theme_file_uri('/js/main.js'), array('jquery'), '1.0.0', true );
}
add_action('wp_enqueue_scripts', 'my_enqueue_files');


// 3. 機能系ロジック（閲覧履歴など）

// 投稿ページのみ検索対象にする
function my_post_search($search) {
    if(is_search()) {
        $search .= " AND post_type = 'post'";
    }
    return $search;
}
add_filter('posts_search', 'my_post_search');

// 空欄検索でTOPページにリダイレクト
function empty_search_redirect( $wp_query ) {
    if ( $wp_query->is_main_query() && $wp_query->is_search() && ! $wp_query->is_admin() ) {
        $s = $wp_query->get( 's' );
        $s = trim( $s );
        if ( empty( $s ) ) {
            wp_safe_redirect( home_url('/') );
            exit; 
        }
    } 
}
add_action( 'parse_query', 'empty_search_redirect' );


// 4. メニューとサイドバーの設定

// メニュー位置の登録
add_action('after_setup_theme',function(){
    register_nav_menus( array(
        'sidebar-menu' => 'サイドバーのメニュー',
        'footer-menu' => 'フッターのメニュー'
    ));
});

/* * 重要：HTML構造を維持するためのカスタムウォーカー
 * これがないと、sidebar.phpで wp_nav_menu を使った時に
 * 静的コーディング通りのクラスが出力されません。
 */
class custom_walker_nav_menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '<ul class="l-sidebar__menu__list">';
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '</ul>';
    }
}
class custom_walker_nav_footermenu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '<ul class="p-footer__text">';
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '</ul>';
    }
}

// サイドバーのaタグにクラスを追加
function add_menu_link_class($atts, $item, $args,$depth) {
    if (is_object($args) && isset($args->theme_location) && $args->theme_location === 'sidebar-menu') {
        if($depth==0){
            $atts['class'] = 'l-sidebar__title--small c-menuItem__link';
        } elseif($depth==1){
            $atts['class'] = 'c-menuItem__link';
        }
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 10, 4);

// フッターのaタグにクラスを追加
function add_menu_footerLink_class($atts, $item, $args,$depth) {
    if (is_object($args) && isset($args->theme_location) && $args->theme_location === 'footer-menu') {
        if($depth==0){
            $atts['class'] = 'p-link__footer';
        }
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_footerLink_class', 10, 4);


// 5. コンテンツ調整

// 特定の固定ページでH2タグの中にspanを入れる（デザイン再現用）
function add_span($content) {
    // ページID 974 またはスラッグ index の場合
    // 必要に応じて条件を変更してください（例: 全ページなら if文を削除）
    if (is_page(974) || is_page('index') || is_front_page()) {
        $content = preg_replace_callback(
            '/<h2(.*?)>(.*?)<\/h2>/is',
            function($matches) {
                return '<h2' . $matches[1] . '><span>' . $matches[2] . '</span></h2>';
            },
            $content
        );
    }
    return $content;
}
add_filter('the_content', 'add_span');

// 投稿アーカイブページのURL設定 (例: /menu/ で一覧表示)
function post_has_archive($args, $post_type) {
    if ('post' == $post_type) {
        $args['rewrite'] = true;
        $args['has_archive'] = 'menu'; //URLスラッグ
    }
    return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);

// アーカイブタイトルの不要な文字（"カテゴリー:"など）を削除
add_filter( 'get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('',false);
    } elseif (is_tag()) {
        $title = single_tag_title('',false);
    } elseif (is_tax()) {
        $title = single_term_title('',false);
    } elseif (is_post_type_archive() ){
        $title = post_type_archive_title('',false);
    } elseif (is_date()) {
        $title = get_the_time('Y年n月');
    } elseif (is_search()) {
        $title = ''.esc_html( get_search_query(false) );
    } elseif (is_404()) {
        $title = '「404」ページが見つかりません';
    }
    return $title;
});

// カスタム投稿タイプにリビジョン（保存履歴）追加
function add_posttype_revisions() {
    add_post_type_support( 'column', 'revisions' );
}
add_action('init', 'add_posttype_revisions');

// デバッグ用（本番では消してもOK）
add_action( 'init', function() {
    // error_log( 'functions.php loaded' );
});

// 独自の抜粋表示関数（文字数指定可能）
function my_custom_excerpt( $length = 120 ) {
    // 1. 抜粋欄に入力があればそれを、なければ本文を取得
    if ( has_excerpt() ) {
        $text = get_the_excerpt();
    } else {
        $text = get_the_content();
        $text = strip_shortcodes( $text ); // ショートコード削除
    }

    // 2. HTMLタグと改行を削除
    $text = wp_strip_all_tags( $text );
    $text = str_replace( array("\r", "\n"), '', $text );

    // 3. 指定した文字数でカット
    if ( mb_strlen( $text ) > $length ) {
        $text = mb_substr( $text, 0, $length ) . '...';
    }

    return $text;
}