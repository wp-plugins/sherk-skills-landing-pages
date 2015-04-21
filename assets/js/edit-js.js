window.jQuery = window.$ = jQuery; /*Sherk Skills type class*/

var EditSherkSkillsAjax = function() {
    var controller=new EditSherkSkillsController();
	
	this.ajaxSubmit = function(request, ajax_data) {
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: ajaxurl,
			data: {
				'action': 'sherk_skills_action',
				'request': request,
				'post_id': controller.getPostId(),
				'data_sherk_skills': ajax_data,
			},
			complete: function(object) {
				if (object.status == 200) {
					var jsonResponse = object.responseJSON;
					if (jsonResponse && typeof jsonResponse === "object" && jsonResponse !== null) {
						var sherkSkillsHtml=new EditSherkSkillsHtml();
						if(request == 'get' && jsonResponse.success==true){
							sherkSkillsHtml.refreshDataTable(jsonResponse.webs, 'list_webs');
							sherkSkillsHtml.refreshDataTable(jsonResponse.videos, 'list_videos');
						}else if (request == 'add_update_web_submit' && jsonResponse.success==true) {
							sherkSkillsHtml.refreshDataTable(jsonResponse.webs, 'list_webs');
						} else if (request == 'delete_web_submit' && jsonResponse.success) { 
							sherkSkillsHtml.refreshDataTable(jsonResponse.webs, 'list_webs');
						} else if (request == 'add_update_video_submit' && jsonResponse.success) {
							sherkSkillsHtml.refreshDataTable(jsonResponse.videos, 'list_videos');
						} else if (request == 'delete_video_submit' && jsonResponse.success) { 
							sherkSkillsHtml.refreshDataTable(jsonResponse.videos, 'list_videos');
						}
					} else {
						console.log("Ajax Failed");
					}
				} else {
					console.log("Ajax Failed");
				}
			}
		});
	}
}

var EditSherkSkillsController = function() {

	this.webToJson = function(webTitle,webUrl,webDesc) {
		var webJson = {
			web_title: escape(webTitle),
			web_url: escape(webUrl),
			web_desc: escape(webDesc),
		};
		return JSON.stringify(webJson);
	};
	
	this.videoToJson = function(videoTitle,videoEmbed,videoDesc) {
		var videoJson = {
			video_title: escape(videoTitle),
			video_embed: escape(videoEmbed),
			video_desc: escape(videoDesc),
		};
		return JSON.stringify(videoJson);
	};
	
	
	this.isValidUrl = function(url) {
		var urlregex = new RegExp("^(http|https|ftp)\://([a-zA-Z0-9\.\-]+(\:[a-zA-Z0-9\.&amp;%\$\-]+)*@)*((25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])|([a-zA-Z0-9\-]+\.)*[a-zA-Z0-9\-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(\:[0-9]+)*(/($|[a-zA-Z0-9\.\,\?\'\\\+&amp;%\$#\=~_\-]+))*$");
		if (urlregex.test(url)) {
			return true;
		} else {
			alert('Error:Invalid Url Format');
			return false;
		}
	}
	
	this.getPostId= function (){
		return $('#_post_id').attr('value');
	}
	
	
}

