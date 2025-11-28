<?php get_header(); ?>

<?php 
    if( have_posts()):
        while( have_posts()):
            the_post(); ?>
            <main class="l-main l-main__font l-main__color">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
                <div class="p-hero__singleArea">
                            <img src="<?php the_field('hero'); ?>" class="c-image__hero--sp" />
                            <img src="<?php the_field('hero_tb'); ?>" class="c-image__hero--tb" />
                            <img src="<?php the_field('hero_pc'); ?>" class="c-image__hero--pc" />
                            <h1 class="c-title__hero--single"><?php the_title(); ?></h1>
                </div>

            <div class="post-content c-article u-weight__mediumBold u-margin__left--topic u-width__tbLarge u-margin__bottom--textBlock u-lineheight">
                <?php the_content(); ?>
            </div>

        <?php endwhile; endif; ?>
    </main>

    <?php get_sidebar(); ?>


<?php get_footer(); ?>