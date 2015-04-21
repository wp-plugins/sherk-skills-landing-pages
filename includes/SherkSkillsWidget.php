<?php


class SherkSkillsWidget extends WP_Widget {

	function __construct(){

		$widget_options = array( 'classname'   => 'SherkSkills Slider Widget',

                               'description' => 'Add SherkSkills featured images Slider on your widget areas.');

 

		$this->WP_Widget('sherk_skills_widget_id',

                       'SherkSkills Slider Widget',

                       $widget_options);

	}

 

	function form($instance){

      // outputs the content of the widget

		$instance = wp_parse_args((array) $instance, array( 'title' => '','posttype_cat_id'=>''));

		$title = $instance['title'];
		$posttype_cat_id = $instance['posttype_cat_id'];

	?>

	  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
     <?php
	}

	
	function update($new_instance, $old_instance){

      // outputs the options form on admin

		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		
		return $instance;

	}

 
    //body of the widget
    function widget($args, $instance){
        extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); 

		if (!empty($title))
		  echo '<h3 class="widgettitle">'.$before_title . $title . $after_title.'</h3>';
		?>
		<li id="text-1" class="widget widget_text">
			
			<div class="textwidget">
				<ul class="bxslider">
				   <?php
				   $content='';
				   $sherk_skills_keys=SherkSkillsHelper::get_all_sherk_skills_keys();
					foreach($sherk_skills_keys as $sherk_skills_key){
						if($sherk_skills_key['img_url']!=''){
							$content .= '<li><a href="'.$sherk_skills_key['url'].'"><img width="100%" src="'.$sherk_skills_key['img_url'].'" title="'.$sherk_skills_key['title'].'"/></a></li>'; 
						}
					}
					echo $content;
			?>
				</ul>
			</div>
		</li>
		<?php
		echo $after_widget;
	}


} //end class

