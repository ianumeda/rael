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
    <ol class="carousel-indicators">
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
<div id="thefold" class="">&nbsp;</div>
<div class="container">
<div id="belowthefold" class="row">
      <?php
        $query = new WP_Query( array( 'post_type' => 'page', 'post_parent' => $post->ID, 'posts_per_page' => '-1', 'offset' => '0', 'order' => 'ASC', 'orderby' => 'menu_order' ));
        if ( $query->have_posts() ) {
          $i=1;
        	while ( $query->have_posts() ) {
        		$query->the_post();
            if($i==1) {
              ?>
              <div id="welcome" class="col-sm-6 ">
                <div >
                  <div class="section content">
            		    <h2 class="section_heading"><?php echo get_the_title($post->ID); ?></h2>
                    <?php the_content(); ?>
              	  </div>
                <?php 
              } elseif($i==$query->found_posts){
                  $the_last_bit_of_content_on_the_home_page='<div id="last_section" class="col-xs-12"><div class="section content">
            		  <h2 class="section_heading">'. get_the_title($post->ID) .'</h2>'. get_the_content($post->ID) .'</div></div>';
                } else {
                ?>
                <div class="section content">
            		  <h2 class="section_heading"><?php echo get_the_title($post->ID); ?></h2>
                    <?php the_content(); ?>
                </div>
              <?php 
            }
          	$i++;
        	}
          ?>
            </div>
            <div class="spacer hidden-xs"></div>
          </div>
          <?php 
            } else { 
          ?>
        	<div class="alert alert-danger">Content not found.</div>
        <?php }
        wp_reset_postdata();
      ?>
    
      <?php 
      global $post;
      $all_events = tribe_get_events(array( 'eventDisplay'=>'upcoming', 'posts_per_page'=>10 ));
      if(count($all_events)>0){ 
        if(count($all_events)>=3){
          // if sufficient upcoming events make a separate column for events, otherwise stack events on top of news ?>
          <div id="events_col" class="col-sm-3">
        <?php
        } else {
        ?> 
          <div id="events_col" class="col-sm-6">
        <?php
          }
        ?>
        <div>
        <h3 class="section_heading">Events</h3>
        <?php 
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
        
          <div class="event_item event_<?php echo $eventstatus; ?> post_preview">
            <div class="event_status <?php echo $eventstatus; ?>"><?php echo $eventstatus; ?></div>
            <div class="event_date">
              <span class="fa fa-calendar-o"></span>
              <?php echo tribe_events_event_schedule_details(); ?>
              <?php //echo '<span class="event_status">'. ($eventstatus=="future" ? '' : $eventstatus ) .'</span>'; ?>
            </div>
            <div class="post_title event_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
            <?php the_excerpt(); ?>
      		<button type="button" class="btn btn-link btn-block btn-xs"><a class="post_preview_link" href="<?php the_permalink(); ?>">Read more <span class="glyphicon glyphicon-arrow-right"></span></a></button>
          </div>
        <?php 
        }
        wp_reset_postdata();
        ?>      
      </div>
      <div class="spacer hidden-xs"></div>
        
        <div class="">
          <button type="button" class="btn btn-link btn-block">
            <a href="./events/">Go to the Events calendar <span class="glyphicon glyphicon-chevron-right"></span></a>
          </button>
        </div>
      </div>
        <?php
        }
        ?>
          
      <?php if(count($all_events)>=3) { ?>
        <div id="news_col" class="col-sm-3">        
      <?php } else { ?> 
        <div id="news_col" class="col-sm-6">        
      <?php } ?>    
        <div class="">
          <h3 class="section_heading">News</h3>
            <?php
              $query = new WP_Query( array( 'category_name' => 'news', 'posts_per_page' => '10' ));
              if ( $query->have_posts() ) {
              	while ( $query->have_posts() ) {
              		$query->the_post(); 
            ?>
              		<div <?php post_class("post_preview news_item"); ?>>
                    <h5 class="post_title"><a href="<?php the_permalink(); ?>"> <?php echo get_the_title(); ?></a></h5>
                    <p>
                      <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_time('M d'); ?></time> 
                  		<?php echo get_the_excerpt(); ?>
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
      <div class="spacer hidden-xs"></div>
      <div class="">
        <button type="button" class="btn btn-link btn-block">
          <a href="./events/">Go to News &amp; Events <span class="glyphicon glyphicon-chevron-right"></span></a>
        </button>
      </div>
    </div>
    <?php echo $the_last_bit_of_content_on_the_home_page; ?>

  </div><!-- #belowthefold -->

    </div>
</div>

</div>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>

<script>
$(document).ready(function(){
  // the following removes news items from the news column until the height of the news column matches the layout
  home_page_layout();
});
</script>