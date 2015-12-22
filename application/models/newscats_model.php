<?php
/**
 * Newscats Model.
 *
 * It is news model file include the news_categories database process class Newscats_model.
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
 * Newscats Model Class.
 *
 * This class manages the processes on the database table news_categories
 *
 * @package		models
 * @category	Database
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Newscats_model extends My_Model
{
   	/**
	 * store this news_categories table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='news_categories';
	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	function Main_model()
	{
		parent::__construct();
	}
		
	function insert($news_id, $data)
	{
	  $this->delete($news_id);
	    	
	    foreach($data as $row)
	    {
	       	$this->db->insert('news_categories', $row);
	    }
	}
	
	function delete($news_id)
	{
	    $this->db->where("news_id", $news_id);
    	return $this->db->delete("news_categories");
	}
	
}
?>