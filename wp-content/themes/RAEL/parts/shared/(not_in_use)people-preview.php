<?php
global $columns_per_preview;
if(!is_numeric($columns_per_preview)) $columns_per_preview=3;
global $person_type; 
if($person_type==undefined) $person_type="";
?>
<div class="person_<?php echo str_replace(' ','_',strtolower($person_type)); ?> person_item col-xs-6 col-sm-<?php echo $columns_per_preview; ?>">
  <a class="" href="<?php echo get_permalink($post->ID); ?>">
<?php 
  if ($columns_per_preview>2){
    if(has_post_thumbnail( $post->ID ) ){
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); 
      $imgurl=$image[0];
?>
      <div class="image headshot" style="background-image: url('<?php echo $imgurl; ?>')"></div>
<?php 
  } else { 
?>
      <!-- <div class="image headshot"><span class="glyphicon glyphicon-user"></span></div> -->
<?php 
  }
}
?>
      <h4 class="name"><?php echo display_name_format(get_the_title()); ?></h4>

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
    </a>
    <?php
      echo get_the_term_list( $post->ID, 'topics', '<ul class="person_meta"><li class="topic">', '</li><li class="topic">', '</li></ul>' );
    ?>
    <p class="person_excerpt"><?php echo get_the_excerpt(); ?></p>
    <button type="button" class="btn btn-link btn-block btn-xs"><a class="post_preview_link" href="<?php echo get_permalink($post->ID); ?>">Go to <?php echo display_name_format(get_the_title()); ?>&apos;s Page <span class="glyphicon glyphicon-arrow-right"></span></a></button>
</div>
