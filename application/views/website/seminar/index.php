<?php $this->load->view('website/includes/header'); ?>
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
	if(isset($seminar_rows)) {
		$seminar_rows_counter=1;
      	foreach($seminar_rows as $seminar_row) {
      	$seminar_alias=$seminar_row->alias;
			
      	if($this->lang->lang()=='ar') {
			$title=$seminar_row->title_ar;
			$seminar_brief=$seminar_row->brief_ar;
      	
		} else {
			$title=$seminar_row->title;
			$seminar_brief=$seminar_row->brief;
      	
		}
      	$banner_file_selected=$seminar_row->banner_file_selected;
		
      	$full_link_url=base_url().$this->lang->lang().'/seminar/content/'.$seminar_alias;

      	$hijri_date=$website_object->getHijri($seminar_row->last_modify_date);
	   	$miladi_date=$website_object->getDateForamt($seminar_row->last_modify_date);
	   	
	   	$hijri_date=$website_object->getHijri($seminar_row->last_modify_date);
	   	$miladi_date=$website_object->getDateForamt($seminar_row->last_modify_date);
	   	
      	if($seminar_rows_counter==1) {
		   		$seminar_rows_li_style="class='first'";
		   	}  else if($seminar_rows_counter==20) {
		   		$seminar_rows_li_style="class='last zebra'";
		   	}  else if($seminar_rows_counter%2==0) {
		   		$seminar_rows_li_style="class='zebra'";
		   	} else {
		   		$seminar_rows_li_style='';
		   	}
		   	
      	echo "<li $seminar_rows_li_style>
                  <div class='first last'>
                    <div class='first'>                      
                      <div class='last'>
                        <h2 class='first'><a class='first last' href='$full_link_url'>$title</a></h2>
                        <div class='articleTime'>$hijri_date - $miladi_date</div>

                        <p class='last'>$seminar_brief ..</p>
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
	