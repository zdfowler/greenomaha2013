<?php get_header(); ?>

    <div class="container marketing">
        <div class="row-fluid">
            <div class="span12">
                <h1>index.php</h1>
                <?php if (have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p><em><?php the_time('l, F jS, Y'); ?></em></p>
                <?php the_content(); ?>

            </div>

            <?php endwhile; else: ?>
                <p><?php _e('Sorry! No there are no posts.');?></p>
            <?php endif; ?>

        </div>
    </div>

    <div id="push"></div>

<?php get_footer(); ?>