var EditSherkSkillsHtml = function(){

	this.refreshDataTable = function(jsonSherkSkills, tableId) {
		var objSherkSkills = JSON.parse(jsonSherkSkills);
		var thead='<thead><tr><th>Title</th><th>Description</th><th>Actions</th></tr></thead>';
	    var trdata='';
		if(tableId=='list_webs'){			
			for (index = 0; index < objSherkSkills.length; ++index) {
				sherkSkill=objSherkSkills[index];
				trdata += '<tr id="web_row_'+index+'" title="'+unescape(sherkSkill['web_title'])+'"><td class="web_row_title"><a target="_blank" href="'+unescape(sherkSkill['web_url'])+'">'+unescape(sherkSkill['web_title'])+'</a></td><td class="web_desc">'+unescape(sherkSkill['web_desc'])+'</td><td><i class="edit-web-sherk-skill dashicons dashicons-edit"></i><i class="remove-web-sherk-skill dashicons dashicons-no"></i></td></tr>';
			}
			$('#list_webs').html(thead+'<tbody>'+trdata+'</tbody>');
			$('#_sherk_skills_meta_web_title').val('');
			$('#_sherk_skills_meta_web_title').prop('disabled', false);
		    $('#_sherk_skills_meta_web_url').val('');
		    $('#_sherk_skills_meta_web_desc').val('');
		    $('#_web_submit').html('Add Web Resource');
		}else if(tableId=='list_videos'){
			
			for (index = 0; index < objSherkSkills.length; ++index) {
				sherkSkill=objSherkSkills[index];
				trdata += '<tr id="video_row_'+index+'" title="'+unescape(sherkSkill['video_title'])+'"><td class="video_row_title" video_embed="'+sherkSkill['video_embed']+'">'+unescape(sherkSkill['video_title'])+'</td><td class="video_desc">'+unescape(sherkSkill['video_desc'])+'</td><td><i class="edit-video-sherk-skill dashicons dashicons-edit"></i><i class="remove-video-sherk-skill dashicons dashicons-no"></i></td></tr>';
			}
			$('#list_videos').html(thead+'<tbody>'+trdata+'</tbody>');
			$('#_sherk_skills_meta_video_title').val('');
			$('#_sherk_skills_meta_video_title').prop('disabled', false);
		    $('#_sherk_skills_meta_video_embed').val('');
		    $('#_sherk_skills_meta_video_desc').val('');
		    $('#_video_submit').html('Add Video Resource');
		}
	}
	
	this.populateForm = function(trId,listId){
	    if(listId=='list_webs'){
		   $('#_sherk_skills_meta_web_title').val($('#'+trId).attr('title'));
		   $('#_sherk_skills_meta_web_title').prop('disabled', true);
		   $('#_sherk_skills_meta_web_url').val($('#'+trId+' .web_row_title a').attr('href'));
		   $('#_sherk_skills_meta_web_desc').val($('#'+trId+' .web_desc').html());
		   $('#_web_submit').html('Update Web Resource');
		}else if(listId=='list_videos'){
		   $('#_sherk_skills_meta_video_title').val($('#'+trId).attr('title'));
		   $('#_sherk_skills_meta_video_title').prop('disabled', true);
		   $('#_sherk_skills_meta_video_embed').val(unescape($('#'+trId+' .video_row_title').attr('video_embed')));
		   $('#_sherk_skills_meta_video_desc').val($('#'+trId+' .video_desc').html());
		   $('#_video_submit').html('Update Video Resource');
		}
	}
}


var EditSherkSkillsMain=function(){
	var controller=new EditSherkSkillsController();
    var ajaxController= new EditSherkSkillsAjax();
	var sherkSkillsHtml= new EditSherkSkillsHtml();
	
	$(document).on('click', '#_web_submit', function(e) {
	    var web_title=$('#_sherk_skills_meta_web_title').val();
	    var web_url=$('#_sherk_skills_meta_web_url').val();
	    var web_desc=$('#_sherk_skills_meta_web_desc').val();
		
		if(controller.isValidUrl(web_url) && web_desc!='' && web_title!=''){
		   ajaxController.ajaxSubmit('add_update_web_submit',controller.webToJson(web_title,web_url,web_desc));
		}else{
		   alert('nahhhh');
		} 
		e.preventDefault();
	});
	
	$(document).on('click', '#_video_submit', function(e) {
	    var video_title=$('#_sherk_skills_meta_video_title').val();
	    var video_embed=$('#_sherk_skills_meta_video_embed').val();
	    var video_desc=$('#_sherk_skills_meta_video_desc').val();
		
		if(video_desc!='' && video_embed!='' && video_title!=''){
		   ajaxController.ajaxSubmit('add_update_video_submit',controller.videoToJson(video_title,video_embed,video_desc));
		}else{
		   alert('Missing values. Please input values.');
		} 
		e.preventDefault();
	});
	
	$(document).on('click','.edit-web-sherk-skill',function(e){
        var trId=$(this).closest('tr').attr('id');
		sherkSkillsHtml.populateForm(trId,'list_webs');
	});
	
	$(document).on('click','.edit-video-sherk-skill',function(e){
        var trId=$(this).closest('tr').attr('id');
		sherkSkillsHtml.populateForm(trId,'list_videos');
	});
	
	$(document).on('click','.remove-web-sherk-skill',function(e){
        var web_title=$(this).closest('tr').attr('title');
		ajaxController.ajaxSubmit('delete_web_submit',controller.webToJson(web_title,'',''));
	});
	
	$(document).on('click','.remove-video-sherk-skill',function(e){
        var video_title=$(this).closest('tr').attr('title');
		ajaxController.ajaxSubmit('delete_video_submit',controller.videoToJson(video_title,'',''));
	});
	
	$(document).ready(function(){
		ajaxController.ajaxSubmit('get',controller.webToJson('','',''));
	});
	
}

new EditSherkSkillsMain();

