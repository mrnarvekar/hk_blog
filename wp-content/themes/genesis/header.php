<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Templates
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

/**
 * Fires at start of header.php, immediately before `genesis_title` action hook to render the Doctype content.
 *
 * @since 1.3.0
 */
do_action( 'genesis_doctype' );

/**
 * Fires immediately after `genesis_doctype` action hook, in header.php to render the document title.
 *
 * @since 1.0.0
 */
do_action( 'genesis_title' );

/**
 * Fires immediately after `genesis_title` action hook, in header.php to render the meta elements.
 *
 * @since 1.0.0
 */
do_action( 'genesis_meta' );

wp_head(); // We need this for plugins.
?>
</head>
<?php
genesis_markup(
	[
		'open'    => '<body %s>',
		'context' => 'body',
	]
);

if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}

/**
 * Fires immediately after the `wp_body_open` action hook.
 *
 * @since 1.0.0
 */
do_action( 'genesis_before' );

genesis_markup(
	[
		'open'    => '<div %s>',
		'context' => 'site-container',
	]
);

/**
 * Fires immediately after the site container opening markup, before `genesis_header` action hook.
 *
 * @since 1.0.0
 */
do_action( 'genesis_before_header' );

/**
 * Fires to display the main header content.
 *
 * @since 1.0.2
 */
//do_action( 'genesis_header' );

/**
 * Fires immediately after the `genesis_header` action hook, before the site inner opening markup.
 *
 * @since 1.0.0
 */
do_action( 'genesis_after_header' );
?>
<header id="site-header" class="site-header">
		<div class="container">
			<div class="tob-bar-menu">
				<?php wp_nav_menu( array( 'theme_location' => 'top-menu' ) ); ?>
			</div>
			<div id="site-navigation" class="site-navigation">
				<div class="main-header d-flex justify-content-between pt-3 pb-4">
					<div class="logo-text">
						<div class="site-logo d-flex align-items-center">
							<!--Toggle Start -->
							<div id="togglerBtn" class="toggler">
					        	<div class="top-line"></div>
					            <div class="mid-line"></div>
					            <div class="bot-line"></div>
			        		</div> <!-- Toggler End-->
							<?php 
							   	$custom_logo_id = get_theme_mod( 'custom_logo' );
							   	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
					      	?>
							<img src="<?php echo $image[0]; ?>" alt="" class="pr-2">
							<span class="pr-4 f-24 font-weight-500">Blog</span>
						</div>
						<div class="input-group">
							<input type="text" class="form-control search-bar" placeholder="Search Healthkart Blog">
							<div class="input-group-append button-icon">
								<button class="btn" type="button">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/search-icon.png" alt="search" class="search-icon-white">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/search-icon-grey.png" alt="search" class="search-icon-grey">
								</button>
							</div>
						</div>
					</div>
					<div class="action-block">
						<a href=""> Shop at Healthkart <i class="fa fa-arrow-right pl-2" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="navbar navbar-expand-md navbar-light header-menu p-0">
					  <?php wp_nav_menu(); ?>
				</div>
			</div>
		</div>
		<!-- Mobile Menu -->
		<div class="menu-list-container">
			<div class="mweb-innnermenu">
				<div class="menu-section">
					<div class="menu-content-list expandable">
						<div class="">
							<div class="user-bar">
								<div class="greet-container">
									<span class="close-icon"></span>
									<span class="user-name">To get personalised Offers</span>
								</div>
								<div class="user-mweb-button">
									<ul>
										<li class="login-link-mweb">
											<a href="https://www.healthkart.com/account/" target="_blank">Log In</a>
										</li>
										<li class="registeruser">
											<a href="https://www.healthkart.com/account/" target="_blank">Sign Up</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="list-view">
								<?php wp_nav_menu(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
<?php
// genesis_markup(
// 	[
// 		'open'    => '<div %s>',
// 		'context' => 'site-inner',
// 	]
// );
// genesis_structural_wrap( 'site-inner' );
