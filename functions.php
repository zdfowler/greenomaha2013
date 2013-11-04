<?php
/* Include support for PHPExcel for dealing with uploads. */
include plugin_dir_path( __FILE__ ) . 'lib/PHPExcel.php';
include plugin_dir_path( __FILE__ ) . 'lib/Excel_Helper.php';


add_theme_support( 'post-thumbnails' );

if(!function_exists('get_post_top_ancestor_id')){
    /**
     * Gets the id of the topmost ancestor of the current page. Returns the current
     * page's id if there is no parent.
     *
     * @uses object $post
     * @return int
     */
    function get_post_top_ancestor_id(){
        global $post;

        if($post->post_parent){
            $ancestors = array_reverse(get_post_ancestors($post->ID));
            return $ancestors[0];
        }

        return $post->ID;
    }}
if(!function_exists('get_post_second_top_ancestor_id')){
    /**
     * Gets the id of the topmost ancestor of the current page. Returns the current
     * page's id if there is no parent.
     *
     * @uses object $post
     * @return int
     */
    function get_post_second_top_ancestor_id(){
        global $post;

        if($post->post_parent){
            $ancestors = array_reverse(get_post_ancestors($post->ID));
            return $ancestors[1];
        }

        return $post->ID;
    }}




/* Support Custom Navigation menus */
function goc_register_my_menu() {
    register_nav_menu('main-nav-menu',__( 'Main Navigation' ));
}
add_action( 'init', 'goc_register_my_menu' );


/* Widgets -- Deal with this later. */
/* To enable, uncomment the following block. */
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name' => __('Blog Sidebar'),
        'id' => 'goc-blog-posts',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));


/* Members Custom Post Type */

