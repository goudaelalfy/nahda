<?php
require_once  getcwd().'/added/php_excel_library/Classes/PHPExcel/IOFactory.php';

/**
 * Importwriter controller file.
 *
 * Contains controller class of import writer table.
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
 * Controller class  import writer table.
 *
 * This is the controller class to import writer table. between model and view, in MVC design pattern.
 *
 * @package		admin
 * @category	controller
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Importwriter extends MY_Controller
{
	/**
	 * store this controller importwriter screen id.
	 *
	 * @var int
	 * @access public
	 */
	public $screen_id=41;

		/**
	 * store this controller writer table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='writer';
	
	
	/**
	 * Constructor
	 *
	 * @access public
	 */
	function __construct()
	{
		parent::__construct();

		$this->load->model('Writer_model', 'Writer_model' , True);
		$this->load->model('Page_model', 'Page_model' , True);
		
		error_reporting(E_ALL);
		set_time_limit(0);
		date_default_timezone_set('Africa/Cairo');
	}

	/**
	 * Index Method.
	 *
	 * Default method for each controller, called when no method name path through URL.
	 *
	 * @access	public
	 */
	function index($mode='')
	{
		if(!$this->user_screen_privielge_allowed($this->screen_id, $this->privielge_view)) {
			redirect(base_url().$this->lang->lang()."/".ADMIN."/accessforbidden");
		}
		if(!$this->user_screen_privielge_allowed($this->screen_id, $this->privielge_add)) {
			redirect(base_url().$this->lang->lang()."/".ADMIN."/accessforbidden");
		}
		if(!$this->user_screen_privielge_allowed($this->screen_id, $this->privielge_edit)) {
			redirect(base_url().$this->lang->lang()."/".ADMIN."/accessforbidden");
		}


		$data['mode']= $mode;

		if(isset($_POST['smt_read']))
		{
				
			if($_FILES['ecxel_file']['name']=="")
			{
				$data['error']= lang('please_select_excel_file');
			}
			else
			{

				$userfile_name = $_FILES['ecxel_file']['name']; // file name
				$userfile_tmp  = $_FILES['ecxel_file']['tmp_name']; // actual location
				$userfile_size  = $_FILES['ecxel_file']['size']; // file size
				$userfile_type  = $_FILES['ecxel_file']['type']; // mime type of file sent by browser. PHP doesn't check it.
				$userfile_error  = $_FILES['ecxel_file']['error'];

				$extension = end(explode('.', $_FILES['ecxel_file']['name']));
/*
				if ($userfile_type!='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
				{
					$data['error']= lang('must_select_excel_file');
				}
				else
	*/			{
					$dateTime = new DateTime();
					$current_date=$dateTime->format("Y-m-d H:i:s");

					$name_file_timestamp=strtotime($current_date);
					$uplad_path_file=getcwd().'/added/uploads/excel/' . $name_file_timestamp.'.'.$extension;
					if(move_uploaded_file($_FILES["ecxel_file"]["tmp_name"], $uplad_path_file))
					{
						$this->session->set_userdata('excel_file_session',$uplad_path_file);

						$inputFileName=$uplad_path_file;
						//echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
						$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);


						$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
						//var_dump($sheetData);




						$data['sheetData']=$sheetData;
						$data['mode']= 'read';
					}
					else
					{
						$data['error']= lang('file_saving_error');
					}

				}
			}
				
			$this->load->view('admin/import_excel/writer',$data);
		}
		else if(isset($_POST['smt_import']))
		{
				
			if($this->session->userdata('excel_file_session'))
			{
				$inputFileName= $this->session->userdata('excel_file_session');
					
				//echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);


				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
				//var_dump($sheetData);

				$row_counter=0;
				foreach($sheetData as $row_arr)
				{
					if($row_counter>0)
					{
						$dateTime = new DateTime(); 
						$current_date=$dateTime->format("Y-m-d H:i:s");

						/*
						$data = array(
						//'writer_category_id' => 3,
						//'writer_category_id' => 2,
						//'writer_category_id' => 1,
						'id' => $row_arr[$_POST['id']],
						'alias' => $row_arr[$_POST['alias']],
					    'name' => $row_arr[$_POST['name']],
					    'name_ar' => $row_arr[$_POST['name_ar']],
						'seo_words' => $row_arr[$_POST['seo_words']],
					    'seo_words_ar' => $row_arr[$_POST['seo_words_ar']],
					    'brief' => $row_arr[$_POST['brief']],
						'brief_ar' => $row_arr[$_POST['brief_ar']],
					    'body' => $row_arr[$_POST['body']],
						'body_ar' => $row_arr[$_POST['body_ar']],
						//'approved' => $this->session->userdata('user_session')->admin,
						'approved' => $row_arr[$_POST['approved']],
						'deleted' => $row_arr[$_POST['deleted']],
						//'last_user_id' => $row_arr[$_POST['last_user_id']],
						'last_user_id' => $this->session->userdata('user_session')->id,
						'last_modify_date' =>$row_arr[$_POST['last_modify_date']],
						);
						 */
						/*
						$data = array(
						'picture_id_old' => $row_arr[$_POST['alias']],
					   	);
						*/
						
						//$this->Writer_model->insert($this->table, $data);
						//$this->Writer_model->update($this->table,$row_arr[$_POST['id']], $data);
						
						
						$data = array(
						'id' => $row_arr[$_POST['id']],
						'email' => $row_arr[$_POST['alias']],
						'username' => $row_arr[$_POST['name']],
					    'password' => $row_arr[$_POST['name_ar']],
						'salt' => $row_arr[$_POST['seo_words']],
						'firstname' => $row_arr[$_POST['name']],
						'registeration_datetime' =>$row_arr[$_POST['last_modify_date']],
						'approved' => 1,
						'deleted' => 0,
						//'last_user_id' => $row_arr[$_POST['last_user_id']],
						'last_user_id' => $this->session->userdata('user_session')->id,
						'last_modify_date' =>$row_arr[$_POST['last_modify_date']],
					   	);
						//$this->Writer_model->insert('member', $data);
						$this->Page_model->insertIgnore('member', $data);
						
					}
					$row_counter=$row_counter+1;
				}

				$data['mode']= 'import';
				$data['message']= lang('import_successfully');

				unlink($inputFileName);
			}
			else
			{
				$data['error']= lang('file_saving_error');
			}
			$this->load->view('admin/import_excel/writer',$data);
		}
		else
		{
			$this->load->view('admin/import_excel/writer',$data);
		}
	}

}