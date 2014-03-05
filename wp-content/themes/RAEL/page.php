<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="page">
  <div class="row">
    <div class="col-lg-10 col-lg-offset-1 ">
      <div class="row">
        <?php $content_columns=10; ?>
        <?php Starkers_Utilities::get_template_parts( array( 'parts/shared/page-menu' ) ); ?>
        <div class="col-md-<?php echo $content_columns; ?> content">
          <article>
          <h2 class="section_heading"><?php the_title(); ?></h2>
            <?php the_content(); ?>
            <?php comments_template( '', true ); ?>
          </article>
        </div>
      </div>
    </div>
  </div>
</div><!-- .page -->
<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>
