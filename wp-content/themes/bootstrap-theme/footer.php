<?php


?>

</div><!-- #page -->

<?php wp_footer(); ?>
<footer id="main-footer">
<div class="container">
 <div class="row">
   <div class="col-12 col-lg-3">
   <a href="/" class="footer-logo">
      <?php
       $footer_logo = get_theme_mod('footer_logo');
       $img = wp_get_attachment_image_src($footer_logo, 'full');
       if ($img) :
         ?>
       <img src="<?php echo $img[0]; ?>" alt="">
       <?php endif; ?>
     </a>
    </div>
  <div class="col-12 col-lg-9">
  	<nav id="site-navigation" class="main-navigation">
     <?php
	  wp_nav_menu(
		array(
		'theme_location' => 'menu-1',
	    'menu_id'        => 'primary-menu',
			)
			);
			?>
		  </nav><!-- #site-navigation -->
		</div>	
		</div>
	</div>
</footer>
</body>
</html>
