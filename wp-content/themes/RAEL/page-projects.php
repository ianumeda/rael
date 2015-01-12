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
<div id="projects_page" class="container">

    <div class="row content">
      <h2 class="section_heading"><?php the_title(); ?></h2>
        <?php
          the_content();
        ?>
        <?php
        $query = new WP_Query( array( 'post_type' => 'projects','posts_per_page' => '1', 'order' => 'ASC', 'orderby' => 'date', 'tag__in'=>array(80)));
        // tag id 80 is "spotlight"
        if ( $query->have_posts() ) {
        	while ( $query->have_posts() ) {
        		$query->the_post();
            Starkers_Utilities::get_template_parts( array( 'parts/shared/project-spotlight' ) ); 
        	}
        } 
        wp_reset_postdata();
      ?>    
    </div>
    <div class="row projects_filters">
      <div class="btn-group" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="projects_filter" value="show_current_projects" autocomplete="off" checked> Current Projects
        </label>
        <label class="btn btn-primary">
          <input type="radio" name="projects_filter" value="show_all_projects" autocomplete="off"> All Projects
        </label>
      </div> 
    </div>
    <div class="row projects_layout">
      <div id="projects_list" class="col-xs-12">
        <?php
          $query = new WP_Query( array( 'post_type' => 'projects', 'posts_per_page' => '-1', 'offset' => '0', 'order' => 'DESC', 'orderby' => 'date' ));
          if ( $query->have_posts() ) {
            $counter=0;
          	while ( $query->have_posts() ) {
          		$query->the_post();
        		  Starkers_Utilities::get_template_parts( array( 'parts/shared/project-item' ) ); 
            }
          } else { ?>
          	<div class="alert alert-danger">Content not found.</div>
          <?php }
          wp_reset_postdata();
        ?>
    </div>
  </div>
</div>

</div>
<?php endwhile; ?>

<script>
function project_filter(){
  if ($("input[name='projects_filter']:checked").val() == 'show_all_projects')
    $("#projects_page .project_item").fadeIn();
  else {
    $("#projects_page .project_item").fadeOut();
    $("#projects_page .project_item.current_project").fadeIn();
  }
}
$(document).ready(function(){
  $('.btn').button();
  $('input[name="projects_filter"').change(function(){
    project_filter();
  });
  project_filter();
});

</script>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>
