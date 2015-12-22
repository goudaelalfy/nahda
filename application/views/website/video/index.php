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
<script type="text/javascript" src="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/js/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/css/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" src="<?php echo base_url();?>css/<?php echo $website_css_dir; ?>/js/jquery.youtubeplaylist.js"></script>
<style type="text/css">
#videoHolder{
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	z-index: 1100;
	display: none;
	background-color: rgba(70, 70, 71, 0.5); 
	color: rgba(70, 70, 71, 0.5);	
	}
#videoHolder iframe {position:fixed;}

</style>
<script type="text/ecmascript">
		$(function() {
			$("ul.youtubeVideo").ytplaylist({
                addThumbs:true, 
                autoPlay: true,
                onChange: function() {
                    console.log('changed');
                },
             holderId: 'videoHolder'});
			 var documentHeight = $(document).height();
			 var windowHeight = $(window).height();
 			 var windowWidth = $(window).width();
			 $('#videoHolder').css('height',documentHeight);
			 
			 $('.youtubeVideo a').click(function () {	
				 $('#videoHolder').fadeIn('slow');
				 $('#videoHolder iframe').css('margin-right',((windowWidth-500)/2));
				 $('#videoHolder iframe').css('margin-top',((windowHeight-350)/2));			 
			 }) ;
			 $('#videoHolder').click(function () {				 
				 $('#videoHolder iframe').remove();
				 $(this).fadeOut('slow');
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
     <div class="body-rightCol last">
      <div class="first last">
        <div class="bodyComponent articlesList first last" id="dv_articlesList">
          <div class="first">
            <h2 class="first last"><?php if(isset($title)) {echo $title;} ?></h2>
          </div>
          <div class="last">
            <div class="first last">
              <ul class="articleListUL first last">
 
<?php 
	if(isset($video_rows)) {
		$video_rows_counter=1;
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
	   	
      	
      	if($video_rows_counter==1) {
				$video_rows_li_style="class='first'";
			}  else if($video_rows_counter==20) {
				$video_rows_li_style="class='last zebra'";
			}  else if($video_rows_counter%2==0) {
				$video_rows_li_style="class='zebra'";
			} else {
				$video_rows_li_style='';
			}
			
	   	echo "
                
                <li $video_rows_li_style>
                  <div class='first last'>
                    <div class='first'>                      
                      <div class='last'>
                        <h2 class='first'><a class='last' href='$full_link_url'>$title</a></h2>
                        <div class='articleTime'>$hijri_date - $miladi_date</div>
                        
                        <p class='last'>$video_brief ..</p>

                        <div class='videoThumb'>
                            <ul class='youtubeVideo'>
                              <li><a href='$video_video_link'></a></li>
                              <li><div id='videoHolder'><div style='width:300px;height:200px;margin:0 auto;'></div></div></li>
                            </ul>
                        </div>
                      </div>

                    </div>                    
                  </div>
                </li>
                
                
                ";
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
</div>

<?php $this->load->view('website/includes/footer'); ?>
	