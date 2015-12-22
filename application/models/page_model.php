<?php
/**
 * Page Model.
 *
 * It is page model file include the page database process class page_model.
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
 * Page Model Class.
 *
 * This class manages the processes on the database table page
 *
 * @package		models
 * @category	Database
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Page_model extends My_Model
{
	/**
	 * store this page table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='page';
   	
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
	
	function get_page_types_by_id($id)
	{
	    $this->db->select('page_types.*, page_type.name, page_type.name_ar');
	    $this->db->from('page_types');
	    $this->db->join('page_type', 'page_types.page_type_id = page_type.id');
	    $this->db->where("page_types.page_id", $id);
	     $this->db->where("page_type.approved", 1);
     	$this->db->where('page_type.deleted !=', 1);
	    $query = $this->db->get();
        return $query->result();
	}
	
	function get_page_categories_by_id($id)
	{
	    $this->db->select('page_categories.*, page_category.name, page_category.name_ar');
	    $this->db->from('page_categories');
	    $this->db->join('page_category', 'page_categories.page_category_id = page_category.id');
	    $this->db->where("page_categories.page_id", $id);
	    $this->db->where("page_category.approved", 1);
     	$this->db->where('page_category.deleted !=', 1);
	    $query = $this->db->get();
        return $query->result();
	}
		
	function get_page_pages_by_id($id)
	{
	    $this->db->select('page_pages.*,page.alias, page.title, page.title_ar, writer.alias as writer_alias, writer.name as writer_name, writer.name_ar as writer_name_ar');
	    $this->db->from('page_pages');
	    $this->db->join('page', 'page_pages.page_page_id = page.id');
	   	$this->db->join('writer', 'writer.id = page.writer_id', 'left');
	    $this->db->where("page_pages.page_id", $id);
	     $this->db->where("page.approved", 1);
     	$this->db->where('page.deleted !=', 1);
	    $query = $this->db->get();
        return $query->result();
	}
	
	function get_by_writer($writer_id, $limit=10)
	{
	    $this->db->select('page.*, writer.alias as writer_alias, writer.name as writer_name, writer.name_ar as writer_name_ar');
	    $this->db->from('page');
	    $this->db->join('writer', 'writer.id = page.writer_id', 'left');
	    
	    $this->db->where("page.writer_id", $writer_id);
	    $this->db->where("page.approved", 1);
     	$this->db->where('page.deleted !=', 1);
     	$this->db->limit($limit);
     	
     	$this->db->order_by("id", "desc");
     	
	    $query = $this->db->get();
        return $query->result();
	}
	
	/*
	 * For paging where id less the passed id
	*/
	function get_by_writer_id_less_than($writer_id, $id, $limit='')
	{
	    $this->db->select('page.*, writer.alias as writer_alias, writer.name as writer_name, writer.name_ar as writer_name_ar');
	    $this->db->from('page');
	    $this->db->join('writer', 'writer.id = page.writer_id', 'left');
	    
	    $this->db->where("writer.id", $writer_id);
	    $this->db->where("page.id < ", $id);
	    
	    $this->db->where("page.approved", 1);
     	$this->db->where('page.deleted !=', 1);
     	
		if($limit!='') {
     		$this->db->limit($limit);
     	}
     	
     	$this->db->order_by("id", "desc");
     	
	    $query = $this->db->get();
        return $query->result();
	}
	
	function get_by_pagecat($pagecat_id, $limit='')
	{
	    $this->db->select('page.*, writer.alias as writer_alias, writer.name as writer_name, writer.name_ar as writer_name_ar');
	    $this->db->from('page');
	    $this->db->join('page_categories', 'page_categories.page_id = page.id');
	    $this->db->join('writer', 'writer.id = page.writer_id');
	    
	    $this->db->where("page_categories.page_category_id", $pagecat_id);
	    $this->db->where("page.approved", 1);
     	$this->db->where('page.deleted !=', 1);
     	
     	if($limit!='') {
     		$this->db->limit($limit);
     	}
     	
     	$this->db->order_by("id", "desc");
     	
	    $query = $this->db->get();
        return $query->result();
	}
	
	/*
	 * For paging where id less the passed id
	 */
	function get_by_pagecat_id_less_than($pagecat_id, $id, $limit='')
	{
	    $this->db->select('page.*, writer.alias as writer_alias, writer.name as writer_name, writer.name_ar as writer_name_ar');
	    $this->db->from('page');
	    $this->db->join('page_categories', 'page_categories.page_id = page.id');
	    $this->db->join('writer', 'writer.id = page.writer_id', 'left');
	    
	    $this->db->where("page_categories.page_category_id", $pagecat_id);
	    $this->db->where("page.id < ", $id);
	    
	    $this->db->where("page.approved", 1);
     	$this->db->where('page.deleted !=', 1);
     	
		if($limit!='') {
     		$this->db->limit($limit);
     	}
     	
     	$this->db->order_by("id", "desc");
     	
	    $query = $this->db->get();
        return $query->result();
	}
	
	function get_by_pagetype($pagetype_id, $limit='')
	{
	    $this->db->select('page.*, writer.alias as writer_alias, writer.name as writer_name, writer.name_ar as writer_name_ar');
	    $this->db->from('page');
	    $this->db->join('page_types', 'page_types.page_id = page.id');
	    $this->db->join('writer', 'writer.id = page.writer_id', 'left');
	    
	    $this->db->where("page_types.page_type_id", $pagetype_id);
	    $this->db->where("page.approved", 1);
     	$this->db->where('page.deleted !=', 1);
     	
		if($limit!='') {
     		$this->db->limit($limit);
     	}
     	
     	$this->db->order_by("id", "desc");
     	
	    $query = $this->db->get();
        return $query->result();
	}
	
	/*
	 * For paging where id less the passed id
	 */
	function get_by_pagetype_id_less_than($pagetype_id, $id, $limit='')
	{
	    $this->db->select('page.*, writer.alias as writer_alias, writer.name as writer_name, writer.name_ar as writer_name_ar');
	    $this->db->from('page');
	    $this->db->join('page_types', 'page_types.page_id = page.id');
	    $this->db->join('writer', 'writer.id = page.writer_id', 'left');
	    
	    $this->db->where("page_types.page_type_id", $pagetype_id);
	    $this->db->where("page.id < ", $id);
	    
	    $this->db->where("page.approved", 1);
     	$this->db->where('page.deleted !=', 1);
     	
		if($limit!='') {
     		$this->db->limit($limit);
     	}
     	
     	$this->db->order_by("id", "desc");
     	
	    $query = $this->db->get();
        return $query->result();
	}
	
	function get_by_pagetypes_and_pagecategories($pagetype_id, $pagecat_id , $limit='')
	{
		
	    $this->db->select('page.`id`,  page.`alias`, page.`banner_image_thumbs`, page.`banner_files`, page.`banner_image_thumb_selected`, page.`banner_file_selected`, page.`title`,  page.`title_ar`, page.`seo_words`, page.`seo_words_ar`, page.`brief`, page.`brief_ar`,  page.`last_modify_date`, writer.alias as writer_alias, writer.name as writer_name, writer.name_ar as writer_name_ar');
	    $this->db->from('page');
	    $this->db->join('page_types', 'page_types.page_id = page.id');
	    $this->db->join('page_categories', 'page_categories.page_id = page.id');
	    
	    $this->db->join('writer', 'writer.id = page.writer_id', 'left');
	    
	    $this->db->where("page_types.page_type_id", $pagetype_id);
	    $this->db->where("page_categories.page_category_id", $pagecat_id);
	    
	    $this->db->where("page.approved", 1);
     	$this->db->where('page.deleted !=', 1);
     	
		if($limit!='') {
     		$this->db->limit($limit);
     	}
     	
     	$this->db->order_by("id", "desc");
     	
	    $query = $this->db->get();
        return $query->result();
	}
	
	function get_by_pagetypes_and_pagecategories_less_than($pagetype_id, $pagecat_id, $id, $limit='')
	{
	    $this->db->select('page.*, writer.alias as writer_alias, writer.name as writer_name, writer.name_ar as writer_name_ar');
	    $this->db->from('page');
	    $this->db->join('page_types', 'page_types.page_id = page.id');
	    $this->db->join('page_categories', 'page_categories.page_id = page.id');
	    
	    $this->db->join('writer', 'writer.id = page.writer_id', 'left');
	    
	    $this->db->where("page_types.page_type_id", $pagetype_id);
	    $this->db->where("page_categories.page_category_id", $pagecat_id);
	    $this->db->where("page.id < ", $id);
	    
	    $this->db->where("page.approved", 1);
     	$this->db->where('page.deleted !=', 1);
     	
     	if($limit!='') {
     		$this->db->limit($limit);
     	}
     	
     	
     	$this->db->order_by("id", "desc");
     	
	    $query = $this->db->get();
        return $query->result();
	}
	
	
	
	function get_by_keyword($keyword, $limit='')
	{
	    $this->db->select('page.*, writer.alias as writer_alias, writer.name as writer_name, writer.name_ar as writer_name_ar');
	    $this->db->from('page');
	    $this->db->join('page_categories', 'page_categories.page_id = page.id');
	    $this->db->join('writer', 'writer.id = page.writer_id', 'left');
	    
	    $this->db->where("page.alias like '%$keyword%' 
	    or page.title like '%$keyword%' or page.title_ar like '%$keyword%' 
	    or page.brief like '%$keyword%' or page.brief_ar like '%$keyword%' ");
	    
	    $this->db->where("page.approved", 1);
     	$this->db->where('page.deleted !=', 1);
     	
		if($limit!='') {
     		$this->db->limit($limit);
     	}
     	
     	$this->db->order_by("id", "desc");
     	
	    $query = $this->db->get();
        return $query->result();
	}
	/*
	 * For paging where id less the passed id
	 */
	function get_by_keyword_less_than($keyword, $id, $limit='')
	{
	    $this->db->select('page.*, writer.alias as writer_alias, writer.name as writer_name, writer.name_ar as writer_name_ar');
	    $this->db->from('page');
	    $this->db->join('page_categories', 'page_categories.page_id = page.id');
	    $this->db->join('writer', 'writer.id = page.writer_id', 'left');
	    
	    $this->db->where("page.alias like '%$keyword%' 
	    or page.title like '%$keyword%' or page.title_ar like '%$keyword%' 
	    or page.brief like '%$keyword%' or page.brief_ar like '%$keyword%' ");
	    $this->db->where("page.id < ", $id);
	    
	    $this->db->where("page.approved", 1);
     	$this->db->where('page.deleted !=', 1);
     	
		if($limit!='') {
     		$this->db->limit($limit);
     	}
     	
     	$this->db->order_by("id", "desc");
     	
	    $query = $this->db->get();
        return $query->result();
	}
	
	
	function get_joined_by_alias($alias)
    {
	    $this->db->select('page.*, writer.alias as writer_alias, writer.name as writer_name, writer.name_ar as writer_name_ar');
	    $this->db->from('page');
	    
	    $this->db->join('writer', 'writer.id = page.writer_id', 'left');
	    $this->db->where("page.alias", $alias);
        $query = $this->db->get();
	    return ($query->num_rows > 0) ? $query->row() : array();
	 }
	
	function updatePictureID($table='', $alias ,$data)
	{	
		if($table=='') {
			$table=$this->table;
		}
		
	   	$this->db->where('alias', $alias);
        return $this->db->update($table, $data); 
	}
	
	function updateByPictureId($table='', $picture_id ,$data)
	{	
		if($table=='') {
			$table=$this->table;
		}
		
	   	$this->db->where('picture_id_old', $picture_id);
        return $this->db->update($table, $data); 
	}
	
	/*
	function get_all($table='')
	{
		if($table=='') {
			$table=$this->table;
		}
	    $this->db->select('picture_id_old');
	    $this->db->where('id < 15');
	    $this->db->where('id > 0');
	    $this->db->order_by("id", "desc");
	    $query = $this->db->get($table);
        return $query->result();
	}
	*/
	
	function get_banner_file_selected_by_alias($alias, $table='')
    {
    	if($table=='') {
			$table=$this->table;
		}
	    $this->db->select('banner_file_selected');
	    $this->db->where("alias", $alias);
	    $query = $this->db->get($table);
        return ($query->num_rows > 0) ? $query->row() : array();
	 }
}
?>