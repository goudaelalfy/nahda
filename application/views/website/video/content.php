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
         }
         
        ?>
        
        
          <div>
            <h2><?php if(isset($title)) {echo $title;} ?></h2>
          </div>
          <div>
            <div>
              <div class="articleHeader">
                <div>
                  <ul class="articleHeader-date">
                    <li>
                      <div><span>12</span> <span>شـوال</span></div>
                      <div>1433</div>
                    </li>
                    <li>
                      <div><span>22</span> <span>أغسطس</span></div>
                      <div>2012</div>
                    </li>
                    <li>
                      <div><span>6:30</span> <span>صبـاحا</span></div>
                    </li>
                  </ul>
                  <ul class="articleHeader-socialIcons">
                    <li><a href="#" class="article-header-socialIcons-addThis">Add this</a></li>
                    <li><a href="#" class="article-header-socialIcons-twitter">Twitter</a></li>
                    <li><a href="#" class="article-header-socialIcons-facebook">Facebook</a></li>
                    <li><a href="#" class="article-header-socialIcons-plus">Google plus</a></li>
                    <li><a href="#" class="article-header-socialIcons-fav">Add to favourite</a></li>
                  </ul>
                  <div class="articleHeader-authorContainer">
                  <a href="<?php if (isset($page_writer_full_link_url)) { echo $page_writer_full_link_url; } ?>"><img src="<?php if(isset($page_writer_image)) {echo $page_writer_image;}?>" alt="<?php if(isset($page_writer_name)) {echo $page_writer_name;}?>" width="100px"/>
                  </a>
                    <p><?php if(isset($page_writer_name)) {echo $page_writer_name;} ?></p>
                  </div>
                </div>
                <div>
                <!-- 
                <img src="<?php if(isset($banner_file_selected)) {echo $banner_file_selected;}?>" alt="<?php if(isset($title)) {echo $title;} ?>" /></div>
         		-->      
        <?php 
              
              echo "
           <iframe src='$video_video_link' 
			width='500%' height='500' frameborder='0'></iframe>
			
              ";
              
              ?>
              
              </div>
              <div class="articleBody">
                <h1><?php if(isset($title)) {echo $title;} ?></h1>
               <?php 
               if(isset($body)) {echo $body;}
               ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('website/includes/footer'); ?>
	