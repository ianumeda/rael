<?php
// precompile term list for search filter
$terms = wp_get_post_terms( $post->ID, 'topics', array("fields" => "all") );
$term_list="";
$term_string="";
if(!empty($terms)){
  $term_list.='<ul class="topics">';
  foreach( $terms as $term ){
    $term_list.='<li class="topic btn btn-link btn-xs click-search-filter" title="filter using this topic" data-search-query="'.strtolower($term->name).'">';
    $term_list.= $term->name; 
    // $term_list.= ($term->count > 1) ? ('<a href="'. get_term_link($term) .'">'. $term->name .'</a>') : $term->name; // this needs to change to filter the publications list by this topic key
    $term_list.='</li>';
    $term_string.=$term->name."|";
  }
  $term_list.='</ul>';
}
$authors=get_posts_associated_posts_of_type($post->ID,'people');
$authors_list='';
$authors_string='';
if($authors){
  $authors_list.='<ul class="authors">';
  foreach( $authors as $author ){
    $authors_list.='<li class="btn btn-link btn-xs author click-search-filter" title="filter using this name" data-search-query="'.strtolower(get_the_title($author)).'">';
    $authors_list.=get_the_title($author);
    $authors_list.='</li>';
    $authors_string.=get_the_title($author)."|";
  }
  $authors_list.='</ul>';
}
?>
<div id="publication_<?php echo $post->ID; ?>" class="publication_item row" data-title="<?php echo strtolower(get_the_title($post->ID)); ?>" data-topics="<?php echo strtolower($term_string); ?>" data-year="<?php echo get_the_date('Y',$post->ID); ?>" data-authors="<?php echo strtolower($authors_string); ?>">
  <div class="pub_date col-sm-2"><span class="title visible-xs">Publication Date:</span><?php echo get_the_date('d M Y',$post->ID); ?></div>
  <div class="pub_title col-sm-4"><span class="title visible-xs">Title:</span><a href="<?php echo get_the_permalink($post->ID); ?>" title="View this publication"><?php echo get_the_title($post->ID); ?></a></div>
  <div class="pub_authors col-sm-2"><span class="title visible-xs">Author(s):</span>
    <?php echo $authors_list; ?>
  </div>
  <div class="pub_topics col-sm-2"><span class="title visible-xs">Topics:</span>
    <?php echo $term_list; ?>
  </div>
  <div class="pub_actions col-sm-2"><span class="title visible-xs">Actions:</span>
    <button class="download btn btn-link btn-xs">Download <span class="fa fa-download"></span></button>
    <a class="post_link btn btn-link btn-xs" href="<?php echo get_permalink($post->ID); ?>">View Publication <span class="fa fa-sign-in"></span></a>
    <button class="more_info btn btn-link btn-xs" data-toggle="collapse" data-target="#pub_<?php echo $post->ID; ?>_collapse">More Info <span class="fa fa-angle-down"></span></button>
  </div>
  <div class="pub_excerpt collapse col-sm-12" id="pub_<?php echo $post->ID; ?>_collapse">
    <span class="title visible-xs">Description:</span>
    <?php echo get_the_excerpt($post->ID); ?>
    <a class="post_link btn btn-link btn-sm" href="<?php echo get_permalink($post->ID); ?>">View Publication <span class="fa fa-sign-in"></span></a>
  </div>
  <button class="more_info_button btn btn-block btn-xs" data-toggle="collapse" data-target="#pub_<?php echo $post->ID; ?>_collapse"><span class="fa fa-angle-down"></span><span class="fa fa-angle-up"></span></button>
</div>