// Register Custom Post Type
function goc_cpt_members() {

    $labels = array(
        'name'                => 'Members',
        'singular_name'       => 'Member',
        'menu_name'           => 'Membership',
        'parent_item_colon'   => 'Parent Member:',
        'all_items'           => 'All Members',
        'view_item'           => 'View Member',
        'add_new_item'        => 'Add New Member',
        'add_new'             => 'New Member',
        'edit_item'           => 'Edit Member',
        'update_item'         => 'Update Member',
        'search_items'        => 'Search members',
        'not_found'           => 'No members found',
        'not_found_in_trash'  => 'No members found in Trash',
    );
    $args = array(
        'label'               => 'goc_member',
        'rewrite'             => array('slug' => 'members'),
        'description'         => 'Member Information',
        'labels'              => $labels,
        'supports'            => array( 'title','thumbnail'),
        'taxonomies'          => array(  ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 100,
        'menu_icon'           => get_stylesheet_directory_uri() . '/img/logo-16x16.png',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'goc_member', $args );

}

// Hook into the 'init' action
add_action( 'init', 'goc_cpt_members', 0 );


/* Add Meta Information to Member */
/*
 * Title == Name
 *  Fname, LName
 * Type/Level (taxonomy)
 * Amount
 * URL / Link
 * Company logo?
 * 
 * 
 */


/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function goc_cpt_member_add_custom_box() {

    $screens = array( 'goc_member');

    foreach ( $screens as $screen ) {

        add_meta_box(
            'goc_web_id',
            __( 'Member Details', 'goc_textdomain' ),
            'goc_cpt_member_name_custom_box',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'goc_cpt_member_add_custom_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function goc_cpt_member_name_custom_box( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'goc_cpt_member_inner_custom_box', 'goc_cpt_member_inner_custom_box_nonce' );

    /*
       * Use get_post_meta() to retrieve an existing value
       * from the database and use the value for the form.
       */
    $fname  = get_post_meta( $post->ID, 'goc_member_fname', true );
    $lname  = get_post_meta( $post->ID, 'goc_member_lname', true );
    $url  = get_post_meta(   $post->ID, 'goc_member_url', true );
    $since = get_post_meta(  $post->ID, 'goc_member_since', true);
    $org_or_individ = get_post_meta(  $post->ID, 'goc_member_org_or_individ', true);

    echo '<p>The title box above is how the member will be displayed.  Use the First and Last name boxes for sorting.</p>';
    echo '<label for="goc_member_fname">';
    _e( "First Name", 'goc_textdomain' );
    echo '</label> ';
    echo '<input type="text" id="goc_member_fname" name="goc_member_fname" value="' . esc_attr( $fname ) . '" size="25" />';
    echo '<br>';

    echo '<label for="goc_member_lname">';
    _e( "Last Name", 'goc_textdomain' );
    echo '</label> ';
    echo '<input type="text" id="goc_member_lname" name="goc_member_lname" value="' . esc_attr( $lname ) . '" size="25" />';
    echo '<br>';

    echo '<label for="goc_member_org_or_individ">';
    _e( "Is this member an organizational or individual member?", 'goc_textdomain' );
    echo '</label> ';

    echo '<select name="goc_member_org_or_individ">';
    echo '<option value="">Select</option>';
    echo '<option ';
    if ('org' == $org_or_individ)
        echo 'selected="selected"';
    echo '>Organizational</option>';
    echo '<option ';
    if ('individ' == $org_or_individ)
        echo 'selected="selected"';
    echo '>Individual</option>';
    echo '</select>';

    echo '<br>';

    echo '<label for="goc_member_since">';
    _e( "Member Since", 'goc_textdomain' );
    echo '</label> ';
    echo '<input type="text" id="goc_member_since" name="goc_member_since" value="' . esc_attr( $since ) . '" size="25" />';
    echo '<br>';



    echo '<br>';


    echo '<label for="goc_member_url">';
    _e( "Website URL", 'goc_textdomain' );
    echo '</label> ';
    echo '<input type="text" id="goc_member_url" name="goc_member_url" value="' . esc_attr( $url ) . '" size="65" />';
    echo '<br>';

    echo '<p>Select the member level to the right.  If this is a company, you can also upload the logo using the "Featured Image" section of this page.</p>';
}


/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function goc_cpt_member_save_postdata( $post_id ) {

    /*
       * We need to verify this came from the our screen and with proper authorization,
       * because save_post can be triggered at other times.
       */

    // Check if our nonce is set.
    if ( ! isset( $_POST['goc_cpt_member_inner_custom_box_nonce'] ) )
        return $post_id;

    $nonce = $_POST['goc_cpt_member_inner_custom_box_nonce'];

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'goc_cpt_member_inner_custom_box' ) )
        return $post_id;

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;

    // Check the user's permissions.
    // todo: zdf: change to goc_member??
    if ( 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) )
            return $post_id;

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) )
            return $post_id;
    }

    /* OK, its safe for us to save the data now. */

    // Sanitize user input.
    $fname = sanitize_text_field( $_POST['goc_member_fname'] );
    $lname = sanitize_text_field( $_POST['goc_member_lname'] );
    $url = sanitize_text_field( $_POST['goc_member_url'] );
    $since = sanitize_text_field( $_POST['goc_member_since'] );
    $org_or_individ = sanitize_text_field($_POST['goc_member_org_or_individ']);

    // Update the meta field in the database.
    update_post_meta( $post_id, 'goc_member_fname', $fname );
    update_post_meta( $post_id, 'goc_member_lname', $lname );
    update_post_meta( $post_id, 'goc_member_url', $url );
    update_post_meta( $post_id, 'goc_member_org_or_individ', $org_or_individ );

    update_post_meta( $post_id, 'goc_member_since', $since );

}
add_action( 'save_post', 'goc_cpt_member_save_postdata' );








/* Extra Menu Feature: Upload Members */


/** Upload Artist Info Menu Page */

add_action('admin_menu', 'goc_register_upload');

function goc_register_upload() {
    add_submenu_page( 'edit.php?post_type=goc_member', 'Upload Members', 'Upload Members', 'manage_options', 'goc_upload', 'goc_upload_form' );
}

