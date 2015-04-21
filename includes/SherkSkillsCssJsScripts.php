<?php

/**
 * LoadScripts class.
 * Load css and javascripts
 */
class SherkSkillsLoadScripts {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		add_action('wp_enqueue_scripts', array($this, 'include_sherk_skills_css_js'));
		
		add_action('admin_enqueue_scripts', array(&$this, '_edit_sherk_skills_js'));
		
	}



	/**
	 * include_sherk_skills_css_js function.
	 *
	 * @access public
	 * @return void
	 */
	public function include_sherk_skills_css_js() {
		if(get_post_type()=='sherk_skills'){
			wp_register_style('sherk-skills-styles', SherkSkills::get_plugin_url().'assets/css/style.css', array(), '20121224', 'all' );
			wp_enqueue_style('sherk-skills-styles');
		}
		
		//widget styles 
		wp_register_style('bxslider-styles', SherkSkills::get_plugin_url().'assets/css/jquery.bxslider.css', array(), '20121224', 'all' );
		wp_enqueue_style('bxslider-styles');
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('bxslider-js', SherkSkills::get_plugin_url().'assets/js/jquery.bxslider.js', array(), '1.0.0', true);
		wp_enqueue_script('sherkskills-js', SherkSkills::get_plugin_url().'assets/js/sherk_skills-classes.js');
	}
	
	function _edit_sherk_skills_js($pagenow){
		global $post,$typenow;
		
		if (empty($typenow) && !empty($_GET['post'])) {
			
			$post = get_post($_GET['post']);
			$typenow = $post->post_type;
			
		}//if
		
		if (is_admin() && $pagenow=='post-new.php' || $pagenow=='post.php' && $typenow=='sherk_skills') {
			wp_enqueue_script('sherkskills-editjs', SherkSkills::get_plugin_url().'assets/js/edit-js.js');
			wp_enqueue_script('jquery');
			
		}elseif ($post->post_type=='sherk_skills' && is_single()) {
			wp_enqueue_script('jquery');
		}
	}

}

new SherkSkillsLoadScripts();