<?php
/* Template Name: Contact Template */

get_header(); ?>

<div class="container marketing">
    <div class="row-fluid">
        <div class="post_content span8">

            <?php if (have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php
                echo "<h1 class=\"page_title\">" . get_the_title() . "</h1>";
            ?>
            <?php the_content(); ?>
        </div>
        <br><br>
        <div class="sidebar span4">
            <?php
                $p = get_post(4116);
                echo $p->post_content;
            ?>
        </div>

        <?php endwhile; else: ?>
            <p><?php _e('Sorry! That page does not exist.');?></p>
        <?php endif; ?>

    </div>
</div>

<div id="push"></div>

<?php get_footer(); ?>