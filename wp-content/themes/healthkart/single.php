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

// This file handles single entries, but only exists for the sake of child theme forward compatibility.
// genesis();

get_header(); 

?>

<div class="single-post">
	<div class="header_image position-relative">
		<div class="header">
			<div class="container">
				<div class="breadcrumbs-wrapper position-relative">
      				<div class="breadcrumbs-inside">
  						<a href="<?php echo get_site_url(); ?>/">Home</a> <span class="sep-icon">/</span> 
  						<span><a class="mr-1" href="<?php echo get_site_url(); ?>/exhibiting-advice">exhibiting advice</a><span class="sep-icon">/</span> <span class="breadcrumb-title"><?php the_title(); ?></span></span>
  					</div>
  				</div>
			</div>
		</div>
	</div>

	<div class="single_post_page">
		<div class="container">
			<?php if ( have_posts() ) : ?>
				<?php			
				while ( have_posts() ) :
				  the_post();
				?>
					<div class="blog_featured_img">
						<?php
						if ( has_post_thumbnail() ) :
						the_post_thumbnail( 'medium-large' );
						endif;
						?>
					</div>
					<header class="entry-header">
						<span><span class="category"><?php the_category(' , '); ?><span class="last-read">2 Min Read</span></span>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					</header>
					<div class="entry-content"><?php the_content(); ?></div>  
					<span class="entry-tags"><?php the_tags( null, ''); ?></span>
					<div class="share">
						<div class="share-title section-title"> Share </div>
						<div class="share-icons">
							<i class="fa fa-envelope" aria-hidden="true"></i>
							<i class="fa fa-facebook" aria-hidden="true"></i>
							<i class="fa fa-twitter" aria-hidden="true"></i>
							<i class="fa fa-pinterest-p" aria-hidden="true"></i>
							<i class="fa fa-reddit" aria-hidden="true"></i>
							<span>FEEDBACK</span>
							<i class="fa fa-smile-o" aria-hidden="true"></i>
							<i class="fa fa-frown-o" aria-hidden="true"></i>
						</div>
					</div>
					<div class="post-list-view">
						<div class="section-title">Read these next</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php
//get_sidebar();
get_footer();

?>
