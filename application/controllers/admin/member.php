<?php
/**
 * Member controller file.
 *
 * Contains controller class of the member table.
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
 * Controller class of the member table.
 *
 * This is the controller class of the member table. between model and view, in MVC design pattern.
 *
 * @package		admin
 * @category	controller
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Member extends My_Controller
{ 	
	/**
	 * store this controller member screen id.
	 *
	 * @var int
	 * @access public
	 */
	public $screen_id=48;
	
	/**
	 * store this controller member table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='member';
	
	/**
	 * store table fields to display in table.
	 *
	 * @var string
	 * @access public
	 */
	public $table_fields_to_display=" id,  username,  firstname, lastname, approved ";
	
	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Member_model', 'Member_model' , True);
		 
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
		redirect(base_url().$this->lang->lang()."/".ADMIN."/member/table");
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
		
		$rows_count = $this->Member_model->get_count($this->table);
		$data['rows_count']=$rows_count;
		
		$settings = $this->Setting_model->get_all();
		$data['paging_no_of_pages']=$settings[0]->paging_no_of_pages;
		
		$per_page = $data['paging_no_of_pages'];
    	
		$start = ($page-1)*$per_page;

		$data['rows'] = $this->Member_model->get_all_display_paging($this->table, $start, $per_page, $this->table_fields_to_display, $order, $order_type); 
        
		
		$this->load->view("admin/member/table", $data);
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
								
		$this->Member_model->update($this->table, $id, $data);
		$this->User_history_model->insert($this->session->userdata('user_session')->id,$this->screen_id,3,$current_date,$id);								
		//---------------------------------------------//
		
		redirect(base_url().$this->lang->lang().'/'.ADMIN.'/member/index');
	}
	
	/**
	 * Submit display method.
	 * 
	 * Method was called when submit the form. 
	 *
	 * @access	public
	 */
	public function submit_display()
	{
		if(isset($_POST['smt_export'])) {
			if(!$this->user_screen_privielge_allowed($this->screen_id, $this->privielge_view)) {
				redirect(base_url().$this->lang->lang()."/".ADMIN."/accessforbidden");
			}
			
			if(isset($_POST['chk_current_row'])) {
				$export_ids_arr=array();
				
				$export=$_POST['chk_current_row'];
				foreach($export as $export_id) {
					//----------User Histroy Row ------------------//
					//$this->User_history_model->insert($this->session->userdata('user_session')->id,$this->screen_id,4,$current_date,$export_id);								
					//---------------------------------------------//
		
					$export_ids_arr[]=$export_id;
				}
				
				$member_rows=$this->Member_model->get_by_array($export_ids_arr);
				
				$html= "<table class='table table-striped table-bordered bootstrap-datatable datatable' border='1'>";
				$index=0;
				foreach ($member_rows as $record)
				{
						$current_row_id=0;
						
						if($index==0)
						{
							$html.= "<thead><tr>";
							foreach ($record as $key=>$value)
							{
								$html.="<th >".lang($key)." </th>";
								
							}
							$html.= "</tr></thead>";				
						}
						
						
						
						$html.= "<tbody><tr>";
						foreach ($record as $key=>$value)
						{
							$width_row='150px';
							$html.="<td  class='center'> $value </td>";	
							
						}
					$html.= "</tr>";
					$index=$index+1;
				}
				
				$html.="</tbody></table>";
				
				$file_name='members.xls';
				header("Content-type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=$file_name");
				echo $html;
				exit;
		
			}
			
			
			
		} else {
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
											
					$this->Member_model->update($this->table, $del_id, $data);
					$this->User_history_model->insert($this->session->userdata('user_session')->id,$this->screen_id,3,$current_date,$del_id);								
					//---------------------------------------------//
		
				}
			}
		}			
			redirect(base_url().$this->lang->lang().'/'.ADMIN.'/member/index');
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
							
			$this->Member_model->update($this->table, $id, $data);
			$this->User_history_model->insert($this->session->userdata('user_session')->id,$this->screen_id,2,$current_date,$id);						
			//---------------------------------------------//
			
			redirect(base_url().$this->lang->lang().'/'.ADMIN.'/member/index');
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
			$data['current_row'] = $this->Member_model->get_by_id($this->table, $id);
			
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
				$data['current_row'] = $this->Member_model->get_by_id($this->table, $id);
				$last_modify_date=$data['current_row']->last_modify_date;
			} else {
				if(!$this->user_screen_privielge_allowed($this->screen_id, $this->privielge_add)) {
				redirect(base_url().$this->lang->lang()."/".ADMIN."/accessforbidden");
				}
				$last_modify_date='';
			}
			 {
				$dateTime = new DateTime(); 
				$current_date=$dateTime->format("Y-m-d H:i:s");

				if($this->username_redundency($id))
				{
					
					if(isset($_POST['approved'])) {
						$approved=1;
					} else {
						$approved=0;
					}
					
					if(isset($_POST['receive_newsletter'])) {
						$receive_newsletter=1;
					} else {
						$receive_newsletter=0;
					}
					
					$data['current_row'] = array(
					'id' => $id ,
					'username'=>$_POST['username'],  
					'password'=>$_POST['password'],
					'firstname'=>$_POST['firstname'],  
					'lastname'=>$_POST['lastname'],  
					'gender'=>$_POST['gender'],  
					'birthdate'=>$_POST['birthdate'],
					'email'=>$_POST['email'],  
										
					'organization'=>$_POST['organization'],  
					
					'address'=>$_POST['address'],
					'postal_code' => $_POST['postal_code'] ,
					'city' => $_POST['city'] ,
					'country_id' => $_POST['country_id'] ,
					
					'phone' => $_POST['phone'] ,
					'fax'=>$_POST['fax'], 
					  
					'receive_newsletter'=>$receive_newsletter,  
					
				     );
				            
				  $duplicated_id=$this->Member_model->get_id_by_username($_POST['username']);
				  $data['error']= lang('username_redundency_error')."<a  href='".base_url().$this->lang->lang()."/".ADMIN."/member/form/$duplicated_id/view' >".$this->lang->line('click_here_link')."</a>";
				            
				  $data['mode']= 'return';
				}
				else 
				{
				/*
				if($_FILES['logo']['name']!="") {
					$userfile_name = $_FILES['logo']['name']; // file name  
					$userfile_tmp  = $_FILES['logo']['tmp_name']; // actual location  
					$userfile_size  = $_FILES['logo']['size']; // file size  
					$userfile_type  = $_FILES['logo']['type']; // mime type of file sent by browser. PHP doesn't check it.  
					$userfile_error  = $_FILES['logo']['error'];
									
					$extension = end(explode('.', $_FILES['logo']['name']));
					
					 // Add logo file, to solve conflict if i upload banner and logo as image, will take
					 // same name.
					 	
					$name_file_timestamp=strtotime($current_date).'_logo';
						
					$uplad_path_file=getcwd().'/added/uploads/logo/member/' . $name_file_timestamp.'.'.$extension;
				
					//if ($userfile_type!='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
					if(move_uploaded_file($_FILES["logo"]["tmp_name"], $uplad_path_file))
					{
						
						if($id==0) {
							$logo = '/added/uploads/logo/member/'.$name_file_timestamp.'.'.$extension;
									
						} else {
								
						if($_FILES['logo']['name']!='') {
							
							$logo=$this->Member_model->get_logo_by_id($this->table, $id);
							$logo_path=getcwd().$logo;
							if(isset($logo_path) && $logo_path!=getcwd()) {
							unlink($logo_path);
							}
							$logo = '/added/uploads/logo/member/'.$name_file_timestamp.'.'.$extension;
							
						} else {
							$logo = $this->Member_model->get_logo_by_id($this->table, $id);;
						}
							
						}
					}
					
					
				}else {
					if($id==0) {
							$logo = '';
									
						} else { 
							$logo = $this->Member_model->get_logo_by_id($this->table, $id);
						}
					}
				*/
				
				if(isset($_POST['receive_newsletter'])) {
						$receive_newsletter=1;
					} else {
						$receive_newsletter=0;
					}
					
					
				$data['current_row'] = array(
				'username'=>$_POST['username'],  
				'password'=>$_POST['password'],
				'firstname'=>$_POST['firstname'],  
				'lastname'=>$_POST['lastname'],  
				'gender'=>$_POST['gender'],  
				'birthdate'=>$_POST['birthdate'],
				'email'=>$_POST['email'],  
									
				'organization'=>$_POST['organization'],  
				
				'address'=>$_POST['address'],
				'postal_code' => $_POST['postal_code'] ,
				'city' => $_POST['city'] ,
				'country_id' => $_POST['country_id'] ,
				
				'phone' => $_POST['phone'] ,
				'fax'=>$_POST['fax'], 
				  
				'receive_newsletter'=>$receive_newsletter, 
				'registeration_datetime'=>$current_date,  
				'active'=>1,  
				'active_code'=>'admin',
				'approved' => $this->session->userdata('user_session')->admin,
				'deleted' => 0,
				'last_user_id' => $this->session->userdata('user_session')->id,
				'last_modify_date' =>$current_date,
				);
					        
				if($id==0){
					$this->Member_model->insert($this->table, $data['current_row']);
					$id=$this->Member_model->get_max_id($this->table);
					//----------User Histroy Row ------------------//
					$this->User_history_model->insert($this->session->userdata('user_session')->id,$this->screen_id,1,$current_date,$id);		
					//---------------------------------------------//
					$this->session->set_userdata('message_session',lang('saved_successfully'));
				} else {
					$this->Member_model->update($this->table, $id, $data['current_row']);
					//----------User Histroy Row ------------------//
					$this->User_history_model->insert($this->session->userdata('user_session')->id,$this->screen_id,2,$current_date,$id);
					//---------------------------------------------//
					$this->session->set_userdata('message_session',lang('saved_successfully'));
				}
				
				redirect(base_url().$this->lang->lang()."/".ADMIN."/member/form/$id/view");
				}
			}
		}
        
		$this->load->view('admin/member/form',$data);
	}
	
	function username_redundency($id)
	{
		$username = $_POST['username'] ;
		$username_count=$this->Member_model->get_count_by_username($id,$username);
		
			if($username_count>0)
			{
				return true;
			}

			return false;
	}
	
	function check_username_availability($id)
	{
		if(isset($_POST['username']))
		{
			$username=$_POST['username'];
			$username_count=$this->Member_model->get_count_by_username($id,$username);
			if($username_count>0)
			{
					echo str_replace("###",$username, lang('username_not_available_error'));
			}
			else
			{
				echo 'OK';
			}
		}
		exit;
	}
	
}