function goc_upload_form() {

    if (isset($_POST['clear_members'])) {
        $mycustomposts = get_posts( array( 'post_type' => 'goc_member', 'numberposts' => 100000) );
        foreach( $mycustomposts as $mypost ) {
            // Delete's each post.
            wp_delete_post( $mypost->ID, true);
            // Set to False if you want to send them to Trash.
        }
    }


    //must check that the user has the required capability
    if (!current_user_can('manage_options'))
    {
        wp_die( __('You do not have sufficient permissions to access this page.') );
    }

    // variables for the field and option names
    $hidden_field_name = 'mt_submit_hidden';
    $data_field_name = 'xlsfile';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {


        // Read their posted value

        // pull in CSV data
        $filename = $_FILES['xlsfile']['tmp_name'];



        // Type-checking of Excel file not needed. Tested with xls files and xlsx
        $objReader = PHPExcel_IOFactory::createReaderForFile($filename);

        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($filename);

        // Check to make sure the XLS has the right format.

        // Store collected data in an array based on date.
        $data = array();
        // Sort through individuals AND org members.
        // echo date('H:i:s') . " Iterate worksheets\n<br>";
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $wksTitle = $worksheet->getTitle();

            if ($wksTitle == 'LookupTables') {
                continue;
            }


            // Loop through members:
            //   Find by email address.  If match, update to XLS, replacing contents.
            //   If no match, creates new.
            foreach ($worksheet->getRowIterator() as $row) {
                // Skip first row, always.
                if ($row->getRowIndex() == 1) { continue; }

                $data['last'] 				= $worksheet->getCellByColumnAndRow('0',$row->getRowIndex())->getCalculatedValue();
                $data['first'] 				= $worksheet->getCellByColumnAndRow('1',$row->getRowIndex())->getCalculatedValue();
                $data['org']				= $worksheet->getCellByColumnAndRow('2',$row->getRowIndex())->getCalculatedValue();
                $data['address'] 			= $worksheet->getCellByColumnAndRow('3',$row->getRowIndex())->getCalculatedValue();
                $data['city'] 				= $worksheet->getCellByColumnAndRow('4',$row->getRowIndex())->getCalculatedValue();
                $data['state']				= $worksheet->getCellByColumnAndRow('5',$row->getRowIndex())->getCalculatedValue();
                $data['zip'] 				= $worksheet->getCellByColumnAndRow('6',$row->getRowIndex())->getCalculatedValue();
                $data['phone'] 				= $worksheet->getCellByColumnAndRow('7',$row->getRowIndex())->getCalculatedValue();
                $fe 						= $worksheet->getCellByColumnAndRow('8',$row->getRowIndex())->getCalculatedValue();
                $data['fax'] 				= strstr($fe,"@") ? '' : $fe;
                $data['email'] 				= strstr($fe,"@") ? $fe : '';
                if ($data['email'] == '') {
                    $data['email'] = $data['org'] . '@NoEmail';
                }

                $data['org_or_individ']		= $worksheet->getTitle() == 'Orgs' ? 'org' : 'individ';
                $data['membership_level']	= $worksheet->getCellByColumnAndRow('9',$row->getRowIndex())->getCalculatedValue();
                $data['amount']				= $worksheet->getCellByColumnAndRow('10',$row->getRowIndex())->getCalculatedValue();
                $data['joined']				= Excel_Helper::exceltomysqldate($worksheet->getCellByColumnAndRow('11',$row->getRowIndex())->getCalculatedValue(),"Y-m-d");
                $data['expires']			= Excel_Helper::exceltomysqldate($worksheet->getCellByColumnAndRow('12',$row->getRowIndex())->getCalculatedValue(),"Y-m-d");
                $data['last_renewal']		= Excel_Helper::exceltomysqldate($worksheet->getCellByColumnAndRow('13',$row->getRowIndex())->getCalculatedValue(),"Y-m-d");
                $data['council_interests']	= $worksheet->getCellByColumnAndRow('14',$row->getRowIndex())->getCalculatedValue();
                $data['do_not_publicize']	= strtolower($worksheet->getCellByColumnAndRow('15',$row->getRowIndex())->getCalculatedValue()) == 'x' ? 1 : 0; // X used in sheet

                $data['company_url']		= $worksheet->getCellByColumnAndRow('20',$row->getRowIndex())->getCalculatedValue();


                // Trim them up.
                foreach ($data as $k=>$v) {
                    $data[$k] = trim($v);
                }
                // Do some quick checks to skip adding bogus records.
                if ($data['first'] == '' && $data['last'] == '' && $data['org_or_individ'] == 'individ') {
                    continue;
                }

                if ($data['org'] == '' && $data['org_or_individ'] == 'org') {
                    continue;
                }



                if (! $data['do_not_publicize']) {
                    // Do save.

                    $fname  = sanitize_text_field($data['first']);
                    $lname  = sanitize_text_field($data['last']);
                    $url = sanitize_text_field($data['company_url']);
                    $since = sanitize_text_field($data['joined']);
                    $org_or_individ_sheet = sanitize_text_field($data['org_or_individ']);

                    // Title should be the individual person's name, unless it's a company.
                    $title = "$fname $lname";
                    if ($org_or_individ_sheet == 'org' && $data['org'] != '' )
                        $title = sanitize_text_field($data['org']);

                    $level = strtolower(sanitize_text_field($data['membership_level']));

                    // Set membership level. Weed out the gratis, then tack on the identifier for org/individ members
                    if ( 'gratis' != $level ) {
                        if ('org' == $org_or_individ_sheet) {
                            $level = $level . '-member-organizational';
                        } elseif ('individ' == $org_or_individ_sheet) {
                            $level = $level . '-member-individual';
                        }
                    }

                    $post = array(
                        'post_title' => $title,
                        'post_comment' => '',
                        'post_status' => 'publish',
                        'post_type' => 'goc_member'
                    );

                    $post_id = wp_insert_post($post);
                    update_post_meta( $post_id, 'goc_member_fname', $fname );
                    update_post_meta( $post_id, 'goc_member_lname', $lname );
                    update_post_meta( $post_id, 'goc_member_url', $url );
                    update_post_meta( $post_id, 'goc_member_org_or_individ', $org_or_individ_sheet );
                    update_post_meta( $post_id, 'goc_member_since', $since );

                    // Add goc member type.  Must match.
                    $tax = term_exists($level, 'goc_member_type');
                    wp_set_post_terms($post_id, $tax, 'goc_member_type');



                }


            }

        }

        ?>
        <div class="updated"><p><strong><?php _e('Members uploaded.', 'goc_textdomain' ); ?></strong></p></div>
    <?php

    }


    echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
    echo '<h2>Upload Membership Information</h2>';
    ?>
    <form name="upload" method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

        <p><?php _e("Excel File With Membership Information:", 'goc_textdomain' ); ?>
            <input type="file" name="<?php echo $data_field_name; ?>">
        </p>
        <p><input type="checkbox" name="clear_members" id="clear_members" checked> <label for="clear_members">Check this box to replace all member data.</label><br><bR>
        Members which appear in the spreadsheet are <em>alwaays</em> added to the website, never updated or replaced.
        </p>
        <hr>
        <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Upload') ?>" />
        </p>

    </form>
    <?php
    echo '</div>';

}



