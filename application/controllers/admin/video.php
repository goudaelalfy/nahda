<?php
/**
 * Video controller file.
 *
 * Contains controller class of the video table.
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
 * Controller class of the video table.
 *
 * This is the controller class of the video table. between model and view, in MVC design pattern.
 *
 * @package		admin
 * @category	controller
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Video extends My_Controller
{ 	
	/**
	 * store this controller video screen id.
	 *
	 * @var int
	 * @access public
	 */
	public $screen_id=39;
	
	/**
	 * store this controller video table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='video';
	/**
	 * store table fields.
	 *
	 * @var string
	 * @access public
	 */
	public $table_fields="'id',  'alias', 'banner_image_thumbs', 'banner_files', 'banner_file_selected',  'title',  'title_ar', 'seo_words', 'seo_words_ar', 'brief', 'brief_ar', 'body', 'body_ar'";
	
	/**
	 * store table fields to display in table.
	 *
	 * @var string
	 * @access public
	 */
	public $table_fields_to_display=" id,  alias, banner_image_thumb_selected,  title,  title_ar, approved ";
	
	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Video_model', 'Video_model' , True);
		$this->load->model('Pagecat_model', 'Pagecat_model' , True);
		$this->load->model('Videocats_model', 'Videocats_model' , True);
		 
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
		redirect(base_url().$this->lang->lang()."/".ADMIN."/video/table");
	}

	/**
	 * Method displaying records or rows in table.
	 * 
	 * Method to call model get_all_display_paging method and pass this table records to view
	 * to display in table. 
	 *
	 * @access	public
	 * @param   int
	 * @param   string
	 * @param   string
	 */
	public function table($page=1, $order=null, $order_type=null)
	{
		if(!$this->user_screen_privielge_allowed($this->screen_id, $this->privielge_view)) {
			redirect(base_url().$this->lang->lang()."/".ADMIN."/accessforbidden");
		} 
		
		$data['page']=$page;
		
		$rows_count = $this->Video_model->get_count($this->table);
		$data['rows_count']=$rows_count;
		
		$settings = $this->Setting_model->get_all();
		$data['paging_no_of_pages']=$settings[0]->paging_no_of_pages;
		
		$per_page = $data['paging_no_of_pages'];
    	
		$start = ($page-1)*$per_page;

		$data['rows'] = $this->Video_model->get_all_display_paging($this->table, $start, $per_page, $this->table_fields_to_display, $order, $order_type); 
        
		
		$this->load->view("admin/video/table", $data);
	}
	
	/**
	 * Delete method.
	 * 
	 * Method used to delete one record. 
	 *
	 * @access	public
	 * @param   int
	 */
	public function delete($id)
	{	
		if(!$this->user_screen_privielge_allowed($this->screen_id, $this->privielge_delete)) {
			redirect(base_url().$this->lang->lang()."/".ADMIN."/accessforbidden");
		}	
		//----------User Histroy Row ------------------//
		$dateTime = new DateTime(); 
		$current_date=$dateTime->format("Y-m-d H:i:s");
		$data = array(
		'deleted' => 1,
		'last_user_id' => $this->session->userdata('user_session')->id,
		'last_modify_date' =>$current_date,
		);
								
		$this->Video_model->update($this->table, $id, $data);
		$this->User_history_model->insert($this->session->userdata('user_session')->id,$this->screen_id,3,$current_date,$id);								
		//---------------------------------------------//
		
		redirect(base_url().$this->lang->lang().'/'.ADMIN.'/video/index');
	}
	
	/**
	 * Delete all method.
	 * 
	 * Method used to delete alot of records, by submit the form. 
	 *
	 * @access	public
	 */
	public function delete_all()
	{
		if(!$this->user_screen_privielge_allowed($this->screen_id, $this->privielge_delete)) {
			redirect(base_url().$this->lang->lang()."/".ADMIN."/accessforbidden");
		}
			if(isset($_POST['chk_current_row'])) {
				$del=$_POST['chk_current_row'];
				foreach($del as $del_id) {
					//----------User Histroy Row ------------------//
					$dateTime = new DateTime(); 
					$current_date=$dateTime->format("Y-m-d H:i:s");
					$data = array(
					'deleted' => 1,
					'last_user_id' => $this->session->userdata('user_session')->id,
					'last_modify_date' =>$current_date,
					);
											
					$this->Video_model->update($this->table, $del_id, $data);
					$this->User_history_model->insert($this->session->userdata('user_session')->id,$this->screen_id,3,$current_date,$del_id);								
					//---------------------------------------------//
		
				}
			}			
			redirect(base_url().$this->lang->lang().'/'.ADMIN.'/video/index');
	}
	
	/**
	 * Approve method.
	 * 
	 * Method used to approve or un approve record.
	 *
	 * @access	public
	 * @param int
	 * @param int
	 */
	public function approve($id, $approve=0)
	{
		if($this->session->userdata('user_session')->admin!=1) {
			redirect(base_url().$this->lang->lang()."/".ADMIN."/accessforbidden");
		}
			//----------User Histroy Row ------------------//
			$dateTime = new DateTime(); 
			$current_date=$dateTime->format("Y-m-d H:i:s");
			$data = array(
			'approved' => $approve,
			'last_user_id' => $this->session->userdata('user_session')->id,
			'last_modify_date' =>$current_date,
			);
							
			$this->Video_model->update($this->table, $id, $data);
			$this->User_history_model->insert($this->session->userdata('user_session')->id,$this->screen_id,2,$current_date,$id);						
			//---------------------------------------------//
			
			redirect(base_url().$this->lang->lang().'/'.ADMIN.'/video/index');
	}
	
	
	/**
	 * Method check redundency of alias.
	 * 
	 * Method used to check redundency of alias py passing id as paramter to ignore. 
	 *
	 * @param   int
	 * @access	public
	 */
	public function alias_redundency($id)
	{
		$alias = $_POST['alias'] ;
		$alias_count=$this->Video_model->get_count_by_alias($this->table,$id,$alias);
		
			if($alias_count>0)
			{
				return true;
			}

			return false;
	}
	
	/**
	 * Method check availability of alias.
	 * 
	 * Method used to check availability of alias called from ajax. 
	 *
	 * @param   int
	 * @access	public
	 */
	public function check_alias_availability($id)
	{
		if(isset($_POST['alias']))
		{
			$alias=$_POST['alias'];
			$alias_count=$this->Video_model->get_count_by_alias($this->table,$id,$alias);
			if($alias_count>0)
			{
					echo str_replace("###",$alias, lang('alias_not_available_error'));
			}
			else
			{
				echo 'OK';
			}
		}
		exit;
	}
		
	/**
	 * Method form used to save data.
	 * 
	 * Method used to save data redirect by form submit. 
	 *
	 * @param   int
	 * @param   string
	 * @access	public
	 */
	public function form($id, $mode)
	{ 		
		if(!$this->user_screen_privielge_allowed($this->screen_id, $this->privielge_view)) {
			redirect(base_url().$this->lang->lang()."/".ADMIN."/accessforbidden");
		} else if($mode=='add') {
			if(!$this->user_screen_privielge_allowed($this->screen_id, $this->privielge_add)) {
			redirect(base_url().$this->lang->lang()."/".ADMIN."/accessforbidden");
			}
		}
		else if($mode=='edit') {
			if(!$this->user_screen_privielge_allowed($this->screen_id, $this->privielge_edit)) {
			redirect(base_url().$this->lang->lang()."/".ADMIN."/accessforbidden");
			}
		}
		
        if($id!=0){	
			$data['current_row'] = $this->Video_model->get_by_id($this->table, $id);
			//------------------------ Video Categories ----------------------------------------
			$video_categories_rows = $this->Video_model->get_video_categories_by_id($id);
			$data['video_category_ids']='';
			$data['video_category_names']='';			
			$counter=0;
			foreach($video_categories_rows as $video_categories_rows)
			{			
				$video_category_id=$video_categories_rows->page_category_id;
				if($this->lang->lang()=='ar') {
					$video_category_name=$video_categories_rows->name_ar;
				} else {
					$video_category_name=$video_categories_rows->name;
				}
				if($counter==0)
				{
					$data['video_category_ids']=$data['video_category_ids'].$video_category_id;
					$data['video_category_names']=$data['video_category_names'].$video_category_name;
				}
				else
				{
					$data['video_category_ids']=$data['video_category_ids'].','.$video_category_id;
					$data['video_category_names']=$data['video_category_names'].','.$video_category_name;
				}
				$counter=$counter+1;
			}
			
			
        } 
        $data['mode']= $mode;

        //-----------------------------------------------------------------
        $message_session=$this->session->userdata('message_session');
		if($message_session) {
        	$data['message']= $message_session;
        	$this->session->unset_userdata('message_session');
		}
        //-----------------------------------------------------------------
        
		if(isset($_POST['smt_save'])) {
			if($id!=0) {
				if(!$this->user_screen_privielge_allowed($this->screen_id, $this->privielge_edit)) {
				redirect(base_url().$this->lang->lang()."/".ADMIN."/accessforbidden");
				}
				$data['current_row'] = $this->Video_model->get_by_id($this->table, $id);
				$last_modify_date=$data['current_row']->last_modify_date;
			} else {
				if(!$this->user_screen_privielge_allowed($this->screen_id, $this->privielge_add)) {
				redirect(base_url().$this->lang->lang()."/".ADMIN."/accessforbidden");
				}
				$last_modify_date='';
			}
			if($this->alias_redundency($id)) {
					$data['current_row'] = array(
								'id' => $id ,
				               	'alias' => $_POST['alias'] ,
								'video_category_ids' => $_POST['page_category_ids'] ,
								'video_category_names' => $_POST['page_category_names'] ,
								
				               	'title' => $_POST['title'] ,
				               	'title_ar' => $_POST['title_ar'],
								'seo_words' => $_POST['seo_words'] ,
				               	'seo_words_ar' => $_POST['seo_words_ar'] ,
				               	'brief' => $_POST['brief'],
								'brief_ar' => $_POST['brief_ar'] ,
				               	'body' => $_POST['body'],
								'body_ar' => $_POST['body_ar'] ,
								'video_link' => $_POST['video_link'] ,
								
								//'writer_id' => $_POST['writer_id'] ,
				            );
				            
				         	$duplicated_id=$this->Video_model->get_id_by_alias($this->table,$_POST['alias']);
				            $data['error']= lang('alias_redundency_error')."<a  href='".base_url().$this->lang->lang()."/".ADMIN."/video/form/$duplicated_id/view' >".$this->lang->line('click_here_link')."</a>";
				            
				            
				            $data['mode']= 'return';
				} else {
				$dateTime = new DateTime(); 
				$current_date=$dateTime->format("Y-m-d H:i:s");

				if($_FILES['banner_file']['name']!='') {
					
				$userfile_name = $_FILES['banner_file']['name']; // file name  
				$userfile_tmp  = $_FILES['banner_file']['tmp_name']; // actual location  
				$userfile_size  = $_FILES['banner_file']['size']; // file size  
				$userfile_type  = $_FILES['banner_file']['type']; // mime type of file sent by browser. PHP doesn't check it.  
				$userfile_error  = $_FILES['banner_file']['error'];
					
				$extension = end(explode('.', $_FILES['banner_file']['name']));
		
				$name_file_timestamp=strtotime($current_date);
					
				$uplad_path_file=getcwd().'/added/uploads/banner/video/' . $name_file_timestamp.'.'.$extension;
				
				//if ($userfile_type!='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
				{
					if(move_uploaded_file($_FILES["banner_file"]["tmp_name"], $uplad_path_file))
					{
						
						if($id==0) {
							$banner_files = '/added/uploads/banner/video/'.$name_file_timestamp.'.'.$extension;
							$banner_image_thumbs= '/added/uploads/banner/video/'.$name_file_timestamp.'_thumb'.'.'.$extension;
							$banner_file_selected = '/added/uploads/banner/video/'.$name_file_timestamp.'.'.$extension;
							$banner_image_thumb_selected= '/added/uploads/banner/video/'.$name_file_timestamp.'_thumb'.'.'.$extension;
							
						} else {
								
							if($_POST['hdn_banner_image_thumbs']=='') {
							$banner_image_thumbs = '/added/uploads/banner/video/'.$name_file_timestamp.'_thumb'.'.'.$extension;
							} else {
								$banner_image_thumbs = $_POST['hdn_banner_image_thumbs'].',,,'.'/added/uploads/banner/video/'.$name_file_timestamp.'_thumb'.'.'.$extension;
							}
							
							if($_POST['hdn_banner_files']=='') {
								$banner_files = '/added/uploads/banner/video/'.$name_file_timestamp.'.'.$extension;
							} else {
								$banner_files = $_POST['hdn_banner_files'].',,,'.'/added/uploads/banner/video/'.$name_file_timestamp.'.'.$extension;
							} 
							
							
							
							if(isset($_POST['are_current'])) {
							$banner_file_selected = '/added/uploads/banner/video/'.$name_file_timestamp.'.'.$extension;
							$banner_image_thumb_selected= '/added/uploads/banner/video/'.$name_file_timestamp.'_thumb'.'.'.$extension;
							} else {
								if(isset($_POST['headers'])) {
								$banner_image_thumb_selected= $_POST['headers'];
								$banner_file_selected = str_replace('_thumb.','.',$banner_image_thumb_selected);
								} else {
								$banner_file_selected = '/added/uploads/banner/video/'.$name_file_timestamp.'.'.$extension;
								$banner_image_thumb_selected= '/added/uploads/banner/video/'.$name_file_timestamp.'_thumb'.'.'.$extension;
							
								}
							}
						}
					} else {
						
						
					}
					/*
					list($width, $height, $type, $attr) = getimagesize($uplad_path_file);
					if($width>2000) {
					$new_width=$width/7;
					$new_height=$height/7;
					} elseif ($width>1500) {
						$new_width=$width/6;
						$new_height=$height/6;
					} elseif ($width>1000) {
						$new_width=$width/4;
						$new_height=$height/4;
					} elseif ($width>750) {
						$new_width=$width/3;
						$new_height=$height/3;
					}elseif ($width>350) {
						$new_width=$width/2;
						$new_height=$height/2;
					} else {
						$new_width=$width;
						$new_height=$height;
					}
					*/
				    
				            
				    $config['image_library'] = 'gd2';
					$config['source_image'] = $uplad_path_file;
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 100;
					$config['height'] = 50;
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();       
				            							            
							            
							            
					}
					
				} else {
				 	if($id==0) {
							$banner_image_thumbs = '';
							$banner_files = '';
							$banner_file_selected = '';
							$banner_image_thumb_selected= '';
						} else {
							$banner_image_thumbs = $_POST['hdn_banner_image_thumbs'];
							$banner_files = $_POST['hdn_banner_files'];
							if(isset($_POST['headers'])) {
							$banner_image_thumb_selected= $_POST['headers'];
							$banner_file_selected = str_replace('_thumb.','.',$banner_image_thumb_selected);
							} else {
							$banner_file_selected = '';
							$banner_image_thumb_selected= '';
							}
						}
				}
				
				/**
				 * Delete Banners selected.
				 */
				if(isset($_POST['chk_headers_delete'])) {
					$del_headers=$_POST['chk_headers_delete'];
					foreach($del_headers as $del_header) {
						
						$del_header_thumb_full_path=getcwd().$del_header;
						$del_header_full_path=str_replace('_thumb.','.',$del_header_thumb_full_path);
						
						$del_header_thumb=$del_header;
						$del_header=str_replace('_thumb.','.',$del_header_thumb);
						
						
						/**
						 * Un Set current banner value if deleted. 
						 */
						if($del_header_thumb==$banner_image_thumb_selected) {
							$banner_file_selected = '';
							$banner_image_thumb_selected= '';
						}
						
						
						if(file_exists($del_header_thumb_full_path)) {
							unlink($del_header_thumb_full_path);
						}
						if(file_exists($del_header_full_path)) {
							unlink($del_header_full_path);
						}
						
						if (strpos($banner_image_thumbs, ',,,'.$del_header_thumb) !== false) {
							$banner_image_thumbs=str_replace(',,,'.$del_header_thumb,'',$banner_image_thumbs);
						} else {
							$banner_image_thumbs=str_replace($del_header_thumb,'',$banner_image_thumbs);
						}
						
						if (strpos($banner_files, ',,,'.$del_header) !== false) {
							$banner_files=str_replace(',,,'.$del_header,'',$banner_files);
						} else {
							$banner_files=str_replace($del_header,'',$banner_files);
						}
						
						
						
					}
				}
				
				
				$data['current_row'] = array(
               	'alias' => $_POST['alias'] ,
               	'title' => $_POST['title'] ,
               	'title_ar' => $_POST['title_ar'],
				'seo_words' => $_POST['seo_words'] ,
               	
				'banner_image_thumbs' => $banner_image_thumbs ,
               	'banner_files' => $banner_files,
				'banner_image_thumb_selected' => $banner_image_thumb_selected ,
				'banner_file_selected' => $banner_file_selected ,
               
				'seo_words_ar' => $_POST['seo_words_ar'] ,
               	'brief' => $_POST['brief'],
				'brief_ar' => $_POST['brief_ar'] ,
               	'body' => $_POST['body'],
				'body_ar' => $_POST['body_ar'] ,
				'video_link' => $_POST['video_link'] ,
				'approved' => $this->session->userdata('user_session')->admin,
				'deleted' => 0,
				'last_user_id' => $this->session->userdata('user_session')->id,
				'last_modify_date' =>$current_date,
				);
					        
				if($id==0){
					$this->Video_model->insert($this->table, $data['current_row']);
					$id=$this->Video_model->get_max_id($this->table);
					//----------User Histroy Row ------------------//
					$this->User_history_model->insert($this->session->userdata('user_session')->id,$this->screen_id,1,$current_date,$id);		
					//---------------------------------------------//
					$this->session->set_userdata('message_session',lang('saved_successfully'));
				} else {
					$this->Video_model->update($this->table, $id, $data['current_row']);
					//----------User Histroy Row ------------------//
					$this->User_history_model->insert($this->session->userdata('user_session')->id,$this->screen_id,2,$current_date,$id);
					//---------------------------------------------//
					$this->session->set_userdata('message_session',lang('saved_successfully'));
				}
				
				
				//Insert video categoriess.
				$video_category_ids = $_POST['page_category_ids'];
				$video_category_ids = $video_category_ids;
				$video_category_ids = explode(",", $video_category_ids);
				$video_category_data = array();
				foreach($video_category_ids as $video_category_id) {
					if($video_category_id!=0) {
					$video_category_data[]=array('video_id' => $id,'page_category_id' => $video_category_id);
					}
				}
				$this->Videocats_model->insert($id,$video_category_data);

				redirect(base_url().$this->lang->lang()."/".ADMIN."/video/form/$id/view");
			}
		}
        
		$this->load->view('admin/video/form',$data);
	}
	
	
	
	/**
	 * Methos popuppagecategory to display popup for pagecategory.
	 * @access public
	 * @return boolean
	*/
	public function popuppagecategory($id)
	{
		$data['rows'] = $this->Pagecat_model->get_all();
		
		$video_categories_rows = $this->Video_model->get_video_categories_by_id($id);
		$data['page_categories_rows'] = $video_categories_rows;
		
		$this->load->view('admin/pagecat/popup', $data);
	}
	
}