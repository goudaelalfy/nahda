<?php
/**
 * Video Model.
 *
 * It is video model file include the video database process class video_model.
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
 * Video Model Class.
 *
 * This class manages the processes on the database table video
 *
 * @package		models
 * @category	Database
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Video_model extends My_Model
{
	/**
	 * store this video table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='video';
   	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	function Main_model()
	{
		parent::__construct();
	}
		
	function get_video_categories_by_id($id)
	{
	    $this->db->select('video_categories.*, page_category.name, page_category.name_ar');
	    $this->db->from('video_categories');
	    $this->db->join('page_category', 'video_categories.page_category_id = page_category.id');
	    $this->db->where("video_categories.video_id", $id);
	    $this->db->where("page_category.approved", 1);
     	$this->db->where('page_category.deleted !=', 1);
	    $query = $this->db->get();
        return $query->result();
	}

	function get_by_videocat($videocat_id, $limit='')
	{
	    $this->db->select('video.`id`,  video.`alias`, video.`banner_image_thumbs`, video.`banner_files`, video.`banner_image_thumb_selected`, video.`banner_file_selected`, video.`title`,  video.`title_ar`, video.`seo_words`, video.`seo_words_ar`, video.`brief`, video.`brief_ar`,  video.`last_modify_date`, writer.alias as writer_alias, writer.name as writer_name, writer.name_ar as writer_name_ar');

	    $this->db->from('video');
	    $this->db->join('video_categories', 'video_categories.video_id = video.id');
	    $this->db->join('writer', 'writer.id = video.writer_id', 'left');
	    
	    $this->db->where("video_categories.page_category_id", $videocat_id);
	    $this->db->where("video.approved", 1);
     	$this->db->where('video.deleted !=', 1);
	
     	if($limit!='') {
     		$this->db->limit($limit);
     	}
     	
     	$this->db->order_by("id", "desc");
     	
	    $query = $this->db->get();
        return $query->result();
	}
	
	function get_all_limit($limit='')
	{
	    $this->db->select('video.`id`,  video.`alias`, video.`video_link`, video.`banner_image_thumbs`, video.`banner_files`, video.`banner_image_thumb_selected`, video.`banner_file_selected`, video.`title`,  video.`title_ar`, video.`seo_words`, video.`seo_words_ar`, video.`brief`, video.`brief_ar`,  video.`last_modify_date`');

	    $this->db->from('video');
	    
	    $this->db->where("video.approved", 1);
     	$this->db->where('video.deleted !=', 1);
	
     	if($limit!='') {
     		$this->db->limit($limit);
     	}
     	
     	$this->db->order_by("id", "desc");
     	
	    $query = $this->db->get();
        return $query->result();
	}

}
?>