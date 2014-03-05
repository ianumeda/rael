<?php 
  global $content_columns;
  $content_columns=10;
  if(tribe_is_event($post->ID)){
    $menu='about';
?>
<div id="pagenav_mobile" class="col-sm-12 hidden-md hidden-lg ">
      <!-- <h4><?php echo strtoupper( $categories[0]->cat_name ); ?></h4>
      <ul>
        <li class="" style="padding:0 15px;">
          <a href="<?php echo tribe_get_events_link() ?>"> <span class="glyphicon glyphicon-chevron-up"></span> <?php _e( 'All Events', 'tribe-events-calendar' ) ?></a> 
        </li>
      </ul> -->
  <?php wp_nav_menu( array('menu'=>$menu,'menu_class'=>'nav nav-pills nav-justified','walker'=>new wp_bootstrap_navwalker())); ?>
</div>
<div id="pagenav" class="col-md-2 hidden-sm hidden-xs">
  <div class="row">
    <div class="col-lg-10 col-lg-offset-1">
      <!-- <h4><?php echo strtoupper( $categories[0]->cat_name ); ?></h4>
      <ul>
        <li>
          <a href="<?php echo tribe_get_events_link() ?>"> <span class="glyphicon glyphicon-chevron-up"></span> <?php _e( 'All Events', 'tribe-events-calendar' ) ?></a> 
        </li>
      </ul> -->
      <?php wp_nav_menu( array('menu'=>$menu,'menu_class'=>'nav nav-pills nav-justified','walker'=>new wp_bootstrap_navwalker())); ?>
	  </div>
	</div>
</div>

<?php  
  } else {
    $post_categories=get_the_category($post->ID);
  
    global $menu; 
    if(empty($menu)) $menu=get_page_menu($post->ID); 
    $menu='about';
    
    // if( !empty($menu) ) { 
  ?>
    <div id="pagenav_mobile" class="col-sm-12 hidden-md hidden-lg ">
          <!-- <ul>
            <li class="" style="padding:0 15px;"><a href="<?php echo get_category_link( $post_categories[0]->term_id ); ?>" title="<?php echo esc_attr( sprintf( __( "View all posts in %s" ), $post_categories[0]->name ) ); ?>"><span class="glyphicon glyphicon-chevron-up"></span> <?php echo $post_categories[0]->cat_name; ?> Archive</a></li>
          </ul> -->
      <?php wp_nav_menu( array('menu'=>$menu,'menu_class'=>'nav nav-pills nav-justified','walker'=>new wp_bootstrap_navwalker())); ?>
    </div>
    <div id="pagenav" class="col-md-2 hidden-sm hidden-xs">
      <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
          <!-- <h4><?php echo strtoupper( $categories[0]->cat_name ); ?></h4>
          <ul>
            <li><a href="<?php echo get_category_link( $post_categories[0]->term_id ); ?>" title="<?php echo esc_attr( sprintf( __( "View all posts in %s" ), $post_categories[0]->name ) ); ?>"><span class="glyphicon glyphicon-chevron-up"></span> <?php echo $post_categories[0]->cat_name; ?> Archive</a></li>
          </ul> -->
          <?php wp_nav_menu( array('menu'=>$menu,'menu_class'=>'nav','walker'=>new wp_bootstrap_navwalker())); ?>
    	  </div>
    	</div>
    </div>
<?php 
}
// } else { $content_columns=12; } 
?>
