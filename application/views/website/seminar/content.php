<?php $this->load->view('website/includes/header'); ?>
<?php 
$this->load->controller('Website');
$website_object= new Website();
?>
<?php if($this->lang->lang()=='ar') {
	$website_css_dir='website';
	$html_dir='rtl';
} else {
	$website_css_dir='website';
	$html_dir='ltr';
}
?>

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
			      	$writer_row_writer_alias=$writer_row->alias;
			      	if($this->lang->lang()=='ar') {
						$writer_row_writer_name=$writer_row->name_ar;
						$writer_row_writer_brief=$writer_row->brief_ar;
					} else {
						$writer_row_writer_name=$writer_row->name;
						$writer_row_writer_brief=$writer_row->brief;
					}
					
					$writer_row_writer_full_link_url=base_url().$this->lang->lang().'/writer/content/'.$writer_row_writer_alias;
	   
					echo "<li><a href='$writer_row_writer_full_link_url'>$writer_row_writer_name</a></li>";
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
        <div class="bodyComponent articleDetails">
        <?php 
         if(isset($row)) {
         	$seminar_id=$row->id;
         if($this->lang->lang()=='ar') {
				$title=$row->title_ar;
				$seo_words=$row->seo_words_ar;
				$brief=$row->brief_ar;
				$body=$row->body_ar;
			} else {
				$title=$row->title;
				$seo_words=$row->seo_words;
				$brief=$row->brief;
				$body=$row->body;
				
			}
			$banner_file_selected=base_url().$row->banner_file_selected;
			$video_video_link=$row->video_link;
		
			$banner_file_selected=base_url().$row->banner_file_selected;
			
				$hijri_date=$website_object->getHijri($row->last_modify_date);
			   	$miladi_date=$website_object->getDateForamt($row->last_modify_date);
			   	
			  
         }
         
        ?>
        
        
          <div>
            <h2><?php if(isset($title)) {echo $title;} ?></h2>
          </div>
          
          
           <div>
            <div>
              <div class="seminar-details">
                        <h2><a href="#"><?php if(isset($title)) {echo $title;} ?></a></h2>
                        <div class="articleTime"><?php if(isset($hijri_date)) {echo $hijri_date;} ?> - <?php if(isset($miladi_date)) {echo $miladi_date;} ?></div>
                         <?php 
			               if(isset($body)) {echo $body;}
			               ?>
                      <div class="download">
                      	<span>لتحميل الندوة كملف وورد أو بى دى اف</span>
                      	<a href="#" class="downloadDOC"><img src="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/imgs/seminars/downloadDOC.png" width="24" height="22" /></a>
                        <a href="#" class="downloadDOC"><img src="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/imgs/seminars/downloadPDF.png" width="20" height="25" /></a>
                      
              </div>
              
            </div>
          </div>
        </div>
          
         
          
          
          
          
        </div>
        
        
        
        
        
        
        
       <div class="seminar-video">
      <h2>فيديو الندوة</h2>
      <div class="sVideo">
      <?php if(trim($video_video_link)!='') {?>
 		<iframe src="<?php if(isset($video_video_link)) {echo $video_video_link;} ?>?autoplay=1" width="450" height="300" frameborder="0" allowfullscreen></iframe>
 		<?php }?>     
      </div>
     </div>
     <div class="seminar-video">
      <h2>ملف الصور</h2>
      <div class="selectedPhotos">
      <div class="pager">
      	<div id="nxt"></div>
      	<div class="countPaging">
      		<span id="allSlides"></span> -  <span id="currentSlide"></span>
        </div>
        <div id="prev"></div>
      </div>
      <ul>
      
<?php 


if(file_exists(getcwd()."/added/uploads/seminar/images/$seminar_id/")) {
$photos_dir=opendir(getcwd()."/added/uploads/seminar/images/$seminar_id/");
                               
    while ($image = readdir($photos_dir)) {
        if ($image == '.' || $image == '..') {
           continue;
        } else {
   			$image_full_path=base_url()."/added/uploads/seminar/images/$seminar_id/$image";
     		
			 echo "
			 <li class='current'>
      		<img src='$image_full_path' width='427' height='223' />            
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
    </div>
  </div>
</div>

<?php $this->load->view('website/includes/footer'); ?>
	