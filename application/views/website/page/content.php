<?php $this->load->view('website/includes/header'); ?>

<script type="text/javascript">

/***********************************************
* Bookmark site script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

/* Modified to support Opera */
function bookmarksite(title,url){
if (window.sidebar) // firefox
	window.sidebar.addPanel(title, url, "");
else if(window.opera && window.print){ // opera
	var elem = document.createElement('a');
	elem.setAttribute('href',url);
	elem.setAttribute('title',title);
	elem.setAttribute('rel','sidebar');
	elem.click();
} 
else if(document.all)// ie
	window.external.AddFavorite(url, title);
}
</script>

<?php 
$this->load->controller('Website');
$website_object= new Website();
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
            <h2><?php  echo $this->lang->line('pages_related'); ?></h2>
          </div>
          <div>
            <ul class="bodyComponent-regularUL">
             <?php 
            if(isset($page_related_rows)) {
		      	foreach($page_related_rows as $page_related_row) {
			      	$page_related_row_alias=$page_related_row->alias;
			      	$page_related_row_writer_alias=$page_related_row->writer_alias;
			      	if($this->lang->lang()=='ar') {
						$page_related_row_title=$page_related_row->title_ar;
						$page_related_row_writer_name=$page_related_row->writer_name_ar;
			      	
					} else {
						$page_related_row_title=$page_related_row->title;
						$page_related_row_writer_name=$page_related_row->writer_name;
			      	
					}
					
					$page_related_row_full_link_url=base_url().$this->lang->lang().'/page/content/'.$page_related_row_alias;
	   				$writer_full_link_url=base_url().$this->lang->lang().'/writer/content/'.$page_related_row_writer_alias;
	   				
					if(!isset($current_alias)) {
	   					$current_alias='';
	   				}
					if($current_alias!=$page_related_row_alias) {
						
						echo "
						<li><a href='$page_related_row_full_link_url'>$page_related_row_title</a>
		                <div><span>".lang('writer').":</span> <a href='$writer_full_link_url'>$page_related_row_writer_name</a></div>
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
            <h2>	<?php  echo $this->lang->line('other_articles_for_writer'); ?></h2>
          </div>
          <div>
            <ul class="bodyComponent-regularUL">
            <?php 
            if(isset($other_writer_article_rows)) {
		      	foreach($other_writer_article_rows as $other_writer_article_row) {
			      	$other_writer_article_row_alias=$other_writer_article_row->alias;
			      	if($this->lang->lang()=='ar') {
						$other_writer_article_row_title=$other_writer_article_row->title_ar;
					} else {
						$other_writer_article_row_title=$other_writer_article_row->title;
					}
					
					$other_writer_article_row_full_link_url=base_url().$this->lang->lang().'/page/content/'.$other_writer_article_row_alias;
	   				if(!isset($current_alias)) {
	   					$current_alias='';
	   				}
					if($current_alias!=$other_writer_article_row_alias) {
						echo "<li><a href='$other_writer_article_row_full_link_url'>$other_writer_article_row_title</a></li>";
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
    <div class="body-rightCol last">
      <div class="first last">
        <div class="bodyComponent articleDetails  first last">
        <?php 
        
        $miladi_month = '';
		$miladi_day = '';	
		$miladi_year = '';	
		
		$hijri_day='';
	   	$hijri_month='';
	   	$hijri_year='';
	   		
		
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
			
			$hijri_date=$website_object->getHijriArray($row->last_modify_date);
	   		$miladi_date=$website_object->getDateForamt($row->last_modify_date);
	   	
	   		$miladi_month = date("m",strtotime($row->last_modify_date));
	   		$miladi_month =$website_object->getMiladiMonth($miladi_month);	
			$miladi_day = date("j",strtotime($row->last_modify_date));	
			$miladi_year = date("Y",strtotime($row->last_modify_date));	
		
	   		$hijri_day=$hijri_date['day'];
	   		$hijri_month=$hijri_date['month'];
	   		$hijri_year=$hijri_date['year'];
	   		
			$page_time = date("h:i",strtotime($row->last_modify_date));	
			$page_time_am_pm = date("a",strtotime($row->last_modify_date));	
	   		$page_time_am_pm=str_replace('am',lang('am'),$page_time_am_pm);
	   		$page_time_am_pm=str_replace('pm',lang('pm'),$page_time_am_pm);
	   		
         }
         
         if(isset($page_writer_row)) {
         	$page_writer_alias=$page_writer_row->alias;
         	
         if($this->lang->lang()=='ar') {
				$page_writer_name=$page_writer_row->name;
				$page_writer_seo_words=$page_writer_row->seo_words_ar;
				$page_writer_brief=$page_writer_row->brief_ar;
				$page_writer_body=$page_writer_row->body_ar;
			} else {
				$page_writer_name=$page_writer_row->name;
				$page_writer_seo_words=$page_writer_row->seo_words;
				$page_writer_brief=$page_writer_row->brief;
				$page_writer_body=$page_writer_row->body;
				
			}
			$page_writer_image=base_url().$page_writer_row->banner_file_selected;
			$page_writer_full_link_url=base_url().$this->lang->lang().'/writer/content/'.$page_writer_alias;
	   				
         }
         
        ?>
        
        
          <div class="first">
            <h2 class="first last"><?php if(isset($title)) {echo $title;} ?></h2>
          </div>
          <div class="last">
            <div class="first last">
              <div class="articleHeader first">
                <div class="first">
                  <ul class="articleHeader-date first">
                    <li class="first">
                      <div class="first"><span class="first"><?php echo $hijri_day; ?></span> <span class="last"><?php echo $hijri_month; ?></span></div>
                      <div class="last"><?php echo $hijri_year; ?></div>
                    </li>
                    <li>
                      <div class="first"><span class="first"><?php echo $miladi_day;?></span> <span class="last"><?php echo $miladi_month;?></span></div>
                      <div class="last"><?php echo $miladi_year;?></div>
                    </li>
                    <li class="last">
                      <div class="first last"> <span class="first"><?php echo $page_time;?></span> <span class="last"><?php echo $page_time_am_pm;?></span></div>
                    </li>
                  </ul>
                  <ul class="articleHeader-socialIcons">
                    <li class="first"><a href="#"  class="article-header-socialIcons-addThis first last">Add this</a></li>
                    <li><a target="_blank" href="http://twitter.com/home?status=<?php echo base_url().$this->lang->lang().'/page/content/'.$current_alias; ?>" class="article-header-socialIcons-twitter first last">Twitter</a></li>
                    <li><a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo base_url().$this->lang->lang().'/page/content/'.$current_alias; ?>" class="article-header-socialIcons-facebook first last">Like</a> </li>
                    <li><a target="_blank" href="https://plusone.google.com/_/+1/confirm?hl=en&url=<?php echo base_url().$this->lang->lang().'/page/content/'.$current_alias; ?>" class="article-header-socialIcons-plus first last">Google plus</a></li>
                    <li class="ast"><a href="javascript:bookmarksite('Dynamic Drive', 'http://www.nahdaislah.com')" class="article-header-socialIcons-fav first last">Add to favourite</a></li>
                  </ul>
                  <div class="articleHeader-authorContainer last">
                  <a class="first" href="<?php if (isset($page_writer_full_link_url)) { echo $page_writer_full_link_url; } ?>"><img class="first last" src="<?php if(isset($page_writer_image)) {echo $page_writer_image;}?>" alt="<?php if(isset($page_writer_name)) {echo $page_writer_name;}?>" width="100px"/>
                  </a>
                    <p class="last"><?php if(isset($page_writer_name)) {echo $page_writer_name;} ?></p>
                  </div>
                </div>
                <div class="last"><img class="first last" src="<?php if(isset($banner_file_selected)) {echo $banner_file_selected;}?>" alt="<?php if(isset($title)) {echo $title;} ?>" /></div>
              </div>
              <div class="articleBody last">
                <h1 class="first"><?php if(isset($title)) {echo $title;} ?></h1>
                 <p>
        		<?php 
               if(isset($body)) {echo $body;}
               ?>
               </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('website/includes/footer'); ?>
	