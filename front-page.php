
<?php get_header(); ?>


<!-- ************************** Carousel ************************** -->
<div id="myCarousel" class="container marketing carousel slide">
    <div class="carousel-inner">
        <div class="item active">
            <div class="row-fluid">
                <img class="image" src="<?php echo  get_stylesheet_directory_uri()?>/img/dcslider.png" width="160" height="132" alt="">
                <div class="span8 carousel-caption" style="float: right">
                    <h1>Design &amp; Construcion</h1>
                    <p class="lead">The Design and Construction Council is a collaborative effort amongst design and construction professionals to increase awareness among the construction community through educational program and resource development.</p>
                </div>
            </div>
        </div>

        <div class="item">
            <div class="row-fluid">
                <img class="image" src="<?php echo  get_stylesheet_directory_uri()?>/img/dcslider.png" width="160" height="132" alt="">
                <div class="span8 carousel-caption" style="float: right">
                    <h1>Design &amp; Construcion</h1>
                    <p class="lead">The Design and Construction Council is a collaborative effort amongst design and construction professionals to increase awareness among the construction community through educational program and resource development.</p>
                </div>
            </div>
        </div>

        <div class="item">
            <div class="row-fluid">
                <img class="image" src="<?php echo  get_stylesheet_directory_uri()?>/img/dcslider.png" width="160" height="132" alt="">
                <div class="span8 carousel-caption" style="float: right">
                    <h1>Design &amp; Construcion</h1>
                    <p class="lead">The Design and Construction Council is a collaborative effort amongst design and construction professionals to increase awareness among the construction community through educational program and resource development.</p>
                </div>
            </div>
        </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><img src="<?php echo  get_stylesheet_directory_uri()?>/img/arrow_left.png" alt="&lsaquo;"></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"><img src="<?php echo  get_stylesheet_directory_uri()?>/img/arrow_right.png" alt="&lsaquo;"></a>
</div>
<!-- /.carousel -->



<!-- ************************** FEATURETTES ************************** -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing">
    <div class="row">
        <div class="span12">
            <?php if (have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <h2><?php echo strtoupper(get_the_title())?></h2>
                <?php the_content(); ?>
            <?php endwhile; else: ?>
                <p><?php _e('Sorry! That page does not exist.');?></p>
            <?php endif; ?>

        </div>

    </div>


    <!-- Three columns of text below the carousel -->
    <div class="row">


        <div class="span4">
            <h2>2013 SURVEY <br> ELECTION RESULTS</h2>
            <p class="text-left">Mayoral and city council candidates answer our green questions for the upcoming election.</p>
            <a class="btn-mini" href="#">&#x2713; &#x2713; &#x2713;</a>
        </div><!-- /.span4 -->
        <div class="span4">
            <h2>TODAYS EVENTS</h2>
            <h4><script>
                    today = new Date();
                    document.write(today.getMonth(),"/",today.getDate(),"/",today.getFullYear());
                </script>
            </h4>
            <p class="text-left">5:30p - Utlization of Native Plants in Your Landscaping.<br><br>
                6:00p - Bike Maintance & Repair Series: Chains and Chainrings</p>
            <a class="btn btn-large btn-success" href="#">CALENDAR</a>
        </div><!-- /.span4 -->
        <div class="span4">
            <h2>BECOME A <br> MEMEBER TODAY!</h2>
            <p class="text-left">The strength of the GOCcomes from the diversity of its members.</p>
            <a class="btn btn-large btn-success" href="#">JOIN NOW!</a>
        </div><!-- /.span4 -->
    </div><!-- /.row -->
</div>


<div id="push"></div>

<?php get_footer(); ?>