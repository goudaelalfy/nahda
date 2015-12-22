<?php
/**
 * Visistor_questionnaire_answer Model.
 *
 * It is page model file include the visistor_questionnaire_answer database process class Visistor_questionnaire_answer_model.
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
 * Visistor_questionnaire_answer Model Class.
 *
 * This class manages the processes on the database table visistor_questionnaire_answer
 *
 * @package		models
 * @category	Database
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Visistor_questionnaire_answer_model extends My_Model
{
   	/**
	 * store this visistor_questionnaire_answer table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='visistor_questionnaire_answer';
	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	function Main_model()
	{
		parent::__construct();
	}

	function delete_by_visitor($visitor_id)
	{
	    $this->db->where("visitor_id", $visitor_id);
    	return $this->db->delete($this->table);
	}
	
	function get_by_visitor($visitor_id)
	{
	    $this->db->select('*');
	    $this->db->from($this->table);
	    $this->db->where("visitor_id", $visitor_id);
	    $query = $this->db->get();
        return $query->result();
	}
	
	function get_by_visitor_and_question($visitor_id, $question_id)
	{
	    $this->db->select('*');
	    $this->db->from($this->table);
	    $this->db->where("visitor_id", $visitor_id);
	    $this->db->where("question_id", $question_id);
	    
	    $query = $this->db->get();
        return $query->result();
	}
	
	function get_count_by_question($question_id)
    {
	    $this->db->where("question_id", $question_id);
	    $this->db->where('deleted !=', 1);
    	
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	
	function get_count_by_question_group_answer($question_id)
	{
	    $this->db->select('count(*) as answer_count, answer, question_id, deleted');
	    $this->db->from($this->table);
	    $this->db->group_by('answer');
	    $this->db->having("question_id", $question_id);
	     $this->db->having('deleted !=', 1);
	     
	    $query = $this->db->get();
        return $query->result();
	}
}
?>