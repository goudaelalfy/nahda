<?php
/**
 * Writer Model.
 *
 * It is writer model file include the writer database process class writer_model.
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
 * Writer Model Class.
 *
 * This class manages the processes on the database table writer
 *
 * @package		models
 * @category	Database
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Writer_model extends My_Model
{
	/**
	 * store this writer table name.
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
	function Main_model()
	{
		parent::__construct();
	}
	
	function get_all($limit='')
	{
		
	    $this->db->select('*');
	    $this->db->from($this->table);
	    $this->db->where("approved", 1);
     	$this->db->where('deleted !=', 1);
     	
		if($limit!='') {
     		$this->db->limit($limit);
     	}
     	
     	$this->db->order_by("id", "desc");
	    $query = $this->db->get();
        return $query->result();
	}


	function get_all_less_than( $id, $limit='')
	{
	    $this->db->select('*');
	    $this->db->from($this->table);
	    	    
	    $this->db->where("writer.id < ", $id);
	    
	    $this->db->where("approved", 1);
     	$this->db->where('deleted !=', 1);
     	
		if($limit!='') {
     		$this->db->limit($limit);
     	}
     	
     	$this->db->order_by("id", "desc");
     	
	    $query = $this->db->get();
        return $query->result();
	}
	
	/*
	function updateByPictureId($table='', $picture_id ,$data)
	{	
		if($table=='') {
			$table=$this->table;
		}
		
	   	$this->db->where('picture_id_old', $picture_id);
        return $this->db->update($table, $data); 
	}
	
	function get_all($table='')
	{
		if($table=='') {
			$table=$this->table;
		}
	    $this->db->select('picture_id_old');
	    $this->db->order_by("id", "desc");
	    $query = $this->db->get($table);
        return $query->result();
	}
	*/
}
?>