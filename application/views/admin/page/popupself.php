<?php $this->load->view('admin/includes/header_popup'); ?>
<script type="text/javascript">
function selectPage(page_id, page_name) 
{
	window.opener.document.getElementById('page_page_ids').value=page_id;
	window.opener.document.getElementById('page_page_names').value=page_name;
	javascript:this.close();
}
</script>

<script type="text/javascript">
function checkUncheckPages() 
{	
	 	{
	    	for (var i = 0; i < document.frm_popup.elements.length; i++ ) 
		    {
		    	var check_id=document.frm_popup.elements[i].id;
		    	check_id=check_id.substring(0, 3);

		        if (document.frm_popup.elements[i].type == 'checkbox' && check_id=='pag') 
			    {		        		    
		        	document.frm_popup.elements[i].checked = document.frm_popup.elements['pagecategories'].checked; 
		        }

	    	}
	 	}
}
</script>
<script type="text/javascript">
function selectPages() 
{

		
		var page_page_ids='';
		var page_page_names='';
		var counter=0;
		
		for (var i = 0; i < document.frm_popup.elements.length; i++ ) 
	    {
			var checkbox_id=document.frm_popup.elements[i].id;
	        if (document.frm_popup.elements[i].type == 'checkbox' && checkbox_id!='pagecategories' ) 
		    {		   
			        		    
	        	if(document.frm_popup.elements[i].checked)
	        	{
		        	if(counter==0)
		        	{
		        		page_page_ids=page_page_ids+document.frm_popup.elements[i].value;
		        		page_page_names=page_page_names+document.frm_popup.elements[i].name;
		        	}
		        	else
		        	{
		        		page_page_ids=page_page_ids+','+document.frm_popup.elements[i].value;
		        		page_page_names=page_page_names+','+document.frm_popup.elements[i].name;
			        	
			        }
		        	counter=counter+1;
		        } 
	        }

    	}
	
		window.opener.document.getElementById('page_page_ids').value=page_page_ids;
		window.opener.document.getElementById('page_page_names').value=page_page_names;
		
	javascript:this.close();
}
</script>


<form id="frm_popup" name="frm_popup"  method="post">



			<div class="row-fluid sortable">		
				<div class="box span12">
					
					<div class="box-content">
<?php 
echo "<table class='table table-striped table-bordered bootstrap-datatable datatable'>";
	$index=0;		
	foreach ($pages_rows as $pages_row) {
		if($index==0){
			echo "<thead><tr>";
			echo "<th ><input type='checkbox' name='pagecategories' id='pagecategories' value='0' onclick='checkUncheckPages()' /></th>";
			echo"<th >".lang('pages')." </th>";					
			echo "</tr></thead>";	
			echo "<tbody>";				
		}
				
		$id= $pages_row->id;
		
		$page_title='';
		if($this->lang->lang()=='ar') {
		$page_title=$pages_row->title_ar;
		} else {
		$page_title=$pages_row->title;
		}
		
			$checked='';
			
			
			foreach($rows as $row)
			{
				$row_id=$row->page_page_id;
				if($row_id==$id)
				{
					$checked="checked='checked'";
				}
			}
			
		
		echo "<tr>";
		echo"<td><input type='checkbox' name='$page_title' id='page[]' value='$id' $checked onclick='document.frm_popup.elements[\"pagecategories\"].checked = false;' /></td>";
			
		echo"<td> <a  href=\"javascript:selectPage('$id','$page_title')\" >$page_title</a>  </td>";	
		echo "</tr>";
		$index=$index+1;
	}
echo"</tbody></table>";
?>
	
 	
<div class="form-actions">
<a class='btn btn-info' href='javascript:selectPages()'>
<i class='icon-zoom-in icon-white'></i>  
<?php  echo $this->lang->line('ok'); ?>                                           
</a>
		

<a class='btn btn-warning' href="javascript:this.close();">
<i class='icon-edit icon-white'></i>
<?php  echo $this->lang->line('btn_cancel'); ?>
</a>			            

					</div>
				




	
	<div class="pagination pagination-centered">
	<ul>
	<?php 
            	$pages=ceil($rows_count/$paging_no_of_pages);
            	
            	// ------------- previous link---------
            	$previous_lnk=$page-1;
            	if($previous_lnk>0)
            	{
            		echo "<li><a href='".base_url().$this->lang->lang()."/".ADMIN."/page/popupself/$current_page_id/$previous_lnk'> ".lang('lnk_prev')."</a></li>";
            	}
            	
            	for ($counter = 0; $counter < $pages; $counter += 1) 
            	{
            		$page_no=$counter+1;
            		if($page==$page_no)
            		$class_style="class='active'";
            		else
            		$class_style="";
            		
            		
            		$range_previous=$page-2; 
            		$range_next=$page+2;  
            		
            		if(($page_no<$page && $page_no > $range_previous) || ($page_no>$page && $page_no < $range_next) || $page==$page_no)
            		{
            			echo "<a href='".base_url().$this->lang->lang()."/".ADMIN."/page/popupself/$current_page_id/$page_no' $class_style>$page_no</a>";
            		}
            	}
            	
            	// ------------- next link---------
            	$next_lnk=$page+1;
            	if($next_lnk<=$pages)
            	{
            		echo "<a href='".base_url().$this->lang->lang()."/".ADMIN."/page/popupself/$current_page_id/$next_lnk' >".lang('lnk_next')." </a>";
            	}
            	?>
	
	
						  
							
						  </ul>
						</div>				
					
						            
				
				
				
				
				
				
				</div><!--/span-->
			
			</div><!--/row-->

     
</form>



<?php $this->load->view('admin/includes/footer_popup'); ?>
