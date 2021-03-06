<?php
/**
 * The Template for displaying all single posts
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
<div class="container">

  <div class="row">
    <div class="col-sm-10 col-sm-push-1 content">
      <article>
        <h2 class="section_heading"><?php the_title(); ?><time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?></time></h2>
    	  <?php if(comments_open()) comments_popup_link('<span class="glyphicon glyphicon-comment">', '1 Comment', '% Comments'); ?></span>
        <?php the_content(); ?>
        <?php if(comments_open()) comments_template( '', true ); ?>
      </article>
  <?php
    $projects=get_posts_associated_posts_of_type($post->ID,'projects');
    if($projects){
    ?>
    <div class="projects">
    <?php
      $projects_list.='<ul>';
      foreach( $projects as $project ){
        $projects_list.='<li class="project"><a class="" title="go to the '.display_name_format(get_the_title($project)).' page" href="'.get_permalink($project).'">';
        $projects_list.=get_the_title($project);
        $projects_list.='</a></li>';
      }
      $projects_list.='</ul>'; 
      ?>
      <div class="title col-sm-2">Associated Projects:</div>
      <div class="projects col-sm-10">
        <?php echo $projects_list; ?>
      </div>
    </div>
    <?php 
    }
    ?>
    </div>
  </div>
  <div class="row">
    <?php $this_posts_categories=get_the_category($post->ID); ?>
    <h3 class="section_heading" style="text-align:center;"><a href="<?php echo get_category_link( $this_posts_categories[0]->term_id ); ?>" alt="Go to the <?php echo $this_posts_categories[0]->name; ?> Archive">Browse <?php echo $this_posts_categories[0]->name; ?></a></h3>
    <ul class="pager">
      <li><?php previous_post_link('%link', '<span class="glyphicon glyphicon-arrow-left"></span> Previous post: %title', TRUE); ?></li>
      <li><?php next_post_link('%link', 'Next post: %title <span class="glyphicon glyphicon-arrow-right"></span>', TRUE); ?></li>
    </ul>
  </div>

</div>

<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>