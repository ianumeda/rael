<?php
/**
 * The Template for displaying all people posts
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

    <div class="publication_page publication_<?php echo $post->ID; ?>">

        <div class="row">
          <div class="col-xs-12 publication_title">
            <h2>
            <?php echo (get_the_title()); ?>
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="title col-sm-2">Published:</div>
          <div class="publish_date col-sm-10">
            <?php the_date(); ?>
          </div>
        </div>
        <div class="row">
          <?php
          $authors=get_publications_authors($post->ID);
          $authors_list='';
          if($authors){
            $authors_list.='<ui>';
            foreach( $authors as $author ){
              $authors_list.='<li class="author"><a class="" title="go to '.display_name_format(get_the_title($author)).'\'s page" href="'.get_permalink($author).'">';
              $authors_list.=get_the_title($author);
              $authors_list.='</a></li>';
            }
            $authors_list.='</ui>';
          }          
          ?>
          <div class="title col-sm-2">Author(s):</div>
          <div class="authors col-sm-10">
            <?php echo $authors_list; ?>
          </div>
        </div>
        <?php
        $terms = wp_get_post_terms( $post->ID, 'topics', array("fields" => "all") );
        if(!empty($terms)){ 
        ?>
        <div class="publication_meta row">
          <div class="title col-sm-2">Topics:</div>
          <div class="topics col-sm-10">
            <?php
            echo '<ul>';
            foreach( $terms as $term ){
              echo '<li class="topic">';
              echo ($term->count > 1) ? ('<a class="" href="'. get_term_link($term) .'" title="click to search this site for this topic">'. $term->name .'</a>') : $term->name;
              echo '</li>';
            }
            echo '</ul>';
            ?>
          </div>
        </div>
        <?php             
        }
        $projects=get_posts_associated_posts_of_type($post->ID,'projects');
        if($projects){
        ?>
        <div class="projects row">
        <?php
          $projects_list.='<ui>';
          foreach( $projects as $project ){
            $projects_list.='<li class="project"><a class="" title="go to the '.display_name_format(get_the_title($project)).' page" href="'.get_permalink($project).'">';
            $projects_list.=get_the_title($project);
            $projects_list.='</a></li>';
          }
          $projects_list.='</ui>'; 
          ?>
          <div class="title col-sm-2">Associated Projects:</div>
          <div class="projects col-sm-10">
            <?php echo $projects_list; ?>
          </div>
        </div>
      <?php } ?>
      <div class="row clearfix">
        <div class="title col-sm-2 col-xs-12">Description:</div>
        <div class="image col-sm-3 col-sm-push-7 col-xs-2 col-xs-push-10">
          <?php
            if (has_post_thumbnail( $post->ID ) ){
              $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); 
              $imgurl=$image[0];
              echo '<div class="image square headshot" style="background-image:url('. $imgurl .')";></div>';
            } else {
        		  echo '<div class="image square headshot"><span class="fa fa-file-pdf-o"></span></div>';
            }
          ?>
        </div>
        <div class="col-sm-7 col-sm-pull-3 col-xs-10 col-xs-pull-2">
          <article>
            <?php the_content(); ?>
          </article>
        </div>
      </div>

    <?php
      $prevperson = get_adjacent_person('prev');
      $nextperson = get_adjacent_person('next');
      ?>

      <?php endwhile; ?>
      <div class="row">
        <h3 class="section_heading" style="text-align:center;">Browse Publications:</h3>
        <ul class="pager">
          <?php if($prevperson) : ?>
              <li><a href="<?php echo get_permalink($prevperson->ID)?>"><span class="glyphicon glyphicon-arrow-left"></span> <?php echo display_name_format($prevperson->post_title); ?></a></li>
          <?php endif; ?>

          <?php if($nextperson) : ?>
              <li><a href="<?php echo get_permalink($nextperson->ID)?>"><?php echo display_name_format($nextperson->post_title); ?>  <span class="glyphicon glyphicon-arrow-right"></span></a></li>
          <?php endif; ?>
        </ul>
      </div>
  </div>
</div>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>