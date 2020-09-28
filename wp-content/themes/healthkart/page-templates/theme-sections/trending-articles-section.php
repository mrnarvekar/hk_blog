<h1 class="trending-articles-heading pt-3 pb-3">TRENDING</h1>
<div class="trending-articles mt-4">
	<div class="row">
		<div class="col-md-8 col-12 row">
		<?php 
			$post_ids = get_query_var('post_ids');
			$args = array(
				'posts_per_page' => 2,
				'post_type' => array('post'),
				'post_status' => 'publish',
				'post__not_in' => $post_ids,
				'meta_key' => 'hk_views',
				'order' => 'DESC',
				'orderby' => 'meta_value_num'
			);
			$main_post = new wp_query( $args );
			if( $main_post->have_posts() ) :
				while( $main_post->have_posts() ) :
					$main_post->the_post(); 
					$post_ids[] = get_the_id();?>
					<div class="trending-articles-single trending-articles-single-main col-md-6 col-12">
						<div class="trending-articles-single-image mb-4"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
							<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail('medium', ['title' => get_the_title()]); ?>
							<?php
							} else { ?>
							<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/default.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
							<?php } ?>
						</a></div>
						<div class="trending-articles-single-content">
							<div class="content-title">
								<?php $categories = hk_get_category(get_the_ID());  ?>
								<span>
									<span class="category">
										<?php foreach($categories as $index => $category): ?>
										<a title="<?php echo $category->name; ?>" href="<?php echo get_category_link($category); ?>" rel="category tag"><?php echo $category->name; ?></a>
										<?php if($index+1 != count($categories)): ?>
											,
										<?php endif; endforeach; ?>
									</span>
									<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
									<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
								</span>
								<h2 class="title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							</div>
							<div class="content-description"><?php echo hk_get_excerpt(90); ?></div>
						</div>
					</div>
				<?php endwhile;
			endif; ?>
		</div>
		<div class="col-md-4 col-12 sidebar">
			<?php
                do_shortcode('[Subscribe-form]');
            ?>
		</div>
	</div>
	<h1 class="trending-articles-heading pt-3 pb-3 mt-5">MORE SIMILIAR</h1>
	<div class="row">
	<?php
	$args = array(
		'posts_per_page' => 6,
		'post_type' => array('post'),
		'post_status' => 'publish',
		'post__not_in' => $post_ids,
		'meta_key' => 'hk_views',
		'order' => 'DESC',
		'orderby' => 'meta_value_num'
	);
	$main_post = new wp_query( $args );
	if( $main_post->have_posts() ) :
		while( $main_post->have_posts() ) :
			$main_post->the_post(); 
			$post_ids[] = get_the_id();?>
			<div class="trending-articles-single row mb-3 col-md-4 col-12">
				<div class="trending-articles-single-image mb-5 col-md-4 col-12"><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
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
					
				</a></div>
				<div class="trending-articles-single-content col-md-8 col-12">
					<div class="content-title">
						<?php $categories = hk_get_category(get_the_ID()); ?>
						<span>
							<span class="category">
								<?php foreach($categories as $index => $category): ?>
								<a title="<?php echo $category->name; ?>" href="<?php echo get_category_link($category); ?>" rel="category tag"><?php echo $category->name; ?></a>
								<?php if($index+1 != count($categories)): ?>
									,
								<?php endif; endforeach; ?>
							</span>
							<span class="dot"><i class="fa fa-circle" aria-hidden="true"></i></span>
							<span class="last-read"><?php echo get_mins_read(); ?> MIN READ</span>
						</span>
						<h2 class="title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</div>
				</div>
			</div>
		<?php endwhile;
	endif; 
	set_query_var( 'post_ids', $post_ids );
?>
	</div>
</div>