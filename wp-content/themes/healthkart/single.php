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
				<?php if ( have_posts() ) : ?>
					<?php			
					while ( have_posts() ) :
					  the_post();
					  $views = (int) get_post_meta($post->ID, 'hk_views', true);
					  update_post_meta($post->ID, 'hk_views', $views + 1);
					  $hindi_url = get_post_meta($post->ID, 'hk_hindi_post', true);
					  $english_url = get_post_meta($post->ID, 'hk_english_post', true);
					?>
						<header class="entry-header col-12">
							<span>
								<?php $categories = hk_get_category(get_the_ID()); 
								 	$GLOBALS['global_article_id']  = get_the_ID();

								 ?>
								<span class="category">
									<?php foreach($categories as $index => $category): ?>
									<a title="<?php echo $category->name; ?>" href="<?php echo get_category_link($category); ?>" rel="category tag"><?php echo $category->name; ?></a>

									<?php if($index+1 != count($categories)): ?>
										,
									<?php endif; endforeach; ?>
								</span>
								<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
								<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
								<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
								<span class="last-read"><?php echo $views+1; ?> VIEWS</span>
								<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
								<span class="last-read"><?php the_date(); ?></span>
								<?php if($hindi_url): ?>
									<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
									<span class="category"><a href="/<?php echo $hindi_url; ?>">Read in Hindi</a></span>
								<?php endif; ?>
								<?php if($english_url): ?>
									<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
									<span class="category"><a href="/<?php echo $english_url; ?>">Read in English</a></span>
								<?php endif; ?>
							</span>
							<div class="post-title">
								<h1 class="entry-title mt-2"><?php the_title(); ?></h1>
								<div class="d-flex flex-row align-items-center author">
										<?php 
										$user_info = get_userdata($post->post_author);
										?>
									<div class="">
									<?php 
										$reviewedby = get_field('medically_reviewed_by');
										if(!empty($reviewedby)){
											$reviewedby = get_field('medically_reviewed_by');
											$username = sanitize_user($reviewedby);
											if ( username_exists( $username) ) {
												$user_data = get_user_by('login', $username);
												if(!empty($user_data->user_lastname || $user_data->user_firstname)){
										?>
										<div class="date f-12 text-black font-weight-bold reviewer">Medically Reviewed By
										<a href="<?php echo get_author_posts_url($user_data->ID); ?>" class="author-link"> 
											<?php 
														echo $user_data->display_name;
											?>
										</a>
										</div>
										<?php
														}
													}
												}
										 ?>
										<div class="date f-12 text-black font-weight-bold">Written By
										<a href="<?php echo get_author_posts_url($user_info->ID); ?>" class="author-link"> 
											<?php 
												echo $user_info->display_name;
											?>
										</a>
										</div>
									</div>
								</div>
							</div>
						</header>
						<div class="col-md-8 col-12 single-post-content">
						<div class="category">
									<?php the_category(' <span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span> '); ?>
								</div>
							<div class="entry-content entry-description mt-2"><p><?php if(has_excerpt(get_the_ID())): echo get_the_excerpt(); endif; ?></p></div>
							<div class="popupOverlay">
								<?php
								if ( has_post_thumbnail() ) :
								the_post_thumbnail( 'large', ['title' => get_the_title()] );
								endif;
								?>
							</div>
							<div class="blog_featured_img mb-4">
								<?php
								if ( has_post_thumbnail() ) :
								the_post_thumbnail( 'large', ['title' => get_the_title()] );
								endif;
								?>
							</div>
							<?php
								$description = get_post_meta($post->ID, 'hk_description', true);
								if ($description) :
								?><div class="entry-content entry-description"><p><?php echo $description; ?></p></div><?php 
								endif;
							?>
							<div class="entry-content"><?php the_content(); ?></div>  
							  <?php 
                                $postUrl = 'http' . ( isset( $_SERVER['HTTPS'] ) ? 's' : '' ) . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; 
                                $title = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));
                            ?>
							<div class="share share-desktop">
								<div class="share-title section-title"> Share </div>
								<div class="share-icons">
									<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $postUrl; ?>" class="text-orange f-28" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<a href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $postUrl; ?>&amp;via=Healthkart" class="text-orange f-28" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
									<!-- Whatsapp sharing onn desktop -->
									<a href="https://web.whatsapp.com/send?text=<?php echo $postUrl; ?>" id="whatsapp-desktop" class="whatsapp social boxed-icon white-fill" data-href="<?php echo $postUrl; ?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>
								</div>
							</div>
							<div class="share share-mob">
								<div class="share-title section-title"> Share Article </div>
								<div class="share-icons">
									<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $postUrl; ?>" class="text-orange f-28" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<a href="https://twitter.com/intent/tweet?text=<?php echo $title; ?>&amp;url=<?php echo $postUrl; ?>&amp;via=Healthkart" class="text-orange f-28" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
									<!-- Whatsapp sharing onn mobile -->
									<a href="whatsapp://send?text=<?php echo $postUrl; ?>" id="whatsapp-mobile" class="whatsapp social boxed-icon white-fill" data-href="<?php echo $postUrl; ?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>
								</div>
							</div>
							<div class="comment-block">
								<?php if($_GET['unapproved']): ?>
								<div class="alert alert-success">
								  <strong>Success!</strong> Your comment has been sent for moderation.
								</div>
							<?php endif;
								$fields =  array(
								    'author' =>
								        '<input class="comment-input comment-input-name" required name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .'" size="30" placeholder="'.__('Name','text-domain').( $req ? ' (Required)' : '' ).'"/>',
								    'email' =>
								        '<input required class="comment-input comment-input-email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" size="30" placeholder="'.__('Email','text-domain').( $req ? ' (Required)' : '' ).'"/>',
								);
								$args = array(
								    'id_form'           => 'commentform',
								    'class_form'        => 'comment-form',
								    'id_submit'         => 'submit',
								    'class_submit'      => 'submit',
								    'name_submit'       => 'submit',
								    'submit_button'     => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
								    'title_reply'       => '',
								    'title_reply_to'    => __( 'Reply to %s','text-domain' ),
								    'cancel_reply_link' => __( 'Cancel comment','text-domain' ),
								    'label_submit'      => __( 'Post comment','text-domain' ),
								    'format'            => 'xhtml',
								    'comment_field'     =>  '<textarea id="comment" name="comment" placeholder="'.__('Add a comment...','text-domain').'" cols="45" rows="2" aria-required="true">' .'</textarea>',
								    'logged_in_as'      => '',
								    'comment_notes_before' => '',
								    'fields'            => $fields,
								);

								comment_form( $args );
								$comments = get_comments( array('status' => 'approve','order' => 'DESC', 'post_id' => get_the_id()) );
								?>
								<ul class="comments-list">
								<?php foreach ($comments as $comment): ?>
									<li>
										<div class="my-4">
											<div class="comment-author-image">
												<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/avatar.jpg" alt="search" class="search-icon-white">
											</div>
											<div class="comment-text">
												<div class="comment-text-author"><?php echo $comment->comment_author; ?></div>
												<div class="comment-text-content"><?php echo $comment->comment_content; ?></div>
												<div class="comment-text-date"><?php display_human_readable_time($comment->comment_date); ?></div>
											</div>
										</div>
									</li>
								<?php endforeach; ?>
								</ul>
							</div>
							<div class="latest-reads">
								<?php echo do_shortcode('[read-these-next]'); ?>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
				<div class="col-md-4 col-12">
					<?php
	                    get_sidebar();
	                ?>
				</div>
			</div>
		</div>
	</div>
	<a id="back-to-top" href="#" class="btn btn-lg back-to-top" role="button"><i class="fa fa-chevron-up"></i></a>
</div>

<?php
get_footer();

?>
