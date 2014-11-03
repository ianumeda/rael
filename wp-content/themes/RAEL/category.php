<?php
/**
 * The template for displaying Category Archive pages
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
  <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 ">
    <div class="content">
<?php if ( have_posts() ): ?>
          <h2 class="section_heading"><?php echo single_cat_title( '', false ); ?> Archive:</h2>
          <?php while ( have_posts() ) : the_post(); ?>
          	<div class="row">
          		<article>
          		  <h2 class="post_heading">
          		    <a href="<?php esc_url( the_permalink() ); ?>" title="<?php echo strip_tags(get_the_title($post->ID)); ?>" rel="bookmark"><?php the_title(); ?></a>
          		    <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?></time>
          		  </h2>
          			<?php the_content(); ?>
          		</article>
            </div>
          <?php endwhile; ?>
          <?php else: ?>
          <h2>No posts to display in <?php echo single_cat_title( '', false ); ?></h2>
          <?php endif; ?>
    </div>
  </div>
</div>

</div>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>