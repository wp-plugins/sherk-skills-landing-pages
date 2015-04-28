<?php


class SherkSkillsHelper {


	public function __construct() {
		/*AJAX 	prep*/
		add_action('sherk_skills_action', array($this, 'sherk_skills_action'));
		add_action('wp_ajax_sherk_skills_action', array($this, 'sherk_skills_action'));
		add_action('wp_ajax_nopriv_sherk_skills_action', array($this, 'sherk_skills_action'));
	}



	/**
	 * Saves the smarttask data to the post_meta with meta_keys
	 * @todo save data in json format
	 *
	 * @return string echo success for ajax
	 */ 
	public function sherk_skills_action() {
		$dataSherkSkills=json_decode(str_replace("\\", "",$_POST['data_sherk_skills']), true);
		$post_id=$_POST['post_id'];
		$request=$_POST['request'];
		$post=get_post($post_id);
		$access=current_user_can('edit_posts');
		
 		if ($request=='get') {
			echo json_encode(array('access'=>$access, 'success'=>true, 'webs'=>get_post_meta( $post_id, '_web_sherk_skills', true),'videos'=>get_post_meta( $post_id, '_video_sherk_skills', true)));
		} else if ($access==true) { //making sure valid user
			if ($request=='add_update_web_submit') {
				if ($this->sherk_skills_addUpdate($post_id, $dataSherkSkills,'_web_sherk_skills')) {
					echo json_encode(array('request'=>$request,'videos'=>get_post_meta( $post_id, '_video_sherk_skills', true), 'webs'=>get_post_meta( $post_id, '_web_sherk_skills', true), 'success'=>true));
				}else {
					echo json_encode(array('request'=>$request, 'success'=>false));
				}
			}else if($request=='delete_web_submit'){
				if ($this->sherk_skills_remove($post_id, $dataSherkSkills,'_web_sherk_skills')) {
					echo json_encode(array('request'=>$request, 'webs'=>get_post_meta( $post_id, '_web_sherk_skills', true), 'success'=>true));
				}else {
					echo json_encode(array('request'=>$request, 'success'=>false));
				}
			} else if ($request=='add_update_video_submit') {
				if ($this->sherk_skills_addUpdate($post_id, $dataSherkSkills,'_video_sherk_skills')) {
					echo json_encode(array('request'=>$request,'videos'=>get_post_meta( $post_id, '_video_sherk_skills', true), 'success'=>true));
				}else {
					echo json_encode(array('request'=>$request, 'success'=>false));
				}
			}else if($request=='delete_video_submit'){
				if ($this->sherk_skills_remove($post_id, $dataSherkSkills,'_video_sherk_skills')) {
					echo json_encode(array('request'=>$request,'videos'=>get_post_meta( $post_id, '_video_sherk_skills', true), 'success'=>true));
				}else {
					echo json_encode(array('request'=>$request, 'success'=>false));
				}
			} 
		}  

		die(1);

	}
	
	public function getDbSherkSkillsArray($post_id,$metakey) {
		$oldJSONValue=get_post_meta( $post_id, $metakey, true);
		if ($oldJSONValue && $oldJSONValue!='null') {
			return json_decode($oldJSONValue, true);
		}else {
			return array();
		}
	}

	public function sherk_skills_addUpdate($post_id, $jsonData,$metakey) {
		$arrayCollection = array();
		$arrSherkSkills=$this->getDbSherkSkillsArray($post_id,$metakey);
		$updated=false;
		
		foreach ($arrSherkSkills as $sherkSkills) {
			if($metakey=='_web_sherk_skills'){
				if ($sherkSkills['web_title'] == $jsonData['web_title']) {
					$sherkSkills['web_url']=$jsonData['web_url'];
					$sherkSkills['web_desc']=$jsonData['web_desc'];
					$updated=true;
				}
			}else if($metakey=='_video_sherk_skills'){
				if ($sherkSkills['video_title'] == $jsonData['video_title']) {
					$sherkSkills['video_embed']=$jsonData['video_embed'];
					$sherkSkills['video_desc']=$jsonData['video_desc'];
					$updated=true;;
				}
			}
			array_push($arrayCollection, $sherkSkills);
		}
		if($updated==false){ //to be added
			array_push($arrayCollection, $jsonData);
		}
		return update_post_meta($post_id, $metakey, json_encode($arrayCollection));
	}

	public function sherk_skills_remove($post_id, $jsonData, $metakey) {
		$arrayCollection = array();
		$arrSherkSkills=$this->getDbSherkSkillsArray($post_id, $metakey);

		foreach ($arrSherkSkills as $sherkSkills) {
			if($metakey=='_web_sherk_skills'){
				if ($sherkSkills['web_title'] != $jsonData['web_title']) {
					array_push($arrayCollection, $sherkSkills);
				}
			}else if($metakey=='_video_sherk_skills'){
				if ($sherkSkills['video_title'] != $jsonData['video_title']) {
					array_push($arrayCollection, $sherkSkills);
				}
			}
		}
		return update_post_meta($post_id, $metakey, json_encode($arrayCollection));
	}
	
	function get_all_sherk_skills_keys(){
		$arr_sherk_skills_keys=array();
		
		$args = array(
			'numberposts'	=> -1,
			'post_type' => 'sherk_skills',
			'post_status' => 'publish',
		);
		
		$the_query = new WP_Query( $args ); 
		
		if ( $the_query->have_posts() ) : 
			while ( $the_query->have_posts() ) : $the_query->the_post();
			    $meta_sherk_skills = get_post_meta(get_the_ID(), '_sherk_skills_meta',true);
				$image_attributes = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');
				if($image_attributes ) {
				    $img_url=$image_attributes[0];
				}else{
					$img_url='';
				}
			    $arr_sherk_skills_keys[]=array(
						'title'=>get_the_title(),
						'url'=>get_permalink($post->ID),
						'key'=>$meta_sherk_skills,
						'img_url'=>$img_url,
						);
			endwhile; 
			wp_reset_postdata(); 
		endif;
		
		return $arr_sherk_skills_keys;
	}

}

new SherkSkillsHelper();