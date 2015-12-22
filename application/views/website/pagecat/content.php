<?php $this->load->view('website/includes/header'); ?>
<?php 
$this->load->controller('Website');
$website_object= new Website();
?>
<!-- 
<link rel="stylesheet" href="<?php echo base_url();?>added/scrolling_paging/9lessons.css" type="text/css" />
 -->
<script type="text/javascript" src="<?php echo base_url();?>added/scrolling_paging/jquery-1.2.6.pack.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
			
		function last_msg_funtion() 
		{ 
           var ID=$(".message_box:last").attr("id");
			$('div#last_msg_loader').html('<img src="<?php echo base_url();?>images/icons/loading.gif">');
			$.post("<?php echo base_url().$this->lang->lang(); ?>/pagecat/contentajax/<?php echo $current_alias; ?>?action=get&last_msg_id="+ID,
			
			function(data){
				if (data != "") {
				$(".message_box:last").after(data);			
				}
				$('div#last_msg_loader').empty();
			});
		};  
		
		$(window).scroll(function(){
			
			if  ($(window).scrollTop() > $(document).height() - $(window).height()-400){
			   last_msg_funtion();
			}
		}); 
		
	});
	</script>
<div class="bodyWrapper">
  <div class="bodyContainer">
    <div class="body-leftCol">
      <div>
        <div class="bodyComponent">
          <div>
            <h2><?php  echo $this->lang->line('page_selected'); ?></h2>
          </div>
          <div>
            <ul class="bodyComponent-regularUL">
             <?php 
            if(isset($page_selected_rows)) {
		      	foreach($page_selected_rows as $page_selected_row) {
			      	$page_selected_row_alias=$page_selected_row->alias;
			      	$page_selected_row_writer_alias=$page_selected_row->writer_alias;
			      	if($this->lang->lang()=='ar') {
						$page_selected_row_title=$page_selected_row->title_ar;
						$page_selected_row_writer_name=$page_selected_row->writer_name_ar;
			      	
					} else {
						$page_selected_row_title=$page_selected_row->title;
						$page_selected_row_writer_name=$page_selected_row->writer_name;
			      	
					}
					
					$page_selected_row_full_link_url=base_url().$this->lang->lang().'/page/content/'.$page_selected_row_alias;
	   				$writer_full_link_url=base_url().$this->lang->lang().'/writer/content/'.$page_selected_row_writer_alias;
	   				
					if(!isset($current_alias)) {
	   					$current_alias='';
	   				}
					if($current_alias!=$page_selected_row_alias) {
						
						echo "
						<li><a href='$page_selected_row_full_link_url'>$page_selected_row_title</a>
		                <div><span>".lang('writer').":</span> <a href='$writer_full_link_url'>$page_selected_row_writer_name</a></div>
		              	</li>
						";
		   			}
	   				
		      	}
            }
            ?>
            </ul>
          </div>
        </div>
      </div>
      <!-- 
      <div>
        <div class="bodyComponent">
          <div>
            <h2>موضوعـات ذات صلة</h2>
          </div>
          <div>
            <ul class="bodyComponent-regularUL">
              <li><a href="#">الدستور بين اليوم والامس</a>
                <div><span>الكاتب:</span> <a href="#">نهى أبو كرم</a></div>
              </li>
              <li><a href="#">الدستور بين اليوم والامس</a>
                <div><span>الكاتب:</span> <a href="#">نهى أبو كرم</a></div>
              </li>
              <li><a href="#">الدستور بين اليوم والامس</a>
                <div><span>الكاتب:</span> <a href="#">نهى أبو كرم</a></div>
              </li>
              <li><a href="#">الدستور بين اليوم والامس</a>
                <div><span>الكاتب:</span> <a href="#">نهى أبو كرم</a></div>
              </li>
              <li><a href="#">الدستور بين اليوم والامس</a>
                <div><span>الكاتب:</span> <a href="#">نهى أبو كرم</a></div>
              </li>
            </ul>
          </div>
        </div>
      </div>
       -->
      <!-- 
      <div>     
        <div class="bodyComponent">
          <div>
            <h2>مقالات اخرى للكاتب</h2>
          </div>
          <div>
            <ul class="bodyComponent-regularUL">
              <li><a href="#">الحل بين اثنين</a></li>
              <li><a href="#">الحل بين اثنين</a></li>
              <li><a href="#">الحل بين اثنين</a></li>
            </ul>
          </div>
        </div>
      </div>
      -->
      <div>
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
      </div>
    </div>
    <div class="body-rightCol">
      <div>
        <div class="bodyComponent articlesList">
          <div>
            <h2><?php if(isset($title)) {echo $title;} ?></h2>
          </div>
          <div>
            <div>
              <ul class="articleListUL gateArticle">
                <li >
                  <div>
					<p>
					<?php if(isset($brief)) {echo nl2br($brief);} ?>
					</p>
                      </div>
                </li>
              </ul>
              
            </div>
 
