<?php


/* Support Custom Navigation menus */
function goc_register_my_menu() {
    register_nav_menu('main-nav-menu',__( 'Main Navigation' ));
}
add_action( 'init', 'goc_register_my_menu' );


/* Widgets -- Deal with this later. */
/* To enable, uncomment the following block. */
/*if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));*/