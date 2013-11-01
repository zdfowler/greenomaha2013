
<?php get_header(); ?>

<div class="container marketing">
    <div class="row-fluid">
        <div class="span8">
            <?php if (have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <h2><?php echo strtoupper(get_the_title())?></h2>
            <p><em><?php the_time('l, F jS, Y'); ?></em></p>
            <?php the_content(); ?>
            <hr>
            <?php comments_template(); ?>
        </div>


        <?php get_sidebar(); ?>

        <?php endwhile; else: ?>
            <p><?php _e('Sorry! That page does not exist.');?></p>
        <?php endif; ?>

    </div>
</div>

<div id="push"></div>

<?php get_footer(); ?>