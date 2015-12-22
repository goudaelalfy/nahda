<?php
/**
 * News Model.
 *
 * It is news model file include the news database process class news_model.
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
 * News Model Class.
 *
 * This class manages the processes on the database table news
 *
 * @package		models
 * @category	Database
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class News_model extends My_Model
{
	/**
	 * store this news table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='news';
   	
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
	 * Inserting Record Method and ignore error.
	 *
	 * Method to insert record in database by passing table name and associative arry 
	 * contains the database field name and its value and ignore errors 
	 *
	 * @access	public
	 * @param   string
	 * @param   array
	 * @return	boolean
	 */	
	function insertIgnore($table='', $data)
	{
		if($table=='') {
			$table=$this->table;
		}
	  	$insert_query = $this->db->insert_string($table, $data);
		$insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
		return $this->db->query($insert_query);
	}
	
	function get_news_categories_by_id($id)
	{
	    $this->db->select('news_categories.*, page_category.name, page_category.name_ar');
	    $this->db->from('news_categories');
	    $this->db->join('page_category', 'news_categories.page_category_id = page_category.id');
	    $this->db->where("news_categories.news_id", $id);
	    $this->db->where("page_category.approved", 1);
     	$this->db->where('page_category.deleted !=', 1);
	    $query = $this->db->get();
        return $query->result();
	}

	function get_by_newscat($newscat_id)
	{
	    $this->db->select('news.*');
	    $this->db->from('news');
	    $this->db->join('news_categories', 'news_categories.news_id = news.id');
	    
	    $this->db->where("news_categories.page_category_id", $newscat_id);
	    $this->db->where("page.approved", 1);
     	$this->db->where('page.deleted !=', 1);
     	$this->db->order_by("id", "desc");
     	
	    $query = $this->db->get();
        return $query->result();
	}
	
		
	function get_by_writer($writer_id, $limit=10)
	{
	    $this->db->select('news.*');
	    $this->db->from('news');
	    $this->db->where("news.writer_id", $writer_id);
	    $this->db->where("news.approved", 1);
     	$this->db->where('news.deleted !=', 1);
     	$this->db->limit($limit);
     	
     	$this->db->order_by("id", "desc");
     	
	    $query = $this->db->get();
        return $query->result();
	}
	
	
}
?>