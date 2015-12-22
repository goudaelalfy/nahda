<?php
/**
 * Videocats Model.
 *
 * It is video model file include the video_categories database process class Videocats_model.
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
 * Videocats Model Class.
 *
 * This class manages the processes on the database table video_categories
 *
 * @package		models
 * @category	Database
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Videocats_model extends My_Model
{
   	/**
	 * store this video_categories table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='video_categories';
	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	function Main_model()
	{
		parent::__construct();
	}
		
	function insert($video_id, $data)
	{
	  $this->delete($video_id);
	    	
	    foreach($data as $row)
	    {
	       	$this->db->insert('video_categories', $row);
	    }
	}
	
	function delete($video_id)
	{
	    $this->db->where("video_id", $video_id);
    	return $this->db->delete("video_categories");
	}
	
}
?>