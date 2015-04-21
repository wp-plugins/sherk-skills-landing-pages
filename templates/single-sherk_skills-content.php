<?php

$webResources=json_decode(get_post_meta( $post->ID, '_web_sherk_skills', true),true);
$videoResources=json_decode(get_post_meta( $post->ID, '_video_sherk_skills', true),true);

$sherk_skills_terms = get_the_terms( $post->ID,'sherk_skills_cat');
$sep='';
if($sherk_skills_terms){
	foreach($sherk_skills_terms as $sherk_skills_term) {
		$output.=$sep.'<a href="'.get_term_link($sherk_skills_term).'">'.$sherk_skills_term->name.'</a>';
		if($sep==''){$sep=' / ';}
	}
	echo '<h3>Category: '.trim($output, $separator).'</h3>';
}
$webHtml='';
$videoHtml='';
if (is_array($webResources)){
	foreach ($webResources as $webResource) {
		$webHtml.='	<li class="web_item">
						<h3><i class="dashicons dashicons-admin-site"></i> '.urldecode($webResource['web_title']).'</h3>
						<p>'.urldecode($webResource['web_desc']).'
						<br/><a href="'.urldecode($webResource['web_url']).'" target="_blank">Resource Link</a>
						</p>
					</li>';
	}
}
if (is_array($videoResources)){
	foreach ($videoResources as $videoResource) {
		$videoHtml.='<li class="video_item">
						<h3><i class="dashicons dashicons-format-video"></i> '.urldecode($videoResource['video_title']).'</h3>
						<div class="video_embed">'.urldecode($videoResource['video_embed']).'</div>
						<p>'.urldecode($videoResource['video_desc']).'</p>
					</li>';
	}
}
$divclass='';

if(($webHtml!='' && $videoHtml=='')||($webHtml=='' && $videoHtml!='')){
   $divclass='fullwidth';
}elseif($webHtml!='' && $videoHtml!=''){
   $divclass='halfwidth';
}
?>


<?php //the_post_thumbnail('', array( 'class' => 'sherk_skills')); ?>
<?php echo $content; ?>
<?php

  $donateButton='<div class="float-none"><form id="donatebutton" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"><input name="cmd" type="hidden" value="_s-xclick" />
<input name="hosted_button_id" type="hidden" value="W7HKSYRWYFB3S" />
<input style="width:100px" alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" type="image" />
<img src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" alt="" width="1" height="1" border="0" /></form></div>';
	
  
?>
<?php if($divclass!=''){ ?>

<div id="sherk_skills_container" post_id="<?php echo $post->ID;?>" class="fullwidth">
	<?php if($webHtml!=''){ ?>
		<div id="weblist" class="<?php echo $divclass;?>">
			<h2><i class="dashicons dashicons-admin-site"></i> Web Resources</h2>
			<ul>
			<?php echo $webHtml;?>
			</ul>
		</div>
    <?php } ?>
	<?php if($videoHtml!=''){ ?>
		<div id="videolist" class="<?php echo $divclass;?>">
		<h2><i class="dashicons dashicons-format-video"></i> Video Resources</h2>
			<ul>
			<?php echo $videoHtml;?>
			</ul>
		</div>
    <?php } ?>
	<div class="clear-both"></div>
	<?php echo $donateButton;?>
</div>

<?php } ?>



<!--
created by:
  _________.__                  __      _________
 /   _____/|  |__   ___________|  | __ /   _____/_____   ____ _____ _______
 \_____  \ |  |  \_/ __ \_  __ \  |/ / \_____  \\____ \_/ __ \\__  \\_  __ \
 /        \|   Y  \  ___/|  | \/    <  /        \  |_> >  ___/ / __ \|  | \/
/_______  /|___|  /\___  >__|  |__|_ \/_______  /   __/ \___  >____  /__|
        \/      \/     \/           \/        \/|__|        \/     \/

http://www.sherkspear.com
-->