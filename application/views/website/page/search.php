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
			$.post("<?php echo base_url().$this->lang->lang(); ?>/page/searchajax/<?php echo $keyword; ?>?action=get&last_msg_id="+ID,
			
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
              <ul class="articleListUL">
 
 
 <?php
//$last_msg_id=$_GET['last_msg_id'];
//$action=$_GET['action'];
$last_msg_id='';
$action='';

if($action <> "get")
{
?>

<?php

$page_id=0;

$page_rows=$this->Page_model->get_by_keyword($keyword, 20);
		
		
if(isset($page_rows)) {
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
	   	
	   	
      	echo "<li>
                  <div>
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
                </li>";
                
                
      }
      
      echo "<div id='$page_id'  class='message_box' ></div>";
   }
?>

<div id="last_msg_loader" align="center"></div>

<?php
}
else
{

$last_msg_id=$_GET['last_msg_id'];


$page_rows=$this->Page_model->get_by_keyword_less_than($keyword,$last_msg_id, 10);
			
$last_msg_id="";


if(isset($page_rows)) {
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
      
      echo "<div id='$page_id'  class='message_box' ></div>";
   }
}

?>
 
<!-- 
<?php 
	if(isset($page_rows)) {
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
	   	
	   	
      	echo "<li>
                  <div>
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
                </li>";
      }
   }
?>          
-->               
                
                
              
              
              
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('website/includes/footer'); ?>
	