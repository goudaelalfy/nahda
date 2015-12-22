<?php
/**
 * Questionnaire controller file.
 *
 * Contains controller class of the questionnaire entity.
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
 * Controller class for the questionnaire.
 *
 * @package		admin
 * @category	controller
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Questionnaire extends CI_Controller
{

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Questionnaire_model', 'Questionnaire_model' , True);
		$this->load->model('Visistor_questionnaire_answer_model', 'Visistor_questionnaire_answer_model' , True);

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

	public function getVote($question_id, $question_answer_id)
	{
		$dateTime = new DateTime();
		$current_date=$dateTime->format("Y-m-d H:i:s");

		$ipaddress = getenv('REMOTE_ADDR');

		$data['current_row'] = array(
		        'visitor_id' => $ipaddress,
               	'question_id' => $question_id ,
               	'answer' => $question_answer_id ,
			
				'approved' => 1,
				'deleted' => 0,
				'last_user_id' => 0,
				'last_modify_date' =>$current_date,
		);
			
		$this->Visistor_questionnaire_answer_model->insert('', $data['current_row']);

		$all_count=$this->Visistor_questionnaire_answer_model->get_count_by_question($question_id);

		$answer_count_rows=$this->Visistor_questionnaire_answer_model->get_count_by_question_group_answer($question_id);

		$question_answers=$this->Questionnaire_model->get_answers_by_id($question_id);
		foreach($question_answers as $question_answer) {
			$question_answer_id=$question_answer->id;
			if($this->lang->lang()=='ar') {
				$question_answer_name=$question_answer->name_ar;
			} else {
				$question_answer_name=$question_answer->name;
			}
				
			$image_width=0;
			foreach ($answer_count_rows as $answer_count_row) {
				if($question_answer_id==$answer_count_row->answer) {
					$image_width=$answer_count_row->answer_count/$all_count*100;
				}
			}
			$image_width=floor($image_width);
			echo $question_answer_name."&nbsp; &nbsp; <br/> <img src='".base_url()."images/icons/poll.png'  align='right' width='$image_width%' height='15px' > &nbsp;&nbsp; <br/>   $image_width% <br/><br/> ";
		}
		
		exit;
	}



	}