<?php
/**
 * pagetypes Model.
 *
 * It is page model file include the page_types database process class pagetypes_model.
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
 * pagetypes Model Class.
 *
 * This class manages the processes on the database table page_types
 *
 * @package		models
 * @category	Database
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class pagetypes_model extends My_Model
{
   	/**
	 * store this page_types table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='page_types';
	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	function Main_model()
	{
		parent::__construct();
	}

	
	function insert($page_id, $data)
	{
	  $this->delete($page_id);
	    	
	    foreach($data as $row)
	    {
	       	$this->db->insert('page_types', $row);
	    }
	}
	
	
	function insertToImport($page_id, $data)
	{
	 	if($table=='') {
			$table=$this->table;
		}
	  	return $this->db->insert($table, $data);
	}
	
	function delete($page_id)
	{
	    $this->db->where("page_id", $page_id);
    	return $this->db->delete("page_types");
	}
	
}
?>