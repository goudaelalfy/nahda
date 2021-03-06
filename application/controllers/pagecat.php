<?php
/**
 * Pagecat controller file.
 *
 * Contains controller class of the Pagecat entity.
 *
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 * @copyright	Copyright (c) 2013, Info-cast.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://www.infocast-me.com
 * @since		Version 2.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Controller class for the page page.
 *
 * @package		admin
 * @category	controller
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Pagecat extends CI_Controller
{ 	
	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pagecat_model', 'Pagecat_model' , True);
		$this->load->model('Page_model', 'Page_model' , True);
		$this->load->model('Writer_model', 'Writer_model' , True);
		$this->load->model('Page_selected_model', 'Page_selected_model' , True);
		
		$this->load->model('Pagetype_model', 'Pagetype_model' , True);
		
		$this->load->controller('Website');
		$website_object= new Website();
		$website_object->load();
		
	}
	
	/**
	 * Index Method.
	 *
	 * Default method for each controller, called when no method name path through URL. 
	 *
	 * @access	public
	 */	
	public function index($alias='')
	{
		
	}
	
	/**
	 * Content Method.
	 *
	 * main method for each controller used to display all categories content. 
	 * 
	 * @access	public
	 * @param string
	 */	
	public function content($alias='')
	{	
		$alias=urldecode($alias);
		$data['current_alias']=$alias;
		
		
		$row=$this->Pagecat_model->get_by_alias($alias);
		
		$data['row']=$row;
		$data['pagecat_id']=$row->id;
		
		if($this->lang->lang()=='ar') {
			$data['title']=$row->name_ar; 
			$data['seo_words']=$row->seo_words_ar;
				$data['brief']=$row->brief_ar;
				$data['body']=$row->body_ar;     	
		} else {
			$data['title']=$row->name;
			$data['seo_words']=$row->seo_words;
				$data['brief']=$row->brief;
				$data['body']=$row->body;
		}
	
		$data['writer_rows']=$this->Writer_model->get_all();
		$data['page_selected_rows']=$this->Page_selected_model->get_all(15);
		
		$this->load->view("website/pagecat/content", $data);
	}
	
	/*
	public function contentajax($alias='')
	{	
		$alias=urldecode($alias);
		$data['current_alias']=$alias;
		
		
		$row=$this->Pagecat_model->get_by_alias($alias);
		$last_msg_id=$_GET['last_msg_id'];

		$pagecat_id=$row->id;
		$page_rows=$this->Page_model->get_by_pagecat_id_less_than($pagecat_id, $last_msg_id, 10);
		
		$html='';
		$counter_loop=$last_msg_id+1;
		
		$page_id=0;
		
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

	if($counter_loop %2==1) {
		$class_li="class='zebra'";
	} else {
		$class_li="";
	}
	   	$this->load->controller('Website');
		$website_object= new Website();
	   	$hijri_date=$website_object->getHijri($page_row->last_modify_date);
		$miladi_date=$website_object->getDateForamt($page_row->last_modify_date);
	   	
      	$html.= "<li $class_li>
                  <div class='first last'>
                    <div class='first'>
                      <div class='first'><a class='first last' href='$full_link_url'><img src='".base_url().$banner_file_selected."' alt='$title' width='130px' height='100px'/></a></div>
                      <div class='last'>
                        <h2 class='first last'><a class='first last' href='$full_link_url'>$title</a></h2>
                        <div><span class='first'>".lang('writer').":</span> <a href='$page_writer_full_link_url'>$page_writer_name</a></div>
                        <div class='articleTime'>$hijri_date - $miladi_date</div>

                        <p class='last'>$page_brief ..</p>
                      </div>
                    </div>
                    <div class='readMoreContainer'><a href='$full_link_url'>". $this->lang->line('more')."</a></div>
                  </div>
                </li>";
      	
      	$counter_loop++;
      		}
      	$html.= "<div id='$page_id'  class='message_box' ></div>";
   		}
   		
   		echo $html;
   		

	}
	*/
	
}