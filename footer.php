<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

		</div><!-- .site-content -->

		<footer class="site-footer" role="contentinfo">
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'nypap' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'footer',
							'menu_class'     => 'footer-menu',
						 ) );
					?>
				</nav><!-- .main-navigation -->
			<?php endif; ?>

			<div class="section group">
				<div class="col span_3_of_6">
					<?php get_search_form(); ?>
				</div>
			</div>

			<!-- address -->
			<div class="site-info section group division soft-division">
				<div class="col span_3_of_6">
					<div class="section-tag">The New York Preservation Archive Project</div>
					<p>174 East 80th Street, New York, NY 10075<br/>Phone: (212) 988-8379  |  Fax: (212) 537-5571<br/>Contact Us: <a href="mailto:info@nypap.org">info@nypap.org</a></p>
					<div class="clearfix">
						<a class="button social-button button-white" href="https://www.facebook.com/NYPAP" target="_blank">Facebook</a>
						<a class="button button-white social-button" href="https://twitter.com/nypaproject" target="_blank">Twitter</a>
						<a class="button social-button button-white" href="https://www.youtube.com/user/NYPAProject" target="_blank">YouTube</a>
					</div>
				</div>
				<!-- sign up -->
				<div class="col span_3_of_6">
					<p>Sign up for NYPAP mailings and our <br/>Newsletter to stay up-to-date.</p>
					<!-- <script src="https://s3-us-west-2.amazonaws.com/bloomerang-public-cdn/newyorkpreservationarchiveproject/.widget-js/1087488.js" type="text/javascript"></script> -->
					<a class="button red-button" href="/register-for-mailings/">Sign up</a>

					<?php /*get_template_part( 'partials/content', 'signup' ); */?>
				</div>
			</div>	
			<!-- copyright -->
			<div class="credits section group division">
				Copyright &copy; 1998 &ndash; <?php echo date('Y'); ?> New York Preservation Archive Project. All rights reserved.<br/>
				Site design by <a href="http://kissmeimpolish.com" target="_blank">Kiss Me I’m Polish LLC</a>
			</div>
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
