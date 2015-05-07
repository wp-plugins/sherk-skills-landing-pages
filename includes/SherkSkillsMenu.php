<?php


class SherkSkillsMenu {


    function __construct(){
	
	   add_action( 'admin_menu', array($this,'register_my_custom_menu_page' ));

	}
	
	
	
	

	function register_my_custom_menu_page(){
		add_submenu_page( 'edit.php?post_type=sherk_skills', 'How To Use', 'How To Use', 'manage_options', 'sherkskills_info', array($this,'sherkskills_menu_page'), 'dashicons-images-alt2', 10 ); 
	}

	function sherkskills_menu_page(){
		include(SherkSkills::get_plugin_uri().'templates/sherkskills_dashboard.php');
	}
	

	
	

	
} //end of class
	
new SherkSkillsMenu();