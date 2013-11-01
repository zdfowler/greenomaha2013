<?php
if($post->post_parent)
    $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
else
    $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
if ($children) { ?>
    <div class="side span3 offset1">
    <ul>
        <?php echo $children; ?>
    </ul>


    </div>
<?php }

?>

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

<?php endif; ?>
