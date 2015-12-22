<?php $this->load->view('website/includes/header'); ?>
<?php
$this->load->controller('Website');
$website_object= new Website();
?>
<!-- 
<link rel="stylesheet" href="<?php echo base_url();?>added/scrolling_paging/9lessons.css" type="text/css" />
 -->
<script
	type="text/javascript"
	src="<?php echo base_url();?>added/scrolling_paging/jquery-1.2.6.pack.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
			
		function last_msg_funtion() 
		{ 
           var ID=$(".message_box:last").attr("id");
			$('div#last_msg_loader').html('<img src="<?php echo base_url();?>images/icons/loading.gif">');
			$.post("<?php echo base_url().$this->lang->lang(); ?>/writer/allajax/<?php echo $current_alias; ?>?action=get&last_msg_id="+ID,
			
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
       --> <!-- 
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
<a href="<?php echo base_url().$this->lang->lang().'/writer/all'; ?>"><?php echo $this->lang->line('all_writers'); ?></a>
</div>
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
<div class="bodyComponent articlesList" id="dv_articlesList">
<div>
<h2><?php echo $this->lang->line('writers'); ?></h2>
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

	//$writer_id=$row->id;
	$writer_id=0;

	$writer_rows=$this->Writer_model->get_all(20);
	if(isset($writer_rows)) {
		$writer_rows_counter=1;
		foreach($writer_rows as $writer_row) {
			$writer_id=$writer_row->id;
			$writer_alias=$writer_row->alias;

			if($this->lang->lang()=='ar') {
				$name=$writer_row->name_ar;
				$writer_brief=$writer_row->brief_ar;
					
			} else {
				$name=$writer_row->name;
				$writer_brief=$writer_row->brief;
					
			}
			$banner_file_selected=$writer_row->banner_file_selected;

			$full_link_url=base_url().$this->lang->lang().'/writer/content/'.$writer_alias;

			$hijri_date=$website_object->getHijri($writer_row->last_modify_date);
			$miladi_date=$website_object->getDateForamt($writer_row->last_modify_date);

			if($writer_rows_counter==1) {
				$writer_rows_li_style="class='first'";
			}  else if($writer_rows_counter==20) {
				$writer_rows_li_style="class='last zebra'";
			}  else if($writer_rows_counter%2==0) {
				$writer_rows_li_style="class='zebra'";
			} else {
				$writer_rows_li_style='';
			}

			echo "<li $writer_rows_li_style>
        
                  <div class='first last'>
                    <div class='first'>
                      <div class='first'><a class='first last' href='$full_link_url'><img class='first last' src='".base_url().$banner_file_selected."' alt='$name' width='130px' height='100px'/></a></div>
                      <div class='last'>
                        <h2 class='first'><a class='last' href='$full_link_url'>$name</a></h2>
                        <p class='last'>$writer_brief ..</p>
                      </div>
                    </div>
                    <div class='readMoreContainer last'><a class='first last' href='$full_link_url'>". $this->lang->line('more')."</a></div>
                  </div>
                </li>";


		}

		echo "<div id='$writer_id'  class='message_box' ></div>";
	}
	?>

	<div id="last_msg_loader" align="center"></div>

	<?php
}
else
{

	$last_msg_id=$_GET['last_msg_id'];

	//$writer_id=$row->id;
	$writer_rows=$this->Writer_model->get_all_less_than($last_msg_id, 10);

	$last_msg_id="";


	if(isset($writer_rows)) {
		foreach($writer_rows as $writer_row) {
			$writer_id=$writer_row->id;
			$writer_alias=$writer_row->alias;
			$writer_writer_alias=$writer_row->writer_alias;

			if($this->lang->lang()=='ar') {
				$name=$writer_row->name_ar;
				$writer_brief=$writer_row->brief_ar;
					
			} else {
				$name=$writer_row->name;
				$writer_brief=$writer_row->brief;
					
			}
			$banner_file_selected=$writer_row->banner_file_selected;

			$full_link_url=base_url().$this->lang->lang().'/writer/content/'.$writer_alias;
			$writer_writer_full_link_url=base_url().$this->lang->lang().'/writer/content/'.$writer_writer_alias;

			echo "
      	
			$hijri_date=$website_object->getHijri($writer_row->last_modify_date);
			$miladi_date=$website_object->getDateForamt($writer_row->last_modify_date);
	   	
      			<li>
                  <div id='$writer_id' class='message_box' >
                    
                  <div>
                      <div><a href='$full_link_url'><img src='".base_url().$banner_file_selected."' alt='$name' width='130px' height='100px'/></a></div>
                      <div>
                        <h2><a href='$full_link_url'>$name</a></h2>
                      
                        <p>$writer_brief ..</p>
                      </div>
                    </div>
                    <div class='readMoreContainer'><a href='$full_link_url'>". $this->lang->line('more')."</a></div>
                  
                    </div>
                </li>
                
                ";
		}

		echo "<div id='$writer_id'  class='message_box' ></div>";

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
