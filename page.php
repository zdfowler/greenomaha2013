
<?php get_header(); ?>

<div class="container marketing">
    <div class="row-fluid">
        <div class="span8">

            <?php if (have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php
            if($post->post_parent) {
                $p = get_post($post->post_parent);
                echo "<h2>" . strtoupper($p->post_title) . " &bull; " . get_the_title() . "</h2>";
            } else {
                echo "<h2>" . get_the_title() . "</h2>";
            }
            ?>
            <?php the_content(); ?>

        </div>


        <?php get_sidebar(); ?>


        <?php endwhile; else: ?>
            <p><?php _e('Sorry! That page does not exist.');?></p>
        <?php endif; ?>

    </div>
</div>

<div id="push"></div>

<?php get_footer(); ?>