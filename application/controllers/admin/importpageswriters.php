<?php
require_once  getcwd().'/added/php_excel_library/Classes/PHPExcel/IOFactory.php';

/**
 * Importpageswriters controller file.
 *
 * Contains controller class of import pageswriters table.
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
 * Controller class  import pageswriters table.
 *
 * This is the controller class to import pageswriters table. between model and view, in MVC design pattern.
 *
 * @package		admin
 * @category	controller
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Importpageswriters extends MY_Controller
{
	/**
	 * store this controller importpageswriters screen id.
	 *
	 * @var int
	 * @access public
	 */
	public $screen_id=44;

		/**
	 * store this controller pageswriters table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='page';
	
	
	/**
	 * Constructor
	 *
	 * @access public
	 */
	function __construct()
	{
		parent::__construct();

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
				
			$this->load->view('admin/import_excel/pageswriters',$data);
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

				
						$data = array(
						//'pagecat_category_id' => 3,
						//'pagecat_category_id' => 2,
						//'pagecat_category_id' => 1,
						'writer_id' => $row_arr[$_POST['writer_id']],
						);
						 
						$this->Page_model->update($this->table,$row_arr[$_POST['page_id']], $data);
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
			$this->load->view('admin/import_excel/pageswriters',$data);
		}
		else
		{
			$this->load->view('admin/import_excel/pageswriters',$data);
		}
	}

}