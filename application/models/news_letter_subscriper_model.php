<?php
/**
 * News_letter_subscriper Model.
 *
 * It is news_letter_subscriper model file include the news_letter_subscriper database process class news_letter_subscriper_model.
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
 * News_letter_subscriper Model Class.
 *
 * This class manages the processes on the database table news_letter_subscriper
 *
 * @package		models
 * @category	Database
 * @author		Eng Gouda Elalfy <goudaelalfy@hotmail.com>
 */
class News_letter_subscriper_model extends My_Model
{
	/**
	 * store this news_letter_subscriper table name.
	 *
	 * @var string
	 * @access public
	 */
	public $table='news_letter_subscriper';
   	
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