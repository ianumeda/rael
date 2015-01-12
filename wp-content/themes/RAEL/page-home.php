<?php
/**
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php
$query = new WP_Query( array( 'post_type' => 'page', 'post_parent' => '73', 'post', 'posts_per_page' => '4','order' =>'ASC' ) ); 
if ( $query->have_posts() ) {
  $i=0;
  $feature_buttons='<div id="feature_buttons" class="row hidden-xs hidden-sm">';
?>
<div id="feature_box" class="">
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
<div class="container">
<div id="thefold" class="row">&nbsp;</div>
<div id="belowthefold" class="row">
      <?php
        $query = new WP_Query( array( 'post_type' => 'page', 'post_parent' => $post->ID, 'posts_per_page' => '-1', 'offset' => '0', 'order' => 'ASC', 'orderby' => 'menu_order' ));
        if ( $query->have_posts() ) {
          $i=1;
        	while ( $query->have_posts() ) {
        		$query->the_post();
            if($i==1) {
              ?>
              <div id="welcome" class="col-lg-6 col-md-4  content">
                <div class="section ">
          		    <h2 class="section_heading"><?php echo get_the_title($post->ID); ?></h2>
                  <?php the_content(); ?>
            	  </div>
              <?php 
                } else {
              ?>
              <div class="section ">
          		  <h2 class="section_heading"><?php echo get_the_title($post->ID); ?></h2>
                  <?php the_content(); ?>
              </div>
              <?php 
            }
          	$i++;
        	}
          ?>
            </div>
          <?php 
            } else { 
          ?>
        	<div class="alert alert-danger">Content not found.</div>
        <?php }
        wp_reset_postdata();
      ?>
    
      <div id="events_cols" class="col-lg-3 col-md-2 ">
        <h3 class="section_heading">Events</h3>
        <?php 
        global $post;
        $all_events = tribe_get_events(array( 'eventDisplay'=>'upcoming', 'posts_per_page'=>5 ));
        foreach($all_events as $post)
        {
          setup_postdata($post);
          $eventstatus="";
          if(tribe_event_in_category('canceled')){ $eventstatus="canceled"; }
					elseif( tribe_get_start_date($post->ID, true, 'U')-strtotime('now') < 86400) {
						if( tribe_get_end_date($post->ID, true, 'U') < strtotime('now') ) $eventstatus="passed"; // event is over
						elseif( tribe_get_start_date($post->ID, true, 'U') < strtotime('now')) $eventstatus="now"; // event is happening now
						else /*if( tribe_get_start_date($post->ID, true, 'Ymdhi') <= date('Ymdhi', time('now')) )*/ $eventstatus="soon"; // event is upcoming within the next 24 hours
					}
					else $eventstatus="future";
          ?>
        
          <div class="row event_item event_<?php echo $eventstatus; ?> post_preview">
            <div class="event_status <?php echo $eventstatus; ?>"><?php echo $eventstatus; ?></div>
            <div class="event_date">
              <?php echo tribe_events_event_schedule_details(); ?>
              <?php //echo '<span class="event_status">'. ($eventstatus=="future" ? '' : $eventstatus ) .'</span>'; ?>
            </div>
            <h5 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <?php the_excerpt(); ?>
      		<button type="button" class="btn btn-link btn-block btn-xs"><a class="post_preview_link" href="<?php the_permalink(); ?>">Read more <span class="glyphicon glyphicon-arrow-right"></span></a></button>
          </div>
        <?php 
        }
        wp_reset_postdata();
        ?>        
        <div class="row news_item">
          <button type="button" class="btn btn-link btn-block">
            <a href="./events/category/colloquium/">Go to the Colloquium calendar <span class="glyphicon glyphicon-chevron-right"></span></a>
          </button>
        </div>
      </div>
      
      <div id="news_cols" class="col-lg-3 col-md-2 ">
        <h3 class="section_heading">News</h3>
            <?php
              // category__not_in is 'spotlight'
              $query = new WP_Query( array( 'category_name' => 'news', 'category__not_in' => array( 5 ), 'posts_per_page' => '8' ));
              if ( $query->have_posts() ) {
              	while ( $query->have_posts() ) {
              		$query->the_post(); 
            ?>
              		<div <?php post_class("post_preview news_item"); ?>>
              		  <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?></time> 
                    <h5 class="post_title"><a href="<?php the_permalink(); ?>"> <?php echo get_the_title(); ?></a></h5>
                    <p>
                  		<?php // echo get_the_excerpt(); ?>
                  		<a class="post_preview_link" href="<?php echo get_permalink($post->ID); ?>">Read more <span class="glyphicon glyphicon-arrow-right"></span></a>
                    </p>                  
              		</div>
            <?php }
              } else { ?>
              	<div class="alert alert-danger">Content not found.</div>
              <?php }
              wp_reset_postdata();
            ?>
      </div>
  </div>
    <div class="row news_item">
      <button id="link_to_news_page" type="button" class="btn btn-link btn-block">
        <a href="./news-events/">Go to the News &amp; Events Page <span class="glyphicon glyphicon-chevron-right"></span></a>
      </button>
    </div>

    </div>
</div><!-- #belowthefold -->

</div>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>

<script>
function check_for_active_slide(){
  var which_slide_is_active = $('.carousel-indicator.active').attr('data-slide-to');
  if(which_slide_is_active!=null){
    // alert(which_slide_is_active);
    $('.feature_button').removeClass('active');
    $('#feature'+which_slide_is_active).addClass('active');
  }
  else {
    setTimeout(check_for_active_slide, 100); // check again in .1 seconds
  }
}

$('#feature_carousel').on('slid.bs.carousel', function(){ check_for_active_slide(); });
$("#feature0").hover(function(){
  $('.carousel').carousel(0);
}).click(function(){
  window.location = $(this).children('a').attr('href');
});
$("#feature1").hover(function(){
  $('.carousel').carousel(1);
}).click(function(){
  window.location = $(this).children('a').attr('href');
});
$("#feature2").hover(function(){
  $('.carousel').carousel(2);
}).click(function(){
  window.location = $(this).children('a').attr('href');
});
$("#feature3").hover(function(){
  $('.carousel').carousel(3);
}).click(function(){
  window.location = $(this).children('a').attr('href');
});
</script>