<?php
/**
 * Seminar controller file.
 *
 * Contains controller class of the Seminar entity.
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
class Seminar extends CI_Controller
{ 	
	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Seminar_model', 'Seminar_model' , True);
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
		$data['seminar_rows']=$this->Seminar_model->get_all();
	
		$data['title']=lang('seminars');
		
		$data['writer_rows']=$this->Writer_model->get_all();
		$data['page_selected_rows']=$this->Page_selected_model->get_all(15);
		
		$this->load->view("website/seminar/index", $data);
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
		
		$row=$this->Seminar_model->get_by_alias($alias);
		
		$data['row']=$row;
		
		$data['writer_rows']=$this->Writer_model->get_all();
		$data['page_selected_rows']=$this->Page_selected_model->get_all(15);
		
		$this->load->view("website/seminar/content", $data);
	}
	
}