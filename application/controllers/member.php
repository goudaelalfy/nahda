<?php
/**
 * Member controller file.
 *
 * Contains controller class of the member entity.
 *
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 * @copyright	Copyright (c) 2013, Info-cast.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://www.infocast-me.com
 * @since		Version 2.0
 * @filesource
 */

// ------------------------------------------------------------------------

require(APPPATH.'controllers/'.ADMIN.'/email_setting.php');


/**
 * Controller class for the member page.
 *
 * @package		admin
 * @category	controller
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Member extends Ci_Controller
{ 	
	/**
	 * store this controller member table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='member';
	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Member_model', 'Member_model' , True);
		$this->load->model('Menu_link_model', 'Menu_link_model' , True);
		
		$this->load->model('Email_template_model', 'Email_template_model' , True);
		
		/*
		$this->load->controller('Website');
		$website_object= new Website();
		$website_object->load();
		*/
		$this->load->helper('language');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->helper('cookie');
				
		$this->lang->load('main');
		
	}
	
	function login()
	{
		$data=array();
		$member_session=$this->session->userdata('member_session');
		if($member_session)
		{
			redirect(base_url().$this->lang->lang().'/member/profile');
		}
		/*
		if(isset($_POST['smt_login']))
		{
			$username=$_POST['username'];
			$password=$_POST['password'];
			
			if($this->checkAuth($username,$password))
			{
				redirect(base_url().$this->lang->lang().'/member/index');				
			}
			else
			{
				$data['login_error']=lang('login_invalid');
			}
		}
		*/
		
		$this->load->view('website/member/login', $data);		
	}
	
	function authourize()
	{
		$data=array();
		$member_session=$this->session->userdata('member_session');
		if($member_session)
		{
			redirect(base_url().$this->lang->lang().'/member/index');
		}
		//if(isset($_POST['smt_login']))
		//{
			$username=$_POST['username'];
			$password=$_POST['password'];
			
			if($this->checkAuth($username,$password))
			{
				redirect(base_url().$this->lang->lang().'/member/profile');				
			}
			else
			{
				$data['login_error']=lang('login_invalid');
			}
		//}
		
		$this->load->view('website/member/login', $data);		
	}
	
	function checkAuth($username='',$password='')
	{
		$row_data=$this->Member_model->get_by_username_and_password($username,$password);
		$count=count($row_data);
		if($count>0)
		{
			$this->session->set_userdata('member_session',$row_data);
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function logout()
	{
		$this->session->unset_userdata('member_session');
		redirect(base_url().$this->lang->lang()."/member/login");
	}
	
	function forgetPassword()
	{
		$this->load->view('website/member/forget_password');		
	}
	
	function sendPassword()
	{
		$email=$_POST['email'];
		
		$row_data=$this->Member_model->get_by_email($email);
		$count=count($row_data);
		if($count>0) { 
			$this->session->set_userdata('message_session',lang('password_sent_successfully'));
				
			$name=$row_data->firstname;
			$username=$row_data->username;
			$password=$row_data->password;
				/*
				 * Send email to member
				 */
				//--------------------------------------------------------------------------------------
				$email_template_row=$this->Email_template_model->get_by_purpose('member_forget_password');
				$count_email_template_row=count($email_template_row);
				if($count_email_template_row>0) {
					
					$email_active=$email_template_row->active;
					$email_subject=$email_template_row->subject;
					//$email_body=$email_template_row->body;
					
					$email_body=$this->getEmailBody('forgetpassword');
					
					$email_body= str_replace('#@#@#@',$name, $email_body);
					$email_body= str_replace('#&#&#&',$username, $email_body);
					$email_body= str_replace('#*#*#*',$password, $email_body);
				
					$email_body= str_replace('#!#!#!', "<a href='".base_url().$this->lang->lang().'/member/login'."'>".lang('login')."</a>" , $email_body);
					//$email_body= str_replace('#%#%#%', "<a href='".base_url().$this->lang->lang()."/member/activate/$active_code'>".lang('activate')."</a>" , $email_body);
					$email_body= str_replace('#^#^#^','http://www.gizasystems.com', $email_body);
				
					
					if($email_active==1) {
						$email=$_POST['email'];
						$emailSetting= new EmailSetting();
						$sending_email=$emailSetting->send_email($email, $email_subject, $email_body);
					}
				}
				
				//---------------------------------------------------------------------------------------
				
		
		} else {
			$this->session->set_userdata('message_session',lang('this_not_exist_in_db'));
		}
		redirect(base_url().$this->lang->lang().'/member/result');
		
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
		$data=array();
		
		$alias=urldecode($alias);
		$data['current_alias']=$alias;

		$data['title']=lang('members');

		$data['rows']=$this->Member_model->get_all_approved();
		$this->load->view("website/member/index", $data);
	}
	
	/**
	 * profile Method.
	 *
	 * profile method used in registeration and updating profile.
	 * 
	 *  @access	public
	 */	
	public function profile()
	{ 
		$data=array();

		$data['title']=lang('sign_up');
		$id=0;
		if($this->session->userdata('member_session')) {
			$id= $this->session->userdata('member_session')->id;
		}
		
        if($id!=0){	
			$data['current_row'] = $this->session->userdata('member_session');
		
        } 
        
        
        //$data['mode']= $mode;

        //-----------------------------------------------------------------
        $message_session=$this->session->userdata('message_session');
		if($message_session) {
        	$data['message']= $message_session;
        	$this->session->unset_userdata('message_session');
		}
        //-----------------------------------------------------------------
        
		
        
		$this->load->view('website/member/profile',$data);
	}
	
	public function save()
	{ 	
		$id=0;
		if($this->session->userdata('member_session')) {
			$id= $this->session->userdata('member_session')->id;
		}
		
		$dateTime = new DateTime(); 
		$current_date=$dateTime->format("Y-m-d H:i:s");

		/*
		if($_FILES['logo']['name']!="") {
					$userfile_name = $_FILES['logo']['name']; // file name  
					$userfile_tmp  = $_FILES['logo']['tmp_name']; // actual location  
					$userfile_size  = $_FILES['logo']['size']; // file size  
					$userfile_type  = $_FILES['logo']['type']; // mime type of file sent by browser. PHP doesn't check it.  
					$userfile_error  = $_FILES['logo']['error'];
									
					$extension = end(explode('.', $_FILES['logo']['name']));
					
					//Add logo file, to solve conflict if i upload banner and logo as image, will take
					//same name.
					 	
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
			
		
		
		if($id==0) {
		$active_code=$this->randString(15);
		//$username = str_replace(' ', '', $_POST['firstname']);
		//$username=$username.$this->randString(3);
		$username=$_POST['email'];
		
		$password=$_POST['password'];
		$active=0;
		} else {
			$current_row=$this->Member_model->get_by_id($this->table, $id);

			$active_code=$current_row->active_code;
			$username=$current_row->username;
			$password=$current_row->password;
			$active=1;
		}
		
	if(isset($_POST['receive_newsletter'])) {
				$receive_newsletter=1;
			} else {
				$receive_newsletter=0;
			}

		$data['current_row'] = array(
				'username'=>$username,  
				'password'=>$password,
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
				'active'=>$active,  
				'active_code'=>$active_code,
				'approved' => 0,
				'deleted' => 0,
				//'last_user_id' => $this->session->userdata('user_session')->id,
				//'last_modify_date' =>$current_date,
				);
					        
				if($id==0){
					$this->Member_model->insert($this->table, $data['current_row']);
					$id=$this->Member_model->get_max_id($this->table);
					
					/*
					 * Send email to member
					 */
					//--------------------------------------------------------------------------------------
					$email_template_row=$this->Email_template_model->get_by_purpose('member_signup');
					$count_email_template_row=count($email_template_row);
					if($count_email_template_row>0) {
						
						$email_active=$email_template_row->active;
						$email_subject=$email_template_row->subject;
						//$email_body=$email_template_row->body;
						
						$email_body=$this->getEmailBody('registeration');
						
						$email_body= str_replace('#@#@#@',$_POST['firstname'], $email_body);
						$email_body= str_replace('#&#&#&',$username, $email_body);
						$email_body= str_replace('#*#*#*',$password, $email_body);
					
						$email_body= str_replace('#!#!#!', "<a href='".base_url().$this->lang->lang().'/member/login'."'>".lang('login')."</a>" , $email_body);
						$email_body= str_replace('#%#%#%', "<a href='".base_url().$this->lang->lang()."/member/activate/$active_code'>".lang('activate')."</a>" , $email_body);
						$email_body= str_replace('#^#^#^','http://www.nahdaislah.com', $email_body);
					
						
						if($email_active==1) {
							$email=$_POST['email'];
							$emailSetting= new EmailSetting();
							$sending_email=$emailSetting->send_email($email, $email_subject, $email_body);
						}
					}
					
					//---------------------------------------------------------------------------------------
					$this->session->set_userdata('message_session',lang('registered_successfully'));
				} else {
					$this->Member_model->update($this->table, $id, $data['current_row']);
					$this->session->set_userdata('message_session',lang('profile_saved_successfully'));
					
					$row_data=$this->Member_model->get_by_id($this->table, $id);
					$count=count($row_data);
					if($count>0)
					{
						$this->session->set_userdata('member_session',$row_data);
					}
				}
				
		redirect(base_url().$this->lang->lang()."/member/result");
	}
	
	/**
	 * activate method.
	 * 
	 * Method used to activate member.
	 *
	 * @access	public
	 * @param int
	 * @param int
	 */
	public function activate($active_code)
	{
		$data = array(
		'active' => 1,
		);
						
		$this->Member_model->activate($active_code, $data);
		$this->session->set_userdata('message_session',lang('activated_successfully').'<br>'."<a href='".base_url().$this->lang->lang()."/member/login'>".lang('login')."</a>");
		
		redirect(base_url().$this->lang->lang().'/member/result');

	}
	function result()
	{
		//-----------------------------------------------------------------
        $data=array();
		$message_session=$this->session->userdata('message_session');
		if($message_session) {
        	$data['message']= $message_session;
        	$this->session->unset_userdata('message_session');
		}
        //-----------------------------------------------------------------
        
		$this->load->view('website/member/result', $data);
	}
	
	function getEmailBody($case)
	{
		$message='';
		if($case=='registeration') {
		$message = "<html>
			<head>
				<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
				<title>Nahda</title>
			</head>
			<body>
				<table width='100%' cellpadding='0' cellspacing='0'>
					<tr>
						<td valign='top' align='center'>
							<table width='800' cellpadding='0' cellspacing='0' style='background:#fbfbfb'>
								<tr>
									<td height='20'></td>
								</tr>
								
								<tr>
									<td height='20'></td>
								</tr>
								<tr>
									<td valign='top' align='left'>
										<table width='750' cellpadding='0' cellspacing='0' style='margin-left:40px;'>
											<tr>
												<td height='20'></td>
											</tr>
											<tr>
												<td align='left' valign='top'>
													<span style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#636363'>Dear</span> 
													<span style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#00a4e4'>	#@#@#@</span>
												</td>
											</tr>
											<tr>
												<td height='20'></td>
											</tr>
											<tr>
												<td align='center' valign='top'>
													<div style='font-family:Arial, Helvetica, sans-serif; font-size:17px; color:#00a4e4'>
													Thank you for registering on the Nahda website. Your account has been created. 
													</div>
												</td>
											</tr>
											<tr>
												<td height='20'></td>
											</tr>
											<tr>
												<td align='left' valign='top'>
													<span style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#636363'>Your Username is: </span> 
													<span style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#00a4e4'>	#&#&#&</span>
												</td>
											</tr>
											<tr>
												<td height='10'></td>
											</tr>
											<tr>
												<td align='left' valign='top'>
													<span style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#636363'>Your Password is: </span> 
													<span style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#00a4e4'>	#*#*#*</span>
												</td>
											</tr>
											<tr>
												<td height='10'></td>
											</tr>
											<tr>
												<td align='left' valign='top'>
													<span style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#636363'>To activate your account please follow the link : </span> 
													<span style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#00a4e4'>	#%#%#% </span>
												</td>
											</tr>
											<tr>
												<td height='20'></td>
											</tr>
											<tr>
												<td align='left' valign='top'>
													<div style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#636363'>To login and/or edit your profile and contact information,<br /> 
		please visit: <span style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#00a4e4'> #!#!#! </span>
		</div> 
												</td>
											</tr>
											<tr>
												<td height='20'></td>
											</tr>
											
											<tr>
												<td height='40'></td>
											</tr>
											<tr>
												<td align='left' valign='top'>
													<div style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#636363'>Thank You,</div>
													<div style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#636363'>Nahda Team</div>
												</td>
											</tr>
											<tr>
												<td height='40'></td>
											</tr>
											
											<tr>
												<td height='40'></td>
											</tr>
											
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</body>
		</html>";
		} else if($case=='forgetpassword') {
			$message = "<html>
				<head>
					<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
					<title>Nahda</title>
				</head>
				<body>
					<table width='100%' cellpadding='0' cellspacing='0'>
						<tr>
							<td valign='top' align='center'>
								<table width='800' cellpadding='0' cellspacing='0' style='background:#fbfbfb'>
									<tr>
										<td height='20'></td>
									</tr>
								
									<tr>
										<td height='20'></td>
									</tr>
									<tr>
										<td valign='top' align='left'>
											<table width='750' cellpadding='0' cellspacing='0' style='margin-left:40px;'>
												<tr>
													<td align='left' valign='top'>
														<span style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#636363'>Dear</span> 
														<span style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#00a4e4'>	#@#@#@</span>
													</td>
												</tr>
												<tr>
													<td height='20'></td>
												</tr>
												<tr>
													<td align='center' valign='top'>
														<div style='font-family:Arial, Helvetica, sans-serif; font-size:17px; color:#00a4e4'>
															Thank you for using Nahda website. 
														</div>
													</td>
												</tr>
												<tr>
													<td height='20'></td>
												</tr>
												<tr>
													<td align='left' valign='top'>
														<span style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#636363'>Your Username is: </span> 
														<span style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#00a4e4'>#&#&#&</span>
													</td>
												</tr>
												<tr>
													<td height='10'></td>
												</tr>
												<tr>
													<td align='left' valign='top'>
														<span style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#636363'>Your Password is: </span> 
														<span style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#00a4e4'>#*#*#* </span>
													</td>
												</tr>
												<tr>
													<td height='20'></td>
												</tr>
												<tr>
												<td align='left' valign='top'>
													<div style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#636363'>To login and/or edit your profile and contact information,<br /> 
		please visit: <span style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#00a4e4'> #!#!#! </span>
		</div> 
												</td>
											</tr>
												<tr>
													<td height='20'></td>
												</tr>
												
												<tr>
													<td height='40'></td>
												</tr>
												<tr>
													<td align='left' valign='top'>
														<div style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#636363'>Thank You,</div>
														<div style='font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#636363'>Nahda Team</div>
													</td>
												</tr>
												<tr>
													<td height='40'></td>
												</tr>
												
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</body>
			</html>";
		}
		return $message;
	}
	
	function randString($length=5) 
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$size = strlen( $chars );
		$str='';
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}
    	$str = substr( str_shuffle( $chars ), 0, $length );
    	return $str;
	}
		
}