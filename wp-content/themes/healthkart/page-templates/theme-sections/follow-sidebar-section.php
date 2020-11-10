<div id="social-follow-sidebar" class="content-desktop">
	<?php $social_data = get_option('wpseo_social'); 
	foreach ($social_data as $type => $link) : 
		$type_parts = explode("_", $type); 
		if($link): ?>
			<a href="<?php echo $link; ?>" class="contact-button-link <?php echo $type_parts[0]; ?>" title="Follow on <?php echo ucwords($type_parts[0]); ?>" target="_blank" style=""><span class="fa fa-<?php echo $type_parts[0]; ?>"></span></a>
		<?php endif; 
	endforeach; ?>
</div>