<?php

/* Generated from http://themergency.com/generators/wordpress-custom-post-types/ */

class SherkSkillsMetaBox {

	public function __construct() {
		
		add_action('add_meta_boxes', array($this, 'register_meta_boxes'));
	
		//save meta box values
		//add_action('save_post', array($this, '_save_meta_boxes'), 1, 2);
		
	}

	
	function register_meta_boxes(){
		//$this->boxes[] = add_meta_box('key_sherk_skills','Scan and Replace Content for Skills', array($this, '_sherk_skills_html'), 'sherk_skills', 'side', 'high');
		$this->boxes[] = add_meta_box('website_sherk_skills','Website Skill Resources', array($this, '_websites_sherk_skills_html'), 'sherk_skills', 'normal', 'high');
		$this->boxes[] = add_meta_box('videos_sherk_skills','Video Skill Resources', array($this, '_videos_sherk_skills_html'), 'sherk_skills', 'normal', 'high');
	}
	
	function _websites_sherk_skills_html(){
		
		global $post;
		
		$meta = get_post_meta($post->ID, '_sherk_skills_meta',true);
		
		echo '<!-- WEehhe ';
			print_r($meta);
		echo '-->';
		
		if(empty($meta)){
		    $meta['_sherk_skills_meta_websites']=array();
		}
		echo '<div id="_post_id" value="'.$post->ID.'"></div>';
		echo '<table class="form-table" id="websherkform">';
			echo '<tr>';
				echo '<td>';
					echo 'Website Title:<br/><input class="large-text" type="text" name="_sherk_skills_meta_web_title" id="_sherk_skills_meta_web_title" value=""/>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>';
					echo 'Website Url:<br/><input class="large-text" type="text" name="_sherk_skills_meta_web_url" id="_sherk_skills_meta_web_url" value=""/>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>';
					echo 'Short Description:<br/><textarea class="widefat" name="_sherk_skills_meta_web_desc" id="_sherk_skills_meta_web_desc" value=""></textarea>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>';
					echo '<div class="button-secondary" id="_web_submit">Add Web Resource</div>';
				echo '</td>';
			echo '</tr>';
			
		echo '</table>';
		
		echo '<table class="widefat" id="list_webs"></table>';
		
	}//function
	
	function _videos_sherk_skills_html(){
		
		global $post;
		
		$meta = get_post_meta($post->ID, '_sherk_skills_meta',true);
		
		if(empty($meta)){
		    $meta['_sherk_skills_meta_videos']=array();
		}
		
		echo '<table class="form-table" id="videosherkform">';
			
			echo '<tr>';
				echo '<td>';
					echo 'Video Resource Title:<br/><input class="large-text" type="text" name="_sherk_skills_meta_video_title" id="_sherk_skills_meta_video_title" value=""/>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>';
					echo 'Video Resource Embed Video Url:<br/><textarea class="widefat" name="_sherk_skills_meta_video_embed" id="_sherk_skills_meta_video_embed" value=""></textarea>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>';
					echo 'Short Description:<br/><textarea class="widefat" name="_sherk_skills_meta_video_desc" id="_sherk_skills_meta_video_desc" value=""></textarea>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td>';
					echo '<div class="button-secondary" id="_video_submit">Add Video Resource</div>';
				echo '</td>';
			echo '</tr>';
			
		echo '</table>';
		
		echo '<table id="list_videos" class="widefat"></table>';
		
	}//function
	
	function _sherk_skills_html(){
		
		global $post;
		
		$meta_sherk_skills = get_post_meta($post->ID, '_sherk_skills_meta',true);
				
		if(empty($meta_sherk_skills)){
		    $meta_sherk_skills='';
		}
	
		echo '<table class="form-table">';
			
			echo '<tr>';
				echo '<td>';
					echo 'Skill Key ex. css<br/><input class="large-text" type="text" name="_sherk_skills_meta_key" value="'.$meta_sherk_skills.'"/>';
				echo '</td>';
			echo '</tr>';
			
		echo '</table>';
		
	}//function
	
	
	function _save_meta_boxes($post_id, $post){
		global $post;
		
    	if ( !current_user_can( 'edit_post', $post->ID ) && ($post->post_type!='sherk_skills')){
        	return $post->ID;
    	}//if
    	
        $meta_sherk_skills ='';
		
        if(isset($_POST['_sherk_skills_meta_key']))
			$meta_sherk_skills=$_POST['_sherk_skills_meta_key'];

        
        update_post_meta($post->ID, '_sherk_skills_meta', $meta_sherk_skills);

        return $post->ID;
        
	}//function
	
}
new SherkSkillsMetaBox();