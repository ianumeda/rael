<?php
/**
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div id="publications_page" class="container">

    <div class="row content">
      <h2 class="section_heading">RAEL <?php the_title(); ?></h2>
        <?php
          the_content();
        ?>
        <?php
        $query = new WP_Query( array( 'post_type' => 'publications','posts_per_page' => '1', 'order' => 'ASC', 'orderby' => 'date', 'tag__in'=>array(80)));
        // tag id 80 is "spotlight"
        if ( $query->have_posts() ) {
        	while ( $query->have_posts() ) {
        		$query->the_post();
            Starkers_Utilities::get_template_parts( array( 'parts/shared/publication-spotlight' ) ); 
        	}
        } 
        wp_reset_postdata();
      ?>    
    </div>
    <?php
      $query = new WP_Query( array( 'post_type' => 'publications', 'posts_per_page' => '-1', 'offset' => '0', 'order' => 'DESC', 'orderby' => 'date' ));
      if ( $query->have_posts() ) {
        $all_years=array();
      	while ( $query->have_posts() ) {
      		$query->the_post();
          if(!in_array(get_the_date('Y',$post->ID), $all_years)){
            $all_years[]=get_the_date('Y',$post->ID);
          }
        }
      } 
    ?>
    <div class="row publications_layout">
      <h3 class="section_heading">All Publications</h3>
      <div class="pub_filters clearfix">
        <div class="title col-sm-1 col-xs-12">Filter:</div>
        <div class="col-xs-3 col-sm-2">
          <select id="year_select" class="form-control input-sm" onchange="do_the_filter();">
            <option value="0">All Years</option>
            <?php
            foreach($all_years as $year){
              echo '<option value="'.$year.'">'.$year.'</option>';
            }
            ?>
          </select>
        </div>
        <div class="col-xs-5">
          <input type="text" class="form-control search-query input-sm" placeholder="Search Title, Author, or Topic">
        </div>
        <div class="col-xs-4">
          
          <button class="clear_filter_button btn pull-right btn-sm">Clear All Filters</button>
          <span class="filter_results"></span>
        </div>
      </div>
      <div class="table_head hidden-xs clearfix">
        <div class="pub_date col-sm-2 ">Publish Date</div>
        <div class="pub_title col-sm-4 ">Title</div>
        <div class="pub_authors col-sm-2 ">Author(s)</div>
        <div class="pub_topics col-sm-2 ">Topics</div>
        <div class="pub_actions col-sm-2">Actions</div>
      </div>
      <div class="table_data col-xs-12">
        <?php
          $query = new WP_Query( array( 'post_type' => 'publications', 'posts_per_page' => '-1', 'offset' => '0', 'order' => 'DESC', 'orderby' => 'date' ));
          if ( $query->have_posts() ) {
            $all_years=array();
          	while ( $query->have_posts() ) {
          		$query->the_post();
              $all_years[]=get_the_date('Y',$post->ID);
        		  Starkers_Utilities::get_template_parts( array( 'parts/shared/publication-item' ) ); 
            }
          } else { ?>
          	<div class="alert alert-danger">Content not found.</div>
          <?php }
          wp_reset_postdata();
        ?>
      <div id="no_filter_results" class="alert alert-danger">
        No publications match the selected filter.
      </div>
    </div>
  </div>
</div>

</div>
<?php endwhile; ?>

<script>
function do_the_filter(init){
  var year_results=year_filter();
  var search_results=search_filter();
  var final_results=(search_results==undefined ? year_results : year_results.filter(search_results));
  $('div.publication_item').hide();
  final_results.each(function(){
    $(this).show();
  });
  $('.filter_results').html("Showing "+final_results.length+" of "+($('.publication_item').length)+" publications");
  if(final_results.length<1){
    $('#no_filter_results').show();
  } else {
    $('#no_filter_results').hide();
  }
  // if(!init) $('html,body').animate({scrollTop:($('#funds_list').position().top)},800,'swing');
}
function year_filter() {
  var year = $('#year_select').val();
  if(year=="All Years"){
    return $('div.publication_item');
  } else {
    return $('div.publication_item[data-year*="'+year.toLowerCase()+'"]');
  }
}
function search_filter(search_string){
  search_string=search_string==null ? $('input.search-query').val().toLowerCase() : search_string.toLowerCase();
  if(search_string.length>1){
    var name_results=$('div.publication_item[data-topics*="'+search_string+'"]').add($('div.publication_item[data-title*="'+search_string+'"]')).add($('div.publication_item[data-authors*="'+search_string+'"]'));
    return name_results;
  } else {
    return null;
  }
}
// function highlight_text(search_string){
//   search_string=search_string==null ? $('input.search-query').val().toLowerCase() : search_string.toLowerCase();
//   $('div.publication_item[data-topics*="'+search_string+'"]').add($('div.publication_item[data-title*="'+search_string+'"]')).add($('div.publication_item[data-authors*="'+search_string+'"]'));
// }

$(document).ready(function(){
  $(".click-search-filter").on("click", function(){
    $('input.search-query').val($(this).attr('data-search-query'));
    do_the_filter();
  });
  $('.btn').button();
  $("input.search-query").on("input change",function(){
    do_the_filter();
  }).keypress(function(e){
    // this prevents 'enter' from submitting the form and reloading the page...
    if ( e.which == 13 ) e.preventDefault();
  });
  $('.clear_filter_button').on('click', function(e){
    e.stopPropagation();
    $('input.search-query').val('');
    $('#year_select').val(0);
    do_the_filter();
  });
  do_the_filter(true); // ensures the selected year filter is correct on load
});
</script>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>
