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
<div class="person_page person_<?php echo $post->ID; ?>">
<div class="container">

    <?php $positions=wp_get_post_terms($post->ID, 'position', array("fields" => "all")); ?>
    <div class=" person_page <?php echo $positions[0]->slug; ?>">

      <?php $menu='People'; ?>

      <div class=" content">
        <div class="row">
            <h2 class="person_title">
              <span class="pretitle">
              <?php
                echo '<span class="position">'.$positions[0]->name."</span>"; 
            		if($titles=wp_get_post_terms($post->ID, 'titles', array("fields" => "names"))) { 
            		  echo '<span class="titles">';
            		  foreach($titles as $title){
            		    echo $title;
            		    if($title!=$titles[count($titles)-1]) echo ' / ';
            		  }
            		  echo '</span>';
            		}
              ?>
            </span>
              <?php
                echo display_name_format(get_the_title()); 
              ?>
            </h2>
        </div>
        <div class="row">
          <div class="col-sm-4 col-sm-push-8">
              <div class="col-xs-6 col-sm-12">
                <?php
                  if (has_post_thumbnail( $post->ID ) ){
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); 
                    $imgurl=$image[0];
                    echo '<div class="post_thumbnail fitted"><img src="'. $imgurl .'"></div>';
                  } else {
              		  echo '<div class="image fitted"><span class="fa fa-user"></span></div>';
                  }
                ?>
              </div>
          </div>
          <div class="col-sm-8 col-sm-pull-4">
            <div class="row">
                <?php the_content(); ?>
              </article>
            </div>
            <?php 
            $projects=get_posts_reverse_associated_posts_of_type($post->ID,'projects');
            if($projects){
            ?>
            <div class="projects row">
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
            <?php 
            $publications=get_posts_reverse_associated_posts_of_type($post->ID,'publications');
            if($publications){
            ?>
            <div class="publications row">
            <?php
              $publications_list.='<ul>';
              foreach( $publications as $publication ){
                $publications_list.='<li class="publication"><a class="" title="go to the '.(get_the_title($publication)).' page" href="'.get_permalink($publication).'">';
                $publications_list.=get_the_title($publication);
                $publications_list.='</a></li>';
              }
              $publications_list.='</ul>'; 
              ?>
              <div class="title col-sm-2">Authored Publications:</div>
              <div class="publications col-sm-10">
                <?php echo $publications_list; ?>
              </div>
            </div>
            <?php 
            }
            ?>
            <div class="row topics">
              <?php
              $terms = wp_get_post_terms( $post->ID, 'topics', array("fields" => "all") );
              if(!empty($terms)){
              ?>
                <div class="title col-sm-2">Focus:</div>
                <div class="focus col-sm-10">
                  <?php 
                  echo '<ul class="topics">';
                  foreach( $terms as $term ){
                    echo '<li class="topic">';
                    echo ($term->count > 1) ? ('<a href="'. get_term_link($term) .'">'. $term->name .'</a>') : $term->name;
                    echo '</li>';
                  }
                  echo '</ul>';
                  
                  ?>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>

    </div>
    <?php
$prevperson = get_adjacent_person('prev');
$nextperson = get_adjacent_person('next');
?>

<?php endwhile; ?>
<div class="">
  <h3 class="section_heading" style="text-align:center;">Browse 
  <?php 
  if ($positions[0]->slug=='student') echo 'Students'; 
  elseif ($positions[0]->slug=='visiting-scholars') echo 'Visiting Scholars'; 
  elseif ($positions[0]->slug=='professor-emeritus') echo 'Professors Emeritus'; 
  else echo $positions[0]->name;
  ?>
  :</h3>
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