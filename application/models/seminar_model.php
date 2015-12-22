<?php
/**
 * Seminar Model.
 *
 * It is seminar model file include the seminar database process class seminar_model.
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
 * Seminar Model Class.
 *
 * This class manages the processes on the database table seminar
 *
 * @package		models
 * @category	Database
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Seminar_model extends My_Model
{
	/**
	 * store this seminar table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='seminar';
   	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	function Main_model()
	{
		parent::__construct();
	}
		
	function get_seminar_categories_by_id($id)
	{
	    $this->db->select('seminar_categories.*, page_category.name, page_category.name_ar');
	    $this->db->from('seminar_categories');
	    $this->db->join('page_category', 'seminar_categories.page_category_id = page_category.id');
	    $this->db->where("seminar_categories.seminar_id", $id);
	    $this->db->where("page_category.approved", 1);
     	$this->db->where('page_category.deleted !=', 1);
	    $query = $this->db->get();
        return $query->result();
	}

	function get_by_seminarcat($seminarcat_id, $limit='')
	{
	    $this->db->select('seminar.`id`,  seminar.`alias`, seminar.`banner_image_thumbs`, seminar.`banner_files`, seminar.`banner_image_thumb_selected`, seminar.`banner_file_selected`, seminar.`title`,  seminar.`title_ar`, seminar.`seo_words`, seminar.`seo_words_ar`, seminar.`brief`, seminar.`brief_ar`,  seminar.`last_modify_date`, writer.alias as writer_alias, writer.name as writer_name, writer.name_ar as writer_name_ar');

	    $this->db->from('seminar');
	    $this->db->join('seminar_categories', 'seminar_categories.seminar_id = seminar.id');
	    $this->db->join('writer', 'writer.id = seminar.writer_id', 'left');
	    
	    $this->db->where("seminar_categories.page_category_id", $seminarcat_id);
	    $this->db->where("seminar.approved", 1);
     	$this->db->where('seminar.deleted !=', 1);
     	if($limit!='') {
     		$this->db->limit($limit);
     	}
     	
     	$this->db->order_by("id", "desc");
     	
	    $query = $this->db->get();
        return $query->result();
	}

}
?>