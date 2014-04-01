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
  <div class="col-sm-6 col-sm-offset-3 ">
      <div class="content ">
        <h2 class="section_heading">ERG <?php the_title(); ?></h2>
        <?php the_content(); ?>
  	    <?php wp_nav_menu( array('menu'=>'site-map')); ?>

      </div>
  </div>
</div>

<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>
