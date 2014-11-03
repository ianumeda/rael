<?php
/**
 * Search results page
 * 
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
<div class="container">

<div class="row">
  <div class="col-lg-10 col-lg-offset-1 ">
    <div class="row">
      <?php $content_columns=10; ?>
      <?php Starkers_Utilities::get_template_parts( array( 'parts/shared/page-menu' ) ); ?>
      <div class="col-md-<?php echo $content_columns; ?> content">
        <?php if ( have_posts() ): ?>
        <h2 class="section_heading">Search Results for '<strong><?php echo get_search_query(); ?></strong>'</h2>	
        <div class="row">
          <div class="col-md-8 col-md-push-2 col-sm-10 col-sm-push-1">
        <?php while ( have_posts() ) : the_post(); ?>
        		<article>
        			<h2><a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php echo strip_tags(get_the_title($post->ID)); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        			<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?></time> 
    	        <?php if(comments_open()) comments_popup_link('<span class="glyphicon glyphicon-comment">', '1 Comment', '% Comments'); ?></span>
              <p>
        			<?php echo get_the_content("Continue Reading..." ); ?>
              </p>
        		</article>
        <?php endwhile; ?>
      </div>
    </div>
        <?php else: ?>
        <h2 class="section_heading">No results found for '<?php echo get_search_query(); ?>'</h2>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div><!-- .page -->

</div>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>