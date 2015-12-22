<?php
/**
 * Sql controller file.
 *
 * Contains controller class of the page_category table.
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
 * Controller class of the page_category table.
 *
 * This is the controller class of the page_category table. between model and view, in MVC design pattern.
 *
 * @package		admin
 * @category	controller
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Sql extends My_Controller
{ 	
	/**
	 * store this controller pagecat screen id.
	 *
	 * @var int
	 * @access public
	 */
	public $screen_id=32;
	
	/**
	 * store this controller page_category table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='page_category';
	
	/**
	 * store table fields to display in table.
	 *
	 * @var string
	 * @access public
	 */
	public $table_fields_to_display=" id,alias,  name,  name_ar, approved ";
	
	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('News_model', 'News_model' , True);
		$this->load->model('Page_model', 'Page_model' , True);
		$this->load->model('Pagetypes_model', 'Pagetypes_model' , True);
		$this->load->model('Writer_model', 'Writer_model' , True);
		
	}
	
	public function importNews()
	{
		$rows=$this->News_model->get_all_including_deleted('nop_news'); 
        foreach($rows as $row) {
        	$data = array(
		
						'id' => $row->NewsID,
						'alias' => $row->Title,
					    'title' => $row->Title,
						'title_ar' => $row->Title,
						'seo_words' => $row->Title,
					    'seo_words_ar' => $row->Title,
					    'brief' => $row->Short,
						'brief_ar' => $row->Short,
					    'body' => $row->Full,
						'body_ar' => $row->Full,
						'approved' => $row->Published,
						'deleted' => 0,
						'last_user_id' => $this->session->userdata('user_session')->id,
						'last_modify_date' =>$row->CreatedOn,
						);
						 
						//$this->News_model->insertIgnore('news', $data);
        }
	}
	
	
	public function importPages()
	{
			
		$rows=$this->News_model->get_all_including_deleted('nop_news'); 
        foreach($rows as $row) {
        	$data = array(
		
						//'id' => $row->ProductId,
						'alias' => $row->Title,
					    'title' => $row->Title,
						'title_ar' => $row->Title,
						'seo_words' => $row->Title,
					    'seo_words_ar' => $row->Title,
					    'brief' => $row->Short,
						'brief_ar' => $row->Short,
					    'body' => $row->Full,
						'body_ar' => $row->Full,
        				'picture_id_old' =>  $row->PictureId,
						'approved' => 1,
						'deleted' => 0,
						'last_user_id' => $this->session->userdata('user_session')->id,
						'last_modify_date' =>$row->CreatedOn,
						);
						 
						$this->Page_model->insertIgnore('page', $data);
						$id=$this->Page_model->get_max_id('page');
					
						$data_types = array(
						'page_id' => $id,
						'page_type_id' => 2,
						);
						 
						$this->Pagetypes_model->insertToImport('page_types', $data_types);
        }
	}

	public function updateAlias()
	{
		//$rows=$this->News_model->get_all_including_deleted('nop_news'); 
        foreach($rows as $row) {
        	$alias=str_replace('(','',$row->alias);
        	$alias=str_replace(')','',$alias);
        	
        	$data = array(
		
						
						'alias' =>  $alias,
					   
						);
						 
						//$this->Page_model->update('page', $row->id,$data);
					
						
        }
	}
	
	public function updatePhotoPath()
	{
		$rows=$this->Page_model->get_all(); 
        foreach($rows as $row) {
        	$picture_id_old=$row->picture_id_old;
        	
        	$banner_files = '';
			$banner_image_thumbs= '';
			$banner_file_selected = '';
			$banner_image_thumb_selected= '';
		        	
        	
        	$extension='jpeg';
        	
        	
        	//$ssss=getcwd().'/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
        	
        	if(file_exists(getcwd().'/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension)) {
        	
        	$banner_files = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
			$banner_image_thumbs= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
			$banner_file_selected = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
			$banner_image_thumb_selected= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
        	} else {
        		
        		$extension='jpg';
	        	if(file_exists(getcwd().'/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension)) {
	        	
	        	$banner_files = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_image_thumbs= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_file_selected = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_image_thumb_selected= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
	        	} else {
        		$extension='png';
	        	if(file_exists(getcwd().'/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension)) {
	        	
	        	$banner_files = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_image_thumbs= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_file_selected = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_image_thumb_selected= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
	        	} else {
        		$extension='gif';
	        	if(file_exists(getcwd().'/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension)) {
	        	
	        	$banner_files = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_image_thumbs= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_file_selected = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_image_thumb_selected= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
	        	} else {
	        		$extension='bmp';
	        	if(file_exists(getcwd().'/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension)) {
	        	
	        	$banner_files = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_image_thumbs= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_file_selected = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_image_thumb_selected= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
	        	} else {
	        		$extension='pjpeg';
		        	if(file_exists(getcwd().'/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension)) {
		        	
		        	$banner_files = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
					$banner_image_thumbs= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
					$banner_file_selected = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
					$banner_image_thumb_selected= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
		        	
	        	}
	        	}
        	}
	        	}		
        	
        	}	
        	}
        	
        	$data = array(
				'banner_image_thumbs' => $banner_image_thumbs ,
               	'banner_files' => $banner_files,
				'banner_image_thumb_selected' => $banner_image_thumb_selected ,
				'banner_file_selected' => $banner_file_selected ,
				);
						 
			$this->Page_model->updateByPictureId('page', $picture_id_old,$data);
        	
						
        }
	}
	
	public function updatePhotoPathForWriters()
	{
		$rows=$this->Writer_model->get_all(); 
        foreach($rows as $row) {
        	$picture_id_old=$row->picture_id_old;
        	
        	$banner_files = '';
			$banner_image_thumbs= '';
			$banner_file_selected = '';
			$banner_image_thumb_selected= '';
		        	
        	
        	$extension='jpeg';
        	
        	
        	//$ssss=getcwd().'/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
        	
        	if(file_exists(getcwd().'/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension)) {
        	
        	$banner_files = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
			$banner_image_thumbs= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
			$banner_file_selected = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
			$banner_image_thumb_selected= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
        	} else {
        		
        		$extension='jpg';
	        	if(file_exists(getcwd().'/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension)) {
	        	
	        	$banner_files = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_image_thumbs= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_file_selected = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_image_thumb_selected= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
	        	} else {
        		$extension='png';
	        	if(file_exists(getcwd().'/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension)) {
	        	
	        	$banner_files = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_image_thumbs= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_file_selected = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_image_thumb_selected= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
	        	} else {
        		$extension='gif';
	        	if(file_exists(getcwd().'/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension)) {
	        	
	        	$banner_files = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_image_thumbs= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_file_selected = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_image_thumb_selected= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
	        	} else {
	        		$extension='bmp';
	        	if(file_exists(getcwd().'/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension)) {
	        	
	        	$banner_files = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_image_thumbs= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_file_selected = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
				$banner_image_thumb_selected= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
	        	} else {
	        		$extension='pjpeg';
		        	if(file_exists(getcwd().'/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension)) {
		        	
		        	$banner_files = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
					$banner_image_thumbs= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
					$banner_file_selected = '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
					$banner_image_thumb_selected= '/added/uploads/banner/page/articles_writers/'.$picture_id_old.'.'.$extension;
		        	
	        	}
	        	}
        	}
	        	}		
        	
        	}	
        	}
        	
        	$data = array(
				'banner_image_thumbs' => $banner_image_thumbs ,
               	'banner_files' => $banner_files,
				'banner_image_thumb_selected' => $banner_image_thumb_selected ,
				'banner_file_selected' => $banner_file_selected ,
				);
						 
			$this->Writer_model->updateByPictureId('writer', $picture_id_old,$data);
        	
						
        }
	}
	
	public function updatePhotoId()
	{
		//$rows=$this->News_model->get_all_including_deleted('nop_news'); 
        foreach($rows as $row) {
        	$picture_id=$row->PictureId;
        	$news_title=$row->Title;
        	
        	$data = array(
			'picture_id_old' =>  $picture_id,
			);
						 
			//$this->Page_model->updatePictureID('page', $news_title ,$data);
        }
	}
	
	public function ImportImages()
	{
		$row=$this->News_model->get_by_id('news_image',5735); 
        //foreach($rows as $row) {
        	
	        $image_id = $row->picture_id;
			$image_binary = $row->binary;
			$image_type = $row->mimetype;
				  
			/*
			header ("Content-Type: $image_type\n");
			header ("Content-disposition: inline; filename=\"$image_id\"\ n");
			//header ("Content-Length: {$row['image_size']}\n");
			echo "<img src='data:image/jpeg;base64{$image_binary}' />";;
			*/
			
			header("Content-type: image/jpeg");
			echo $image_binary; 
			exit;
			
			
        	/*
        	$data = array(
			'picture_id_old' =>  $picture_id,
			);
						 
			$this->Page_model->updatePictureID('page', $news_title ,$data);
			*/
        //}
	}
	
}