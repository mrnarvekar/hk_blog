<?php

/*
* Template Name: Import
* The template for migrating data
*/
set_time_limit(0);
require_once("../../../wp-load.php");
require_once( '../../../wp-admin/includes/post.php' );
require_once(__DIR__."/config/field_mapping.php");
header("Content-Type: text/plain");

$mydb = new wpdb('root','root','fitness_freak','localhost');
$nodes = $mydb->get_results("select * from node where type in ('".implode("','", array_keys($post_types))."')");
$x=1;
foreach ($nodes as $node) {
	$field_data_body = $mydb->get_row("select * from field_data_body where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
	if(!$field_data_body){
		$body = '';
		$field_data_field_enter_story = $mydb->get_results("select * from field_data_field_enter_story where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
		foreach ($field_data_field_enter_story as $field_enter_story) {
			$field_data_field_text = $mydb->get_row("select * from field_data_field_text where entity_id='".$field_enter_story->field_enter_story_value."' and entity_type='field_collection_item' and bundle='field_enter_story'");
			if($field_data_field_text){
				$body .= $field_data_field_text->field_text_value;
			}
			$field_data_field_image_upload = $mydb->get_row("select * from field_data_field_image_upload where entity_id='".$field_enter_story->field_enter_story_value."' and entity_type='field_collection_item' and bundle='field_enter_story'");
			if($field_data_field_image_upload){
				$field_data_field_upload_image = $mydb->get_row("select * from field_data_field_upload_image where entity_id='".$field_data_field_image_upload->field_image_upload_value."' and entity_type='field_collection_item' and bundle='field_image_upload'");
				if($field_data_field_upload_image){
					$file_managed = $mydb->get_row("select * from file_managed where fid='".$field_data_field_upload_image->field_upload_image_fid."'");
					if($file_managed){
						$media_id = fetch_image($file_managed->fid, $field_data_field_upload_image->field_upload_image_alt, $field_data_field_upload_image->field_upload_image_title);
						if($media_id){
							$image_markup = "<div class='row'><div class='col-12'><div class='hk-content-image'><img src='".wp_get_attachment_image_src( $media_id, 'full' )[0]."'></div></div></div>";
							$body .= $image_markup;
						}
					}
				}
			}
		}
		if($body){
			$field_data_body = new stdClass;
			$field_data_body->body_value = str_replace("https://www.healthkart.com/connect", "", $body);
		}
	}
	$field_data_field_url = $mydb->get_row("select * from field_data_field_url where entity_id='".$node->nid."' and entity_type='node' and bundle='video'");
	if($field_data_field_url){
		$video_body = $field_data_field_url->field_url_value;
		preg_match('/src=\"(.*?)\"/', $video_body, $matches);
		if($matches[1]){
			$field_data_body = new stdClass;
			$field_data_body->body_value = get_video($matches[1]);
		}
	}

	$url_alias = $mydb->get_row("select * from url_alias where source='node/".$node->nid."'");
	$users = $mydb->get_row("select * from users where uid='".$node->uid."'");

	$post_data = [];
	foreach ($field_mapping['post'] as $post_field => $field_data) {
		$params = explode(".", $field_data['field']);
		if(isset(${$params[0]}->{$params[1]})){
			if(isset($field_data['change']) && is_callable($field_data['change'])){
				$value = $field_data['change'](${$params[0]}->{$params[1]});
			}
			else{
				$value = ${$params[0]}->{$params[1]};
			}
			$post_data[$post_field] = $value;
		}
	}
	echo "ID: ".$node->nid;
	$post_id = wp_insert_post($post_data, true);
	echo ", Post: ".json_encode($post_id);
	//echo ", Data: ".json_encode($post_data);
	$field_data_field_image = $mydb->get_row("select * from field_data_field_image where entity_id='".$node->nid."'");
	if($field_data_field_image){
		$file_managed = $mydb->get_row("select * from file_managed where fid='".$field_data_field_image->field_image_fid."'");
		if($file_managed){
			$media_id = fetch_image($file_managed->fid, $field_data_field_image->field_image_alt, $field_data_field_image->field_image_title);
			if($media_id){
				add_post_meta($post_id, '_thumbnail_id', $media_id);
			}
		}
	}
	
	$field_data_field_description = $mydb->get_row("select * from field_data_field_description where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
	$field_data_field_accomplish_goal = $mydb->get_row("select * from field_data_field_accomplish_goal where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
	$field_data_field_age_after_diet = $mydb->get_row("select * from field_data_field_age_after_diet where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
	$field_data_field_age_before_diet = $mydb->get_row("select * from field_data_field_age_before_diet where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
	$field_data_field_body_fat_before_diet = $mydb->get_row("select * from field_data_field_body_fat_before_diet where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
	$field_data_field_body_fat_after_diet = $mydb->get_row("select * from field_data_field_body_fat_after_diet where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
	$field_data_field_how_did_you_overcome_these = $mydb->get_row("select * from field_data_field_how_did_you_overcome_these where entity_type='node' and bundle='".$node->type."' and entity_id='".$node->nid."'");
	$node_counter = $mydb->get_row("select * from node_counter where nid='".$node->nid."'");
	foreach ($field_mapping['meta'] as $field => $field_data) {
		$params = explode(".", $field_data['field']);
		if(isset(${$params[0]}->{$params[1]})){
			if(isset($field_data['change']) && is_callable($field_data['change'])){
				$value = $field_data['change'](${$params[0]}->{$params[1]});
			}
			else{
				$value = ${$params[0]}->{$params[1]};
			}
			update_post_meta($post_id, $field, $value);
		}
	}
	$taxonomies = $mydb->get_results("select v.name as tax_name, v.machine_name as tax_slug, v.description as tax_description, t.name as term_name, i.sticky
		from taxonomy_vocabulary as v inner join taxonomy_term_data as t on t.vid=v.vid 
		inner join taxonomy_index as i on t.tid=i.tid 
		left join field_data_field_display_name as f on t.tid=f.entity_id 
		where i.nid = '".$node->nid."'
	");
	$term_ids = [];
	echo ", Tax: ";
	foreach ($taxonomies as $tax) {
		if(isset($taxonomy[$tax->tax_slug])){
			$current_tax = $taxonomy[$tax->tax_slug];
			$term_names = explode('#', $tax->term_name);
			foreach ($term_names as $term_name) {
				$term_name = trim($term_name);
				if(isset($field_mapping['taxonomy'][$current_tax][$term_name])){
					$term_name = $field_mapping['taxonomy'][$current_tax][$term_name];
				}
				if($term_name){
					$term = term_exists($term_name, $current_tax);
					if(!$term){
						$term = wp_insert_term($term_name, $current_tax );
						echo $term_name.", ";
						if($tax->sticky){
							update_term_meta($term['term_id'], 'is_sticky', 'true');
						}
					}
					if(is_wp_error($term)){
						echo json_encode($term);
					}else{
						$term_ids[$current_tax][] = (int)$term['term_id'];
					}
				}
			}
		}
	}
	
	if(isset($hk_types[$node->type])){
		$term_name = $hk_types[$node->type];
		$term = term_exists($term_name, 'hk_type');
		if(!$term){
			$term = wp_insert_term($term_name, 'hk_type' );
			echo $term_name.", ";
		}
		if(is_wp_error($term)){
			echo json_encode($term);
		}else{
			$term_ids['hk_type'][] = (int)$term['term_id'];
		}
	}

	foreach ($term_ids as $tax => $ids) {
		wp_set_post_terms($post_id, $ids, $tax);
	}
	echo "\n\n---------------------\n\n";
	$x++;
	if($x == 100){
		//break;
	}
} 