/* Menu Area */


/** modify admin screen to include columns */

// Change the columns for the edit CPT screen
function change_columns( $cols ) {
    $cols = array(
        'cb'            => '<input type="checkbox" />',
        'title'         => __( 'Shown as',      'trans' ),
        'fname'         => __( 'First Name',      'trans' ),
        'lname'          => __( 'Last Name', 'trans' ),
        'url'         => __('Website URL','trans'),
        'goc_member_type' => __( 'Member Type', 'trans' ),
        'since' => __( 'Member Since', 'trans' ),
        'date'          => __('Date','trans'),
    );
    return $cols;
}
add_filter( "manage_goc_member_posts_columns", "change_columns" );


function custom_columns( $column, $post_id ) {
    switch ( $column ) {
        case "fname":
            $fn = get_post_meta($post_id, 'goc_member_fname', true);
            echo $fn;
            break;
        case "lname":
            $ln = get_post_meta($post_id, 'goc_member_lname', true);
            echo $ln;
            break;
        case 'url':
            $url = get_post_meta( $post_id, 'goc_member_url', true);
            echo '<a href="' . $url . '" target="_blank">' . $url. '</a>';
            break;
        case "since":
            $since = get_post_meta($post_id, 'goc_member_since', true);
            echo $since;
            break;
        case 'goc_member_type' :
            $terms = get_the_term_list( $post_id , 'goc_member_type' , '' , ',' , '' );
            if ( is_string( $terms ) )
                echo $terms;
            break;
    }
}

