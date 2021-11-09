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
get_template_part( 'page-templates/theme-sections/follow-sidebar', 'section' ); 
?>

<div class="single-post pt-25">
	<div class="header_image position-relative">
		<div class="header">
			<div class="container">
				<div class="breadcrumbs-wrapper position-relative">
      				<div class="breadcrumbs-inside">
      					<?php echo yoast_breadcrumb(); ?>
  					</div>
  				</div>
			</div>
		</div>
	</div>

	<div class="single_post_page">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-12 single-post-content">
					<div class="entry-content row mt-4">
					<div class="col-12 d-flex flex-column align-items-center justify-content-center reviewer">
							<?php 
							$user_info = get_user_by( 'slug', get_query_var( 'author_name' ) );
							if (!empty(get_avatar_url( $user_info->ID ))){
								?><img class="reviewer-avatar" src="<?php echo esc_url( get_avatar_url( $user_info->ID ) ); ?>" /><?php
							}
							if (!empty(get_the_author_meta( 'hk_designation', $user_info->ID))){
								?><p class="reviewer-designation"><?php echo get_the_author_meta( 'hk_designation', $user_info->ID); ?></p>
							<?php } ?>
							<h1 class="p-0 reviewer-dname"><?php echo $user_info->display_name; ?></h1>
								<?php
									$facebook = get_the_author_meta( 'facebook', $user_info->ID );
									$instagram = get_the_author_meta( 'instagram', $user_info->ID );
									$linkedin = get_the_author_meta( 'linkedin', $user_info->ID );
									$myspace = get_the_author_meta( 'myspace', $user_info->ID );
									$pinterest = get_the_author_meta( 'pinterest', $user_info->ID );
									$soundcloud = get_the_author_meta( 'soundcloud', $user_info->ID );
									$tumblr = get_the_author_meta( 'tumblr', $user_info->ID );
									$twitter = get_the_author_meta( 'twitter', $user_info->ID );
									$youtube = get_the_author_meta( 'youtube', $user_info->ID );
									$wikipedia = get_the_author_meta( 'wikipedia', $user_info->ID );
									
							if(!empty($facebook || $instagram || $linkedin || $myspace || $pinterest || $soundcloud || $tumblr || $twitter || $youtube || $wikipedia )){?>
								<div class="reviewer-social-media">
											<!-- facebook -->
											<?php if (!empty($facebook)){ ?>
											<a href="<?php echo esc_url($facebook); ?>" class="social-media-icons" rel="nofollow" target="_blank"><i class="fa fa-facebook"></i></a>
											<?php } ?>
											<!-- instagram -->
											<?php if (!empty($instagram)){ ?>
											<a href="<?php echo esc_url($instagram); ?>" class="social-media-icons" rel="nofollow" target="_blank"><i class="fa fa-instagram"></i></a>
											<?php } ?>
											<!-- linkedin -->
											<?php if (!empty($linkedin)){ ?>
											<a href="<?php echo esc_url($linkedin); ?>" class="social-media-icons" rel="nofollow" target="_blank"><i class="fa fa-linkedin"></i></a>
											<?php } ?>
											<!-- myspace -->
											<?php if (!empty($myspace)){ ?>
											<a href="<?php echo esc_url($myspace); ?>" class="social-media-icons" rel="nofollow" target="_blank"><i class="fa fa-external-link"></i></a>
											<?php } ?>
											<!-- pinterest -->
											<?php if (!empty($pinterest)){ ?>
											<a href="<?php echo esc_url($pinterest); ?>" class="social-media-icons" rel="nofollow" target="_blank"><i class="fa fa-pinterest"></i></a>
											<?php } ?>
											<!-- soundcloud -->
											<?php if (!empty($soundcloud)){ ?>
											<a href="<?php echo esc_url($soundcloud); ?>" class="social-media-icons" rel="nofollow" target="_blank"><i class="fa fa-soundcloud"></i></a>
											<?php } ?>
											<!-- tumblr -->
											<?php if (!empty($tumblr)){ ?>
											<a href="<?php echo esc_url($tumblr); ?>" class="social-media-icons" rel="nofollow" target="_blank"><i class="fa fa-tumblr"></i></a>
											<?php } ?>
											<!-- twitter -->
											<?php if (!empty($twitter)){ ?>
											<a href="<?php echo "https://twitter.com/".$twitter; ?>" class="social-media-icons" rel="nofollow" target="_blank"><i class="fa fa-twitter"></i></a>
											<?php } ?>
											<!-- youtube -->
											<?php if (!empty($youtube)){ ?>
											<a href="<?php echo esc_url($youtube); ?>" rel="nofollow" class="social-media-icons" target="_blank"><i class="fa fa-youtube-play"></i></a>
											<?php } ?>
											<!-- wikipedia -->
											<?php if (!empty($wikipedia)){ ?>
											<a href="<?php echo esc_url($wikipedia); ?>" rel="nofollow" class="social-media-icons" target="_blank"><i class="fa fa-wikipedia-w"></i></a>
											<?php } ?>
								</div>
							<?php } ?>
							<?php $reviewer_bio = get_the_author_meta('description');
							if(!empty($reviewer_bio)){?>
								<p class="reviewer-bio"> <?php echo $reviewer_bio ?> </p>
							<?php } ?>
						</div>
					</div> 
					<div class="latest-reads">
						<div class="read-these-next">
							<div class="section-title pb-3">Latest Articles</div>
							<?php
							$reviewer_info = get_user_by( 'slug', get_query_var( 'author_name' ) );
							$reviewer_id = $reviewer_info->ID;
							$reviewer_username = $reviewer_info->user_login;

							$reviewer_meta = get_userdata($reviewer_id);
							$reviewer_roles = $reviewer_meta->roles;

							if ( in_array( 'reviewer', $reviewer_roles, true ) ) {
								$post_ids = [];
   							/*  echo "User is a reviewer";
							echo "<br> current reviewer = ".$reviewer_username."<br>";
 */
								$args = array(
									'post_type' => array('post','page'),
									'post_status' => 'publish',
									'posts_per_page' => 5
								  );
								  $qry = new WP_Query($args);?>
								  <?php  // Loop through posts
								if( $qry->have_posts() ) :
								while( $qry->have_posts() ) :
								$qry->the_post(); 
								$post_ids[] = get_the_id(); 
								?>
								<?php $reviewedby = get_field('medically_reviewed_by');
								if(!empty($reviewedby) && ($reviewer_username == $reviewedby)){
									/* echo "this post has reviewer = ".$reviewedby;
									echo "<br> required reviewer = ".$reviewer_username."<br>"; */
									?>
									<div class="col-12 recent-post p-0">
									<div class="row py-4">
										<div class="col-md-4 col-12">
											<div class="recent-post-featured-img">
												<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
													<?php 
													$thumbnail = get_post_meta(get_the_id(), 'hk_thumbnail_image', true);
													if ( $thumbnail ) { ?>
														<img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
													<?php } else if ( has_post_thumbnail() ) {
													the_post_thumbnail('medium', ['title' => get_the_title()]); ?>
													<?php
													} else { ?>
													<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
													<?php } ?>
												</a>
											</div>
										</div>
										<div class="col-md-8 col-12 next-articles">
											<span>
												<span class="category">
													<?php the_category(' , '); ?>
												</span>
												<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
												<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
												<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
												<?php $post_date = get_the_date( 'M j, Y' ); ?>
												<span class="last-read"><?php echo $post_date; ?></span>
											</span>
											<div class="recent-post-header">
												<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
											</div>
											<div class="recent-post-excerpt"><?php echo wp_trim_words(get_the_content(), 18, '...'); ?>
											</div>
											<div class="recent-post-icons">
												<span class="mr-3 f-14 heart"><i class="fa fa-heart" aria-hidden="true"></i> 15 </span>
												<span class="mr-3 f-14 comment"><i class="fa fa-comments" aria-hidden="true"></i> 3</span>
											</div>
										</div>
									</div>
								</div>
								<?php } ?>
								<?php endwhile; ?>
							<?php endif; ?>
							<!-- end loop -->
							<?php }
							else{
								$post_ids = [];
							 	$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
								$args = array(
									'posts_per_page' => 5,
									'author__in'   => array( $author->ID ),
									'no_found_rows'  => true,
									'author'        =>  $author->ID,
								);
								
								// Query posts
								$wpex_query = new wp_query( $args );?>
								<?php  // Loop through posts
								if( $wpex_query->have_posts() ) :
								while( $wpex_query->have_posts() ) :
								$wpex_query->the_post(); 
								$post_ids[] = get_the_id(); ?>
									<div class="col-12 recent-post p-0">
										<div class="row py-4">
											<div class="col-md-4 col-12">
												<div class="recent-post-featured-img">
													<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
														<?php 
														$thumbnail = get_post_meta(get_the_id(), 'hk_thumbnail_image', true);
														if ( $thumbnail ) { ?>
															<img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
														<?php } else if ( has_post_thumbnail() ) {
														the_post_thumbnail('medium', ['title' => get_the_title()]); ?>
														<?php
														} else { ?>
														<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
														<?php } ?>
													</a>
												</div>
											</div>
											<div class="col-md-8 col-12 next-articles">
												<span>
													<span class="category">
														<?php the_category(' , '); ?>
													</span>
													<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
													<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
													<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
													<?php $post_date = get_the_date( 'M j, Y' ); ?>
													<span class="last-read"><?php echo $post_date; ?></span>
												</span>
												<div class="recent-post-header">
													<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
												</div>
												<div class="recent-post-excerpt"><?php echo wp_trim_words(get_the_content(), 18, '...'); ?>
												</div>
												<div class="recent-post-icons">
													<span class="mr-3 f-14 heart"><i class="fa fa-heart" aria-hidden="true"></i> 15 </span>
													<span class="mr-3 f-14 comment"><i class="fa fa-comments" aria-hidden="true"></i> 3</span>
												</div>
											</div>
										</div>
									</div>
								<?php endwhile; ?>
							<?php endif; ?>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-12">
					<?php
						set_query_var( 'post_ids', $post_ids );
	                    get_sidebar();
	                ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();

?>
