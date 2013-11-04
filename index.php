<?php get_header(); ?>

    <div class="container">
        <div class="row-fluid">
            <div class="post_content span8">
                <h1 class="page_title">Updates and News</h1>
                <?php if (have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p><em><?php the_time('l, F jS, Y'); ?></em></p>
                <?php the_excerpt() ?>


                <?php endwhile; else: ?>
                    <p><?php _e('Sorry! No there are no posts.');?></p>
                <?php endif; ?>
            </div>
            <?php get_sidebar('blog') ?>
        </div>
    </div>

    <div id="push"></div>

<?php get_footer(); ?>