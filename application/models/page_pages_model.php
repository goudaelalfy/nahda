<?php
/**
 * Page_pages Model.
 *
 * It is page model file include the page_pages database process class Page_pages_model.
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
 * Page_pages Model Class.
 *
 * This class manages the processes on the database table page_pages
 *
 * @package		models
 * @category	Database
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Page_pages_model extends My_Model
{
   	/**
	 * store this page_pages table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='page_pages';
	
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
	       	$this->db->insert('page_pages', $row);
	    }
	}
	
	
	function delete($page_id)
	{
	    $this->db->where("page_id", $page_id);
    	return $this->db->delete("page_pages");
	}
	
}
?>