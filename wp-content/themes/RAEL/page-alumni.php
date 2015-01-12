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
<?php $person_type="Alumni"; ?>
<div class="container">

  <div class="row">
    <div class=" content">
      <h2 class="section_heading">RAEL <?php the_title(); ?></h2>
      <?php
        the_content();
      ?>
    </div>
  </div>
  <div class="row">
    <?php
      $query = new WP_Query( array( 'post_type' => 'people', 'position'=>'alumni', 'posts_per_page' => '-1', 'offset' => '0', 'order' => 'ASC', 'orderby' => 'title'));
      if ( $query->have_posts() ) {
        $number_of_columns=6;
        $posts_per_column=ceil(($query->post_count)/$number_of_columns);
        $current_post=0;
        $current_column=0;
        $current_post_in_current_column=0;
        // echo '<div class="row">'; // wraps the whole people grid
      	while ( $query->have_posts() ) {
          if(($current_column==0 || $current_column==2 || $current_column==4) && $current_post_in_current_column==0){
            echo '<div class="col-xs-12 col-sm-4 column_level_1"><div class="">'; // this is a 1st level column containing two more columns
          }
          if($current_post_in_current_column==0){
            echo '<div class="col-sm-12 col-lg-6 column_level_2">';
          }
      		$query->the_post();
    		  Starkers_Utilities::get_template_parts( array( 'parts/shared/people-preview-rows' ) ); 
          $current_post++;
          $current_post_in_current_column++;
          if(($current_column<$number_of_columns-1 && $current_post_in_current_column>=$posts_per_column) || $current_post>=$query->post_count){
            echo '</div><!-- .column_level_2 '. $current_post.','.$current_post_in_current_column.','.$current_column.' -->';
            $current_post_in_current_column=0;
            if($current_column==1 || $current_column==3) {
              echo '</div></div><!-- .column_level_1 '. $current_post.','.$current_post_in_current_column.','.$current_column.' -->';
            }
            $current_column++;
            if($current_column<$number_of_columns) $posts_per_column=ceil(($query->post_count-$current_post)/($number_of_columns-$current_column));
          }
      	}
        echo '</div>';
        echo '</div>';
      } else { ?>
      	<div class="alert alert-danger">Content not found.</div>
      <?php }
      wp_reset_postdata();
    ?>
  </div>
  <?php Starkers_Utilities::get_template_parts( array( 'parts/shared/people-footer' ) ); ?>
</div>
<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>
