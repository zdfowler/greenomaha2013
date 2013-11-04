
<?php get_header(); ?>


<!-- ************************** Carousel ************************** -->
<div id="myCarousel" class="container marketing carousel slide">
    <div class="carousel-inner">
        <?php
            $feature_posts = get_posts("post_type=goc_feature");
            foreach ($feature_posts as $p):
                $x++;
                $link = get_post_meta($p->ID,'goc_feature_url',true);
                ?>

        <div class="item <?php echo $x == 1 ? 'active':''?>">
            <div class="row-fluid">
                <?php if ($link != '') { ?>
                    <a href="<?php echo $link?>">  <?php echo get_the_post_thumbnail($p->ID, array(160,160), array('class'=>'image','border'=>0))?></a>
                <?php } else { ?>
                    <?php echo get_the_post_thumbnail($p->ID, array(160,160), array('class'=>'image','border'=>0))?>

                <?php } ?>
                <div class="span8 carousel-caption" style="float: right">
                    <h1><?php echo $p->post_title?></h1>
                    <p class="lead"><?php echo $p->post_content?></p>
                </div>

            </div>
        </div>
        <?php endforeach; ?>

    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><img src="<?php echo  get_stylesheet_directory_uri()?>/img/arrow_left.png" alt="&lsaquo;"></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"><img src="<?php echo  get_stylesheet_directory_uri()?>/img/arrow_right.png" alt="&lsaquo;"></a>
</div>
<!-- /.carousel -->



<!-- ************************** FEATURETTES ************************** -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing">


    <!-- Three columns of text below the carousel -->
    <div class="row">


        <div class="span4">
            <h2>LASTEST GOC NEWS</h2>
            <?php if (have_posts() ) : while ( have_posts() && $n<3) : the_post(); ?>
            <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
                <em><?php the_time('l, F jS, Y'); ?></em></p>
            <?php $n++; endwhile; else: ?>
            <p>No news!</p>
            <?php endif; ?>

        </div><!-- /.span4 -->
        <div class="span4">
            <h2>TODAYS EVENTS</h2>
            <?php echo do_shortcode('[ai1ec view="daily"]'); ?>
            <h4><script>
                    today = new Date();
                    document.write(today.getMonth(),"/",today.getDate(),"/",today.getFullYear());
                </script>
            </h4>
            <p class="text-left">5:30p - Utlization of Native Plants in Your Landscaping.<br><br>
                6:00p - Bike Maintance & Repair Series: Chains and Chainrings</p>
            <a class="btn btn-large btn-success" href="/get-involved/calendar/">CALENDAR</a>
        </div><!-- /.span4 -->
        <div class="span4">
            <h2>Weekly Newsletter</h2>
            <p>Sign up to receive our email newsletter.</p>
            <style type="text/css">
                .link,
                .link a,
                #SignUp .signupframe {
                    color: #226699;
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 13px;
                }
                .link,
                .link a {
                    text-decoration: none;
                }
                #SignUp .signupframe {
                    border: 0;
                    background: #ffffff;
                }
                #SignUp .signupframe .required {
                    font-size: 10px;
                }
                #SignUp input[type="submit"] {
                    display: inline-block;
                    padding: 4px 12px;
                    margin-bottom: 0;
                    font-size: 14px;
                    line-height: 20px;
                    color: #333333;
                    text-align: center;
                    text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
                    vertical-align: middle;
                    cursor: pointer;
                    background-color: #f5f5f5;
                    background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
                    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
                    background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
                    background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
                    background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
                    background-repeat: repeat-x;
                    border: 1px solid #cccccc;
                    border-color: #e6e6e6 #e6e6e6 #bfbfbf;
                    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
                    border-bottom-color: #b3b3b3;
                    -webkit-border-radius: 4px;
                    -moz-border-radius: 4px;
                    border-radius: 4px;
                    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);
                    filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
                    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
                    -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
                    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);

                    padding: 11px 19px;
                    font-size: 17.5px;
                    -webkit-border-radius: 6px;
                    -moz-border-radius: 6px;
                    border-radius: 6px;
                    color: #ffffff;
                    background-color: #8dc63f;
                    *background-color: #8dc63f;
                    vertical-align: middle;
                    cursor: pointer;
                    line-height: 20px;
                    display: inline-block;
                    color: #ffffff;
                    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
                    background-color: #5bb75b;
                    background-image: -moz-linear-gradient(top, #8dc63f, #80b33a);
                    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#8dc63f), to(#80b33a));
                    background-image: -webkit-linear-gradient(top, ##8dc63f, #80b33a);
                    background-image: -o-linear-gradient(top, #8dc63f, #80b33a);
                    background-image: linear-gradient(to bottom, #8dc63f, #80b33a);
                    background-repeat: repeat-x;
                    border-color: #8dc63f #8ac13e #80b33a;
                    border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
                    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff62c462', endColorstr='#ff51a351', GradientType=0);
                    filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
                }

                }
            </style>
            <script type="text/javascript" src="http://app.icontact.com/icp/loadsignup.php/form.js?c=585204&l=27438&f=5112"></script>
            <span class="link"><a href="http://www.icontact.com">iContact Email Marketing</a> You Can Trust</span>




<!--            <h2>BECOME A <br> MEMEBER TODAY!</h2>-->
<!--            <p class="text-left">The strength of the GOCcomes from the diversity of its members.</p>-->
<!--            <a class="btn btn-large btn-success" href="#">JOIN NOW!</a>-->
        </div><!-- /.span4 -->
    </div><!-- /.row -->



</div>


<div id="push"></div>

<?php get_footer(); ?>