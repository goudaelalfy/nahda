<?php
/**
 * Pagecats Model.
 *
 * It is page model file include the page_categories database process class Pagecats_model.
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
 * Pagecats Model Class.
 *
 * This class manages the processes on the database table page_categories
 *
 * @package		models
 * @category	Database
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Pagecats_model extends My_Model
{
   	/**
	 * store this page_categories table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='page_categories';
	
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
	       	$this->db->insert('page_categories', $row);
	    }
	}
	
	
	function delete($page_id)
	{
	    $this->db->where("page_id", $page_id);
    	return $this->db->delete("page_categories");
	}
	
}
?>