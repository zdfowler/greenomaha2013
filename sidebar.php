<?php
/*
1. All sub pages of top-level page: if subpages exist.
2. Then, for each one of those, if I'm in it, display all children.
*/

  $children = wp_list_pages('title_li=&child_of='.get_post_top_ancestor_id().'&echo=0');
  if ($children) {
      ?>
      <div class="sidebar span3 offset1">
          <ul>
              <?php echo $children; ?>
          </ul>
      </div>
        <?php
  }
?>

