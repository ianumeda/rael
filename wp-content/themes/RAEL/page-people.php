<?php
/**
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="row">
  <div class="col-lg-10 col-lg-offset-1 ">
    <div class="row">
      <?php Starkers_Utilities::get_template_parts( array( 'parts/shared/page-menu' ) ); ?>
      <div class="col-md-10 content">
        <h2 class="section_heading"><?php the_title(); ?></h2>
        <?php the_content(); ?>
        <?php
          $query = new WP_Query( array( 'post_type' => 'people', 'posts_per_page' => '-1', 'offset' => '0', 'order' => 'ASC', 'orderby' => 'title'));
          if ( $query->have_posts() ) {
          	while ( $query->have_posts() ) {
          		$query->the_post();
        		  Starkers_Utilities::get_template_parts( array( 'parts/shared/people-preview' ) ); 
          	}
          } else { ?>
          	<div class="alert alert-danger">Error: Content not found.</div>
          <?php }
          wp_reset_postdata();
        ?>
      </div>
    </div>
  </div>
</div>

<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>
