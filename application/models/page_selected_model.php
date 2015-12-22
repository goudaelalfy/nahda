<?php
/**
 * Page_selected Model.
 *
 * It is page_selected model file include the page_selected database process class page_selected_model.
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
 * Page_selected Model Class.
 *
 * This class manages the processes on the database table page_selected
 *
 * @package		models
 * @category	Database
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Page_selected_model extends My_Model
{
	/**
	 * store this page_selected table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='page_selected';
   	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	function Main_model()
	{
		parent::__construct();
	}
	
	function get_all($limit=10)
	{
	    $this->db->select('page.*, writer.alias as writer_alias, writer.name as writer_name, writer.name_ar as writer_name_ar');
	    $this->db->from('page');
	    $this->db->join('page_selected', 'page_selected.page_id = page.id');
	    $this->db->join('writer', 'writer.id = page.writer_id');
	    
	    $this->db->where("page.approved", 1);
     	$this->db->where('page.deleted !=', 1);
     	$this->db->limit($limit);
	    	
     	$this->db->order_by("page_selected.sort");
     	
	    $query = $this->db->get();
        return $query->result();
	}
	
	function get_all_display_paging($table='', $start, $count_of_rows_per_page, $fields, $sort_field=null, $sort_type=null)
	{
		if($table=='') {
			$table=$this->table;
		}
		$this->db->join('page', 'page_selected.page_id = page.id');
		
	    $this->db->select($fields);
    	$this->db->where('page_selected.deleted !=', 1);
     	$this->db->limit($count_of_rows_per_page, $start);
    	if($sort_field==null) {
	    	$this->db->order_by("page_selected.id", "desc");
	    } else {
	     	if($sort_type==null) {
	     		$this->db->order_by($sort_field, "asc");
	     	} else {
	     		$this->db->order_by($sort_field, $sort_type);
	     	}
	    }
	    $query = $this->db->get($table);
        return $query->result();
	}
}
?>