<?php
/**
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>


<div class="row">
  <div class="col-lg-10 col-lg-offset-1 ">
    <?php Starkers_Utilities::get_template_parts( array( 'parts/shared/page-menu' ) ); ?>
      <div class="col-md-10">
        <div class="row content">
          <h3 class="section_heading"><?php the_title(); ?></h3>
          <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
          <?php the_content(); ?>
          <?php endwhile; ?>

          <?php
          $query = new WP_Query( array( 'category__and' => array( 5 ), 'posts_per_page' => '1', 'offset' => '0' ));
          if ( $query->have_posts() ) {
          	while ( $query->have_posts() ) {
          		$query->the_post();
          		echo '<div class="top_news_item news_item row">';
          		echo '<h2 class="post_title"><a href="'. get_permalink($post->ID) .'" alt="link to article">' . get_the_title() . '</a></h2>';
              // if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail or "featured image" assigned to it.
              //   echo '<div class="top_post_image">';
              //   the_post_thumbnail('large');
              //   echo '</div>';
              // } 
              global $more;    // Declare global $more (before the loop).
              $more = 0;       // Set (inside the loop) to display content above the more tag.
              the_content("Continue Reading...");
          		echo '</div>';
          	}
          } else { ?>
          	<div class="alert alert-danger">Content not found.</div>
          <?php }
          wp_reset_postdata();
          ?>
        </div>
        <div class="row">
          <div id="news_feed" class="col-sm-8 ">
            <h3 class="section_heading">News</h3>
            <?php
              $query = new WP_Query( array( 'category_name' => 'news', 'posts_per_page' => '5', 'offset' => '1' ));
              if ( $query->have_posts() ) {
              	while ( $query->have_posts() ) {
              		$query->the_post(); ?>
                  <div class="news_item row post_preview">
                    <h5 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
              		  <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?></time> 
                		<?php 
    		              if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail or "featured image" assigned to it.
                        the_post_thumbnail('thumbnail', array('class' => 'alignleft'));                      
                      } 
                      the_excerpt(); 
                    ?>
                		<button type="button" class="btn btn-link btn-block btn-xs"><a class="post_preview_link" href="<?php the_permalink(); ?>">Read more <span class="glyphicon glyphicon-arrow-right"></span></a></button>
              		</div>
              	<?php }
              } else { ?>
              	<div class="alert alert-danger">Content not found.</div>
              <?php }
              wp_reset_postdata();
            ?>
            <div class="row news_item">
              <?php 
              $category_id = get_cat_ID( 'news' );
              $category_link = get_category_link( $category_id ); 
              ?>
              <button class="btn btn-block btn-lg"><a href="<?php echo $category_link; ?>" alt="Go to the News Archive">Go to the News Archive <span class="glyphicon glyphicon-chevron-right"></span></a></button>
            </div>
          </div>
          <div id="events_feed" class="col-sm-4 ">
              <h3 class="section_heading">Upcoming Events</h3>
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
                  <h5 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                  <div class="event_date">
                    <?php echo tribe_events_event_schedule_details(); ?>
                    <?php //echo '<span class="event_status">'. ($eventstatus=="future" ? '' : $eventstatus ) .'</span>'; ?>
                  </div>
                  <div class="event_venue"><?php echo tribe_get_venue(); ?></div>
                  <?php the_excerpt(); ?>
            		<button type="button" class="btn btn-link btn-block btn-xs"><a class="post_preview_link" href="<?php the_permalink(); ?>">Read more <span class="glyphicon glyphicon-arrow-right"></span></a></button>
                </div>
              <?php 
              }
              wp_reset_postdata();
              ?>        
            <div class="row event_item">
              <button class="btn btn-block btn-lg "><a href="<?php echo home_url('/events/'); ?>" alt="Go to the Events Calendar">Go to the Events Calendar <span class="glyphicon glyphicon-chevron-right"></span></a></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>
