<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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

<div class="row archive_page">
  <div class="col-lg-10 col-lg-offset-1 ">
    <div class="row">
      <?php $content_columns=10; ?>
      <?php Starkers_Utilities::get_template_parts( array( 'parts/shared/page-menu' ) ); ?>
      <div class="col-md-<?php echo $content_columns; ?> content">
        <?php if ( have_posts() ): ?>

        <?php if ( is_day() ) : ?>
        <h2>Archive: <?php echo  get_the_date( 'D M Y' ); ?></h2>							
        <?php elseif ( is_month() ) : ?>
        <h2>Archive: <?php echo  get_the_date( 'M Y' ); ?></h2>	
        <?php elseif ( is_year() ) : ?>
        <h2>Archive: <?php echo  get_the_date( 'Y' ); ?></h2>		
              
      <?php elseif ((is_main_query()) && (is_tax('topics'))) :
            global $wp_query;
            $term = $wp_query->get_queried_object();
        ?>
        <h2 class="section_heading">Archive of Topic: <strong><?php echo $term->name; ?></strong></h2>
      <?php else : ?>
        <h2>Archive</h2>	
        <?php endif; ?>

        <div class="row">
          <div class="col-md-8 col-md-push-2 col-sm-10 col-sm-push-1">
        <?php while ( have_posts() ) : the_post(); ?>
        	
        		<article>
        		  <h3 >
        		    <a href="<?php esc_url( the_permalink() ); ?>" title="<?php echo strip_tags(get_the_title($post->ID)); ?>" rel="bookmark"><?php the_title(); ?></a>
        		  </h3>
        			<?php the_content(); ?>
        		</article>
        <?php endwhile; ?>
          </div>
        </div>
        
        <?php else: ?>
        <h2>No posts to display</h2>	
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

</div>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>