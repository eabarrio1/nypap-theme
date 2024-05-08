<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head>section and everything up till <div id="main">
 *
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?></title>
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, width=device-width">

	<meta content="" property="og:url" />
	<meta content="<?php wp_title( '|', true, 'right' );?>" property="og:title" />
	
	<link rel="profile" href="http://gmpg.org/xfn/11">	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="shortcut icon" href="https://www.nypap.org/favicon.ico" />

	<?php wp_head(); ?>

<body <?php body_class(); ?>>


<div id="banner">							
	<div class="wrapper">
		<div class="site-tagline">
			Help NYPAP document and celebrate NYC&rsquo;s preservation movement. <a href="/donate" class="button red-button">Donate ></a>
		</div>		
	</div>
</div>

<div id="page" class="hfeed site wrapper">

	<header id="masthead" class="site-header container" role="banner">
		<div class="header-main">
			<section class="container" id="logo-search-container">				
				<!-- logo, search, buttons -->
				<div class="section group">

					<div class="site-branding col span_4_of_6">
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<button id="menu-toggle" class="menu-toggle"><?php _e( 'Menu', 'nypap' ); ?></button>
						<?php endif;?>
					</div><!-- .site-branding -->
					<div class="col span_2_of_6 secondary-nav">
						<div class="clearfix">
							<a href="/support" class="button support" >Support Us</a>
							<a href="/about" class="button about" >About Us</a>
						</div>
						<div>
							<?php get_search_form(); ?>
						</div>
					</div>

				</div>
			</section>
			<section class="container navigation">
				<!-- menu -->
				<div class="section group">
				<?php if ( has_nav_menu( 'primary' )) : ?>

					<div id="site-header-menu" class="site-header-menu">
						
						<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'nypap' ); ?>">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'primary',
									'menu_class'     => 'primary-menu clearfix',
								 ) );
							?>
						</nav><!-- .main-navigation -->

						<!-- secondary nav for mobile appears under site-navigation -->
						<div class="mobile-secondary-nav">
							<div class="clearfix">
								<a href="/support" class="button support" >Support Us</a>
								<a href="/about" class="button about" >About Us</a>
							</div>
							<div>
								<?php get_search_form(); ?>
							</div>
						</div>
					</div><!-- .site-header-menu -->
				<?php endif; ?>

				</div>

			</section>

			
			
		</div> 

	</header><!-- #masthead -->

	<div id="content" class="site-content">
