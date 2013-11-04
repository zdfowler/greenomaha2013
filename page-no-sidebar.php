<?php
/* Template Name: No Sidebar */



get_header(); ?>

<div class="container">
    <div class="row-fluid">
        <div class="post_content span12">

            <?php if (have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php
            if($post->post_parent) {
                $p = get_post($post->post_parent);
                echo "<h1>" . strtoupper($p->post_title) . " &bull; " . get_the_title() . "</h1>";
            } else {
                echo "<h1>" . get_the_title() . "</h1>";
            }
            ?>
            <?php the_content(); ?>

        </div>


        <?php endwhile; else: ?>
            <p><?php _e('Sorry! That page does not exist.');?></p>
        <?php endif; ?>

    </div>
</div>

<div id="push"></div>

<?php get_footer(); ?>