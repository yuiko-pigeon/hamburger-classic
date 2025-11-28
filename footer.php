<footer class="l-footer">
            <div class="l-footer__inner">
                <div class="p-footer__color">
                    <div class="p-footer__image">   
                        <article class="l-footer__textarea"> 
                            
                            <section class="p-footer__text l-footer__text">
                                <?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
                                    <?php 
                                    wp_nav_menu( array(
                                        'theme_location' => 'footer-menu',
                                        'container'      => 'div',             // CSSに合わせてdivで囲む
                                        'container_class'=> 'menu-footer-container', // style.cssにあるクラス名
                                        'menu_class'     => 'p-footer__menu',  // ulにつけるクラス（任意）
                                        'depth'          => 1,                 // 1階層のみ
                                    ) ); 
                                    ?>
                                <?php else: ?>
                                    <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="p-link__footer">ショップ情報</a>
                                    <span style="color:#fff; padding:0 0.5rem;">｜</span>
                                    <a href="<?php echo esc_url( home_url( '/history/' ) ); ?>" class="p-link__footer">ヒストリー</a>
                                <?php endif; ?>
                            </section>

                            <section class="p-footer__text--small l-footer__text--small">
                                <a>CopyRight: yuiko</a>
                            </section>
                        </article>
                    </div>
                </div>
            </div>  
        </footer>
    </div><?php wp_footer(); ?>
</body>
</html>