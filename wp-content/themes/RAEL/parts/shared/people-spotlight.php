<?php 
global $person_type; 
if($person_type==undefined) $person_type="";
?>
<div class="spotlight <?php echo $person_type; ?>_spotlight person_spotlight">
  <div class="col-sm-10 col-sm-push-1 person_item">
    <div class="row" id="person_title">
        <h2 class="section_heading">
          <?php echo '<span class="preheading">'.$person_type." Spotlight: </span>"; ?>
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
      <div class="row">
      <?php
        if (has_post_thumbnail( $post->ID ) ){
          $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); 
          $imgurl=$image[0];
          echo '<div class="image headshot square" style="background-image:url('. $imgurl .')";></div>';
        } else {
    		  echo '<div class="image headshot square"><span class="glyphicon glyphicon-user"></span></div>';
        }
      ?>
      <article>
        <?php 
        // global $more;    // Declare global $more (before the loop).
        // $more = 0;       // Set (inside the loop) to display content above the more tag.
        // echo strip_tags( get_the_content("Continue Reading..."), 'a p' );
        echo get_the_excerpt($post->ID);
        ?>
      </article>
    </div>
    <div id="person_meta" class="person_meta row">
    <?php
    $terms = wp_get_post_terms( $post->ID, 'topics', array("fields" => "all") );
    if(!empty($terms)){
      echo '<h5 class="topics section_heading">Focus</h5><ul class="topics">';
      foreach( $terms as $term ){
        echo '<li class="topic">';
        echo ($term->count > 1) ? ('<a href="'. get_term_link($term) .'">'. $term->name .'</a>') : $term->name;
        echo '</li>';
      }
      echo '</ul>';
    }
    ?>
  </div>
    <div class="foot">
      <div class="col-xs-6">
        <button type="button" class="btn btn-link"><a href="#" alt="go to the Spotlight Archive"><span class="glyphicon glyphicon-arrow-left"></span> Go To The Spotlight Archive</a></button>
      </div>
      <div class="col-xs-6">
        <button type="button" class="btn btn-link" style="float:right;"><a class="" href="<?php echo get_permalink($post->ID); ?>">Go to <?php echo display_name_format(get_the_title()); ?>&apos;s Page <span class="glyphicon glyphicon-arrow-right"></span></a></button>
      </div>
    </div>
  </div>
</div>

