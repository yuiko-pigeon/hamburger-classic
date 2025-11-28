<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo get_theme_file_uri( '/picture/favicon.ico' ); ?>" id="favicon">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_theme_file_uri( '/picture/apple-touch-icon-180x180.png' ); ?>">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="l-wrapper" id="js-wrapper">
        <header class="l-header">
            <button type="button" class="l-header__title__small" id="js-hamburger">Menu</button>
            <div class="l-header__article">
                <h1 class="l-header__title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="text-decoration:none; color:inherit;">Hamburger</a>
                </h1>
                
                <form class="p-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" name="search-form">
                    <div class="p-searchform__box">
                        <input type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="" class="p-searchform__input" id="js-search">
                    </div>
                    <input class="p-searchform__button" type="submit" value="検索">
                </form>
            </div>
        </header>