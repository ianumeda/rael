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
  if(!empty(get_field('additional_authors',$post->ID))){
    $add_authors=explode("\n", get_field('additional_authors',$post->ID));
    foreach($add_authors as $author){
      $authors_list.='<li class="btn btn-link btn-xs author click-search-filter" title="filter using this name" data-search-query="'.strtolower($author).'">';
      $authors_list.=$author;
      $authors_list.='</li>';
      $authors_string.=$author."|";
    }
  }
  $authors_list.='</ul>';
}
$projects=get_posts_associated_posts_of_type($post->ID,'projects');
$projects_list='';
$projects_string='';
if($projects){
  $projects_list.='<ul class="projects">';
  foreach( $projects as $project ){
    $projects_list.='<li class="btn btn-link btn-xs author click-search-filter" title="filter for this project" data-search-query="'.strtolower(get_the_title($project)).'">';
    $projects_list.=get_the_title($project);
    $projects_list.='</li>';
    $projects_string.=get_the_title($project)."|";
  }
  $projects_list.='</ul>';
}
?>
<div id="publication_<?php echo $post->ID; ?>" class="publication_item <?php echo ($counter==0 ? 'in' : '') ?>" data-title="<?php echo strtolower(get_the_title($post->ID)).'|'.strtolower(get_field('published_in',$post->ID)); ?>" data-topics="<?php echo strtolower($term_string); ?>" data-year="<?php echo get_the_date('Y',$post->ID); ?>" data-authors="<?php echo strtolower($authors_string); ?>" data-type="<?php echo get_field('publication_type', $post->ID); ?>">

  <div class="background_button" data-toggle="collapse" data-target="#pub_<?php echo $post->ID; ?>_more_info_collapse"></div>
<div class="row">
  <div class="pub_date col-sm-2">
    <div class="row">
      <div class="title visible-xs col-xs-2">Date:</div>
      <div class="the_date col-xs-10 col-sm-12"><?php echo get_the_date('d M Y',$post->ID); ?></div>
    </div>
  </div>
  <div class="pub_title col-sm-7 ">
    <div class="row">
      <div class="title visible-xs col-xs-2">Title:</div>
      <div class="col-xs-10 col-sm-12">
        <a href="<?php echo get_the_permalink($post->ID); ?>" title="View this publication"><?php echo get_the_title($post->ID); ?></a> <button class="publication_type_filter_button btn btn-xs btn-link" title="filter for this publication type" data-publication_type="<?php echo get_field('publication_type',$post->ID); ?>">[<?php echo get_field('publication_type',$post->ID); ?>]</button>
        <?php 
        if(get_field('published_in',$post->ID)) { 
          echo '<button class="btn btn-link btn-xs click-search-filter published_in" data-search-query="'.strtolower(get_field('published_in',$post->ID)).'">['.get_field('published_in',$post->ID).']</button>';
        } 
        ?>
      </div>
    </div>
  </div>

  <div class="pub_authors col-sm-2">
    <div class="row">
      <div class="title visible-xs col-xs-2">Author(s):</div>
      <div class="col-xs-10 col-sm-12">
        <?php echo $authors_list; ?>
      </div>
    </div>
  </div>

  <div class="pub_actions col-sm-1">
    <div class="row">
      <div class="title visible-xs col-xs-2">Actions:</div>
      <div class="col-xs-10 col-sm-12">
        <?php if(get_field('publication_file',$post->ID)) { ?>
        <a href="<?php echo get_field('publication_file', $post->ID); ?>" target="_blank" class="download btn btn-link btn-xs"><span class="hidden-xs visible-sm">DL <span class="fa fa-download"></span></span><span class="visible-xs hidden-sm visible-md visible-lg">Download <span class="fa fa-download"></span></span></a>
        <?php } elseif(!empty(get_field('publication_link',$post->ID))){ ?>
        <a href="<?php echo get_field('publication_file', $post->ID); ?>" target="_blank" class="external_link btn btn-link btn-xs">Link <span class="fa fa-external-link"></span></a>
        <?php } ?>
        <a class="post_link btn btn-link btn-xs" href="<?php echo get_permalink($post->ID); ?>">View <span class="fa fa-sign-in"></span></a>
        <button class="more_info btn btn-link btn-xs" data-toggle="collapse" data-target="#pub_<?php echo $post->ID; ?>_more_info_collapse">More <span class="fa fa-angle-down"></span></button>
      </div>
    </div>
  </div>
</div>
  <div id="pub_<?php echo $post->ID; ?>_more_info_collapse" class="collapse" data-parent="#publications_list" aria-expanded="false">
    <?php if(trim(get_the_excerpt($post->ID)) != "") { ?>
      <div class="row">
        <div class="title col-xs-2">Abstract:</div>
        <div class="pub_excerpt col-xs-10 col-sm-8">
          <?php echo get_the_excerpt($post->ID); ?>
        </div>
      </div>
    <? 
      } 
      if($term_list!="") { 
    ?>
    <div class="row">
      <div class="title col-xs-2">Topics:</div>
      <div class="pub_topics col-xs-10 col-sm-8">
        <?php echo $term_list; ?>
      </div>
    </div>
    <? 
      } 
      if($projects_list) { 
    ?>
    <div class="row">
      <div class="title col-xs-2">Associated Projects:</div>
      <div class="pub_topics col-xs-10 col-sm-8">
        <?php echo $projects_list; ?>
      </div>
    </div>
    <? 
    } 
    if(!empty(get_field('doi',$post->ID))){ 
    ?>
    <div class="row">
      <div class="title col-xs-2">DOI:</div>
      <div class="topics col-xs-10">
        <a href="http://dx.doi.org/<?php echo get_field('doi',$post->ID); ?>" target="_blank"><?php echo get_field('doi',$post->ID); ?></a>
      </div>
    </div>
    <?php             
    }
    ?>
    <div class="pub_link col-xs-12">
      <a class="post_link btn btn-link btn-block btn-sm" href="<?php echo get_permalink($post->ID); ?>">View Publication <span class="fa fa-sign-in"></span></a>
    </div>
  </div>
</div>
<?php $counter++; ?>