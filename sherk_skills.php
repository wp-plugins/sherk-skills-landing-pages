<?php
/*
Plugin Name: Sherk Skills Landing Pages
Plugin URI: http://www.sherkspear.com/portfolio-item/sherk-skills-wordpress-plugin/
Description: Create landing pages for your skills with description, trainings, related videos and related links. Search the contents of the website with your skills tags and replaced links to your skills landing page. Widgets with beautiful carousel using featured images set to your landing pages.
Version: 1.2.3
Author: Sherwin Calims
Author URI: http://www.sherkspear.com

------------------------------------------------------------------------
Copyright 2015 SherkSpear

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/

/*

  _________.__                  __      _________
 /   _____/|  |__   ___________|  | __ /   _____/_____   ____ _____ _______
 \_____  \ |  |  \_/ __ \_  __ \  |/ / \_____  \\____ \_/ __ \\__  \\_  __ \
 /        \|   Y  \  ___/|  | \/    <  /        \  |_> >  ___/ / __ \|  | \/
/_______  /|___|  /\___  >__|  |__|_ \/_______  /   __/ \___  >____  /__|
        \/      \/     \/           \/        \/|__|        \/     \/
*/


/**
 * SherkSkills class.
 */
class SherkSkills {

	/**
	 *
	 *  Include classes essential for the plugin
	 *
	 * @return void
	 */

	public function __construct() {
		//Load SherkSkillsHelper and debugger function
		require "includes/SherkSkillsHelper.php";
		
		//Load Extended Class for ShortCode
		require "includes/SherkSkillsShortcode.php";
		
		//Load Extended Class for Widget
		require "includes/SherkSkillsWidget.php";
		
		// Load any external files you have here
		require "includes/CPT_SherkSkills.php";
		
		// Load any external files you have here
		require "includes/SherkSkillsMetaBox.php";
		
		//Load javascripts and stylesheets
		require "includes/SherkSkillsCssJsScripts.php";
		
		//Load Menu How To Use
		require "includes/SherkSkillsMenu.php";

	}

	/**
	 *
	 * Returns plugin directory
	 *
	 * @return <string>
	 */

	public static function get_plugin_url() {
		return plugins_url( '' , __FILE__ ).'/';
	}

	/**
	 * get_plugin_uri function.
	 *
	 * @access public
	 * @static
	 * @return void
	 */
	public static function get_plugin_uri() {
		return  dirname(__FILE__).'/';
	}
}



new SherkSkills();
