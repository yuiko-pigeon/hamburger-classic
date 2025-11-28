<?php get_header(); ?>

    <main class="l-main l-main__font l-main__color">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
            <div class="p-hero__singleArea">
                <?php if ( has_post_thumbnail() ) : ?>
                    <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>" class="p-hero__thumbnail" alt="<?php the_title(); ?>">
                <?php else: ?>
                    <img src="<?php echo get_theme_file_uri( '/picture/ham-burger-with-vegetables-PC.webp' ); ?>" class="p-hero__thumbnail" alt="<?php the_title(); ?>">
                <?php endif; ?>
                
                <h1 class="c-title__hero--single"><?php the_title(); ?></h1>
            </div>

            <section>
                <div class="c-article u-weight__mediumBold u-margin__left--topic u-width__tbLarge u-margin__bottom--textBlock u-lineheight">
                    <?php the_content(); ?>
                </div>
            </section>

        <?php endwhile; endif; ?>
    </main>

    <?php get_sidebar(); ?>

<?php get_footer(); ?>