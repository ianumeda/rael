<header>
<?php
$query = new WP_Query( array( 'post_type' => 'page', 'post_parent' => '73', 'post', 'posts_per_page' => '4','order' =>'ASC' ) ); 
if ( $query->have_posts() ) {
  $i=0;
  $feature_buttons='<div id="feature_buttons" class="row hidden-xs hidden-sm">';
?>
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
<div id="feature_box" class="row">
  <div id="feature_carousel" class="carousel carousel slide col-md-12" data-interval="10000">
    <!-- Indicators -->
    <ol class="carousel-indicators hidden-md hidden-lg">
      <li data-target="#feature_carousel" data-slide-to="0" class="carousel-indicator active"></li>
      <li data-target="#feature_carousel" data-slide-to="1" class="carousel-indicator"></li>
      <li data-target="#feature_carousel" data-slide-to="2" class="carousel-indicator"></li>
      <li data-target="#feature_carousel" data-slide-to="3" class="carousel-indicator"></li>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner">

<?php	
while ( $query->have_posts() ) { 
  $query->the_post(); 
	if (has_post_thumbnail( $post->ID ) ){
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
  $imgurl=$image[0];
  } else $imgurl="";

?>      

      <div class="item background-carousel<?php if($i==0) echo " active"; ?>" style="background-image:url(<?php echo $imgurl; ?>);">
        <div class="carousel-caption ">
          <div class="carousel-item-title visible-xs"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?> </a></div>
          <div class="hidden-xs"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_content($post->ID); ?></a></div>
          <span class="read_more_link"><a href="<?php echo get_permalink($post->ID); ?>">Read more <span class="glyphicon glyphicon-arrow-right"></span></a></span>
        </div>
        <div class="carousel_bottom">&nbsp;</div>
      </div>

<?php 
  $feature_buttons.='<div id="feature'.$i.'" class="col-sm-3 feature_button';
  if($i==0) $feature_buttons.=' active';
  $feature_buttons.=' data-target="#feature_carousel" data-slide-to="'.$i.'"><a href="'. get_permalink($post->ID) .'"><div class="feature_button_content">';
  if($thumbnail=get_post_meta($post->ID,'thumbnail',true)) $feature_buttons.='<div class="thumbnail" style="background-image:url('.$thumbnail.');"></div>';
  $feature_buttons.='<span class="title">'. get_the_title($post->ID) .'</span><span class="blurb">'. get_the_excerpt() .'</span>';
  $feature_buttons.='</a></div></div>';
  $i++;
}
$feature_buttons.='</div>'; 
?>

    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#feature_carousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#feature_carousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
  </div>
</div>
<?php } else { ?>
	<div class="alert alert-danger">Carousel content not found.</div>
<?php } wp_reset_postdata(); ?>

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
<div id="page" class="home_page">
  <div class="container">
