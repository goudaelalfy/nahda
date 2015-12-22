<?php $this->load->view('website/includes/header'); ?>
<?php 
$this->load->controller('Website');
$website_object= new Website();
?>

<SCRIPT type="text/javascript">
pic1 = new Image(16, 16); 
pic1.src = "<?php echo base_url(); ?>images/icons/loader.gif";

$(document).ready(function(){

$(".first last prtal link").click(function() { 

var id_value = $(".first last prtal link").attr("id");
id_value=id_value.split("#*#$#"); 

var index=id_value[0];
var alias=id_value[1];

$("#dv_home_portals_menus_links_"+index).html('<img src="<?php echo base_url();?>images/icons/loader.gif" align="absmiddle">&nbsp;Checking availability...');
    $.ajax({  
    type: "POST",  
    url: "<?php echo base_url().$this->lang->lang();?>home/dvHomePortalsMenusLinksHtml",  
    data: "alias="+ alias,  
    success: function(msg){  
   
   $("#dv_home_portals_menus_links_"+index).ajaxComplete(function(event, request, settings){ 

			$(this).html(msg);
	
	   );

 } 
   
  }); 


});



});
</SCRIPT>

<script type='text/javascript'  src='<?php echo base_url();?>js/includes/functions.js' > </script>
<script language="javascript" type="text/javascript">

	function getPagesByCategories(cat_alias, index) {	
		var strURL="<?php echo base_url().$this->lang->lang(); ?>/home/dvHomePortalsMenusLinksHtml/"+cat_alias;
		var req = GetXmlHttpObject();

		//document.getElementById('homeMainTab-'+index).innerHTML='<img src="<?php echo base_url();?>images/icons/loader.gif" align="absmiddle">');
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {
												
						document.getElementById('homeMainTab-'+index).innerHTML=req.responseText;						
					} else {
						//alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
</script>

<script>
function getVote(question_id, question_answer_id)
{
var xmlhttp = GetXmlHttpObject();
var strURL="<?php echo base_url().$this->lang->lang(); ?>/questionnaire/getVote/"+question_id+"/"+question_answer_id;
	
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("dv_questionnaire").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET",strURL,true);
xmlhttp.send();
}
</script>

<div class="bodyWrapper">
  <div class="bodyContainer featuredNewsWrapper  first last">
    <div class="body-leftCol  first">
      <div class="first last">
        <div class="bodyComponent  first last"> 
        <?php 
        
         $home_page_articles=$this->Menu_link_model->get_all_menu_links_by_menu_map('home_page_article');
		 $home_page_articles_count=count($home_page_articles);
		  if($home_page_articles_count>0) {		  	
  		
		   $link_id=$home_page_articles[0]->id;
		   $link_controller_name=$home_page_articles[0]->controller_name;
		   $link_alias=$home_page_articles[0]->alias;

		   $link_icon=$home_page_articles[0]->icon;
		   $link_icon=base_url().$link_icon;
		 
		   if($this->lang->lang()=='ar') {
		   	$link_title=$home_page_articles[0]->title_ar;
		   } else {
		   	$link_title=$home_page_articles[0]->title;
		   }
		   
		   if($link_alias=='') {
				$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name;
			} else {
					$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name.'/content/'.$link_alias;
			}

			echo "<a href='$full_link_url' class='first last'><img src='$link_icon' alt='$link_title' class='first last' /></a>";
			
		  }
		   
        
        ?>
         
        
        </div>
      </div>
    </div>
    <div class="body-rightCol last">
      <div class="first last">
        <div class="bodyComponent first last">
          <div class="first">
            <h2 class="first"><?php  echo $this->lang->line('last_news'); ?></h2>
            <a class="last" href="<?php echo base_url().$this->lang->lang().'/pagetype/content/News'?>"><?php  echo $this->lang->line('display_news'); ?></a> </div>
          <div class="featuredNewsContainer last">
          
          <?php 
		  $last_news_menus_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('last_news');
		 $last_news_menus_links_count=count($last_news_menus_links);
		  
		  $index=1;
		  echo "<ul class='featuredNewsList first'>";
		  foreach($last_news_menus_links as $last_news_menus_link) {
		  	
  		
		   $link_id=$last_news_menus_link->id;
		   $link_controller_name=$last_news_menus_link->controller_name;
		   $link_alias=$last_news_menus_link->alias;
		   //$link_alias=urldecode($link_alias);
	  		if($link_alias=='') {
				$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name;
			} else {
					$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name.'/content/'.$link_alias;
			}
		   
		   
		   if($this->lang->lang()=='ar') {
		   	$link_title=$last_news_menus_link->title_ar;
		   } else {
		   	$link_title=$last_news_menus_link->title;
		   }
		   
			if($index==1) {
		   		$last_news_menus_links_li_style="class='first'";
		   	} else if($index==$last_news_menus_links_count) {
		   		$last_news_menus_links_li_style="class='last'";
		   	} else {
		   		$last_news_menus_links_li_style='';
		   	}
		   
		   echo "
		   <li $last_news_menus_links_li_style><a class='first last' href='#featuredNews-$index' title='$link_title'>$link_title</a></li>
		   ";
  		 	
		   $index=$index+1;
		  }
		  echo "</ul>";
		  
		  
		  $index=1;
		  echo "<ul class='first'>";
		  foreach($last_news_menus_links as $last_news_menus_link) {
		   $link_id=$last_news_menus_link->id;
		   $link_controller_name=$last_news_menus_link->controller_name;
		   $link_alias=$last_news_menus_link->alias;
		   //$link_alias=urldecode($link_alias);
	  		if($link_alias=='') {
				$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name;
			} else {
					$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name.'/content/'.$link_alias;
			}
		   
		   
		   if($this->lang->lang()=='ar') {
		   	$link_title=$last_news_menus_link->title_ar;
		   } else {
		   	$link_title=$last_news_menus_link->title;
		   }
		   
		   if($link_controller_name=='page') {
		   	$last_news_row=$this->Page_model->get_banner_file_selected_by_alias($link_alias);
			$last_news_banner_file_selected=base_url().$last_news_row->banner_file_selected;
			
		   } else {
		   	$last_news_banner_file_selected='';
		   }
		   
		  if($index==1) {
		   		$last_news_menus_links_li_style="class='first'";
		   	} else if($index==$last_news_menus_links_count) {
		   		$last_news_menus_links_li_style="class='last'";
		   	} else {
		   		$last_news_menus_links_li_style='';
		   	}
		   	
		   echo "
		   <li id='featuredNews-$index' $last_news_menus_links_li_style ><img class='first last' src='$last_news_banner_file_selected' alt='$link_title' /></li>
         
		   ";
  		 	
		   $index=$index+1;
		  }
		  echo "</ul>";
		  
		?>
          
          
            
          </div>
          
          
          
          
        </div>
      </div>
    </div>
  </div>
</div>
<div class="bodyWrapper">
  <div class="bodyContainer first last">
    <div>
      <div class="bodyComponent articlesList homePreview wideHomePreview  first last">
        <div class="first">
        
        <?php 
		  $home_portals_menus_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('home_portals');
		  $home_portals_menus_links_count=count($home_portals_menus_links);
		  $index=1;
		  echo "<ul class='headerTabs first'>";
		  foreach($home_portals_menus_links as $home_portals_menus_link) {
		   $link_id=$home_portals_menus_link->id;
		   $link_controller_name=$home_portals_menus_link->controller_name;
		   $link_alias=$home_portals_menus_link->alias;
		   //$link_alias=urldecode($link_alias);
	  		if($link_alias=='') {
				$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name;
			} else {
					$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name.'/content/'.$link_alias;
			}
		   
		   
		   if($this->lang->lang()=='ar') {
		   	$link_title=$home_portals_menus_link->title_ar;
		   } else {
		   	$link_title=$home_portals_menus_link->title;
		   }
		   
		   
		    if($index==1) {
		   		$home_portals_menus_li_style="class='first selected'";
		   	}  else if($index==2) {
		   		$home_portals_menus_li_style="class='selectedNext'";
		   	} else if($index==$home_portals_menus_links_count) {
		   		$home_portals_menus_li_style="class='last'";
		   	} else {
		   		$home_portals_menus_li_style='';
		   	}
		   	
		   //$link_alias_url_encode=urlencode($link_alias);
		   echo "
		   <li $home_portals_menus_li_style><a href='#homeMainTab-$index'  class='first last' title='$link_title' onclick=\"getPagesByCategories('$link_alias', '$index')\" >$link_title</a></li>
		   ";
  		 	
		   $index=$index+1;
		  }
		  echo "</ul>
		 <!--
		  	<a href='#' class='last'>البوابة السياسية</a>
        	-->
        	 </div>
		  	<div class='last'>
          	<div class='first last'>
		  
		  ";
		  
		  
		  $index=1;
		  foreach($home_portals_menus_links as $home_portals_menus_link) {
		  	
		   if($index==1) {
		   		$home_portals_menus_li_style="class='articleListUL first' style='display: block;'";
		   	} else if($index==$home_portals_menus_links_count) {
		   		$home_portals_menus_li_style="class='articleListUL last' style='display: none;'";
		   	} else {
		   		$home_portals_menus_li_style="class='articleListUL last' style='display: none;'";
		   	}
		  	
		  	echo "<ul $home_portals_menus_li_style id='homeMainTab-$index' >";
		  
		   $link_id=$home_portals_menus_link->id;
		   $link_controller_name=$home_portals_menus_link->controller_name;
		   $link_alias=$home_portals_menus_link->alias;
		   //$link_alias=urldecode($link_alias);
	  		if($link_alias=='') {
				$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name;
			} else {
					$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name.'/content/'.$link_alias;
			}
		   
		   
		   if($this->lang->lang()=='ar') {
		   	$link_title=$home_portals_menus_link->title_ar;
		   } else {
		   	$link_title=$home_portals_menus_link->title;
		   }
		   
		   if($link_controller_name=='pagecat') {
		   	$home_portals_row=$this->Pagecat_model->get_by_alias($link_alias);
			
		   	if(count($home_portals_row)>0) {
			
			$pagecat_id=$home_portals_row->id;
			
			
			/**
			 * Load only first tab.
			 */
			if($index==1) {
			$page_rows=$this->Page_model->get_by_pagecat($pagecat_id, 4);
			
			$page_row_counter=1;
			foreach($page_rows as $page_row) {
	      	$page_alias=$page_row->alias;
			$page_writer_alias=$page_row->writer_alias;
	      				      	
	      	if($this->lang->lang()=='ar') {
				$title=$page_row->title_ar;
				$page_brief=$page_row->brief_ar;
				$page_writer_name=$page_row->writer_name_ar;
	      	
			} else {
				$title=$page_row->title;
				$page_brief=$page_row->brief;
				$page_writer_name=$page_row->writer_name;
	      	
			}
	      	$banner_file_selected=base_url().$page_row->banner_file_selected;
			
	      	$full_link_url=base_url().$this->lang->lang().'/page/content/'.$page_alias;
		   	$page_writer_full_link_url=base_url().$this->lang->lang().'/writer/content/'.$page_writer_alias;
	   	
			$hijri_date=$website_object->getHijri($page_row->last_modify_date);
	   		$miladi_date=$website_object->getDateForamt($page_row->last_modify_date);
	   	
	   		
			if($page_row_counter==1) {
		   		$page_row_li_style="class='first'";
		   	} else if($page_row_counter==2) {
		   		$page_row_li_style="class='zebra'";
		   	}  else if($page_row_counter==4) {
		   		$page_row_li_style="class='last zebra'";
		   	} else {
		   		$page_row_li_style="";
		   	}
			
		   	$page_row_counter++;
		   	
		   echo "
         	<li $page_row_li_style>
                <div class='first last'>
                  <div class='first'>
                    <div class='first'><a class='first last' href='$full_link_url'><img class='first last' src='$banner_file_selected' alt='$title' /></a></div>
                    <div class='last'>
                      <h2 class='first'><a class='first last' href='$full_link_url'>$title</a></h2>
                        <div class='articleTime'>$hijri_date - $miladi_date</div>

                        <div><span class='first'>".lang('writer').":</span> <a href='$page_writer_full_link_url'>$page_writer_name</a></div>
                      <p class='last'>$page_brief ..</p>
                    </div>
                  </div>
                  <div class='readMoreContainer' class='last'><a class='first last' href='$full_link_url'>".lang('more')."</a></div>
                </div>
            </li>
		   ";
		   }
		   
		   
			} else {
				//echo "<div id='dv_home_portals_menus_links_$index'> </div> ";
				echo "<img src='".base_url()."images/icons/loading-new.gif' valign='middle' align='center' width='100%' height='350px'>";
			}
		   
		   	
		   	}
		   }
		   	
		   echo "</ul>";
		   $index=$index+1;
		  }
		  echo "
		  </div>
        </div>
		  ";
		  
		?>

        
            
          
          
          
          
        
        
        
      </div>
    </div>
  </div>
</div>
<div class="bodyWrapper">
  <div class="bodyContainer  first last">
    
    
      
    <div class="body-leftCol">
<?php if($this->lang->lang()=='ar') {
	$website_css_dir='website';
	$html_dir='rtl';
} else {
	$website_css_dir='website';
	$html_dir='ltr';
}
?>

<!-- 
      <div>      
          <a href="#"><img src="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/imgs/homeAds/fb.png" alt="" /></a>        
      </div>
 -->     
<div class='first last'>      
          <!-- 
          <a href="#"><img src="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/imgs/homeAds/fb1.png" alt="" /></a>        
      		-->
      		 
      <!-- 
     <fb:like href="http://www.facebook.com/NahdaAndIslah" show_faces="true" width="225"
                action="recommend" font=""></fb:like>
 		-->
 		
<!-- Facebook --> 		
<div class="panel-region-separator"></div>
<div class="panel-pane pane-block pane-block-33 homepage_facebook_like first" style="height: 280px;">
<div class="pane-content first">
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ar_AR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like-box" data-href="http://www.facebook.com/NahdaAndIslah" data-width="299" data-show-faces="true" data-stream="false" data-header="true"></div>  
</div>

</div>
<!-- End facebook -->



<br/>
<!-- Twitter -->
<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 20,
  interval: 6000,
  width: 270,
  height: 270,
  theme: {
    shell: {
      //background: '#8ec1da',
      background: 'red',
      color: '#ffffff'
    },
    tweets: {
      background: '#ffffff',
      color: '#000000',
      links: '#009999'
    }
  },
  features: {
    scrollbar: true,
    loop: false,
    live: true,
    hashtags: true,
    timestamp: true,
    avatars: true,
    behavior: 'all'
  }
}).render().setUser('NahdaIslah').start();
</script>

<br/>
<iframe class="last" allowtransparency="true" frameborder="0" scrolling="no"  src="http://platform.twitter.com/widgets/follow_button.html?screen_name=NahdaIslah&show_count=false"  style="width:150px; height:20px;"></iframe>
<br/>
<br/>
<!-- End of twitter -->


</div>
      
      
      <div>
        <div class="bodyComponent">
          <div>
            <h2>إستفتاء</h2>
            <a href="#">مزيد الإستفتاءات</a> </div>
          <div>
            <div class="voting-container">
            <?php 
            
            $questionnaire_row=	$this->Questionnaire_model->get_by_id('',$this->Questionnaire_model->get_max_id());
            	
										$questionnaire_id=$questionnaire_row->id;
										$questionnaire_answer_type=$questionnaire_row->answer_type;
										$questionnaire_page_no=$questionnaire_row->page_no;
										
										if($this->lang->lang()=='ar') {
											$questionnaire=$questionnaire_row->question_ar;
										} else {
											$questionnaire=$questionnaire_row->question;
										}
										
									?>
									
									<span><?php echo $questionnaire; ?></span><br><br>
                          
											<div id="dv_questionnaire">
											<?php 
											if($questionnaire_answer_type=='choose_answer') {
												
												/*
												$current_questionnaire_answer='';
												foreach ($current_client_survey_rows as $current_client_survey_row) {
													if($current_client_survey_row->question_id==$questionnaire_id) {
														$current_questionnaire_answer=$current_client_survey_row->answer;
													}
												}
												*/
												
												$question_answers=$this->Questionnaire_model->get_answers_by_id($questionnaire_id);
												foreach($question_answers as $question_answer) {
													$question_answer_id=$question_answer->id;
													if($this->lang->lang()=='ar') {
														$question_answer_name=$question_answer->name_ar;
													} else {
														$question_answer_name=$question_answer->name;
													}
													
													$checked='';
													/*
													if($question_answer_id==$current_questionnaire_answer) {
														$checked='checked';
													}
													*/
													
													echo "
													<div class='voting-input'><input type='radio' name='$questionnaire_id' id='$questionnaire_id'  value='$question_answer_id' $checked onclick='getVote($questionnaire_id, $question_answer_id)' ><span style='color:#5c5c5c'>$question_answer_name</span></div>
													";
												}												
											}  
											?>
											</div>
										<!-- 	
										<a href="#" class="newsLetterBtn">تصويت</a>
            							-->
            
            
            
                            	
                                
           </div>
          </div>
        </div>        
      </div>
    </div>
    
    
    
    <div class="body-rightCol  last">
      <div>
        <div class="bodyComponent articlesList homePreview  first last">
          <div class="first">
           <?php 
		  $new_articles_menus_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('new_articles');
		  
		  $index=1;
		  $articles_url=base_url().$this->lang->lang().'/pagetype/content/Articles';
		  
		  echo "<h2 class='first'>".lang('new_articles')."</h2>
            <a href='$articles_url' class='last'>".lang('more')."</a> </div>
          <div class='last'>
            <div class='first last' >
              <ul class='articleListUL first last'> <li  class='first last'>";
		  
		  
		   foreach($new_articles_menus_links as $new_articles_menus_link) {
		   $link_id=$new_articles_menus_link->id;
		   $link_controller_name=$new_articles_menus_link->controller_name;
		   $link_alias=$new_articles_menus_link->alias;
		   //$link_alias=urldecode($link_alias);
	  		if($link_alias=='') {
				$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name;
			} else {
				$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name.'/content/'.$link_alias;
			}
		   
		   
		   if($this->lang->lang()=='ar') {
		   	$link_title=$new_articles_menus_link->title_ar;
		   } else {
		   	$link_title=$new_articles_menus_link->title;
		   }
		   
		   if($link_controller_name=='page') {
		   	$new_articles_row=$this->Page_model->get_joined_by_alias($link_alias);
			$new_articles_banner_file_selected=base_url().$new_articles_row->banner_file_selected;
			
		   	$page_alias=$new_articles_row->alias;
			$page_writer_alias=$new_articles_row->writer_alias;
	      				      	
	      	if($this->lang->lang()=='ar') {
				$page_title=$new_articles_row->title_ar;
				$page_brief=$new_articles_row->brief_ar;
				$page_writer_name=$new_articles_row->writer_name_ar;
	      	
			} else {
				$page_title=$new_articles_row->title;
				$page_brief=$new_articles_row->brief;
				$page_writer_name=$new_articles_row->writer_name;
	      	
			}
		   }
		   
		   
		   	$page_writer_full_link_url=base_url().$this->lang->lang().'/writer/content/'.$page_writer_alias;
	   	
		   	$hijri_date=$website_object->getHijri($new_articles_row->last_modify_date);
	   		$miladi_date=$website_object->getDateForamt($new_articles_row->last_modify_date);
	   	
		   	
		  if($index==1) {
		  	echo "
		  	<div  class='first'>
                    <div  class='first'>
                      <div  class='first'><a  class='first last' href='$full_link_url'><img src='$new_articles_banner_file_selected' alt='$link_title' /></a></div>
                      <div  class='last'>
                        <h2  class='first'><a  class='first last' href='$full_link_url'>$link_title</a></h2>
                        <div class='articleTime'>$hijri_date - $miladi_date</div>

                        <div><span  class='first'>".lang('writer').":</span> <a href='$page_writer_full_link_url'>$page_writer_name</a></div>
                        <p  class='last'>$page_brief..</p>
                      </div>
                    </div>
                    <div class='readMoreContainer last'><a href='$full_link_url'  class='first last'>".lang('more')."</a></div>
                  </div>
                  <div  class='last'>
                    <ul  class='first last'>
		  	";
		  } else if($index==2) {
		  	echo " <li class='first'><a class='first'  href='$full_link_url'>$link_title</a>
                        <div class='last'><span class='first'>".lang('writer').":</span> <a class='last' href='$page_writer_full_link_url'>$page_writer_name</a></div>
                      </li>
                      ";
		  }  else if($index==count($new_articles_menus_links)) {
		  	echo " <li class='last'><a class='first'  href='$full_link_url'>$link_title</a>
                        <div class='last'><span class='first'>".lang('writer').":</span> <a class='last' href='$page_writer_full_link_url'>$page_writer_name</a></div>
                      </li>
                      ";
		  } else {
		  	echo " <li><a class='first'  href='$full_link_url'>$link_title</a>
                        <div class='last'><span class='first'>".lang('writer').":</span> <a class='last' href='$page_writer_full_link_url'>$page_writer_name</a></div>
                      </li>
                      ";
		  }
		 
		  $index++;
		   }
                    echo "
                    </ul>
                  </div>
                </li>
              </ul>";
              ?>
              
              
            </div>
          </div>
        </div>
      </div>
      <div class="last">
        <div class="bodyComponent articlesList homePreview  first last">
          <div class="first">
          <?php 
		  $menu_after_new_articles_menus_links=$this->Menu_link_model->get_all_menu_links_by_menu_map('menu_after_new_articles');
		  
		  $index=1;
		  echo "<ul class='headerTabs  first'>";
		  foreach($menu_after_new_articles_menus_links as $menu_after_new_articles_menus_link) {
		   $link_id=$menu_after_new_articles_menus_link->id;
		   $link_controller_name=$menu_after_new_articles_menus_link->controller_name;
		   $link_alias=$menu_after_new_articles_menus_link->alias;
		   //$link_alias=urldecode($link_alias);
	  		if($link_alias=='') {
				$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name;
			} else {
					$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name.'/content/'.$link_alias;
			}
		   
		   
		   if($this->lang->lang()=='ar') {
		   	$link_title=$menu_after_new_articles_menus_link->title_ar;
		   } else {
		   	$link_title=$menu_after_new_articles_menus_link->title;
		   }
		   
		   
		  if($index==1) {
		   		$menu_after_new_articles_menus_links_li_style="class='first selected'";
		   	} else if($index==2) {
		   		$menu_after_new_articles_menus_links_li_style="class='selectedNext'";
		   	}  else if($index==count($menu_after_new_articles_menus_links)) {
		   		$menu_after_new_articles_menus_links_li_style="class='last'";
		   	}  else {
		   		$menu_after_new_articles_menus_links_li_style="";
		   	}
		   	
		   echo "
		   <li $menu_after_new_articles_menus_links_li_style><a class='first last' href='#homeInnerTab-$index' title='$link_title'>$link_title</a></li>
		   ";
  		 	
		   $index=$index+1;
		  }
		  
		  echo " </ul>
            <!-- <a href='#' class='last'>".lang('more')."</a> --> </div>
          <div class='last'>
            <div class='first last'>
              <ul class='articleListUL first last'>
		  
		  ";
		  
		  
		  $index=1;
		  foreach($menu_after_new_articles_menus_links as $menu_after_new_articles_menus_link) {
		  
		   $link_id=$menu_after_new_articles_menus_link->id;
		   $link_controller_name=$menu_after_new_articles_menus_link->controller_name;
		   $link_alias=$menu_after_new_articles_menus_link->alias;
		   //$link_alias=urldecode($link_alias);
	  		if($link_alias=='') {
				$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name;
			} else {
					$full_link_url=base_url().$this->lang->lang().'/'.$link_controller_name.'/content/'.$link_alias;
			}
		   
		   
		   if($this->lang->lang()=='ar') {
		   	$link_title=$menu_after_new_articles_menus_link->title_ar;
		   } else {
		   	$link_title=$menu_after_new_articles_menus_link->title;
		   }
		   
		   if($link_controller_name=='pagecat') {
		   	$menu_after_new_articles_row=$this->Pagecat_model->get_by_alias($link_alias);
			
		   	if(count($menu_after_new_articles_row)>0) {
			
			$pagecat_id=$menu_after_new_articles_row->id;
			$page_rows=$this->Page_model->get_by_pagecat($pagecat_id, 4);
			
			$counter_inner_loop=0;
			foreach($page_rows as $page_row) {
	      	$page_alias=$page_row->alias;
			$page_writer_alias=$page_row->writer_alias;
	      				      	
	      	if($this->lang->lang()=='ar') {
				$title=$page_row->title_ar;
				$page_brief=$page_row->brief_ar;
				$page_writer_name=$page_row->writer_name_ar;
	      	
			} else {
				$title=$page_row->title;
				$page_brief=$page_row->brief;
				$page_writer_name=$page_row->writer_name;
	      	
			}
			
			// To get sentence of brief.
			$page_brief = substr($page_brief, 0, 100);
			$page_brief = explode(' ', $page_brief);
			array_pop($page_brief);
			$page_brief = implode(' ', $page_brief);
			
			
	      	$banner_file_selected=base_url().$page_row->banner_file_selected;
			
	      	$full_link_url=base_url().$this->lang->lang().'/page/content/'.$page_alias;
		   	$page_writer_full_link_url=base_url().$this->lang->lang().'/writer/content/'.$page_writer_alias;
	   	
		   	$hijri_date=$website_object->getHijri($page_row->last_modify_date);
	   		$miladi_date=$website_object->getDateForamt($page_row->last_modify_date);
	   	
			if($index==1) {
		   		$page_row_li_style="class='first'";
		   	} else if($index==4) {
		   		$page_row_li_style="class='last' style='display: none;'";
		   	} else {
		   		$page_row_li_style="style='display: none;'";
		   	}
			
		   	$page_row_counter++;
	   		
			if($counter_inner_loop==0) {
		   echo "
		   <li id='homeInnerTab-$index' $page_row_li_style>
                  <div class='first'>
                    <div class='first'>
                    <div class='first'><a class='first last' href='$full_link_url'><img class='first last' src='$banner_file_selected' alt='$title' /></a></div>
                      <div class='last'>
                        <h2 class='first'><a class='first last' href='$full_link_url'>$title</a></h2>
                        <div class='articleTime'>$hijri_date - $miladi_date</div>

                        <div><span class='first'>".lang('writer').":</span> <a href='$page_writer_full_link_url'>$page_writer_name</a></div>
                        <p class='last'>$page_brief ..</p>
                      </div>
                    </div>
                    <div class='readMoreContainer last'><a class='first last' href='$full_link_url'>".lang('more')."</a></div>
                  </div>
                  <div class='last'>
                    <ul class='first last'>
                   ";
		   
			}  else if($counter_inner_loop==1) {
                    echo"
                     <li class='first'><a  class='first' href='$full_link_url'>$title</a>
                        <div  class='last'><span  class='first'>".lang('writer').":</span> <a  class='last' href='$page_writer_full_link_url'>$page_writer_name</a></div>
                      </li>
                     ";
			} else if($counter_inner_loop==3) {
                    echo"
                     <li class='last'><a  class='first' href='$full_link_url'>$title</a>
                        <div  class='last'><span  class='first'>".lang('writer').":</span> <a class='last' href='$page_writer_full_link_url'>$page_writer_name</a></div>
                      </li>
                     ";
			}  else  {
                    echo"
                     <li><a  class='first' href='$full_link_url'>$title</a>
                        <div  class='last'><span  class='first'>".lang('writer').":</span> <a class='last' href='$page_writer_full_link_url'>$page_writer_name</a></div>
                      </li>
                     ";
			}
			
			if($counter_inner_loop==3) {
			echo"
                    </ul>
                  </div>
                </li>
		   ";
			}
		   
			$counter_inner_loop++;
			}
		   	
		   	}
		   }
		   	
		   $index=$index+1;
		   
		  }
		  echo "</ul></div></div>";
		  
		?>
		  
            
        </div>
      </div>
      
      <div class="writers-container">
        <div class="bodyComponent">
          <div>
            <h2><?php echo $this->lang->line('writers'); ?></h2>
            <a href="<?php echo base_url().$this->lang->lang().'/writer/all'; ?>"><?php echo $this->lang->line('all_writers'); ?></a> </div>
          <div>
            <ul class="bodyComponent-regularUL">
            <?php 
            if(isset($writer_rows)) {
		      	foreach($writer_rows as $writer_row) {
			      	$writer_alias=$writer_row->alias;
			      	if($this->lang->lang()=='ar') {
						$writer_name=$writer_row->name_ar;
						$writer_brief=$writer_row->brief_ar;
					} else {
						$writer_name=$writer_row->name;
						$writer_brief=$writer_row->brief;
					}
					
					$writer_full_link_url=base_url().$this->lang->lang().'/writer/content/'.$writer_alias;
	   
					echo "<li><a href='$writer_full_link_url'>$writer_name</a></li>";
		      	}
            }
            ?>
              
            </ul>
          </div>
        </div>
        <!--end writers-->
                <?php echo "<script type='text/javascript'  src='".base_url()."js/website/news_letter_subscriper/form.js' > </script>";?>
                <form name="frm_news_letter_subscriper" id="frm_news_letter_subscriper" action="<?php echo base_url().$this->lang->lang();?>/newslettersubscriper/save" method="post" enctype='multipart/form-data'>
                <div class="newsLetter">
                <h1>القائمة البريدية</h1>
                <div class="newsLetter-txt">
               	  <input name="email" id="email"  type="text" placeholder="اشترك في القائمة البريدية" />
            		<br/>
            		<div class="dv_error" id="dv_email_false" style="display:none"><?php echo lang('email_false'); ?></div>
					<br/>	
                </div>
                <a href="javascript:submit_news_letter_subscriper_form()" class="newsLetterBtn" onclick="return validate_form();">إشترك الآن</a>
		
                </div> 
                </form>
                 
                <!--end news letter-->
              </div>
      


			     <div class="videoContainer">
                    <div class="videoContainer-header">
                        <ul class="headerTabs">
                            <li><a href="#videoTab-1">فيديوهات</a></li>
                            <!-- <li><a href="#videoTab-2">ألبوم الصور</a></li> -->
                        </ul>
                        <a href="<?php echo base_url().$this->lang->lang().'/video'; ?>"><?php echo lang('more');?></a>
                    </div>
                    <div>
                        <div>
                            <ul class="articleListUL">
                                <li id="videoTab-1">
                                    <ul class="videos">
                                        <li>
                                            <div id="homeVideoHolder" class="video-preview">
                                                <img src="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/imgs/homeFeaturedNews/featuredNews.png" width="426" height="222" />
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="links youtubeVideo">
<?php 
	
	$video_rows=$this->Video_model->get_all_limit(3);
		  
	if(isset($video_rows)) {
      	foreach($video_rows as $video_row) {
      	$video_alias=$video_row->alias;
		$video_video_link=$video_row->video_link;
		
      	if($this->lang->lang()=='ar') {
			$title=$video_row->title_ar;
			$video_brief=$video_row->brief_ar;
      	
		} else {
			$title=$video_row->title;
			$video_brief=$video_row->brief;
      	
		}
      	$banner_file_selected=base_url().$video_row->banner_file_selected;
		$banner_image_thumb_selected=base_url().$video_row->banner_image_thumb_selected;
		
      	$full_link_url=base_url().$this->lang->lang().'/video/content/'.$video_alias;

      	$hijri_date=$website_object->getHijri($video_row->last_modify_date);
	   	$miladi_date=$website_object->getDateForamt($video_row->last_modify_date);
	   	
      	echo "
                <li><a href='$video_video_link'>$title</a></li>  
                
                ";
      }
   }          
   ?>
                                        
       							</ul>
                                </li>
                    
                    
                                
                                
                                
                            </ul>
                        </div>
                    </div>
             
                </div>
           

      
      
    </div>
  </div>
</div>




<?php $this->load->view('website/includes/footer'); ?>
