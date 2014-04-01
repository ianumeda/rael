
	jQuery(document).ready(function($) {

    function set_footer_position(){
      var page_position=$('#page').position();
      var page_bottom=page_position.top+$('#page').outerHeight(true);
      // alert(page_position.top+" + "+$('#page').outerHeight(true));
      if( $(window).height() > page_bottom + $('#footer').outerHeight(true) ){
        $('#footer').css({'position':'fixed', 'bottom':'0px'});
      } else {
        $('#footer').css({'position':'absolute', 'top':(page_bottom)+'px'});
      }
    } 

		new UISearch( document.getElementById( 'sb-search-top' ) );
		new UISearch( document.getElementById( 'sb-search-bottom' ) );
    
    function makesquares(){
      $('.headshot.square').each(function(){
          var $img = $(this),
              imgWidth = $img.width();

          $(this).css({"height":imgWidth});
          $('.person_page .headshot .glyphicon-user').css({"font-size":imgWidth});
      });
      
    }

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
        set_footer_position();
        last_resize=$.now();
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
    on_resize(false);
	});