add_action( "manage_posts_custom_column", "custom_columns", 10, 2 );

/** Apply sort-able columns */
add_filter("manage_edit-goc_member_sortable_columns","goc_member_sortable_columns");
function  goc_member_sortable_columns($columns) {
    $columns['fname'] = 'fname';
    $columns['lname'] = 'lname';
    $columns['since'] = 'since';
    $columns['url'] = 'url';

    return $columns;
}

add_filter('request','goc_member_orderby_override');
function goc_member_orderby_override($vars) {
    if ('goc_member' == $vars['post_type']) {

        if ( isset( $vars['orderby'] ) && 'lname' == $vars['orderby'] ) {
            $vars = array_merge( $vars, array(
                'meta_key' => 'goc_member_lname',
                'orderby' => 'meta_value'
            ) );
        } elseif (isset( $vars['orderby'] ) && 'fname' == $vars['orderby'] ) {
            $vars = array_merge( $vars, array(
                'meta_key' => 'goc_member_fname',
                'orderby' => 'meta_value'
            ) );
        }  elseif (isset( $vars['orderby'] ) && 'url' == $vars['orderby'] ) {
            $vars = array_merge( $vars, array(
                'meta_key' => 'goc_member_url',
                'orderby' => 'meta_value'
            ) );
        }  elseif (isset( $vars['orderby'] ) && 'since' == $vars['orderby'] ) {
            $vars = array_merge( $vars, array(
                'meta_key' => 'goc_member_since',
                'orderby' => 'meta_value'
            ) );
        } elseif (isset( $vars['orderby'] ) && 'date' == $vars['orderby'] ) {
            $vars = array_merge( $vars, array(
                'orderby' => 'date'
            ) );
        } elseif (isset( $vars['orderby'] ) && 'title' == $vars['orderby'] ) {
            $vars['orderby'] = 'title';
        } else {
            $vars['orderby'] = '';

        }
    }
    return $vars;

}

/**
 * Do custom tax filter box
 * See http://wp.tutsplus.com/tutorials/plugins/a-guide-to-wordpress-custom-post-types-taxonomies-admin-columns-filters-and-archives/
 */

add_action('restrict_manage_posts','goc_member_filter_by_medium');
function goc_member_filter_by_medium() {
    $screen = get_current_screen();
    global $wp_query;
    if ( $screen->post_type == 'goc_member' ) {
        wp_dropdown_categories( array(
            'show_option_all' => 'Show All Member Types',
            'taxonomy' => 'goc_member_type',
            'name' => 'goc_member_type',
            'orderby' => 'name',
            'selected' => ( isset( $wp_query->query['goc_member_type'] ) ? $wp_query->query['goc_member_type'] : '' ),
            'hierarchical' => false,
            'depth' => 3,
            'show_count' => false,
            'hide_empty' => true,
        ) );
    }
}

add_filter('parse_query','goc_member_do_type_filter');
function goc_member_do_type_filter($query) {
    $qv = &$query->query_vars;
    if ( ( $qv['goc_member_type'] ) && is_numeric( $qv['goc_member_type'] ) ) {
        $term = get_term_by( 'id', $qv['goc_member_type'], 'goc_member_type' );
        $qv['goc_member_type'] = $term->slug;
    }
}




/* Taxonomy for Members */

