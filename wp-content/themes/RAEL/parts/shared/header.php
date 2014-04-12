<header>
  <div id="page_head" style="background-image:url(<?php header_image(); ?>);">
    <div class="container">
    	<a href="<?php echo home_url(); ?>">
    	  <div id="logo" class="hover logo">
    	    <div class="branding hidden-xs"><span class="name">RAEL</span></span><span class="name_spelled_out">Renewable &amp; Appropriate Energy Laboratory</span></div>
    	    <div class="branding visible-xs"><span class="name">RAEL</span><span class="name_spelled_out">Renewable &amp; Appropriate Energy Laboratory</span></div>
    	    <div class="vertical_bar"></div>
      	  <div class="tagline hidden-xs"><?php bloginfo( 'description' ); ?></div>
      	  <div class="tagline visible-xs"><?php bloginfo( 'description' ); ?></div>
    	  </div>
    	</a>
    </div>
  </div>
<div class="cbp-af-header">
    <div class="cbp-af-inner container">
        <h1 class="logo">RAEL</h1>
        <nav >
      	    <?php wp_nav_menu( array('menu'=>'top','menu_class'=>'nav navbar-nav','walker'=>new wp_bootstrap_navwalker())); ?>
        </nav>
    </div>
</div>
  <nav id="topmenu" class="navbar navbar-default" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <li class="topnav_logo erg visible-xs">
          <a class="navbar-brand" href="<?php echo home_url(); ?>">Renewable &amp; Appropriate Energy Laboratory</a>
        </li>
      </div>
      <div id="topnav" class="collapse navbar-collapse navbar-ex1-collapse">
        <div class="col-sm-12">
      	    <?php wp_nav_menu( array('menu'=>'top','menu_class'=>'nav navbar-nav','walker'=>new wp_bootstrap_navwalker())); ?>
      	</div>
  			  <div id="sb-search-top" class="sb-search hidden-xs">
    				<form action="<?php echo home_url('/'); ?>" method="get">
    					<input class="sb-search-input" placeholder="Search the RAEL website..." type="field" value="" name="s" id="s">
    					<input class="sb-search-submit" type="submit" value="">
    					<span class="sb-icon-search glyphicon glyphicon-search"></span>
    				</form>
    			</div>
      </div><!-- /.navbar-collapse -->
    </div><!-- .container -->
  </nav>
</header>
<div id="page">
  <div class="container">
