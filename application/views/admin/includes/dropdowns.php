<?php 
//UMS
$this->load->model('user_group_model'); 
$this->load->model('screen_model');
$this->load->model('pagecat_model');
//$this->load->model('media_section_category_model');
//$this->load->model('media_section_model');

$this->load->model('writer_model');


$this->load->model('menu_model');
$this->load->model('menu_link_model');
$this->load->model('menu_map_model');
$this->load->model('controller_model');

$this->load->model('country_model');

?>

<?php
class Dropdowns {
  
   public function __construct() {
   			
   }
   
   
   	 //////////////////////////////////////////////////  Main Data  //////////////////////////////////////////////////
    public function drpdwn_country($object, $selected_id=0,$drpdwn_name, $are_disabled='') 
   	{ 
   		$drpdwn="<select  class='input_pr'  name='$drpdwn_name' id='$drpdwn_name' $are_disabled>";
     	$drpdwn=$drpdwn."<option value='0'></option>";
      	
     	$country_model=new Country_model();
     	$arr=$country_model->get_all_approved($object->table); 
     	foreach ($arr as $record) { 
      		$are_selected="";
      		if($selected_id==$record->id) {
      			$are_selected="selected='selected'";
      		}
      		
      		if($object->lang->lang()=='ar') {
      			$name=$record->name_ar;
      		} else {
      			$name=$record->name;
      		}
      		
      	  $drpdwn=$drpdwn."<option value='". $record->id."' $are_selected>".$name."</option>";
      	} 
     	$drpdwn=$drpdwn."</select>";
     	
     	echo $drpdwn;
   	}  
   	
   	
	//////////////////////////////////// Controller ////////////////////////////////////
   public function drpdwn_controller($object, $selected_url=0,$drpdwn_name, $are_disabled='') 
   	{ 
   		$drpdwn="<select  class='input_pr'  name='$drpdwn_name' id='$drpdwn_name' $are_disabled>";
     	$drpdwn=$drpdwn."<option value='0'></option>";
      	
     	$controller_model=new Controller_model();
     	$arr=$controller_model->get_all(); 
     	foreach ($arr as $record) { 
      		$are_selected="";
      		if($selected_url==$record->url) {
      			$are_selected="selected='selected'";
      		}
      		
      		if($object->lang->lang()=='ar') {
      			$name=$record->name_ar;
      		} else {
      			$name=$record->name;
      		}
      		
      	  $drpdwn=$drpdwn."<option value='". $record->url."' $are_selected>".$name."</option>";
      	} 
     	$drpdwn=$drpdwn."</select>";
     	
     	echo $drpdwn;
   	}
   
   	//////////////////////////////////////////////////  UMS  //////////////////////////////////////////////////
   public function drpdwn_user_group($selected_id=0,$drpdwn_name, $are_disabled='') 
   	{ 
   		
   		$drpdwn="<select  class='input_pr'  name='$drpdwn_name' id='$drpdwn_name' $are_disabled>";
     	$drpdwn=$drpdwn."<option value='0'></option>";
      	
     	$user_group_model=new User_group_model();
     	$arr=$user_group_model->get_all(); 
     	foreach ($arr as $record) 
      	{ 
      		$are_selected="";
      		if($selected_id==$record->id)
      		{
      			$are_selected="selected='selected'";
      		}
      		
      	  $drpdwn=$drpdwn."<option value='". $record->id."' $are_selected>".$record->name."</option>";
      	} 
     	$drpdwn=$drpdwn."</select>";
     	
     	
     	echo $drpdwn;
   	}  

	public function drpdwn_screen_module($selected_id=0,$drpdwn_name, $are_disabled='') 
   	{ 
   		
   		$drpdwn="<select  class='input_pr'  name='$drpdwn_name' id='$drpdwn_name' $are_disabled>";
     	$drpdwn=$drpdwn."<option value='0'></option>";
      	
     	$screen_model=new Screen_model();
     	$arr=$screen_model->get_all_module(); 
     	foreach ($arr as $record) 
      	{ 
      		$are_selected="";
      		if($selected_id==$record->id)
      		{
      			$are_selected="selected='selected'";
      		}
      		
      	  $drpdwn=$drpdwn."<option value='". $record->id."' $are_selected>".$record->name."</option>";
      	} 
     	$drpdwn=$drpdwn."</select>";
     	
     	
     	echo $drpdwn;
   	}
   	
   	
   //////////////////////////////////////////////////  Content  //////////////////////////////////////////////////
    public function drpdwn_pagecat($object, $selected_id=0,$drpdwn_name, $are_disabled='') 
   	{ 
   		$drpdwn="<select  class='input_pr'  name='$drpdwn_name' id='$drpdwn_name' $are_disabled>";
     	$drpdwn=$drpdwn."<option value='0'></option>";
      	
     	$pagecat_model=new Pagecat_model();
     	$arr=$pagecat_model->get_all_approved($object->table); 
     	foreach ($arr as $record) { 
      		$are_selected="";
      		if($selected_id==$record->id) {
      			$are_selected="selected='selected'";
      		}
      		
      		if($object->lang->lang()=='ar') {
      			$name=$record->name_ar;
      		} else {
      			$name=$record->name;
      		}
      		
      	  $drpdwn=$drpdwn."<option value='". $record->id."' $are_selected>".$name."</option>";
      	} 
     	$drpdwn=$drpdwn."</select>";
     	
     	echo $drpdwn;
   	}  
   	
