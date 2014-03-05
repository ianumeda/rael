<?php 
global $person_type; 
if($person_type==undefined) $person_type="";
?>
<div class="row spotlight <?php echo $person_type; ?>_spotlight person_spotlight well">
  <div class="col-md-12">
    <div class="row">
      <div id="person_title" class="col-xs-12">
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
        <div id="person_meta" class="person_meta col-xs-6 col-sm-12">
          <?php
            echo get_the_term_list( $post->ID, 'topics', '<h5 class="">Focus</h5><ul class="topics"><li class="topic">', '</li><li class="topic">', '</li></ul>' );
          ?>
        </div>
      </div>
    </div>
    <div class="col-sm-8 col-sm-pull-4">
      <article>
        <?php 
        global $more;    // Declare global $more (before the loop).
        $more = 0;       // Set (inside the loop) to display content above the more tag.
        echo strip_tags( get_the_content("Continue Reading..."), '<a><p>' );
        ?>
      </article>
    </div>
  </div>
  <button type="button" class="btn btn-block btn-lg "><a class="" href="<?php echo get_permalink($post->ID); ?>">Go to <?php echo display_name_format(get_the_title()); ?>&apos;s Page <span class="glyphicon glyphicon-arrow-right"></span></a></button>
</div>

