<?php

class SherkSkillsShortcode {

	public function __construct() {
		add_shortcode( 'sherkskills', array($this,'sherkskills_func' ));
	}

	function sherkskills_func( $atts ){
		$shortcode_att = shortcode_atts( array(
				'title' => 'Skills',
			), $atts );
		$title = $shortcode_att['title']; 

		if (!empty($title))
			$shortcodecontent='<h3 class="shortcodetitle">' . $title  .'</h3>';
			
		
		$shortcodecontent.='
		<div class="shortcodebody">
			<ul class="shortcode_bxslider">';
			   
				$sherk_skills_keys=SherkSkillsHelper::get_all_sherk_skills_keys();
				
				foreach($sherk_skills_keys as $sherk_skills_key){
					if($sherk_skills_key['img_url']!=''){
						$shortcodecontent .= '<li><a href="'.$sherk_skills_key['url'].'"><img width="100%" src="'.$sherk_skills_key['img_url'].'"   title="'.$sherk_skills_key["title"].'" /></a></li>'; 
					}
				}
			$shortcodecontent.='
			</ul>
		</div>';
	
		echo $shortcodecontent;
	}
	
	
}

new SherkSkillsShortcode();