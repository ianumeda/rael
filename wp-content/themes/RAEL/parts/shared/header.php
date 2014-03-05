<header>
	<a href="<?php echo home_url(); ?>">
	  <div id="logo" class="hover">
	    <div class="branding hidden-xs"><span class="erg"><span class="er">ER</span><span class="g">G</span></span><span class="energyresourcesgroup">Energy &amp; Resources Group</span></div>
	    <div class="branding visible-xs"><span class="erg">ERG</span><span class="energyresourcesgroup">Energy &amp; Resources Group</span></div>
	    <div class="vertical_bar"></div>
  	  <div class="tagline hidden-xs"><?php bloginfo( 'description' ); ?></div>
  	  <div class="tagline visible-xs"><?php bloginfo( 'description' ); ?></div>
	  </div>
	</a>
  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <li class="topnav_logo erg visible-xs">
        <a class="navbar-brand" href="<?php echo home_url(); ?>">Energy &amp; Resources Group</a>
      </li>
    </div>
    <div id="topnav" class="collapse navbar-collapse navbar-ex1-collapse">
      <div class="col-md-9 col-sm-12">
    	    <?php wp_nav_menu( array('menu'=>'top','menu_class'=>'nav navbar-nav','walker'=>new wp_bootstrap_navwalker())); ?>
    	</div>
    	<div class="col-md-3 col-sm-12">
  			<ul id="erg_blog" class="nav navbar-nav navbar-right hidden-sm">
  			  <li><a href="http://lifeaterg.blogspot.fr/" target="_blank">Life at ERG</a></li>
  			</ul>
			  <div id="sb-search-top" class="sb-search hidden-xs">
  				<form action="<?php echo home_url('/'); ?>" method="get">
  					<input class="sb-search-input" placeholder="Search the ERG website..." type="field" value="" name="s" id="s">
  					<input class="sb-search-submit" type="submit" value="">
  					<span class="sb-icon-search glyphicon glyphicon-search"></span>
  				</form>
  			</div>
			</div>
    </div><!-- /.navbar-collapse -->
  </nav>
</header>
<div id="page">
<?php if(!is_home() && !is_front_page()) { ?>
<div class="row" id="page_head" style="background-image:url(<?php header_image(); ?>);">
  <div class="col-sm-12" id="branding"> </div>
</div>
<?php } ?>

