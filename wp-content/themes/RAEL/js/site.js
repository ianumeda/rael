
	jQuery(document).ready(function($) {

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
        match_height(true);
      }
    };
    
    function match_height (init){
      var shortest=10000000;
      if(init){
        $('.match_height').each(function(){
          if(!$(this).hasClass("match_this_height")){
            $(this).attr("original_height",$(this).height());
            $(this).addClass("collapsed");
          }
        });
      }
      if(1==2 && $('.match_this_height').length > 0){
        shortest=$('.match_this_height').height();
      } else {
        $('.match_height.collapsed').each(function(){
          $(this).height("auto");
          shortest=$(this).height() < shortest ? $(this).height() : shortest;
        });
      }
      $('.match_height.collapsed').each(function(){
        if(!$(this).hasClass("match_this_height")){
          $(this).height(shortest);
        } 
      });
    }
    $('.match_height').each(function(){
      if(!$(this).hasClass('.match_this_height')){
        $(this).append('<button class="btn btn-xs btn-block btn-link match_height_button">Read More</button>');
      }
    });
    $('.match_height_button').on("click", function(){
      if($(this).parent().hasClass("collapsed")){
        $(this).parent().removeClass("collapsed");
        $(this).parent().height($(this).parent().attr("original_height"));
        $(this).html("Hide");
      } else {
        $(this).parent().height($('.match_this_height').height());
        $(this).parent().addClass("collapsed");
        $(this).html("read more");
      }
    });
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
    on_resize(false);
    
    $("#footer").click(function(e){
      if( $(this).hasClass("active") ) {
        $(this).removeClass("active");
      } else {
        $(this).addClass("active");
      }
    });
    
});

