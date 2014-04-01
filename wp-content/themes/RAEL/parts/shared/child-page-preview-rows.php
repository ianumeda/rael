<?php

echo '<div class="parent_page_item row">';
echo '<a class="" href=' . get_permalink($post->ID) . '>';
if (has_post_thumbnail( $post->ID ) ){
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); 
  $imgurl=$image[0];
  echo '<div class="image" style="background-image: url('. $imgurl .');"></div>';
} else {
  // echo '<div class="image"><span class="glyphicon glyphicon-star"></span></div>';
}
echo '<h5 class="name">' .get_the_title();
if($titles=wp_get_post_terms($post->ID, 'titles', array("fields" => "names"))) { 
  echo '<span class="titles">';
  foreach($titles as $title){
    echo ', ';
    echo $title;
  }
  echo '</span>';
}
echo '</h5>';
echo '</a>';
the_excerpt();
// echo '<button type="button" class="btn btn-link btn-block btn-xs"><a class="" href=' . get_permalink($post->ID) . '>Go to '. display_name_format(get_the_title()) .'\'s Page <span class="glyphicon glyphicon-arrow-right"></span></a></button>';
echo '</div>';

?>