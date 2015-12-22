<?php $this->load->view('admin/includes/header_popup'); ?>
<script type="text/javascript">
function selectPagetype(page_type_id, page_type_name) 
{
	window.opener.document.getElementById('page_type_ids').value=page_type_id;
	window.opener.document.getElementById('page_type_names').value=page_type_name;
	javascript:this.close();
}
</script>

<script type="text/javascript">
function checkUncheckPagetypes() 
{	
	 	{
	    	for (var i = 0; i < document.frm_popup.elements.length; i++ ) 
		    {
		    	var check_id=document.frm_popup.elements[i].id;
		    	check_id=check_id.substring(0, 3);

		        if (document.frm_popup.elements[i].type == 'checkbox' && check_id=='pag') 
			    {		        		    
		        	document.frm_popup.elements[i].checked = document.frm_popup.elements['pagetypes'].checked; 
		        }

	    	}
	 	}
}
</script>
<script type="text/javascript">
function selectPagetypes() 
{

		
		var page_type_ids='';
		var page_type_names='';
		var counter=0;
		
		for (var i = 0; i < document.frm_popup.elements.length; i++ ) 
	    {
			var checkbox_id=document.frm_popup.elements[i].id;
	        if (document.frm_popup.elements[i].type == 'checkbox' && checkbox_id!='pagetypes' ) 
		    {		   
			        		    
	        	if(document.frm_popup.elements[i].checked)
	        	{
		        	if(counter==0)
		        	{
		        		page_type_ids=page_type_ids+document.frm_popup.elements[i].value;
		        		page_type_names=page_type_names+document.frm_popup.elements[i].name;
		        	}
		        	else
		        	{
		        		page_type_ids=page_type_ids+','+document.frm_popup.elements[i].value;
		        		page_type_names=page_type_names+','+document.frm_popup.elements[i].name;
			        	
			        }
		        	counter=counter+1;
		        } 
	        }

    	}
	
		window.opener.document.getElementById('page_type_ids').value=page_type_ids;
		window.opener.document.getElementById('page_type_names').value=page_type_names;
		
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
	foreach ($rows as $row) {
		if($index==0){
			echo "<thead><tr>";
			echo "<th ><input type='checkbox' name='pagetypes' id='pagetypes' value='0' onclick='checkUncheckPagetypes()' /></th>";
			echo"<th >".lang('page_types')." </th>";					
			echo "</tr></thead>";	
			echo "<tbody>";				
		}
				
		$id= $row->id;
		
		$page_type_name='';
		if($this->lang->lang()=='ar') {
		$page_type_name=$row->name_ar;
		} else {
		$page_type_name=$row->name;
		}
		
			$checked='';
			
			foreach($page_types_rows as $page_types_row)
			{
				$page_types_row_id=$page_types_row->page_type_id;
				if($page_types_row_id==$id)
				{
					$checked="checked='checked'";
				}
			}
		
		echo "<tr>";
		echo"<td><input type='checkbox' name='$page_type_name' id='pagetype[]' value='$id' $checked onclick='document.frm_popup.elements[\"pagetypes\"].checked = false;' /></td>";
			
		echo"<td> <a  href=\"javascript:selectPagetype('$id','$page_type_name')\" >$page_type_name</a>  </td>";	
		echo "</tr>";
		$index=$index+1;
	}
echo"</tbody></table>";
?>
	
	
<div class="form-actions">
<a class='btn btn-info' href='javascript:selectPagetypes()'>
<i class='icon-zoom-in icon-white'></i>  
<?php  echo $this->lang->line('ok'); ?>                                           
</a>
		

<a class='btn btn-warning' href="javascript:this.close();">
<i class='icon-edit icon-white'></i>
<?php  echo $this->lang->line('btn_cancel'); ?>
</a>			            

					</div>
				</div><!--/span-->
			
			</div><!--/row-->

     
</form>



<?php $this->load->view('admin/includes/footer_popup'); ?>
