function home_page_layout(){
  height_to_match=$("#welcome").height();
  // height_to_match=($("#events_col").height() > $("#welcome").height() ? $("#events_col").height() : $("#welcome").height() );
  // first the news column
  if($('#events_col').hasClass('col-sm-6')){  
    // events stacked on top of news so don't need to adjust events
    height_to_match-= $("#events_col").height() ; 
    var last_news_item=$('#news_col > div > .news_item:last-child');
    while(last_news_item && $('#news_col').height()-last_news_item.height()>height_to_match){
      last_news_item.hide();
      last_news_item=last_news_item.prev();
    }
  } else {
    // otherwise adjust both news and events
    var last_news_item=$('#news_col > div > .news_item:last-child');
    while(last_news_item && $('#news_col').height()-last_news_item.height()>height_to_match){
      last_news_item.hide();
      last_news_item=last_news_item.prev();
    }
    var last_events_item=$('#events_col > div > .event_item:last-child');
    while(last_events_item && $('#events_col').height()-last_events_item.height()>height_to_match){
      last_events_item.hide();
      last_events_item=last_events_item.prev();
    }
  }
  // now increase spacer divs so all columns match
  if($('#events_col').hasClass('col-sm-3')){
    $('#welcome .spacer').height($('#news_col').height()-$('#welcome').height()-$('#welcome .spacer').height());
    $('#events_col .spacer').height($('#welcome').height()-$('#events_col').height()-$('#events_col .spacer').height());
    $('#news_col .spacer').height($('#welcome').height()-$('#news_col').height()-$('#news_col .spacer').height());
  } else {
    $('#welcome .spacer').height($('#events_col').height()+$('#news_col').height()-$('#welcome').height()-$('#welcome .spacer').height());
    $('#news_col .spacer').height($('#welcome').height()-$('#events_col').height()-$('#news_col').height()-$('#news_col .spacer').height());
  }
}

function set_footer_position(){
  var page_position=$('#page').position();
  var page_bottom=page_position.top+$('#page').outerHeight(true);
  if( $(window).height() < page_bottom + $('#footer').outerHeight(true) ){
    $('#footer').css({'position':'relative'});
  } else {
    // $('#footer').css({'position':'absolute', 'top':(page_bottom)+'px'});
    $('#footer').css({'position':'fixed', 'bottom':'0'});
  }
} 
    
function makesquares(){
  $('.square').each(function(){
    var max_width=240;
    var $img = $(this),
        imgWidth = ($img.width() > max_width ? max_width : $img.width());

    // $(this).css({"height":imgWidth});
    $(this).find('.fa').each(function(){ $(this).css({"font-size":imgWidth}); });
  });
  $('.fitted').each(function(){
    var max_width=$(this).parent().innerWidth();//240;
    var $img = $(this),
        imgWidth = ($img.width() > max_width ? max_width : $img.width());

    // $(this).css({"height":imgWidth});
    $(this).find('.fa').each(function(){ $(this).css({"font-size":imgWidth}); });
    $(this).addClass('is_fitted');
  });
}

$('.coverall_link').each(function(){
  $(this).css("line-height",$(this).parent().height()+"px");
});

var throttle_id=null;
function throttle_on_resize(thedelayamount){
  // this function sets a timer function that calls on_resize after thedelayamount. when called during that delay a new delay is set. 
  if(thedelayamount==null) thedelayamount=1000;
  if(throttle_id!=null){
    // kill current throttle 
    clearTimeout(throttle_id);
  }
  // start a new one...
  throttle_id=setTimeout(function() { on_resize(true); },thedelayamount); 
}

function on_resize(go_immediately) {
  if(!go_immediately) throttle_on_resize();
  else {
    throttle_id=null;
    makesquares();
    set_carousel_height();
  }
};


function set_carousel_height(){
  var ideal_h_ratio=.666;
  var min_h=300;
  var max_h=640;
  var viewport_w=$(window).width();
  var viewport_h=$(window).height();
  var ideal_h=viewport_h*ideal_h_ratio;
  if(ideal_h>max_h) { var set_height=max_h; } 
  else if(ideal_h<min_h) { var set_height=min_h; }
  else { var set_height=ideal_h; }
  $(".carousel_bottom").css({"margin-top":set_height+"px"});
}
$( window ).resize(function() {
  on_resize(false);
}); 
$(window).load(function(e){ 
  on_resize(false);
});    

jQuery(document).ready(function($) {

  on_resize(false);
  
  $("#footer").click(function(e){
    if( $(this).hasClass("active") ) {
      $(this).removeClass("active");
    } else {
      $(this).addClass("active");
    }
  });

});

