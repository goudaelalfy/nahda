<?php
/**
 * Seminarcats Model.
 *
 * It is seminar model file include the seminar_categories database process class Seminarcats_model.
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
 * Seminarcats Model Class.
 *
 * This class manages the processes on the database table seminar_categories
 *
 * @package		models
 * @category	Database
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Seminarcats_model extends My_Model
{
   	/**
	 * store this seminar_categories table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='seminar_categories';
	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	function Main_model()
	{
		parent::__construct();
	}
		
	function insert($seminar_id, $data)
	{
	  $this->delete($seminar_id);
	    	
	    foreach($data as $row)
	    {
	       	$this->db->insert('seminar_categories', $row);
	    }
	}
	
	function delete($seminar_id)
	{
	    $this->db->where("seminar_id", $seminar_id);
    	return $this->db->delete("seminar_categories");
	}
	
}
?>