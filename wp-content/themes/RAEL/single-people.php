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
<div class="row">
  <div class="col-lg-10 col-lg-offset-1 ">
    <?php $positions=wp_get_post_terms($post->ID, 'position', array("fields" => "all")); ?>
    <div class="row person_page <?php echo $positions[0]->slug; ?>">
      <?php $menu='People'; ?>
      <?php Starkers_Utilities::get_template_parts( array( 'parts/shared/page-menu' ) ); ?>
      <div class="col-md-10 content">
        <div class="row">
          <div id="person_title" class="col-xs-12">
            <h2 class="section_heading">
              <?php echo '<span class="preheading">'.$positions[0]->name." : </span>"; ?>
              <?php
                echo display_name_format(get_the_title()); 
            		if($titles=wp_get_post_terms($post->ID, 'titles', array("fields" => "names"))) { 
            		  echo '<span class="titles">';
            		  foreach($titles as $title){
            		    echo $title;
            		    if($title!=$titles[count($titles)-1]) echo ', ';
            		  }
            		  echo '</span>';
            		}
              ?>
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-sm-push-8">
            <div class="row">
              <div class="col-xs-6 col-sm-12">
                <?php
                  if (has_post_thumbnail( $post->ID ) ){
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); 
                    $imgurl=$image[0];
                    echo '<div class="image headshot square" style="background-image:url('. $imgurl .')";></div>';
                  } else {
              		  echo '<div class="image headshot square"><span class="glyphicon glyphicon-user"></span></div>';
                  }
                ?>
              </div>
              <div id="person_meta" class="col-xs-6 col-sm-12">
                <?php
                $terms = wp_get_post_terms( $post->ID, 'topics', array("fields" => "all") );
                if(!empty($terms)){
                  echo '<h5 class="topics">Focus</h5><ul class="topics">';
                  foreach( $terms as $term ){
                    echo '<li class="topic">';
                    echo ($term->count > 1) ? ('<a href="'. get_term_link($term) .'">'. $term->name .'</a>') : $term->name;
                    echo '</li>';
                  }
                  echo '</ul>';
                }
                ?>
              </div>
            </div>
          </div>
          <div class="col-sm-8 col-sm-pull-4">
            <article>
              <?php the_content(); ?>
            </article>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
$prevperson = get_adjacent_person('prev');
$nextperson = get_adjacent_person('next');
?>

<?php endwhile; ?>

<div class="row">
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

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>