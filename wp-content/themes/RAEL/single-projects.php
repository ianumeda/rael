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

    <div class="project_page project_<?php echo $post->ID; ?>">
          <!-- <a class="btn btn-link" href="<?PHP echo bloginfo("url")."/projects"; ?>"><span class="fa fa-angle-left"></span> Go to the Projects Page</a> -->
<?php
  if (has_post_thumbnail( $post->ID ) ){
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); 
    $imgurl=$image[0];
    ?>
    <div class="banner_image" style="background-image:url(<?php echo $imgurl; ?>)";>
      <div class="fade_to_white"></div>
    </div>
  <?php 
  } 
?>
<div class="container">

        <div class="row">
          <div class="col-xs-12">
            <h2 class="project_title">
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
          		  echo '<div class="post_thumbnail fitted"><span class="fa fa-picture-o"></span></div>';
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
          <?php
          $authors=get_posts_associated_posts_of_type($post->ID,'people');
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
          <div class="title col-sm-2">Project Members:</div>
          <div class="authors col-sm-10">
            <?php echo $authors_list; ?>
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
        $publications=get_posts_reverse_associated_posts_of_type($post->ID,'publications');
        if($publications){
        ?>
        <div class="projects row">
        <?php
          $publications_list.='<ul>';
          foreach( $publications as $publication ){
            $publications_list.='<li class="project"><a class="" title="go to the '.(get_the_title($publication)).' page" href="'.get_permalink($publication).'">';
            $publications_list.=get_the_title($publication);
            $publications_list.='</a></li>';
          }
          $publications_list.='</ul>'; 
          ?>
          <div class="title col-sm-2">Associated Publications:</div>
          <div class="projects col-sm-10">
            <?php echo $publications_list; ?>
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
      <?php } 
      $related_news_posts=get_posts_reverse_associated_posts_of_type($post->ID, 'post');
      if(count($related_news_posts) > 0){
      ?>
        <div class="row news">
          <div class="title col-sm-2 col-xs-12">Related News:</div>
          <div class="col-sm-10 ">
            <ol>
            <?php
            foreach($related_news_posts as $news_post){
              echo '<li><a href="'.get_permalink($news_post).'" title="go to this news post"><span class="title">'.get_the_title($news_post).'</span></a> <span class="date">'.get_the_date('d M Y',$news_post).'</span> </li>';
            }
            ?>
            </ol>
          </div>
        </div>
      <?php
      }
      ?>
      </div>
    </div>

      <div class="row">
        <h3 class="section_heading" style="text-align:center;"><?php shiftnav_toggle( 'projects', "<span class='fa fa-bars'></span> Projects" ); ?></h3>
        <div class="pager">
          <?php get_adjacent_post_links($post->ID); ?>
        </div>
      </div>
  </div>

</div>
      <?php endwhile; ?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>