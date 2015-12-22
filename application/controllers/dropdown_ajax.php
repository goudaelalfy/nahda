<?php
class Dropdown_ajax extends CI_Controller
{ 	
	function __construct()
	{
		parent::__construct();

		$this->load->helper('language');
		$this->load->helper('url');
		$this->load->library('session');
		
		$this->load->model('Dropdown_ajax_model', 'Dropdown_ajax_model' , True);
	}
	
	function index()
	{
		
	}
	
	function get_cities_by_country($country_id)
	{
   		$drpdwn="<select class='input_pr' name='city_id' id='city_id' >";
     	$drpdwn=$drpdwn."<option value='0'></option>";
      	
     	$arr=$this->Dropdown_ajax_model->get_all_cities_by_country($country_id); 
     	foreach ($arr as $record) 
      	{ 
      	  $drpdwn=$drpdwn."<option value='". $record->id."' >".$record->name."</option>";
      	} 
     	$drpdwn=$drpdwn."</select>";
     	
     	echo $drpdwn;
	}
	
}