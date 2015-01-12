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
        $all_types=array();
      	while ( $query->have_posts() ) {
      		$query->the_post();
          if(!in_array(get_the_date('Y',$post->ID), $all_years)){
            $all_years[]=get_the_date('Y',$post->ID);
          }
          if(!in_array(get_field('publication_type',$post->ID), $all_types)){
            $all_types[]=get_field('publication_type',$post->ID);
          }
        }
      } 
    ?>
    <div class="row publications_layout">
      <div class="pub_filters clearfix">
        <div class="title col-sm-1 col-xs-12">Filter:</div>
        <div class="col-xs-12 col-sm-2">
          <select id="year_select" class="form-control input-sm" onchange="do_the_filter();">
            <option value="0">All Years</option>
            <?php
            foreach($all_years as $year){
              echo '<option value="'.$year.'">'.$year.'</option>';
            }
            ?>
          </select>
        </div>
        <div class="col-xs-12 col-sm-2">
          <select id="publication_type_select" class="form-control input-sm" onchange="do_the_filter();">
            <option value="0">All Types</option>
            <?php
            foreach($all_types as $type){
              echo '<option value="'.$type.'">'.$type.'</option>';
            }
            ?>
          </select>
        </div>
        <div class="col-xs-12 col-sm-4">
          <input type="text" class="form-control search-query input-sm" placeholder="Search Title, Author, or Topic">
        </div>
        <div class="col-xs-12 col-sm-3">
          <button class="clear_filter_button btn pull-right btn-sm">Clear All Filters</button>
          <span class="filter_results"></span>
        </div>
      </div>
      <div class="table_head hidden-xs clearfix">
        <div class="pub_date col-sm-2 ">Publish Date</div>
        <div class="pub_title col-sm-7 ">Title</div>
        <div class="pub_authors col-sm-2 ">Author(s)</div>
        <div class="pub_actions col-sm-1">Actions</div>
      </div>
      <div id="publications_list" class="table_data col-xs-12">
        <?php
          $query = new WP_Query( array( 'post_type' => 'publications', 'posts_per_page' => '-1', 'offset' => '0', 'order' => 'DESC', 'orderby' => 'date' ));
          if ( $query->have_posts() ) {
            $counter=0;
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
function do_the_filter(filter_year,filter_type,filter_string){
  var year_results=year_filter(filter_year);
  var type_results=publication_type_filter(filter_type);
  var select_filter_results=year_results.filter(type_results);
  var search_results=search_filter(filter_string);
  var final_results=(search_results==undefined ? select_filter_results : select_filter_results.filter(search_results));
  $('div.publication_item').fadeOut();
  final_results.each(function(){
    $(this).fadeIn();
  });
  if(final_results.length == $('.publication_item').length){
    $('.filter_results').html("Showing all publications");
  } else {
    $('.filter_results').html("Showing "+final_results.length+" of "+($('.publication_item').length)+" publications");
  }
  if(final_results.length<1){
    $('#no_filter_results').show();
  } else {
    $('#no_filter_results').hide();
  }
}
function year_filter(year) {
  if(year){ 
    console.log("year filter:", year);
    $("#year_select").val(year);
  } else {
    var year = $('#year_select').val();
  }
  if(year=="All Years"){
    return $('div.publication_item');
  } else {
    return $('div.publication_item[data-year*="'+year+'"]');
  }
}
function publication_type_filter(type) {
  if(type){ 
    $('#publication_type_select').val(type); 
  } else {
    var type = $('#publication_type_select').val();
  }
  if(type=="0"){
    return $('div.publication_item');
  } else {
    return $('div.publication_item[data-type*="'+type+'"]');
  }
}
function search_filter(search_string){
  if(search_string){
    $('input.search-query').val(search_string);
  } else {
    search_string=search_string==null ? $('input.search-query').val().toLowerCase() : search_string.toLowerCase();    
  }
  if(search_string.length>1){
    var name_results=$('div.publication_item[data-topics*="'+search_string+'"]').add($('div.publication_item[data-title*="'+search_string+'"]')).add($('div.publication_item[data-authors*="'+search_string+'"]'));
    return name_results;
  } else {
    return null;
  }
}

$(document).ready(function(){
  var init_filter_year="<?php echo htmlspecialchars($_GET["publication_year"]); ?>";
  var init_filter_type="<?php echo htmlspecialchars($_GET["publication_type"]); ?>";
  var init_filter_string="<?php echo htmlspecialchars($_GET["publication_search"]); ?>";
  console.log("init filters:",init_filter_year, init_filter_type, init_filter_string);

  $(".click-search-filter").on("click", function(){
    $('input.search-query').val($(this).attr('data-search-query'));
    do_the_filter();
  });
  $(".publication_type_filter_button").on("click", function(){
    console.log($(this).html(), $('#publication_type_select').val());
    $('#publication_type_select').val($(this).attr('data-publication_type'));
    do_the_filter();
  });
  $('.btn').button();
  // $('.collapse').collapse();
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
    $('#publication_type_select').val(0);
    do_the_filter();
  });
  do_the_filter(init_filter_year,init_filter_type,init_filter_string); // ensures the selected year filter is correct on load
});
</script>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>
