<?php
/**
 * Pagetype Model.
 *
 * It is page model file include the page_type database process class Pagetype_model.
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
 * Pagetype Model Class.
 *
 * This class manages the processes on the database table page_type
 *
 * @package		models
 * @category	Database
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class Pagetype_model extends My_Model
{
   	/**
	 * store this page_type table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='page_type';
	
	/**
	 * Constructor
	 *
	 * @access public
	*/
	function Main_model()
	{
		parent::__construct();
	}
		
}
?>