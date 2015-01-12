    <script>  
    // this adds affiliate logos and info into shiftnav
      $(document).ready(function(){
        $(".ucb.affiliate_logo").append('<a href="http://berkeley.edu" alt="UC Berkeley" target="_blank"><img src="<?php bloginfo("template_directory"); ?>/images/UCSeal-transparent-122x122.png" width="61" height="61"><span class="ucbtext">University of California, Berkeley</span></a>');    
        $('.copyright_info').append('<div id="copyright" class="col-xs-12">&copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</div>');
      }); 
    </script>
	<?php wp_footer(); ?>
	</body>
</html>