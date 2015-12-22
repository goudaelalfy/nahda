<?php
/**
 * Video controller file.
 *
 * Contains controller class of the Video entity.
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
class Video extends CI_Controller
{ 	
	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Video_model', 'Video_model' , True);
		$this->load->model('Page_model', 'Page_model' , True);
		$this->load->model('Writer_model', 'Writer_model' , True);
		$this->load->model('Page_selected_model', 'Page_selected_model' , True);
		
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
		$alias=urldecode($alias);
		$data['video_rows']=$this->Video_model->get_all();
	
		$data['title']=lang('videos');
		
		$data['writer_rows']=$this->Writer_model->get_all();
		$data['page_selected_rows']=$this->Page_selected_model->get_all(15);
		
		$this->load->view("website/video/index", $data);
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
		$data=array();
	
		$alias=urldecode($alias);
		$data['current_alias']=$alias;
		
		$row=$this->Video_model->get_by_alias($alias);
		
		$data['row']=$row;
		
		$data['writer_rows']=$this->Writer_model->get_all();
		$data['page_selected_rows']=$this->Page_selected_model->get_all(15);
		
		$this->load->view("website/video/content", $data);
	}
	
}