// Register Custom Taxonomy
function goc_tax_member_types()  {

    $labels = array(
        'name'                       => _x( 'Member Type', 'Taxonomy General Name', 'goc_textdomain' ),
        'singular_name'              => _x( 'Member Type', 'Taxonomy Singular Name', 'goc_textdomain' ),
        'menu_name'                  => __( 'Member Types', 'goc_textdomain' ),
        'all_items'                  => __( 'All Member Types', 'goc_textdomain' ),
        'parent_item'                => __( 'Parent Member Type', 'goc_textdomain' ),
        'parent_item_colon'          => __( 'Parent Member Type:', 'goc_textdomain' ),
        'new_item_name'              => __( 'New Member Type', 'goc_textdomain' ),
        'add_new_item'               => __( 'Add New Member Type', 'goc_textdomain' ),
        'edit_item'                  => __( 'Edit Member Type', 'goc_textdomain' ),
        'update_item'                => __( 'Update Member Type', 'goc_textdomain' ),
        'separate_items_with_commas' => __( 'Separate member types with commas', 'goc_textdomain' ),
        'search_items'               => __( 'Search member types', 'goc_textdomain' ),
        'add_or_remove_items'        => __( 'Add or remove Member Types', 'goc_textdomain' ),
        'choose_from_most_used'      => __( 'Choose from the most used member types', 'goc_textdomain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => false,
        'show_tagcloud'              => false,
    );
    register_taxonomy( 'goc_member_type', 'goc_member', $args );
    register_taxonomy_for_object_type( 'goc_member_type', 'goc_member' );

}

// Hook into the 'init' action
add_action( 'init', 'goc_tax_member_types', 0 );




/*******************************************************************
 *  CPT: Features for Home Page
 */
// Register Custom Post Type
function goc_cpt_features() {

    $labels = array(
        'name'                => 'Home Page Features',
        'singular_name'       => 'Feature',
        'menu_name'           => 'Features',
        'parent_item_colon'   => 'Parent Feature:',
        'all_items'           => 'All Features',
        'view_item'           => 'View Feature',
        'add_new_item'        => 'Add New Feature',
        'add_new'             => 'New Feature',
        'edit_item'           => 'Edit Feature',
        'update_item'         => 'Update Feature',
        'search_items'        => 'Search Features',
        'not_found'           => 'No features found',
        'not_found_in_trash'  => 'No features found in Trash',
    );
    $args = array(
        'label'               => 'goc_feature',
        'rewrite'             => array('slug' => 'feature'),
        'description'         => 'Home Page Features',
        'labels'              => $labels,
        'supports'            => array('title','editor','thumbnail' ),
        'taxonomies'          => array(  ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 110,
        'menu_icon'           => get_stylesheet_directory_uri() . '/img/logo-16x16.png',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'goc_feature', $args );

}

// Hook into the 'init' action
add_action( 'init', 'goc_cpt_features', 0 );




/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function goc_cpt_feature_add_custom_box() {

    $screens = array( 'goc_feature');

    foreach ( $screens as $screen ) {

        add_meta_box(
            'goc_feature_id',
            __( 'Feature Details', 'goc_textdomain' ),
            'goc_cpt_feature_name_custom_box',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'goc_cpt_feature_add_custom_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function goc_cpt_feature_name_custom_box( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'goc_cpt_feature_inner_custom_box', 'goc_cpt_feature_inner_custom_box_nonce' );

    /*
       * Use get_post_meta() to retrieve an existing value
       * from the database and use the value for the form.
       */
    $url  = get_post_meta(   $post->ID, 'goc_feature_url', true );


    echo '<label for="goc_feature_url">';
    _e( "Website URL", 'goc_textdomain' );
    echo '</label> ';
    echo '<input type="text" id="goc_feature_url" name="goc_feature_url" value="' . esc_attr( $url ) . '" size="65" />';
    echo '<br>';

}


/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function goc_cpt_feature_save_postdata( $post_id ) {

    /*
       * We need to verify this came from the our screen and with proper authorization,
       * because save_post can be triggered at other times.
       */

    // Check if our nonce is set.
    if ( ! isset( $_POST['goc_cpt_feature_inner_custom_box_nonce'] ) )
        return $post_id;

    $nonce = $_POST['goc_cpt_feature_inner_custom_box_nonce'];

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'goc_cpt_feature_inner_custom_box' ) )
        return $post_id;

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;

    // Check the user's permissions.
    // todo: zdf: change to goc_feature??
    if ( 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) )
            return $post_id;

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) )
            return $post_id;
    }

    /* OK, its safe for us to save the data now. */

    // Sanitize user input.
    $url = sanitize_text_field( $_POST['goc_feature_url'] );

    // Update the meta field in the database.
    update_post_meta( $post_id, 'goc_feature_url', $url );

}
add_action( 'save_post', 'goc_cpt_feature_save_postdata' );

