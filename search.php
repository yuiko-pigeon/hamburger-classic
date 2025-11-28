<?php get_header(); ?>

    <main class="l-main l-main__font">
        <div class="p-hero__imageArea">
            <div class="p-hero__blackScreen">
                <p class="p-hero__title--area">
                    <span class="p-hero__title--menu">Search:</span>
                    <span class="p-hero__title--menucontent"><?php echo get_search_query(); ?></span>
                </p>
            </div>
            <img src="<?php echo get_theme_file_uri( './picture/three-burgers-on-brown-wooden-tray-between-white-ceramic-sp.webp' ); ?>" class="c-image__threeBurgers--sp" alt="Search Result">
            <img src="<?php echo get_theme_file_uri( './picture/three-burgers-on-brown-wooden-tray-between-white-ceramic-tb.webp' ); ?>" class="c-image__threeBurgers--tb" alt="3つのハンバーガー">
            <img src="<?php echo get_theme_file_uri( './picture/three-burgers-on-brown-wooden-tray-between-white-ceramic-pc.webp' ); ?>" class="c-image__threeBurgers--pc" alt="3つのハンバーガー">
        </div>

        <section class="p-article__area">
            <h2 class="c-title__arcive">検索結果一覧</h2>
            <p class="c-article c-article__lineheight u-weight__mediumBold">
                「<?php echo get_search_query(); ?>」の検索結果は以下の通りです。
            </p>
        </section>

        
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <section class="p-article p-article__cardList">    
            <figure class="p-card__figure--arcive">
                    <div class="p-card__arcive">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>" class="c-image__window" alt="<?php the_title(); ?>">
                        <?php else: ?>
                            <img src="<?php echo get_theme_file_uri( '/picture/window-zoom.webp' ); ?>" class="c-image__window" alt="No Image">
                        <?php endif; ?>

                        <figcaption class="p-card__textarea">
                            <h3 class="p-card__title--arcive"><?php the_title(); ?></h3>
                            <p class="p-card__text--arcive">
                            <?php echo my_custom_excerpt( 120 ); ?>
                            </p>
                            <div class="p-card__button--area">   
                                <button type="button" onclick="location.href='<?php the_permalink(); ?>'" class="c-button__transmit">
                                    <a href="<?php the_permalink(); ?>" class="c-button__text">詳しく見る</a>
                                </button>
                            </div>
                        </figcaption>
                    </div>
                </figure>
            <?php endwhile; else: ?>
                <p>検索結果が見つかりませんでした。</p>
            <?php endif; ?>
        </section>

        <!--SPページネーション-->
        <nav class="p-pagenation">
                    <?php
                        $current = max(1, get_query_var('paged'));
                        $max_page = $wp_query->max_num_pages;
                        ?>
                    <div class="p-pagenation__prev">
                        <?php if ($current > 1): ?>
                            <a rel="prev" href="<?php echo get_pagenum_link(1); ?>" class="c-pagenation__link">
                                <div class="p-pagenation__icon--area">
                                    <span class="p-pagenation__icon--prev"></span>
                                </div>
                            </a>
                        
                            <span class="p-pagenation__text--prev">
                                <a rel="prev" href="<?php
                                        global $paged;
                                        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                                        $prev_page = max(1, $paged - 1);
                                        echo get_pagenum_link($prev_page);
                                        ?>" class="c-pagenation__link">前へ</a>
                            </span>
                        <?php endif; ?>
                    </div>   

                    <div class="p-pagenation__next">
                        <?php if ($current < $max_page): ?>
                            <span class="p-pagenation__text--next">
                                <a rel="next" href="<?php 
                                global $paged;
                                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                                $next_page = $paged + 1;
                                echo get_pagenum_link($next_page);?>" class="c-pagenation__link">次へ</a>
                            </span> 

                        
                            <a rel="next" href="<?php echo get_pagenum_link($max_page); ?>" class="c-pagenation__link">
                                <div class="p-pagenation__icon--area">
                                    <span class="p-pagenation__icon--next"></span>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                </nav>
                <!--TBPCページネーション-->
                <nav class="p-pagenationTBPC">
                    <!--現ページ/総ページ数を表示--> 
                    <div class="p-pagenationTBPC__pagenumber">
                        page <?php echo max(1, get_query_var('paged')) . ' / ' . max(1,$wp_query->max_num_pages); ?>
                    </div>
                    <!--最初のページアイコン-->
                    <?php
                        $current = max(1, get_query_var('paged'));
                        $max_page = $wp_query->max_num_pages;
                        ?>
                    <?php if ($current > 1): ?>
                        <a rel="prev" href="<?php echo get_pagenum_link(1); ?>" class="c-pagenation__link">
                            <div class="p-pagenation__prev">
                                <div class="p-pagenation__icon--area">
                                    <span class="p-pagenation__icon--prev"></span>
                                </div>
                            </div>
                        </a>
                    <?php endif; ?>
                    <!--PageNaviプラグイン-->
                    <?php wp_pagenavi();?>
                    
                    <!--最後のページアイコン-->
                    <?php if ($current < $max_page): ?>
                    <a rel="next" href="<?php echo get_pagenum_link($max_page); ?>" class="c-pagenation__link">
                        <div class="p-pagenation__next"> 
                            <div class="p-pagenation__icon--area">
                                <span class="p-pagenation__icon--next"></span>
                            </div>
                        </div>
                    </a>
                    <?php endif; ?>
                </nav>
            </main>

    <?php get_sidebar(); ?>


<?php get_footer(); ?>