   	public function drpdwn_writer($object, $selected_id=0,$drpdwn_name, $are_disabled='') 
   	{ 
   		$drpdwn="<select  class='input_pr'  name='$drpdwn_name' id='$drpdwn_name' $are_disabled>";
     	$drpdwn=$drpdwn."<option value='0'></option>";
      	
     	$writer_model=new Writer_model();
     	$arr=$writer_model->get_all_approved($object->table); 
     	foreach ($arr as $record) { 
      		$are_selected="";
      		if($selected_id==$record->id) {
      			$are_selected="selected='selected'";
      		}
      		
      		if($object->lang->lang()=='ar') {
      			$name=$record->name_ar;
      		} else {
      			$name=$record->name;
      		}
      		
      	  $drpdwn=$drpdwn."<option value='". $record->id."' $are_selected>".$name."</option>";
      	} 
     	$drpdwn=$drpdwn."</select>";
     	
     	echo $drpdwn;
   	}  
   	
   	
   public function drpdwn_media_section_category($object, $selected_id=0,$drpdwn_name, $are_disabled='') 
   	{ 
   		$drpdwn="<select  class='input_pr'  name='$drpdwn_name' id='$drpdwn_name' $are_disabled>";
     	$drpdwn=$drpdwn."<option value='0'></option>";
      	
     	$media_section_category_model=new Media_section_category_model();
     	$arr=$media_section_category_model->get_all_approved($object->table); 
     	foreach ($arr as $record) { 
      		$are_selected="";
      		if($selected_id==$record->id) {
      			$are_selected="selected='selected'";
      		}
      		
      		if($object->lang->lang()=='ar') {
      			$title=$record->title_ar;
      		} else {
      			$title=$record->title;
      		}
      		
      	  $drpdwn=$drpdwn."<option value='". $record->id."' $are_selected>".$title."</option>";
      	} 
     	$drpdwn=$drpdwn."</select>";
     	
     	echo $drpdwn;
   	}

   public function drpdwn_media_section($object, $selected_id=0,$drpdwn_name, $are_disabled='') 
   	{ 
   		$drpdwn="<select  class='input_pr'  name='$drpdwn_name' id='$drpdwn_name' $are_disabled>";
     	$drpdwn=$drpdwn."<option value='0'></option>";
      	
     	$media_section_model=new media_section_model();
     	$arr=$media_section_model->get_all_approved($object->table); 
     	foreach ($arr as $record) { 
      		$are_selected="";
      		if($selected_id==$record->id) {
      			$are_selected="selected='selected'";
      		}
      		
      		if($object->lang->lang()=='ar') {
      			$title=$record->title_ar;
      		} else {
      			$title=$record->title;
      		}
      		
      	  $drpdwn=$drpdwn."<option value='". $record->id."' $are_selected>".$title."</option>";
      	} 
     	$drpdwn=$drpdwn."</select>";
     	
     	echo $drpdwn;
   	}  
   	
  
   	//------------------------------- Menu -------------------------------------------------
	public function drpdwn_menu($object, $selected_id=0, $drpdwn_name, $are_disabled='') 
   	{ 
   		
   		$drpdwn="<select  class='input_pr'  name='$drpdwn_name' id='$drpdwn_name' $are_disabled>";
     	$drpdwn=$drpdwn."<option value='0'></option>";
      	
     	$menu_model=new Menu_model();
     	$arr=$menu_model->get_all($object->table, $selected_id); 
     	foreach ($arr as $record) 
      	{ 
      		$are_selected="";
      		if($selected_id==$record->id) {
      			$are_selected="selected='selected'";
      		}
      		
      	if($object->lang->lang()=='ar') {
      			$title=$record->title_ar;
      		} else {
      			$title=$record->title;
      		}
      		
      	  $drpdwn=$drpdwn."<option value='". $record->id."' $are_selected>$title</option>";
      	} 
     	$drpdwn=$drpdwn."</select>";
     	
     	
     	echo $drpdwn;
   	}
   	
	public function drpdwn_parent_menu_link($object, $selected_id=0, $current_id=0,$drpdwn_name, $are_disabled='') 
   	{ 
   		
   		$drpdwn="<select  class='input_pr'  name='$drpdwn_name' id='$drpdwn_name' $are_disabled>";
     	$drpdwn=$drpdwn."<option value='0'></option>";
      	
     	$menu_link_model=new Menu_link_model();
     	$arr=$menu_link_model->get_all_parent($object->table, $current_id); 
     	foreach ($arr as $record) 
      	{ 
      		$are_selected="";
      		if($selected_id==$record->id) {
      			$are_selected="selected='selected'";
      		}
      		
      		$alias=$record->alias;
      		
      	if($object->lang->lang()=='ar') {
      			$title=$record->title_ar;
      		} else {
      			$title=$record->title;
      		}
      		
      	  $drpdwn=$drpdwn."<option value='". $record->id."' $are_selected>$alias -- $title</option>";
      	} 
     	$drpdwn=$drpdwn."</select>";
     	
     	
     	echo $drpdwn;
   	}
   	
	public function drpdwn_menu_map($object, $selected_id=0, $drpdwn_name, $are_disabled='') 
   	{ 
   		
   		$drpdwn="<select  class='input_pr'  name='$drpdwn_name' id='$drpdwn_name' $are_disabled>";
     	$drpdwn=$drpdwn."<option value='0'></option>";
      	
     	$menu_map_model=new Menu_map_model();
     	$arr=$menu_map_model->get_all($object->table, $selected_id); 
     	foreach ($arr as $record) 
      	{ 
      		$are_selected="";
      		if($selected_id==$record->id) {
      			$are_selected="selected='selected'";
      		}
      		
      	if($object->lang->lang()=='ar') {
      			$title=$record->title_ar;
      		} else {
      			$title=$record->title;
      		}
      		
      	  $drpdwn=$drpdwn."<option value='". $record->id."' $are_selected>$title</option>";
      	} 
     	$drpdwn=$drpdwn."</select>";
     	
     	
     	echo $drpdwn;
   	}
   	
   	
   	
}