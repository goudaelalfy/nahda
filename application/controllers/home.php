<?php
/**
 * Home controller file.
 *
 * Contains controller class of the home page.
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
 * Controller class for the home page.
 *
 * @package		admin
 * @category	controller
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Home extends Ci_Controller
{

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Page_model', 'Page_model' , True);
		$this->load->model('Menu_map_model', 'Menu_map_model' , True);
		$this->load->model('Menu_model', 'Menu_model' , True);
		$this->load->model('Menu_link_model', 'Menu_link_model' , True);

		$this->load->model('Pagecat_model', 'Pagecat_model' , True);
		$this->load->model('Writer_model', 'Writer_model' , True);
		$this->load->model('Video_model', 'Video_model' , True);
		$this->load->model('Gallery_model', 'Gallery_model' , True);

		$this->load->model('Questionnaire_model', 'Questionnaire_model' , True);
		
		
		$this->load->helper('language');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->helper('cookie');



		$this->lang->load('main');
	}

	/**
	 * Index Method.
	 *
	 * Default method for each controller, called when no method name path through URL.
	 *
	 * @access	public
	 */
	public function index()
	{
		$data['writer_rows']=$this->Writer_model->get_all(7);

		$this->load->view("website/home", $data);
	}

	public function dvHomePortalsMenusLinksHtml($link_alias)
	{
		$link_alias=urldecode($link_alias);
		
		$this->load->controller('Website');
		$website_object= new Website();

		//$link_alias=$_POST['alias'];
		$home_portals_row=$this->Pagecat_model->get_by_alias($link_alias);
			
		if(count($home_portals_row)>0) {
				
			$pagecat_id=$home_portals_row->id;
				
			$page_rows=$this->Page_model->get_by_pagecat($pagecat_id, 4);
				
			$page_row_counter=1;
			foreach($page_rows as $page_row) {
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
				$banner_file_selected=base_url().$page_row->banner_file_selected;
					
				$full_link_url=base_url().$this->lang->lang().'/page/content/'.$page_alias;
				$page_writer_full_link_url=base_url().$this->lang->lang().'/writer/content/'.$page_writer_alias;
				 
				$hijri_date=$website_object->getHijri($page_row->last_modify_date);
				$miladi_date=$website_object->getDateForamt($page_row->last_modify_date);
				 

				if($page_row_counter==1) {
					$page_row_li_style="class='first'";
				} else if($page_row_counter==2) {
					$page_row_li_style="class='zebra'";
				}  else if($page_row_counter==4) {
					$page_row_li_style="class='last zebra'";
				} else {
					$page_row_li_style="";
				}
					
				$page_row_counter++;
				
				echo "
         	<li $page_row_li_style>
                <div class='first last'>
                  <div class='first'>
                    <div class='first'><a class='first last' href='$full_link_url'><img class='first last' src='$banner_file_selected' alt='$title' /></a></div>
                    <div class='last'>
                      <h2 class='first'><a class='first last' href='$full_link_url'>$title</a></h2>
                        <div class='articleTime'>$hijri_date - $miladi_date</div>

                        <div><span class='first'>".lang('writer').":</span> <a href='$page_writer_full_link_url'>$page_writer_name</a></div>
                      <p class='last'>$page_brief ..</p>
                    </div>
                  </div>
                  <div class='readMoreContainer' class='last'><a class='first last' href='$full_link_url'>".lang('more')."</a></div>
                </div>
            </li>
		   ";
			}
		}
		exit;
	}

}