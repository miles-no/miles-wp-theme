<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Miles_2020
 */

?>
<footer id="colophon" class="site-footer">
   <div class="footer__content">
      <miles-logo width="150" color="#ffffff"></miles-logo>
      <div class="footer-wrapper footer-widgetarea-container">
      	<?php if ( is_active_sidebar( 'footer-contact' ) ) : ?>
               <div class="footer-contact-wrapper">
                  <?php dynamic_sidebar( 'footer-contact' ); ?>
               </div>
      	<?php endif; ?>
      	
      	<?php if ( is_active_sidebar( 'footer-social' ) ) : ?>
               <div class="footer-socials-widgetarea">
                  <?php dynamic_sidebar( 'footer-social' ); ?>
               </div>
      	<?php endif; ?>
      </div>
   	
   	<?php if ( is_active_sidebar( 'footer-info' ) ) : ?>
            <div class="footer-widgetarea-container footer-info-widgetarea">
               <?php dynamic_sidebar( 'footer-info' ); ?>
            </div>
   	<?php endif; ?>
   </div>
	</footer><!-- #colophon --> 
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
