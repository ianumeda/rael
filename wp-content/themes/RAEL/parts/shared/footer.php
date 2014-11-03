</div><!-- #page --> 
	<footer id="footer" >
    <div class="container">
  	<div class="row0">
	    <div class="col-md-9 col-sm-12">
    	  <a href="<?php echo home_url(); ?>">
      	  <h1 class="logo">RAEL</h1>
      	  <div class="tagline hidden-xs"><?php bloginfo( 'description' ); ?></div>
      	  <div class="tagline visible-xs"><?php bloginfo( 'description' ); ?></div>
    	  </a>
	    </div>
  	  <div class="col-md-3 col-sm-12">
  		  <div id="sb-search-bottom" class="sb-search row">
  				<form action="<?php echo home_url('/'); ?>" method="get">
  					<input class="sb-search-input" placeholder="Search the RAEL website..." type="text" value="" name="s" id="s">
  					<input class="sb-search-submit" type="submit" value="">
  					<span class="sb-icon-search glyphicon glyphicon-search"></span>
  				</form>
  			</div>
	      <div id="social" class="hidden-xs">
  	      <span id="fb_icon" class="social_icon"><a href="https://www.facebook.com/raelberkeley" alt="Visit us on Facebook" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/facebooklogo-40px-white.png"></a></span>
  	      <span id="twitter_icon" class="social_icon"><a href="https://twitter.com/RAELBerkeley" alt="Follow us on Twitter" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/twitterlogo-40px-white.png"></a></span>
  	    </div>
  		</div>
		</div>
	  <div class="row1">
	    <div class="col-sm-12">
        	<?php wp_nav_menu( array('menu'=>'footer','menu_class'=>'nav nav-pills nav-justified','walker'=>new wp_bootstrap_navwalker())); ?>
	    </div>
	  </div>
	  <div class="row2 affiliate_logos">
	    <div class="col-sm-6 col-md-4">
	      <div class="ucb affiliate_logo"><a href="http://berkeley.edu" alt="UC Berkeley"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/UCSeal-transparent-122x122.png" width="61" height="61"><span class="ucbtext">University of California,<span class="line2"> Berkeley</span></span></a></div>
	    </div>
	    <div class="col-md-4 col-md-push-4">
        <!-- <div class="cnr affiliate_logo"><a href="http://cnr.berkeley.edu" alt="College of Natural Resources at Berkeley"><img src="http://erg.berkeley.edu/wp-content/uploads/2013/12/CNR-RAEL-logo.png"></a></div> -->
	    </div>
	    <div class="col-md-4 col-md-pull-4 col-sm-12">
	      <div class="address">
	        <span class="line">
  	        <span>310 Barrows Hall</span>
    	      <span>University of California</span>
    	      <span>Berkeley, CA 94720-3050</span>
    	    </span>
    	    <span class="line">
            <span>Phone: (510) 642-1640</span>
            <span>Fax: (510) 642-1085</span>
            <span>Email: <a href="<?php echo home_url('/contact'); ?>">ergdeskb@berkeley.edu</a></span>
          </span>
        </div>
	    </div>
	  </div>

	  <div class="row3">
	    <div class="col-sm-12">
	      <div id="social_mobile" class="visible-xs">
  	      <span id="fb_icon" class="social_icon"><a href="https://www.facebook.com/RAELBerkeley" alt="Visit us on Facebook" target="_blank"><img src="http://erg.berkeley.edu/wp2013/wp-content/uploads/2013/11/facebooklogo-40px-white.png"></a></span>
  	      <span id="twitter_icon" class="social_icon"><a href="https://twitter.com/RAELBerkeley" alt="Follow us on Twitter" target="_blank"><img src="http://erg.berkeley.edu/wp2013/wp-content/uploads/2013/11/twitterlogo-40px-white.png"></a></span>
  	    </div>
	    </div>
	  </div>
    <div class="row4">
  	  <div id="copyright" class="col-xs-12">&copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</div>
  	</div>
  </div><!-- .container -->
</footer>
