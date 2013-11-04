</div>
<div id="footer">
    <div class="container">
        <p class="text-center">&copy; 2013 Green Omaha Coalition &bull; Omaha, NE &bull; <a href="mailto:goc@greenomahacoalition.org">goc@greenomahacoalition.org</a><br><br>
            Site by<a href="http://ist.www.unomaha.edu"> University of Nebraska at Omaha’s College of Information Science & Technology</a><br>
            Thanks to <a href="http://twitter.github.io/bootstrap/index.html">Bootstrap</a> and <a href="http://glyphicons.com/">Glyphicons</a>
        </p>
    </div>
</div>

<!-- ************************** JAVASCRIPT ************************** -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="<?php echo get_stylesheet_directory_uri()?>/docs/assets/js/bootstrap-transition.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/docs/assets/js/bootstrap-alert.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/docs/assets/js/bootstrap-modal.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/docs/assets/js/bootstrap-dropdown.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/docs/assets/js/bootstrap-scrollspy.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/docs/assets/js/bootstrap-tab.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/docs/assets/js/bootstrap-tooltip.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/docs/assets/js/bootstrap-popover.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/docs/assets/js/bootstrap-button.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/docs/assets/js/bootstrap-collapse.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/docs/assets/js/bootstrap-carousel.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/docs/assets/js/bootstrap-typeahead.js"></script>
<script>
    !function ($) {
        $(function(){
            // carousel demo
            $('#myCarousel').carousel()
        })
    }(window.jQuery)
</script>
<script src="<?php echo  get_stylesheet_directory_uri()?>/docs/assets/js/holder/holder.js"></script>
<script src="<?php echo  get_stylesheet_directory_uri()?>/js/twitter-bootstrap-hover-dropdown.js"></script>
<script src="<?php echo  get_stylesheet_directory_uri()?>/js/twitter-bootstrap-hover-dropdown.min.js"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=244111995704226";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<?php wp_footer(); ?>
</body>

</html>