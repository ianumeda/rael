<header id="header" class="cbp-af">
  <div class="cbp-af-header">
    <div class="cbp-af-inner container">
      <div class="row">
        <div class="col-xs-3">
          <div class="branding">
          <a href="<?php bloginfo('url'); ?>" title="RAEL Home">
            <h1 class="logo">RAEL</h1>
            <h6 class="logo tagline"><span>Renewable &amp; Appropriate</span><span>Energy Laboratory</span></h6>
          </a>
        </div>
      </div>
      <div class="col-xs-9">
        <nav class="hidden-md hidden-lg visible-sm visible-xs">
    	    <?php //wp_nav_menu( array('menu'=>'top','menu_class'=>'nav')); ?>
        </nav>
        <nav class="visible-md visible-lg hidden-sm hidden-xs">
          <?php wp_nav_menu( array('menu'=>'top','menu_class'=>'nav navbar-nav','walker'=>new wp_bootstrap_navwalker())); ?>
        </nav>
      </div>
    </div>
  </div>
</header>


<div id="page">
