<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php wp_title('|',1,'right'); ?> <?php bloginfo('name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Kara">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="<?php echo get_stylesheet_directory_uri()?>/docs/assets/js/html5shiv.js"></script><![endif]-->

    <!-- ************************** CSS ************************** -->
    <link href="<?php echo get_stylesheet_directory_uri()?>/docs/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri()?>/docs/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo get_stylesheet_uri()?>" rel="stylesheet">

    <!-- ************************** FAV & TOUCH ICONS ************************** -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo  get_stylesheet_directory_uri()?>/docs/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo  get_stylesheet_directory_uri()?>/docs/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo  get_stylesheet_directory_uri()?>/docs/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo  get_stylesheet_directory_uri()?>/docs/assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="<?php echo  get_stylesheet_directory_uri()?>/docs/assets/ico/favicon.png">

    <?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>
</head>

<body>

<!-- Wrap all page content here -->
<div id="wrap">

    <!-- Begin page content -->
    <div class="container">
        <div class="page-header" style="float: right">
            <!--<img src="../img/fb.png"><img src="../img/rss.png" >-->
        </div>

        <!-- ************************** HEADER & NAVIGATION ************************** -->
        <div class="navbar">
            <div class="nav-pills">
                <div class="container">
                    <button class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse" style="border: none;background-color: transparent;">
                        <span><img src="<?php echo get_stylesheet_directory_uri()?>/img/nav.png" alt=""></span>
                    </button>
                    <a class="brand" href="<?php echo site_url(); ?>">

                        <img src="<?php echo  get_stylesheet_directory_uri()?>/img/logo.png" alt="<?php esc_attr(bloginfo('name')); ?>" style="float: left"></a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <?php wp_nav_menu(array('menu_class'=>'nav'));?>
                        </ul>
                    </div> <!-- nav -->
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
    </div>
