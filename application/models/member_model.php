<?php
/**
 * Member Model.
 *
 * It is member model file include the member database process class member_model.
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
 * Member Model Class.
 *
 * This class manages the processes on the database table member
 *
 * @package		models
 * @category	Database
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Member_model extends My_Model
{
	/**
	 * store this member table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='member';
   	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	function Main_model()
	{
		parent::__construct();
	}
	
	function get_id_by_username($username)
    {
    	$this->db->select('`id`');
    	$this->db->where("username", $username);
     	$query = $this->db->get('member');
        $arr=$query->result();
        
        if($arr)
        $id=$arr[0]->id;
        else
        $id=0;
        
        return $id;
    }
   
	function get_count_by_username($id,$username)
    {
		$this->db->where("username", $username);
    	if($id!=0)
		{
			$this->db->where("id !=", $id);
		}
		$this->db->from('member');
		return $this->db->count_all_results();
    }
    
	function get_by_username_and_password($username,$password)
    {
		$this->db->select('*');
    	$this->db->where("username", $username);
		$this->db->where("password", $password);
		$this->db->where("active", 1);
    	$query = $this->db->get('member');
        return ($query->num_rows > 0) ? $query->row() : array();
    }
    
	function get_by_email($email)
    {
		$this->db->select('*');
    	$this->db->where("email", $email);
		$this->db->where("active", 1);
    	$query = $this->db->get('member');
        return ($query->num_rows > 0) ? $query->row() : array();
    }
	
	function get_by_name_like($alpha)
	{
	    $this->db->select('member.*');
	    $this->db->from('member');
	    $this->db->where("member.name like '$alpha%'");
	    $this->db->where("member.approved", 1);
	    $this->db->where('member.deleted !=', 1);
	    $query = $this->db->get();
	    return $query->result();
	}
	
	function get_by_array($member_ids_arr)
    {
    	$this->db->select('*');
     	$this->db->from($this->table);
    	$this->db->where_in('id', $member_ids_arr);
    	
    	$query = $this->db->get(); 

        return $query->result();	    	
    }
    
	function activate($active_code ,$data)
	{
	   	$this->db->where('active_code', $active_code);
        return $this->db->update($this->table, $data); 
	}
	
	/**
	 * Method to get logo path from table by id
	 * 
	 * @access public
	 * @param string table name
	 * @param int it
	 * @return string 
	 */
	function get_logo_by_id($table, $id)
    {
    	$this->db->select('`logo`');
    	$this->db->where("id", $id);
     	$query = $this->db->get($table);
        $arr=$query->result();
        	
        if($arr)
        $logo=$arr[0]->logo;
        else
        $logo='';
        
        return $logo;
    }

}
?>