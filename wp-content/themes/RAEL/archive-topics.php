<?php
/**
 * The template for displaying The Topic Archive pages.
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

<div class="row">
  <div class="col-lg-10 col-lg-offset-1 ">
    <div class="row">
      <?php $content_columns=10; ?>
      <?php Starkers_Utilities::get_template_parts( array( 'parts/shared/page-menu' ) ); ?>
      <div class="col-md-<?php echo $content_columns; ?> content">
        <h2 class="section_heading">Archive of Topic: <?php the_title(); ?></h2>
        <?php if ( have_posts() ): ?>

        <ol>
        <?php while ( have_posts() ) : the_post(); ?>
        	<li>
        		<article>
        		  <h2 class="section_heading">
        		    <a href="<?php esc_url( the_permalink() ); ?>" title="<?php echo strip_tags(get_the_title($post->ID)); ?>" rel="bookmark">
                  <?php echo display_name_format(get_the_title()); ?>
                </a>

                <?php 
                $i=0;
                if($titles=wp_get_post_terms($post->ID, 'titles', array("fields" => "names"))) { 
                  echo '<h5 class="titles">';
                  foreach($titles as $title){
                    if($i>0) echo ', ';
                    echo $title;
                    $i++;
                  }
                  echo '</h5>';
                }
                ?>
        		  </h2>
        			<?php the_content(); ?>
        		</article>
        	</li>
        <?php endwhile; ?>
        </ol>
        <?php else: ?>
        <h2>No posts to display</h2>	
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>


<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>