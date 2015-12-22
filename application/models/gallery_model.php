<?php
/**
 * Gallery Model.
 *
 * It is Gallery model file include the Gallery database process class Gallery_model.
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
 * Gallery Model Class.
 *
 * This class manages the processes on the database table gallery
 *
 * @package		models
 * @category	Database
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Gallery_model extends My_Model
{
   	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	function Main_model()
	{
		parent::__construct();
	}
		
	/**
	 * Method to get icon by id.
	 * access public
	 * @param string
	 * @param int
	 */
	function get_icon_by_id($table, $id)
    {
    	$this->db->select('`icon`');
    	$this->db->where("id", $id);
     	$query = $this->db->get($table);
        $arr=$query->result();
        	
        if($arr)
        $icon=$arr[0]->icon;
        else
        $icon='';
        
        return $icon;
    }
    
	function get_all_limit($limit='')
	{
	    $this->db->select('*');

	    $this->db->from('gallery');
	    
	    $this->db->where("approved", 1);
     	$this->db->where('deleted !=', 1);
	
     	if($limit!='') {
     		$this->db->limit($limit);
     	}
     	
     	$this->db->order_by("id", "desc");
     	
	    $query = $this->db->get();
        return $query->result();
	}
}
?>