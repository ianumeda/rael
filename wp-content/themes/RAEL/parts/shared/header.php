<header>
  <div id="page_head" style="background-image:url(<?php header_image(); ?>);">
    <div class="container">
    </div>
  </div>
<div class="cbp-af-header">
    <div class="cbp-af-inner container">
      <div class="row">
        <div class="col-md-3 col-sm-12">
          <a href="<?php bloginfo('url'); ?>" title="RAEL Home">
            <h1 class="logo">RAEL</h1>
            <h6 class="logo"><span>Renewable &amp; Appropriate</span><span>Energy Laboratory</span></h6>
          </a>
        </div>
        <div class="col-md-9 col-sm-12">
          <nav >
        	    <?php //wp_nav_menu( array('menu'=>'top','menu_class'=>'nav')); ?>
        	    <?php wp_nav_menu( array('menu'=>'top','menu_class'=>'nav navbar-nav','walker'=>new wp_bootstrap_navwalker())); ?>
          </nav>
        </div>
    </div>
</div>
</header>
<div id="page">
  <div class="container">
