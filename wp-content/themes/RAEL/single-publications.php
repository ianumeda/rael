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
          <a class="btn btn-link" href="<?PHP echo bloginfo("url")."/publications"; ?>"><span class="fa fa-angle-left"></span> Go to the Publications Page</a>
          <div class="col-xs-12">
            <h2 class="publication_title">
            <?php echo (get_the_title()); ?>
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-3 col-sm-push-9">
            <?php
              if (has_post_thumbnail( $post->ID ) ){
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); 
                $imgurl=$image[0];
                // echo '<div class="post_thumbnail square" style="background-image:url('. $imgurl .')";></div>';
                echo '<div class="post_thumbnail fitted"><img src="'. $imgurl .'"></div>';
              } else {
                if(get_field('publication_type')=='Book'){
            		  echo '<div class="post_thumbnail fitted"><span class="fa fa-book"></span></div>';
                } else {
            		  echo '<div class="post_thumbnail fitted"><span class="fa fa-file-pdf-o"></span></div>';
                }
              }
            ?>
            <?php 
            if(get_field('publication_file')){
              echo '<a class="btn btn-default btn-block" title="download this publication" href="'.get_field('publication_file').'" target="_blank"><span class="fa fa-download"></span> Download</a>';
            }
            if(get_field('publication_link')){
              echo '<a class="btn btn-default btn-block" title="download this publication from an external website" href="'.get_field('publication_link').'" target="_blank"><span class="fa fa-external-link"></span> Link to Publication</a>';
            }?>
          </div>
          <div class="col-sm-9 col-sm-pull-3">
            <div class="row">
              <div class="title col-sm-2 col-xs-8">Published:</div>
              <div class="publish_date col-sm-7 col-xs-8">
                <?php the_date(); ?>
              </div>
            </div>
        <div class="row">
          <?php
          $authors=get_publications_authors($post->ID);
          $authors_list='';
          if($authors){
            $authors_list.='<ul>';
            foreach( $authors as $author ){
              $authors_list.='<li class="author"><a class="" title="go to '.display_name_format(get_the_title($author)).'\'s page" href="'.get_permalink($author).'">';
              $authors_list.=get_the_title($author);
              $authors_list.='</a></li>';
            }
            if(!empty(get_field('additional_authors'))){
              $add_authors=explode("\n", get_field('additional_authors'));
              foreach($add_authors as $author){
                $authors_list.='<li class="author">';
                $authors_list.=$author;
                $authors_list.='</li>';
              }
            }
            $authors_list.='</ul>';
          }          
          ?>
          <div class="title col-sm-2">Author(s):</div>
          <div class="authors col-sm-10">
            <?php echo $authors_list; ?>
          </div>
        </div>
        <?PHP 
        if(!empty(get_field('doi'))){ 
        ?>
        <div class="publication_doi row">
          <div class="title col-sm-2">DOI:</div>
          <div class="topics col-sm-10">
            <a href="http://dx.doi.org/<?php echo get_field('doi'); ?>" target="_blank"><?php echo get_field('doi'); ?></a>
          </div>
        </div>
        <?php             
        }
        ?>
        <div class="row">
          <?php
          $pub_type=get_field('publication_type');
          ?>
          <div class="title col-sm-2">Publication Type:</div>
          <div class="type col-sm-10">
            <?php echo $pub_type; ?>
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
        $content = get_the_content();
        if(trim($content) != "") {
        ?>
        <div class="row the_content">
          <div class="title col-sm-2 col-xs-12">Abstract:</div>
          <div class="col-sm-10 ">
            <article>
              <?php the_content(); ?>
            </article>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>

      <div class="row">
        <h3 class="section_heading" style="text-align:center;">Browse Publications:</h3>
        <div class="pager">
          <?php get_adjacent_post_links($post->ID); ?>
        </div>
      </div>
  </div>
</div>
      <?php endwhile; ?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>