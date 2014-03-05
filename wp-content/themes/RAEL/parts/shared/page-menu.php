<?php 
  global $content_columns;
  $content_columns=10; 
  global $menu; 
  if(empty($menu)) $menu=get_page_menu($post->ID); 
  if( !empty($menu) ) { 
?>
  <div id="pagenav_mobile" class="col-sm-12 hidden-md hidden-lg">
    <h4 style="text-align:center;"><?php echo strtoupper($menu); ?></h4>
    <?php wp_nav_menu( array('menu'=>$menu,'menu_class'=>'nav nav-pills nav-justified','walker'=>new wp_bootstrap_navwalker())); ?>
  </div>
  <div id="pagenav" class="col-md-2 hidden-sm hidden-xs">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <h4><?php echo strtoupper($menu); ?></h4>
  	    <?php wp_nav_menu( array('menu'=>$menu,'menu_class'=>'nav nav-pills nav-stacked','walker'=>new wp_bootstrap_navwalker())); ?>
  	  </div>
  	</div>
  </div>
<?php } else { $content_columns=12; } ?>
