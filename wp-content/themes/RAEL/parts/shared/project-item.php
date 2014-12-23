<?php
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
$people=get_posts_associated_posts_of_type($post->ID,'people');
$people_list='';
$people_string='';
if($people){
  $people_list.='<ul class="people">';
  foreach( $people as $author ){
    $people_list.='<li class="btn btn-link btn-xs person click-search-filter" title="filter using this name" data-search-query="'.strtolower(get_the_title($person)).'">';
    $people_list.=get_the_title($author);
    $people_list.='</li>';
    $people_string.=get_the_title($author)."|";
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
  $people_list.='</ul>';
}
$projects=get_posts_associated_posts_of_type($post->ID,'publications');
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
<div id="project_<?php echo $post->ID; ?>" class="project_item <?php echo (get_field("current_project",$post->ID)=="true" ? "current_project " : ""); ?><?php echo ($counter==0 ? 'in' : '') ?>" data-title="<?php echo strtolower(get_the_title($post->ID)).'|'.strtolower(get_field('published_in',$post->ID)); ?>" data-topics="<?php echo strtolower($term_string); ?>" data-year="<?php echo get_the_date('Y',$post->ID); ?>" data-authors="<?php echo strtolower($authors_string); ?>" data-type="<?php echo get_field('publication_type', $post->ID); ?>">

  <div class="background_button" data-toggle="collapse" data-target="#pub_<?php echo $post->ID; ?>_more_info_collapse"></div>
    <div class="row">
      <div class="col-xs-12 project_title visible-xs">
        <a href="<?php echo get_the_permalink($post->ID); ?>" title="View this project"><?php echo get_the_title($post->ID); ?></a> 
      </div>
      <div class="project_image col-sm-6">
        <div class="row">
          <div class="col-sm-12">
          <?php 
              if(has_post_thumbnail( $post->ID ) ){
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); 
                $imgurl=$image[0];
          ?>
                <div class="image fitted_image" style="background-image: url('<?php echo $imgurl; ?>')"></div>
          <?php 
            } else { ?>
              <span class="image fitted_icon fa fa-picture-o"></span> 
          <?php }
          ?>
            <a class="coverall_link" href="<?php echo get_permalink($post->ID); ?>">View Project <span class="fa fa-angle-right"></span></a>
          </div>
        </div>
      </div>
      <div class="project_info col-sm-6">
        <div class="project_title hidden-xs">
          <a href="<?php echo get_the_permalink($post->ID); ?>" title="View this project"><?php echo get_the_title($post->ID); ?></a> 
        </div>
        <div class="project_excerpt">
          <?php echo get_the_excerpt($post->ID); ?>
        </div>
        <div class="project_topics">
          <span class="title">Topics:</span>
          <?php echo $term_list; ?>
        </div>
        <div class="project_people">
          <span class="title">Project Members:</span>
          <?php echo $people_list; ?>
        </div>
      
        <div class="pub_link col-xs-12">
          <a class="post_link btn btn-link btn-block btn-sm" href="<?php echo get_permalink($post->ID); ?>">View Project <span class="fa fa-sign-in"></span></a>
        </div>
      </div>
    </div>
  </div>
  <?php $counter++; ?>