<div class="bodyComponent gateComponent">
      
<?php if($this->lang->lang()=='ar') {
	$website_css_dir='website';
	$html_dir='rtl';
} else {
	$website_css_dir='website';
	$html_dir='ltr';
}
?>
<script type="text/javascript" src="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/js/jquery.minimalTabs.js"></script>
              
        <div>
          <ul class="headerTabs gateTabs">
           <?php 
           $pagetype_rows=$this->Pagetype_model->get_all();
           
           $loop_counter_title=1;
           foreach($pagetype_rows as $pagetype_row) {
           if($this->lang->lang()=='ar') {
				$pagetype_name=$pagetype_row->name_ar;
				$pagetype_seo_words=$pagetype_row->seo_words_ar;
			
			} else {
				$pagetype_name=$pagetype_row->name;
				$pagetype_seo_words=$pagetype_row->seo_words;
			}
			
           	echo "<li><a href='#homeMainTab-$loop_counter_title'>$pagetype_name</a></li>";
           	$loop_counter_title++;
           }
           ?>
            <li><a href="#homeMainTab-<?php echo $loop_counter_title; ?>">الندوات</a></li>
            <li><a href="#homeMainTab-<?php echo $loop_counter_title+1; ?>">الفيديوهات</a></li>
          </ul>
          </div>
            
            <div>
          <div>    
                
            <?php 
           $pagetype_rows=$this->Pagetype_model->get_all();
           
           $loop_counter_title=1;
           foreach($pagetype_rows as $pagetype_row) {
           	$pagetype_id=$pagetype_row->id;
           	$pagetype_alias=$pagetype_row->alias;
           	
           if($this->lang->lang()=='ar') {
				$pagetype_name=$pagetype_row->name_ar;
				$pagetype_seo_words=$pagetype_row->seo_words_ar;
			
			} else {
				$pagetype_name=$pagetype_row->name;
				$pagetype_seo_words=$pagetype_row->seo_words;
			}
			
           	echo "<ul class='articleListUL' id='homeMainTab-$loop_counter_title'>";
           
           	$page_rows=$this->Page_model->get_by_pagetypes_and_pagecategories($pagetype_id, $pagecat_id, 20);
           	
           	 foreach($page_rows as $page_row) {
	         	$page_id=$page_row->id;
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
		      	$banner_file_selected=$page_row->banner_file_selected;
				
		      	$full_link_url=base_url().$this->lang->lang().'/page/content/'.$page_alias;
			   	$page_writer_full_link_url=base_url().$this->lang->lang().'/writer/content/'.$page_writer_alias;
		
			   	$hijri_date=$website_object->getHijri($page_row->last_modify_date);
			   	$miladi_date=$website_object->getDateForamt($page_row->last_modify_date);
	   	
	   		echo "
      			<li>
                  <div id='$page_id' class='message_box' >
                    
                  <div>
                      <div><a href='$full_link_url'><img src='".base_url().$banner_file_selected."' alt='$title' width='130px' height='100px'/></a></div>
                      <div>
                        <h2><a href='$full_link_url'>$title</a></h2>
                        <div><span>".lang('writer').":</span> <a href='$page_writer_full_link_url'>$page_writer_name</a></div>
                        <div class='articleTime'>$hijri_date - $miladi_date</div>

                        <p>$page_brief ..</p>
                      </div>
                    </div>
                    <div class='readMoreContainer'><a href='$full_link_url'>". $this->lang->line('more')."</a></div>
                  
                    </div>
                </li>
                
                ";
           	 }
           	  
           	
           	 
           	$type_cat_full_url=base_url().$this->lang->lang()."/categories/content/$pagetype_alias/$current_alias"; 
           	echo "
           	<!-- By Gouda -->
           	<div class='readMoreContainer'><a href='$type_cat_full_url'>". $this->lang->line('more')."</a></div>
           
           	</ul>
           		"; 
           $loop_counter_title++;
           }
           	 
           ?>  
              
            
              
           <?php
           	 
           
          
           
           //Seminars
           echo "<ul class='articleListUL' id='homeMainTab-$loop_counter_title'>";
           	$seminar_rows=$this->Seminar_model->get_by_seminarcat($pagecat_id, 20);
           	
           	 foreach($seminar_rows as $seminar_row) {
	         	$seminar_id=$seminar_row->id;
		      	$seminar_alias=$seminar_row->alias;
				$seminar_writer_alias=$seminar_row->writer_alias;
		      				      	
		      	if($this->lang->lang()=='ar') {
					$title=$seminar_row->title_ar;
					$seminar_brief=$seminar_row->brief_ar;
					$seminar_writer_name=$seminar_row->writer_name_ar;
		      	
				} else {
					$title=$seminar_row->title;
					$seminar_brief=$seminar_row->brief;
					$seminar_writer_name=$seminar_row->writer_name;
		      	
				}
		      	$banner_file_selected=$seminar_row->banner_file_selected;
				
		      	$full_link_url=base_url().$this->lang->lang().'/seminar/content/'.$seminar_alias;
			   	$seminar_writer_full_link_url=base_url().$this->lang->lang().'/writer/content/'.$seminar_writer_alias;
		
			   	$hijri_date=$website_object->getHijri($seminar_row->last_modify_date);
			   	$miladi_date=$website_object->getDateForamt($seminar_row->last_modify_date);
	   	
	   		echo "
      			<li>
                  <div id='$seminar_id' class='message_box' >
                    
                  <div>
                      <div><a href='$full_link_url'><img src='".base_url().$banner_file_selected."' alt='$title' width='130px' height='100px'/></a></div>
                      <div>
                        <h2><a href='$full_link_url'>$title</a></h2>
                        <div><span>".lang('writer').":</span> <a href='$seminar_writer_full_link_url'>$seminar_writer_name</a></div>
                        <div class='articleTime'>$hijri_date - $miladi_date</div>

                        <p>$seminar_brief ..</p>
                      </div>
                    </div>
                    <div class='readMoreContainer'><a href='$full_link_url'>". $this->lang->line('more')."</a></div>
                  
                    </div>
                </li>
                
                ";
           	 }
           	 echo "</ul>";
           
           	 
           	 
           	 
           	 
           	//Videos 
           	$loop_counter_title++;
           	echo "<ul class='articleListUL' id='homeMainTab-".$loop_counter_title."'>";
           
           	$video_rows=$this->Video_model->get_by_videocat($pagecat_id, 20);
           	
           	 foreach($video_rows as $video_row) {
	         	$video_id=$video_row->id;
		      	$video_alias=$video_row->alias;
				$video_writer_alias=$video_row->writer_alias;
		      				      	
		      	if($this->lang->lang()=='ar') {
					$title=$video_row->title_ar;
					$video_brief=$video_row->brief_ar;
					$video_writer_name=$video_row->writer_name_ar;
		      	
				} else {
					$title=$video_row->title;
					$video_brief=$video_row->brief;
					$video_writer_name=$video_row->writer_name;
		      	
				}
		      	$banner_file_selected=$video_row->banner_file_selected;
				
		      	$full_link_url=base_url().$this->lang->lang().'/video/content/'.$video_alias;
			   	$video_writer_full_link_url=base_url().$this->lang->lang().'/writer/content/'.$video_writer_alias;
		
			   	$hijri_date=$website_object->getHijri($video_row->last_modify_date);
			   	$miladi_date=$website_object->getDateForamt($video_row->last_modify_date);
	   	
	   		echo "
      			<li>
                  <div id='$video_id' class='message_box' >
                    
                  <div>
                      <div><a href='$full_link_url'><img src='".base_url().$banner_file_selected."' alt='$title' width='130px' height='100px'/></a></div>
                      <div>
                        <h2><a href='$full_link_url'>$title</a></h2>
                        <div><span>".lang('writer').":</span> <a href='$video_writer_full_link_url'>$video_writer_name</a></div>
                        <div class='articleTime'>$hijri_date - $miladi_date</div>

                        <p>$video_brief ..</p>
                      </div>
                    </div>
                    <div class='readMoreContainer'><a href='$full_link_url'>". $this->lang->line('more')."</a></div>
                  
                    </div>
                </li>
                
                ";
           	 }
           	echo "</ul>";
           	 
                      	 
           
           ?>
              
            
            
             
              
              
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div></div>
<?php $this->load->view('website/includes/footer'); ?>
	