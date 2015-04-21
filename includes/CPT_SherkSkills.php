<?php

class CPTSherkSkills {

	public function __construct() {
		add_action( 'init', array($this, 'register_cpt_sherk_skills'));
		
		add_action( 'init', array($this, 'register_sherk_skills_taxonomies'));
		
		add_filter( 'the_content', array($this, 'sherk_skills_content'));
		
		add_action( 'widgets_init', array($this, '_sherk_skills_widget')); //addwidgets
	}



	public function register_cpt_sherk_skills() {

		$labels = array(
			'name' => _x( 'Sherk Skills', 'sherk_skills' ),
			'singular_name' => _x( 'Sherk Skills', 'sherk_skills' ),
			'add_new' => _x( 'Add New', 'sherk_skills' ),
			'add_new_item' => _x( 'Add New Sherk Skills', 'sherk_skills' ),
			'edit_item' => _x( 'Edit Sherk Skills', 'sherk_skills' ),
			'new_item' => _x( 'New Sherk Skills', 'sherk_skills' ),
			'view_item' => _x( 'View Sherk Skills', 'sherk_skills' ),
			'search_items' => _x( 'Search Sherk Skills', 'sherk_skills' ),
			'not_found' => _x( 'No Sherk Skills found', 'sherk_skills' ),
			'not_found_in_trash' => _x( 'No Sherk Skills found in Trash', 'sherk_skills'),
			'menu_name' => _x( 'Sherk Skills', 'sherk_skills' ),
		);

		$args = array(
			'labels' => $labels,
			'hierarchical' => false,
			'description' => 'Creates a skills custom post types.',
			'supports' => array( 'title', 'editor', 'author', 'thumbnail'),
			'taxonomies' => array( 'sherk_skills_cat', 'post_tag' ),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'menu_icon' => 'dashicons-id-alt',
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true,
			'capability_type' => 'post'
		);

		register_post_type( 'sherk_skills', $args );
	}

	function register_sherk_skills_taxonomies() {
		register_taxonomy(
			'sherk_skills_cat',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
			'sherk_skills',      //post type name
			array(
				'hierarchical'   => true,
				'label'    => 'Skills Category',
				'query_var'   => true,
				'rewrite'   => array(
					'slug'    => 'sherk_skills_category', // This controls the base slug that will display before each term
					'with_front'  => false // Don't display the category base before
				)
			)
		);
	}
	
	
	/**
	 * sherk_skills_content function.
	 *
	 * @access public
	 * @param mixed $content
	 * @return void
	 */
	function sherk_skills_content($content) {
		global $post;
        
		if ($post->post_type=='sherk_skills' && is_single()) {
			include(SherkSkills::get_plugin_uri().'templates/single-sherk_skills-content.php');
			return ob_get_clean();
		}else{
		    /* $sherk_skills_keys=SherkSkillsHelper::get_all_sherk_skills_keys();
			foreach($sherk_skills_keys as $sherk_skills_key){
				if($sherk_skills_key['key']!=''){
					$content = preg_replace ('/('.$sherk_skills_key['key'].')(?!([^\"]*\">[^<]*)?<\/a>)/',
				 '<a href="'.$sherk_skills_key['url'].'">'.$sherk_skills_key['key'].'</a>',
				 $content);
				} 
			} */
			return $content;
		}
	}
	
	
	
	
	function _sherk_skills_widget(){
		register_widget('SherkSkillsWidget');
	}
	
}

new CPTSherkSkills();